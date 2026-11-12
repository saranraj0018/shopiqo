<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    private function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'digits:10'],
            'address'      => ['required', 'string', 'max:1000'],
            'city'         => ['required', 'string', 'max:255'],
            'state'        => ['required', 'string', 'max:255'],
            'pincode'      => ['required', 'string', 'max:20'],
            'address_type' => ['required', 'in:Home,Office,Other'],
        ];
    }

    public function store(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['success' => false, 'message' => 'Please log in again.'], 401);
        }

        $validator = Validator::make($request->all(), $this->rules());
        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $address = Address::create([
            ...$validator->validated(),
            'user_id' => $guard->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address saved',
            'address' => $address,
        ]);
    }

    public function update(Request $request, Address $address)
    {
        $guard = Auth::guard('user');
        if (!$guard->check() || $address->user_id != $guard->id()) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->rules());
        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $address->fill($validator->validated());
        $address->save();

        return response()->json([
            'success' => true,
            'message' => 'Address updated',
            'address' => $address,
        ]);
    }

    public function destroy(Request $request, Address $address)
    {
        $guard = Auth::guard('user');
        if (!$guard->check() || $address->user_id != $guard->id()) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        $address->delete();

        return response()->json(['success' => true, 'message' => 'Address deleted']);
    }
}
