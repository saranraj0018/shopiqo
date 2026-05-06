<style>
.select2-container--default .select2-selection--multiple {
    border-radius: 12px;
    min-height: 42px;
  }
</style>
<div id="productModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-6xl max-h-[95vh] overflow-y-auto rounded-2xl p-6 relative">
        <button id="closeProductModal" class="absolute right-3 top-3 text-gray-500">✕</button>
        <h2 class="text-xl font-bold mb-6" id="product_label">Create Product</h2>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id">
            <input type="hidden" name="existing_main" id="existing_main">
            <input type="hidden" name="existing_gallery[]" class="existing_gallery">
            <input type="hidden" name="variants[0][existing_image]" class="existingVariantImage">
            <div class="step step-1">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Product Name</label>
                        <input type="text" name="product_name" id="product_name"
                            class="w-full border rounded-xl px-4 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Product Code</label>
                        <input type="text" name="product_code" id="product_code"
                            class="w-full border rounded-xl px-4 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Category</label>
                        <select name="category_id" id="category_id" class="w-full border rounded-xl px-4 py-2">
                            <option value="">Select</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Sub Category</label>
                        <select name="sub_category_id" id="sub_category_id" class="w-full border rounded-xl px-4 py-2">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-semibold">Description</label>
                        <textarea name="description" class="w-full border rounded-xl px-4 py-2"></textarea>
                    </div>
                    <!-- MAIN IMAGE -->
                    <div class="col-span-2">
                        <label class="text-sm font-semibold">Main Image</label>
                        <div class="image-wrapper border-2 border-dashed rounded-xl p-5 text-center">
                            <input type="file" name="main_image" id="mainImage" class="main-image-input hidden">
                            <button type="button" class="choose-image-btn bg-black text-white px-4 py-2 rounded-xl">
                                Choose Image
                            </button>
                            <div class="image-preview hidden mt-3">
                                <img class="preview-img w-40 mx-auto rounded">
                                <button type="button" class="remove-image-btn text-red-500 mt-2">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="step step-2 hidden">
                <label class="text-sm font-semibold">Product Type</label>
                <select id="product_type" name="product_type" class="w-full border rounded-xl px-4 py-2 mb-5">
                    <option value="">Select</option>
                    <option value="single">Single</option>
                    <option value="variant">Variant</option>
                    <option value="bulk">Bulk</option>
                </select>
                <div id="singleFields" class="hidden">
                    <div class="grid grid-cols-3 gap-3 mb-3 mt-2">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Regular Price</label>
                            <input type="number" step="0.01" name="single_regular_price" placeholder="Regular Price"
                                class="single_regular_price w-full border border-gray-300 rounded-xl px-4 py-2
                           focus:ring-2 focus:ring-black focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Sale Price</label>
                            <input type="number" step="0.01" name="single_sale_price" placeholder="Sale Price"
                                class="single_sale_price w-full border border-gray-300 rounded-xl px-4 py-2
                           focus:ring-2 focus:ring-black focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Stock</label>
                            <input type="number" name="single_stock" id="single_stock" placeholder="Stock"
                                class="single_stock w-full border border-gray-300 rounded-xl px-4 py-2
                           focus:ring-2 focus:ring-black focus:outline-none">
                        </div>
                    </div>
                </div>

                <div id="variantFields" class="hidden">
                    <div class="mb-4">
                        <select name="primary_variant" id="primary_variant"
                            class="border rounded-xl px-3 py-2 w-full primaryVariant">
                            <option value="">Select Variant</option>
                            @foreach ($variantValues as $attr)
                                <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-7 gap-3 font-semibold mb-2">
                        <div>Primary Value</div>
                        <div>Secondary Value</div>
                        <div>Regular Price</div>
                        <div>Sale Price</div>
                        <div>Stock</div>
                        <div>Image</div>
                        <div>Action</div>
                    </div>
                    <div id="variantWrapper">
                        <div class="variant-row grid grid-cols-7 gap-3 mb-4">
                            <div>
                                <select name="variants[0][primary_value]"
                                    class="border rounded-xl px-3 py-2 w-full primaryValue">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div>
                                <select name="variants[0][secondary_value]"
                                    class="border rounded-xl px-3 py-2 w-full secondaryValue">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div>
                                <input type="number" name="variants[0][regular_price]" placeholder="Regular Price"
                                    class="border rounded-xl px-3 py-2 w-full regular_price">
                            </div>
                            <div>
                                <input type="number" name="variants[0][sale_price]" placeholder="Sale Price"
                                    class="border rounded-xl px-3 py-2 w-full sale_price">
                            </div>
                            <div>
                                <input type="number" name="variants[0][stock]" placeholder="Stock"
                                    class="border rounded-xl px-3 py-2 w-full stock">
                            </div>
                            <!-- IMAGE + PREVIEW -->
                            <div>
                                <input type="file" name="variants[0][image]"
                                    class="variantImage border rounded-xl px-3 py-2 w-full">
                                <img class="imagePreview mt-2 w-16 h-16 object-cover rounded hidden">
                            </div>
                            {{-- <div>
                                <button type="button" class="removeVariant bg-red-500 text-white px-3 py-2 rounded">
                                    Remove
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <button type="button" id="addVariant" class="bg-black text-white px-4 py-2 rounded-xl">
                        Add Variant
                    </button>
                </div>

                <!-- BULK -->

                <div id="bulkFields" class="hidden">
                    <div class="grid grid-cols-3 gap-4 mb-5">
                        @foreach ($variantValues as $attribute)
                            <div>
                                <label class="font-semibold text-sm">
                                    {{ $attribute->name }}
                                </label>
                                <select name="bulk_attributes[{{ $attribute->id }}][]" multiple
                                    class="select2 border rounded-xl px-3 py-2 w-full">
                                    @foreach ($attribute->get_variant_value as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div id="bulkWrapper">
                        <div class="bulk-row grid grid-cols-5 gap-3 mb-3">
                            <div>
                                <input type="number" name="bulk[0][minimum]" placeholder="Minimum Qty"
                                    class="border rounded-xl px-3 py-2 minimum">
                            </div>
                            <div>
                                <input type="number" name="bulk[0][maximum]" placeholder="Maximum Qty"
                                    class="border rounded-xl px-3 py-2 maximum">
                            </div>
                            <div>
                                <input type="number" name="bulk[0][regular_price]" placeholder="Regular Price"
                                    class="border rounded-xl px-3 py-2 bulk_regular_price">
                            </div>
                            <div>
                                <input type="number" name="bulk[0][sale_price]" placeholder="Sale Price"
                                    class="border rounded-xl px-3 py-2 bulk_sale_price">
                            </div>
                            <button type="button" class="removeBulk bg-red-500 text-white px-3 py-2 rounded hidden">
                                Remove
                            </button>
                        </div>
                    </div>
                    <button type="button" id="addBulk" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Add Range
                    </button>
                </div>
            </div>

            <!-- STEP 3 -->

            <div class="step step-3 hidden">
                <label class="text-sm font-semibold">Gallery Images</label>
                <div class="image-wrapper border-2 border-dashed p-5 rounded-xl text-center">
                    <input type="file" name="gallery_images[]" class="gallery-images-input hidden"
                        id="galleryImage" multiple>
                    <button type="button" class="choose-image-btn bg-black text-white px-4 py-2 rounded-xl">
                        Choose Images
                    </button>
                    <div class="gallery-preview flex flex-wrap gap-3 mt-4"></div>
                </div>
            </div>

            <!-- NAVIGATION -->

            <div class="flex justify-between mt-6">
                <button type="button" id="prevBtn"
                    class="hidden bg-gray-500 text-white px-5 py-2 rounded-full">Previous</button>
                <button type="button" id="nextBtn"
                    class="bg-black text-white px-5 py-2 rounded-full">Next</button>
                <button type="submit" id="save_product"
                    class="hidden bg-green-600 text-white px-5 py-2 rounded-full">Submit</button>
            </div>
        </form>
    </div>
</div>
