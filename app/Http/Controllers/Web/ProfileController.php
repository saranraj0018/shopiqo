<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Single entry point for every /profile/* page — the sidebar links are
     * plain GETs and frontend.profile.index picks the right partial based on
     * the request path, so we load only the data that partial needs.
     */
    public function index(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return redirect()->route('login');
        }
        $user = $guard->user();

        $data = [
            'title' => 'My Profile',
            'user'  => $user,
            'unreadNotificationCount' => Notification::where('user_id', $user->id)
                ->where('role', Notification::ROLE_USER)
                ->where('status', Notification::STATUS_UNREAD)
                ->count(),
        ];

        if ($request->is('profile/address')) {
            $data['title'] = 'My Address';
            $data['addresses'] = Address::where('user_id', $user->id)
                ->latest()
                ->get();
        } elseif ($request->is('profile/orders-activity')) {
            $data['title'] = 'Orders & Activity';
            $data['orders'] = Order::with(['orderDetails', 'payment'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        } elseif ($request->is('profile/notification')) {
            $data['title'] = 'Notifications';
            $data['notifications'] = Notification::where('user_id', $user->id)
                ->where('role', Notification::ROLE_USER)
                ->latest()
                ->get();

            // Viewing the page marks everything read — same convention as
            // most notification inboxes (Gmail, GitHub, etc).
            Notification::where('user_id', $user->id)
                ->where('role', Notification::ROLE_USER)
                ->where('status', Notification::STATUS_UNREAD)
                ->update(['status' => Notification::STATUS_READ]);
        } elseif ($request->is('profile/support-help')) {
            $data['title'] = 'Support & Help';
            $data['tickets'] = Ticket::where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('frontend.profile.index', $data);
    }

    public function update(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['success' => false, 'message' => 'Please log in again.'], 401);
        }
        $user = $guard->user();

        // Company/GST only apply to business accounts — the personal signup
        // form never collects them, so requiring them here would lock
        // personal buyers out of saving their own profile.
        $isBusiness = $user->buyer_type === 'business';

        $validator = Validator::make($request->all(), [
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['required', 'digits:10'],
            'company_name' => [$isBusiness ? 'required' : 'nullable', 'string', 'max:255'],
            'gst_number'   => [$isBusiness ? 'required' : 'nullable', 'string', 'max:50'],
            'password'     => ['nullable', 'string', 'min:8'],
            // Capped to match this server's php.ini upload_max_filesize (2M) —
            // anything larger gets truncated by PHP before Laravel ever sees
            // it, which used to fail validation with a confusing generic
            // "failed to upload" message instead of a real size error.
            'profile_photo' => ['nullable', 'image', 'max:2000'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone_number;
        $user->company_name = $request->company_name;
        $user->gst_number = $request->gst_number;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            $imgName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->storeAs('profile-photos', $imgName, 'public');
            $user->image = 'profile-photos/' . $imgName;
        }

        $user->save();
        session()->put('user', $user);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user'    => $user,
        ]);
    }
}
