<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function view(Request $request)
    {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        if($admin->role_id == 1){
            $this->data['attributes'] = AttributeType::with('get_variant_value')->paginate(10);
            $this->data['attribute_name'] = AttributeType::get();
        }else{
            $this->data['attributes'] = AttributeType::with('get_variant_value')->where('created_by', $admin->id)->paginate(10);
            $this->data['attribute_name'] = AttributeType::where('created_by', $admin->id)->get();
        }
        return view('admin.attribute.view')->with($this->data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'attribute' => 'required|exists:attribute_types,id',
            'attribute_value' => 'required|string'
        ]);

        try {
            $attributeId = $request->attribute;
            $values = explode(',', $request->attribute_value);
            $values = array_filter(array_map(function ($value) {
                return trim($value);
            }, $values));
            foreach ($values as $value) {
                $exists = AttributeValue::where(['attribute_type_id' => $attributeId, 'value' => $value])->exists();
                if (!$exists) {
                    $attribute_value = new AttributeValue();
                    $attribute_value->attribute_type_id = $attributeId;
                    $attribute_value->value = $value;
                    $attribute_value->created_by = Auth::guard('admin')->id();
                    $attribute_value->save();
                }
            }

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
