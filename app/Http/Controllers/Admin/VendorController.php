<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function view()
    {
        $this->data['vendors'] = Admin::where('role_id', 2)
            ->orderByRaw('is_approved asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.vendors.view')->with($this->data);
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|exists:admins,id']);

        Admin::where('id', $request->id)->update(['is_approved' => true]);

        return response()->json(['success' => true, 'message' => 'Vendor approved successfully']);
    }

    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|exists:admins,id']);

        $vendor = Admin::where('id', $request->id)->where('role_id', 2)->first();
        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found'], 404);
        }
        $vendor->delete();

        return response()->json(['success' => true, 'message' => 'Vendor application rejected']);
    }
}
