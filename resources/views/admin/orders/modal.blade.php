<div id="orderModal" class="fixed inset-0 flex items-center justify-center z-50 overflow-auto bg-black/40 p-4"
    style="display:none;">

    <!-- Modal -->
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-[900px] mx-4 sm:mx-6 lg:mx-0 overflow-hidden flex flex-col max-h-[90vh]">
        <input type="hidden" id="idSet">
        <input type="hidden" name="exiting_image" x-model="exiting_image" id="exiting_image" />
        <!-- Header -->
        <div class="flex justify-between items-center p-5 border-b border-slate-100 bg-slate-900">
            <h2 class="text-xl sm:text-2xl font-semibold text-white" id="orderModalTitle">Order #</h2>
            {{-- <button id="closeModalBtn" class="px-3 py-1 bg-gray-200 rounded-lg hover:bg-gray-300">Close</button> --}}
        </div>

        <!-- Content -->
        <div class="p-5 overflow-y-auto flex-1 space-y-6">
            <!-- Customer Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl">
                    <h3 class="font-semibold text-slate-700 mb-2">Customer Details</h3>
                    <p><strong>Name:</strong> <span id="orderCustomerName">—</span></p>
                    <p><strong>Email:</strong> <span id="orderCustomerEmail">—</span></p>
                    <p><strong>Mobile:</strong> <span id="orderCustomerMobile">—</span></p>
                </div>
                <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl">
                    <h3 class="font-semibold text-slate-700 mb-2">Billing Address</h3>
                    <p><strong>Name:</strong> <span id="addressCustomerName">—</span></p>
                    <p><strong>Mobile Number:</strong> <span id="addressCustomerMobile">—</span></p>
                    <p><strong>Address:</strong> <span id="addressCustomerAddress">—</span></p>
                    <p><strong>Address Type:</strong> <span id="addressCustomerAddressType">—</span></p>
                    <p><strong>State:</strong> <span id="addressCustomerState">—</span></p>
                    <p><strong>City:</strong> <span id="addressCustomerCity">—</span></p>
                    <p><strong>Pincode:</strong> <span id="addressCustomerPincode">—</span></p>
                </div>
            </div>

            <!-- Products Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-700 border border-slate-200 rounded-xl overflow-hidden">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Product</th>
                            <th class="px-3 py-2">Qty</th>
                            <th class="px-3 py-2">Price</th>
                            <th class="px-3 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="orderProductsBody" class="divide-y divide-slate-100"></tbody>
                </table>
            </div>

            <!-- Amount Breakdown -->
            <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl max-w-md">
                <h3 class="font-semibold text-slate-700 mb-2">Amount Breakdown</h3>
                <div class="flex justify-between mb-1"><span>Subtotal:</span> <span id="orderSubtotal">₹0</span></div>
                <div class="flex justify-between mb-1"><span>GST:</span> <span id="orderGST">₹0</span></div>
                <div class="flex justify-between mb-1"><span>Shipping:</span> <span id="orderShipping">₹0</span></div>
                <div class="flex justify-between mb-1"><span>Coupon Discount:</span> <span id="orderCoupon">-₹0</span>
                </div>
                <div class="flex justify-between font-bold text-lg border-t border-slate-200 pt-2 mt-2 text-indigo-700">
                    <span>Grand Total:</span> <span id="orderGrandTotal">₹0</span>
                </div>
            </div>

            <!-- Status Update -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-slate-700 mb-1">Order Status<span
                            class="text-rose-500">*</span></label>
                    <select id="status" class="w-full border border-slate-300 p-2 sm:p-3 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="1">Pending</option>
                        <option value="2">In Progress</option>
                        <option value="3">Shipped</option>
                        <option value="4">Delivered</option>
                        <option value="5">Cancelled</option>
                        <option value="6">Refunded</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-slate-700 mb-1">Date<span class="text-rose-500">*</span></label>
                    <input type="date" id="statusDate" class="w-full border border-slate-300 p-2 sm:p-3 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                </div>
            </div>

            <!-- Refund Fields (shown only when status = Refunded) -->
            <div id="refundFields" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" style="display:none;">
                <div>
                    <label class="block font-medium text-slate-700 mb-1">Refund Reference / Note <span
                            class="text-rose-500">*</span></label>
                    <textarea id="refundNote" placeholder="Enter refund reference or note" rows="4"
                        class="w-full border border-slate-300 p-2 sm:p-3 rounded-lg text-slate-900 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Refund Proof (Image) <span
                            class="text-rose-500">*</span></label>
                    <input type="file" name="refund_image" id="refundImage" accept=".png, .jpg, .jpeg"
                        class="form-input w-full border border-slate-300 rounded-lg p-2 cursor-pointer bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    <span class="text-rose-600 text-sm">Only JPG,JPEG,PNG files are allowed and File size must not exceed
                        2MB</span>
                    <div class="mt-4 flex justify-center overflow-hidden">
                        <img id="refundImagePreview" src=""
                            class="w-full max-h-[30vh] rounded-lg border border-slate-200 shadow-md object-cover hidden" />
                    </div>
                </div>
            </div>
            <!-- Sample Production Stage -->
            @if(!empty(\App\Models\Order::SAMPLE_STAGES))
            <div class="border-t border-slate-100 pt-5">
                <h3 class="font-semibold text-slate-700 mb-2">Sample Production Stage</h3>
                <p class="text-xs text-slate-500 mb-3">Drives the customer's Sample Process / Sample Review pages.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Stage</label>
                        <select id="sampleStage" class="w-full border border-slate-300 p-2 sm:p-3 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">— No stage yet —</option>
                            @foreach(\App\Models\Order::SAMPLE_STAGES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button id="saveSampleStageBtn" type="button"
                            class="w-full bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                            Update Stage
                        </button>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block font-medium text-slate-700 mb-1">Note (optional, shown to customer)</label>
                    <textarea id="sampleStageNote" rows="2"
                        class="w-full border border-slate-300 p-2 sm:p-3 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. Revised per customer's requested changes"></textarea>
                </div>

                <div id="sampleStageHistory" class="mt-3 text-xs text-slate-600 space-y-1"></div>
            </div>
            @endif
        </div>

        <!-- Footer Buttons -->
        <div class="flex justify-end gap-3 p-5 border-t border-slate-100 bg-slate-50">
            <button id="cancelModalBtn" class="px-5 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors">Cancel</button>
            <button id="saveStatusBtn" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors font-medium">Save</button>
        </div>
    </div>
</div>
