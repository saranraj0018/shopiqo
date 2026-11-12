<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Public vendor application — creates an unapproved Admin account (role
     * "Vendor"). Login is blocked (see AuthController::adminAuthenticate)
     * until an admin approves it from the Vendors screen.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', 'max:255', 'unique:admins,email'],
            'phone_number'     => ['required', 'digits:10'],
            'password'         => ['required', 'string', 'min:8'],
            'business_name'    => ['required', 'string', 'max:255'],
            'business_type'    => ['nullable', 'string', 'max:255'],
            'gst_number'       => ['nullable', 'string', 'max:50'],
            'business_address' => ['nullable', 'string', 'max:1000'],
            'products_offered' => ['nullable', 'string', 'max:1000'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $vendorRoleId = Role::where('slug', 'vendor')->value('id');

        $admin = new Admin();
        $admin->role_id          = $vendorRoleId;
        $admin->name             = $request->full_name;
        $admin->email            = $request->email;
        $admin->password         = Hash::make($request->password);
        $admin->mobile_number    = $request->phone_number;
        $admin->business_name    = $request->business_name;
        $admin->business_type    = $request->business_type;
        $admin->gst_number       = $request->gst_number;
        $admin->business_address = $request->business_address;
        $admin->products_offered = $request->products_offered;
        $admin->is_approved      = false;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => "Application submitted! We'll review your details and notify you once approved.",
        ]);
    }
}
