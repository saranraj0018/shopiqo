
<x-layouts.app>
    <div class="p-4">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold">Vendors</h2>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="w-full text-sm text-left text-gray-700 border-collapse">
                <thead>
                <tr class="bg-[#363636] text-white text-sm uppercase tracking-wider">
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Business</th>
                    <th class="px-3 py-2">GST</th>
                    <th class="px-3 py-2">Applied</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2 text-center">Actions</th>
                </tr>
                </thead>
                <tbody id="vendorTableBody" class="divide-y divide-gray-200">
                @forelse($vendors as $vendor)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            {{ $vendor->name }}
                            <p class="text-gray-500 text-xs">{{ $vendor->mobile_number }}</p>
                        </td>
                        <td class="px-4 py-3">{{ $vendor->email }}</td>
                        <td class="px-4 py-3">
                            {{ $vendor->business_name ?? '—' }}
                            @if($vendor->business_type)
                                <p class="text-gray-500 text-xs">{{ $vendor->business_type }}</p>
                            @endif
                            @if($vendor->products_offered)
                                <p class="text-gray-400 text-xs mt-1 max-w-xs truncate" title="{{ $vendor->products_offered }}">{{ $vendor->products_offered }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $vendor->gst_number ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $vendor->created_at->format('d M Y, h:i A') }}</td>
                        <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $vendor->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $vendor->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if(!$vendor->is_approved)
                                <button class="text-green-600 hover:text-green-800 transition btnApproveVendor mr-3" data-id="{{ $vendor->id }}">
                                    <i class="fa-solid fa-check"></i> Approve
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition btnRejectVendor" data-id="{{ $vendor->id }}">
                                    <i class="fa-solid fa-xmark"></i> Reject
                                </button>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-400">No vendor applications yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $vendors->links() }}
        </div>
    </div>
</x-layouts.app>
<script src="{{ asset('admin/js/vendor.js') }}?v={{ time() }}"></script>
