<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderSampleStageLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function view(Request $request)
    {
        $orders = Order::with('user', 'orderDetails', 'payment', 'sampleStageLogs')->whereHas('payment', function ($q) {
            $q->where('status', 'PAID');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.orders.view', compact('orders'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required',
                'status'   => 'required|integer',
                'date'     => 'required|date',
                'id'       => 'required|exists:orders,id',
            ]);
            $order = Order::with('user')->findOrFail($validated['id']);
            $user  = $order->user;
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            $status = (int) $validated['status'];
            $date   = $validated['date'];
            // Update status timestamps
            switch ($status) {
                case 3:
                    $order->shipped_at = $date;
                    break;
                case 4:
                    $order->delivered_at = $date;
                    break;
                case 5:
                    $order->cancelled_at = $date;
                    break;
                case 6:
                    $order->refunded_at = $date;
                    break;
            }
            $order->status = $status;
            if ($request->hasFile('refund_image')) {
                $img_name = time() . '_' . $request->file('refund_image')->getClientOriginalName();
                $request->file('refund_image')->storeAs('refunds', $img_name, 'public');
                $order->refund_image = 'refunds/' . $img_name;
            } elseif ($request->has('existing_image')) {
                $order->refund_image = $request->existing_image;
            }
            if ($request->has('refund_note')) {
                $order->refund_note = $request->refund_note;
            }

            $order->save(); // Save first (important)

            Notification::notifyUser(
                $user->id,
                'Order ' . $order->status_label,
                "Your order {$order->order_id} is now {$order->status_label}."
            );

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        } catch (\Throwable $e) {
            Log::error('Update Status Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    /**
     * Advances (or replays) the sample production stage shown on the
     * customer's Sample Process / Sample Review pages, logging a dated
     * timeline entry each time — mirrors updateStatus() above but for the
     * sample workflow instead of the shipping workflow.
     */
    public function updateSampleStage(Request $request)
    {
        $validated = $request->validate([
            'id'    => 'required|exists:orders,id',
            'stage' => 'required|integer|min:1|max:5',
            'note'  => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($validated['id']);
        $order->sample_stage = (int) $validated['stage'];
        $order->save();

        OrderSampleStageLog::create([
            'order_id'   => $order->id,
            'stage'      => $validated['stage'],
            'note'       => $validated['note'] ?? null,
            'created_by' => Auth::guard('admin')->id(),
        ]);

        Notification::notifyUser(
            (int) $order->user_id,
            'Sample Update: ' . $order->sample_stage_label,
            "Order {$order->order_id}'s sample is now at: {$order->sample_stage_label}." . (!empty($validated['note']) ? ' ' . $validated['note'] : '')
        );

        return response()->json([
            'success' => true,
            'message' => 'Sample stage updated',
        ]);
    }
}
