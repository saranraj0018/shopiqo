<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
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
            $update = Ticket::where('id', $request->ticket_id)->update([
                'status' => $request->status,
            ]);
            $ticket = Ticket::where('id', $request->ticket_id)->first();
            $user = User::where('id', $ticket->user_id)->first();
            if ($request->status == 'in_progress') {
                $status = 'In Progress';
            } else if ($request->status == 'on_hold') {
                $status = 'On Hold';
            } else if ($request->status == 'resolved') {
                $status = 'Resolved';
            } else if ($request->status == 'rejected') {
                $status = 'Rejected';
            }

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
