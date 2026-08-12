<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserLoginController extends Controller
{
    public function userAuthenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if (!Auth::guard('user')->attempt([
            'email'    => $request['email'],
            'password' => $request['password']
        ], $request->get('remember'))) {
            return response()->json([
                'success' => false,
                'message' => 'Either Email/Password is incorrect',
            ], 401);
        }

        $user = Auth::guard('user')->user();
        session()->put('user', $user);
        return response()->json([
            'success'  => true,
            'message'  => 'Login successful',
            'redirect' => route('home'),
        ]);
    }

    public function userRegisterUpdate(Request $request)
    {
        if ($request->expectsJson()) {
            $validator = Validator::make($request->all(), [
                'full_name'          => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'digits:10'],
                'email'         => ['required', 'email', 'max:255', 'unique:' . User::class],
                'password'      => ['required', 'string', 'min:8'],
            ]);
            if (!$validator->passes()) {
                return redirect()->route('login.personal')
                    ->withErrors($validator)
                    ->withInput($request->only('email', 'name', 'mobile_number', 'password'));
            }
            $user = new User();
            $user->name          = $request['full_name'];
            $user->buyer_type    = $request['buyer_type'];
            $user->email         = $request['email'];
            $user->password      = Hash::make($request['password']);
            $user->phone = $request['phone_number'];
            $user->save();
            Auth::guard('user')->login($user);
            return response()->json([
                'success'  => true,
                'message'  => 'Registered successfully',
                'redirect' => route('login.personal'),
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Not an AJAX request'], 400);
        }
    }

    public function userLogout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
