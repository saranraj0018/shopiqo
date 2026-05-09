<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeTypeController extends Controller
{
    public function view(Request $request)
    {
        $this->data['attributes'] = AttributeType::with('get_variant_value')->paginate(10);
        $this->data['attribute_name'] = AttributeType::get();
        return view('admin.attribute.view')->with($this->data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                'unique:attribute_types,name,' . $request->attribute_type_id,
            ],
        ]);
        try {
            if ($request->attribute_type_id) {
                $attribute = AttributeType::findOrFail($request->attribute_type_id);
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
                'message' => 'Attribute values saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
