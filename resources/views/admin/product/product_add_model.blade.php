<style>
    .select2-container--default .select2-selection--multiple {
        border-radius: 12px;
        min-height: 42px;
    }
</style>

<div id="productModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-6xl max-h-[95vh] overflow-y-auto rounded-2xl p-6 relative">
        <button id="closeProductModal" class="absolute right-3 top-3 text-gray-500 text-xl font-bold">✕</button>
        <h2 class="text-xl font-bold mb-4" id="product_label">Create Product</h2>
        <div class="flex items-center gap-2 mb-6">
            <span class="step-indicator px-3 py-1 rounded-full text-sm font-semibold bg-black text-white" data-step="1">1. Basic Info</span>
            <span class="text-gray-400">→</span>
            <span class="step-indicator px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-500" data-step="2">2. Pricing & Stock</span>
            <span class="text-gray-400">→</span>
            <span class="step-indicator px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-500" data-step="3">3. Gallery</span>
        </div>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Hidden fields for edit mode --}}
            <input type="hidden" name="product_id" id="product_id">
            <input type="hidden" name="existing_main" id="existing_main">

            {{-- ======================================================== --}}
            {{-- STEP 1 — Basic Info                                        --}}
            {{-- ======================================================== --}}
            <div class="step step-1">
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-semibold">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" name="product_name" id="product_name"
                            class="w-full border rounded-xl px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Product Code <span class="text-red-500">*</span></label>
                        <input type="text" name="product_code" id="product_code"
                            class="w-full border rounded-xl px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Category <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id"
                            class="w-full border rounded-xl px-4 py-2 mt-1">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Sub Category</label>
                        <select name="sub_category_id" id="sub_category_id"
                            class="w-full border rounded-xl px-4 py-2 mt-1">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Production Min Days</label>
                        <input type="number" name="production_min_days" id="production_min_days" min="0"
                            class="w-full border rounded-xl px-4 py-2 mt-1" placeholder="e.g. 3">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Production Max Days</label>
                        <input type="number" name="production_max_days" id="production_max_days" min="0"
                            class="w-full border rounded-xl px-4 py-2 mt-1" placeholder="e.g. 7">
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-semibold">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full border rounded-xl px-4 py-2 mt-1"></textarea>
                    </div>

                    {{-- MAIN IMAGE --}}
                    <div class="col-span-2">
                        <label class="text-sm font-semibold">Main Image <span class="text-red-500">*</span></label>
                        <div class="image-wrapper border-2 border-dashed rounded-xl p-5 text-center mt-1">
                            <input type="file" name="main_image" id="mainImage"
                                class="main-image-input hidden" accept="image/*">
                            <button type="button"
                                class="choose-image-btn bg-black text-white px-4 py-2 rounded-xl">
                                Choose Image
                            </button>
                            <div class="image-preview hidden mt-3">
                                <img class="preview-img w-40 mx-auto rounded object-cover">
                                <button type="button"
                                    class="remove-image-btn text-red-500 mt-2 block mx-auto text-sm">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>{{-- end step-1 --}}

            {{-- ======================================================== --}}
            {{-- STEP 2 — Product Type / Pricing / Stock                   --}}
            {{-- ======================================================== --}}
            <div class="step step-2 hidden">

                <div class="mb-4">
                    <label class="text-sm font-semibold">Product Type <span class="text-red-500">*</span></label>
                    <select id="product_type" name="product_type"
                        class="w-full border rounded-xl px-4 py-2 mt-1">
                        <option value="">Select Type</option>
                        <option value="single">Single</option>
                        <option value="variant">Variant</option>
                        <option value="bulk">Bulk</option>
                    </select>
                </div>

                {{-- ---------- SINGLE ---------- --}}
                <div id="singleFields" class="hidden">
                    <div class="grid grid-cols-3 gap-3 mt-2">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Regular Price <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" min="0"
                                name="single_regular_price"
                                placeholder="Regular Price"
                                class="single_regular_price w-full border border-gray-300 rounded-xl px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Sale Price</label>
                            <input type="number" step="0.01" min="0"
                                name="single_sale_price"
                                placeholder="Sale Price"
                                class="single_sale_price w-full border border-gray-300 rounded-xl px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Stock <span class="text-red-500">*</span></label>
                            <input type="number" min="0"
                                name="single_stock"
                                placeholder="Stock"
                                class="single_stock w-full border border-gray-300 rounded-xl px-4 py-2">
                        </div>
                    </div>
                </div>

                {{-- ---------- VARIANT ---------- --}}
                <div id="variantFields" class="hidden">

                    <div class="mb-3">
                        <label class="text-sm font-semibold">Primary Variant Attribute <span class="text-red-500">*</span></label>
                        <select name="primary_variant" id="primary_variant"
                            class="border rounded-xl px-3 py-2 w-full mt-1">
                            <option value="">Select Primary Attribute</option>
                            @foreach ($variantValues as $attr)
                                {{-- $variantValues = AttributeType::with('get_variant_value')->get() --}}
                                <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Column headers --}}
                    <div class="grid grid-cols-7 gap-3 font-semibold text-sm mb-2 text-gray-600">
                        <div>Primary Value</div>
                        <div>Secondary Value</div>
                        <div>Regular Price</div>
                        <div>Sale Price</div>
                        <div>Stock</div>
                        <div>Image</div>
                        <div>Action</div>
                    </div>

                    <div id="variantWrapper">
                        {{-- First row (index 0) — built by JS on primary_variant change --}}
                    </div>

                    <button type="button" id="addVariant"
                        class="mt-2 bg-black text-white px-4 py-2 rounded-xl text-sm">
                        + Add Variant Row
                    </button>
                </div>

                {{-- ---------- BULK ---------- --}}
                <div id="bulkFields" class="hidden">

                    {{-- Bulk Attribute multi-selects --}}
                    <div class="mb-4">
                        <label class="text-sm font-semibold block mb-2">Applicable Attributes</label>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($variantValues as $attribute)
                                <div>
                                    <label class="font-semibold text-sm">{{ $attribute->name }}</label>
                                    <select name="bulk_attributes[{{ $attribute->id }}][]"
                                        multiple
                                        class="select2 border rounded-xl px-3 py-2 w-full mt-1">
                                        @foreach ($attribute->get_variant_value as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bulk price range rows --}}
                    <div class="grid grid-cols-5 gap-3 font-semibold text-sm mb-2 text-gray-600">
                        <div>Min Qty</div>
                        <div>Max Qty</div>
                        <div>Regular Price</div>
                        <div>Sale Price</div>
                        <div></div>
                    </div>

                    <div id="bulkWrapper">
                        <div class="bulk-row grid grid-cols-5 gap-3 mb-3">
                            <div>
                                <input type="number" min="1"
                                    name="bulk[0][minimum]"
                                    placeholder="Min Qty"
                                    class="minimum w-full border rounded-xl px-3 py-2">
                            </div>
                            <div>
                                <input type="number" min="1"
                                    name="bulk[0][maximum]"
                                    placeholder="Max Qty"
                                    class="maximum w-full border rounded-xl px-3 py-2">
                            </div>
                            <div>
                                <input type="number" step="0.01" min="0"
                                    name="bulk[0][regular_price]"
                                    placeholder="Regular Price"
                                    class="bulk_regular_price w-full border rounded-xl px-3 py-2">
                            </div>
                            <div>
                                <input type="number" step="0.01" min="0"
                                    name="bulk[0][sale_price]"
                                    placeholder="Sale Price"
                                    class="bulk_sale_price w-full border rounded-xl px-3 py-2">
                            </div>
                            <div class="flex items-center">
                                {{-- First row has no remove button --}}
                            </div>
                        </div>
                    </div>

                    <button type="button" id="addBulk"
                        class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
                        + Add Price Range
                    </button>
                </div>

            </div>{{-- end step-2 --}}

            {{-- ======================================================== --}}
            {{-- STEP 3 — Gallery Images                                   --}}
            {{-- ======================================================== --}}
            <div class="step step-3 hidden">
                <label class="text-sm font-semibold">Gallery Images <span class="text-red-500">*</span></label>
                <div class="image-wrapper border-2 border-dashed p-5 rounded-xl text-center mt-1">
                    <input type="file" name="gallery_images[]"
                        class="gallery-images-input hidden" id="galleryImage"
                        multiple accept="image/*">
                    <button type="button"
                        class="choose-image-btn bg-black text-white px-4 py-2 rounded-xl">
                        Choose Images
                    </button>
                    <p class="text-gray-400 text-xs mt-2">You can select multiple images</p>
                    <div class="gallery-preview flex flex-wrap gap-3 mt-4 justify-center"></div>
                </div>
            </div>{{-- end step-3 --}}

            {{-- Navigation --}}
            <div class="flex justify-between mt-6">
                <button type="button" id="prevBtn"
                    class="hidden bg-gray-500 text-white px-5 py-2 rounded-full">
                    ← Previous
                </button>
                <div class="flex gap-3 ml-auto">
                    <button type="button" id="nextBtn"
                        class="bg-black text-white px-5 py-2 rounded-full">
                        Next →
                    </button>
                    <button type="submit" id="save_product"
                        class="hidden bg-[#363636] text-white px-5 py-2 rounded-full">
                        Submit
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
