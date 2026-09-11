
<x-layouts.app>
    <div class="p-4">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold">Occasions</h2>
            <button id="createOccasionBtn" class="bg-[#363636] text-white px-4 py-2 rounded">
                Create
            </button>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="w-full text-sm text-left text-gray-700 border-collapse">
                <thead>
                <tr class="bg-[#363636] text-white text-sm uppercase tracking-wider">
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">Slug</th>
                    <th class="px-3 py-2">Icon</th>
                    <th class="px-3 py-2">Sort Order</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Created At</th>
                    <th class="px-3 py-2 text-center">Actions</th>
                </tr>
                </thead>
                <tbody id="occasionTableBody" class="divide-y divide-gray-200">
                @foreach($occasions as $occasion)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $occasion->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $occasion->slug }}</td>
                        <td class="px-4 py-3">
                            @if($occasion->icon)
                                <img src="{{ asset('storage/'.$occasion->icon) }}"
                                     class="h-10 w-10 object-cover rounded-lg shadow-sm border" />
                            @else
                                <span class="text-gray-400 italic">No Icon</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $occasion->sort_order }}</td>
                        <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $occasion->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $occasion->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        </td>
                        <td class="px-4 py-3">
                            {{ $occasion->created_at->format('d M Y, h:i A') }}
                        </td>
                        <td class="px-4 py-3 flex justify-center gap-4">
                            <button
                                class="text-blue-600 hover:text-blue-800 transition editOccasionBtn"
                                data-id="{{ $occasion->id }}"
                                data-name="{{ $occasion->name }}"
                                data-sort_order="{{ $occasion->sort_order }}"
                                data-is_active="{{ $occasion->is_active ? 1 : 0 }}"
                                data-icon="{{ $occasion->icon ? asset('storage/'.$occasion->icon) : '' }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 transition btnDeleteOccasion" data-id="{{ $occasion->id }}">
                                <i class="fa-solid fa-delete-left"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $occasions->links() }}
        </div>
        @include('admin.occasion.model')
    </div>
</x-layouts.app>
<script src="{{ asset('admin/js/occasion.js') }}?v={{ time() }}"></script>
