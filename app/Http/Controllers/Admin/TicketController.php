<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $this->data['ticket_list'] = Ticket::with('get_user')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.tickets.ticket_lists')->with($this->data);
    }

    public function saveTicket(Request $request)
    {
        $rules = [
            'status'  => 'required',
        ];
        $request->validate($rules);
        try {
            Ticket::where('id', $request->ticket_id)->update([
                'status' => $request->status,
            ]);
            $ticket = Ticket::where('id', $request->ticket_id)->first();

            $statusLabels = [
                'pending'     => 'Pending',
                'in_progress' => 'In Progress',
                'on_hold'     => 'On Hold',
                'resolved'    => 'Resolved',
                'rejected'    => 'Rejected',
            ];
            $status = $statusLabels[$request->status] ?? ucfirst($request->status);

            Notification::notifyUser(
                $ticket->user_id,
                'Support Ticket ' . $status,
                "Your support ticket #{$ticket->id} is now {$status}."
            );

            return response()->json([
                'success' => true,
                'message' => 'Ticket status updated successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save ticket status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
