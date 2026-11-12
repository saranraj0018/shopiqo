<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function adminAuthenticate(Request $request)
    {
        $wantsJson = $request->expectsJson();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!$validator->passes()) {
            if ($wantsJson) {
                return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
        if (!Auth::guard('admin')->attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ], $request->boolean('remember'))) {
            if ($wantsJson) {
                return response()->json(['success' => false, 'message' => 'Either Email/Password is incorrect'], 401);
            }
            return redirect()->route('admin.login')->withErrors(['password' => 'Either Email/Password is incorrect'])
                ->withInput($request->only('email'));
        }

        $admin = Auth::guard('admin')->user();

        // Vendors who self-registered from the storefront start unapproved —
        // everyone else (seeded admins, code-gated /admin/register signups) is
        // approved by default, so this only ever blocks pending vendors.
        if (!$admin->is_approved) {
            Auth::guard('admin')->logout();
            $message = 'Your vendor account is still pending approval. We\'ll notify you once it\'s reviewed.';
            if ($wantsJson) {
                return response()->json(['success' => false, 'message' => $message], 403);
            }
            return redirect()->route('admin.login')
                ->withErrors(['email' => $message])
                ->withInput($request->only('email'));
        }

        session()->put('user', $admin);

        if ($wantsJson) {
            return response()->json(['success' => true, 'message' => 'Login successful', 'redirect' => route('dashboard')]);
        }
        return redirect()->route('dashboard');
    }

    public function registerUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'digits:10'],
            'email' => ['required', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'code' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== 'shopiqo@2026') {
                        $fail('The security code is invalid.');
                    }
                }
            ],
        ]);

        if (!$validator->passes()) {
            return redirect()->route('admin.register')
                ->withErrors($validator)
                ->withInput($request->only('email', 'user_name', 'role', 'referral_code'));
        }

        $admin = new Admin();
        $admin->name          = $request['name'];
        $admin->email         = $request['email'];
        $admin->password      = Hash::make($request['password']);
        $admin->role_id          = $request['role'];
        $admin->mobile_number = $request['mobile_number'];
        $admin->code          = $request['code'];
        $admin->save();

        Auth::guard('admin')->login($admin);
        return redirect()->route('dashboard');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
