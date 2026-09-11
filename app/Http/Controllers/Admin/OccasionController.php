<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Occasion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OccasionController extends Controller
{
    public function view()
    {
        $this->data['occasions'] = Occasion::orderBy('sort_order')->orderBy('id')->paginate(10);
        return view('admin.occasion.view')->with($this->data);
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'occasion_name' => [
                    'required',
                    'max:255',
                    'unique:occasions,name,' . $request->occasion_id,
                ],
                'occasion_is_active' => 'required|boolean',
                'occasion_sort_order' => 'nullable|integer|min:0',
            ]);

            if ($request->occasion_id) {
                $occasion = Occasion::findOrFail($request->occasion_id);
                $message = 'Occasion updated successfully';
            } else {
                $occasion = new Occasion();
                $message = 'Occasion saved successfully';
            }
            $occasion->name = $request->occasion_name;
            $occasion->is_active = $request->occasion_is_active;
            $occasion->sort_order = $request->occasion_sort_order ?? 0;
            if (!$occasion->exists || $occasion->getOriginal('name') !== $request->occasion_name) {
                $occasion->slug = $this->uniqueSlug($request->occasion_name, $occasion->id);
            }
            if ($request->hasFile('occasion_icon')) {
                $img_name = time() . '_' . $request->file('occasion_icon')->getClientOriginalName();
                $request->file('occasion_icon')->storeAs('occasions', $img_name, 'public');
                $occasion->icon = 'occasions/' . $img_name;
            } elseif ($request->has('existing_icon')) {
                $occasion->icon = $request->existing_icon;
            }
            $occasion->save();
            return response()->json([
                'success' => true,
                'message' => $message,
                'occasion' => $occasion
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        if (!$request->id) {
            return response()->json(['success' => false, 'message' => 'Occasion ID is required'], 400);
        }
        $occasion = Occasion::find($request->id);
        if (!$occasion) {
            return response()->json(['success' => false, 'message' => 'Occasion not found'], 404);
        }
        $occasion->delete();
        return response()->json(['success' => true, 'message' => 'Occasion deleted successfully']);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;
        while (Occasion::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
