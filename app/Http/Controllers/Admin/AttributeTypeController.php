<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeTypeController extends Controller
{
    public function view(Request $request)
    {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        if($admin->role_id == 1){
            $this->data['attributes'] = AttributeType::paginate(10);
            $this->data['attribute_name'] = AttributeType::get();
        }else{
            $this->data['attributes'] = AttributeType::where('created_by', $admin->id)->paginate(10);
            $this->data['attribute_name'] = AttributeType::where('created_by', $admin->id)->get();
        }
        return view('admin.attribute_type.view')->with($this->data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'attribute_name' => [
                'required',
                'max:255',
                'unique:attribute_types,name,' . $request->attribute_id,
            ],
        ]);
        try {
            if ($request->attribute_id) {
                $attribute = AttributeType::findOrFail($request->attribute_id);
                $message = 'AttributeType updated successfully';
            } else {
                $attribute = new AttributeType();
                $message = 'AttributeType saved successfully';
            }
            $attribute->name = $request->attribute_name;
            $attribute->created_by = Auth::guard('admin')->id();
            $attribute->save();
            return response()->json([
                'success' => true,
                'message' => 'Attribute Type saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
