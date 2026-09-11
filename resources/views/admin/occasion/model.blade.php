<div id="occasionModal" x-data="{ previewUrl: null, existing_icon: '', form: { name: '', sort_order: 0, is_active: '1', occ_id: 0 } }" class="fixed inset-0 hidden items-center justify-center z-50">
    <div class="absolute inset-0 bg-black/40" onclick="$('#occasionModal').hide()"></div>
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-[600px] max-w-[90%] relative z-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800" id="occasion_label">Add Occasion</h2>
        <form id="occasionForm" class="space-y-6">
            <input type="hidden" name="occasion_id" x-model="form.occ_id" id="occasion_id" />
            <input type="hidden" name="existing_icon" x-model="existing_icon" id="existing_icon" />
            <div class="flex items-center gap-3">
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2">Occasion Name<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="occasion_name" id="occasion_name" x-model="form.name"
                        placeholder="e.g. Corporate events"
                        class="form-input w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#363636]">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2">Status<span
                            class="text-red-500">*</span></label>
                    <select name="occasion_is_active" x-model="form.is_active" id="occasion_is_active"
                        class="form-input w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#363636]">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Sort Order</label>
                <input type="number" min="0" name="occasion_sort_order" id="occasion_sort_order" x-model="form.sort_order"
                    placeholder="0"
                    class="form-input w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#363636]">
                <p class="text-xs text-gray-400 mt-1">Controls display order on the homepage "Browse by need" section — lower shows first.</p>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Icon</label>
                <input type="file" name="occasion_icon" id="occasion_icon" accept=".png, .jpg, .jpeg, .svg"
                    x-ref="fileInput"
                    @change="
                               const file = $refs.fileInput.files[0];
                               if (file) {
                                   const reader = new FileReader();
                                   reader.onload = e => { previewUrl = e.target.result }
                                   reader.readAsDataURL(file);
                               }
                           "
                    class="form-input w-full border border-gray-300 rounded-lg p-2 cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#363636] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#363636] file:text-white hover:file:bg-[#363636]">

                <div class="mt-4 flex justify-center overflow-hidden">
                    <img :src="previewUrl" x-show="previewUrl"
                        class="w-20 h-20 rounded-lg border border-gray-300 shadow-md object-contain" />
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="$('#occasionModal').hide()" class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="bg-[#363636] text-white px-5 py-2 rounded-lg hover:bg-[#363632]" id="save_occ">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<div id="deleteOccasionModal" x-data="{ open: false, deleteId: null }">
    <template x-if="open">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black/40" @click="open = false"></div>
            <div class="bg-white p-6 rounded-xl shadow-xl w-[400px] relative z-10">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Confirm Delete</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this occasion?</p>
                <div class="flex justify-end gap-3">
                    <button @click="open = false" class="px-4 py-1 border rounded-lg hover:bg-gray-100">Cancel</button>
                    <button @click="deleteOccasion(deleteId)"
                        class="px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </template>
</div>
