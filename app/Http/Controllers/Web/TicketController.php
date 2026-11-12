<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Logo creation requests are stored as support tickets so admins triage
     * them through the same "Support & Help" queue as everything else.
     */
    public function store(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate([
            'product_id'   => 'nullable|exists:products,id',
            'instructions' => 'nullable|string|max:1000',
            'image'        => 'required|image|max:5120',
        ]);

        $product = $request->product_id ? Product::find($request->product_id) : null;

        $description = 'Logo creation request' . ($product ? " for \"{$product->name}\"" : '') . '.';
        if ($request->filled('instructions')) {
            $description .= ' ' . trim($request->instructions);
        }

        $ticket = new Ticket();
        $ticket->user_id = $guard->id();
        $ticket->description = $description;
        $ticket->status = 'pending';

        $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('logo-requests', $imgName, 'public');
        $ticket->image = 'logo-requests/' . $imgName;

        $ticket->save();

        return response()->json([
            'status'  => 'saved',
            'message' => 'Request submitted — we\'ll get back to you within 24-48 hours.',
        ]);
    }

    /**
     * Support & Help page's own ticket form — a plain description + optional
     * screenshot, not tied to a specific product like the logo request above.
     */
    public function storeSupport(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['success' => false, 'message' => 'Please log in again.'], 401);
        }

        $request->validate([
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|max:5120',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = $guard->id();
        $ticket->description = $request->description;
        $ticket->status = 'pending';

        if ($request->hasFile('image')) {
            $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('support-tickets', $imgName, 'public');
            $ticket->image = 'support-tickets/' . $imgName;
        }

        $ticket->save();

        return response()->json([
            'success' => true,
            'message' => 'Support ticket submitted successfully.',
            'ticket'  => $ticket,
        ]);
    }
}
