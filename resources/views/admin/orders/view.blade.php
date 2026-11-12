<x-layouts.app>
    <div class="p-1">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Orders</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $orders->total() }} paid orders</p>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-2xl border border-slate-200/70 shadow-sm">
            <table class="w-full text-sm text-left text-slate-700 border-collapse">
                <thead>
                    <tr class="bg-slate-900 text-slate-200 text-xs uppercase tracking-wider">
                        <th class="px-4 py-3 font-medium">ID</th>
                        <th class="px-4 py-3 font-medium">Order ID</th>
                        <th class="px-4 py-3 font-medium">User</th>
                        <th class="px-4 py-3 font-medium">Phone</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Amount</th>
                        <th class="px-4 py-3 font-medium text-center">Order Date</th>
                        <th class="px-4 py-3 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody" class="divide-y divide-slate-100">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-indigo-50/40 transition-colors">
                            <td class="px-4 py-3 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-mono text-slate-600">{{ $order->order_id }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-4 py-3">{{ $order->phone }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900">₹{{ number_format($order->gross_amount, 2) }}</td>
                            <td class="px-4 py-3 text-center text-slate-500">{{ optional($order->created_at)->format('d M Y h:i A') }}</td>
                            <td class="px-4 py-3 text-center">
                                <button class="w-8 h-8 rounded-lg inline-flex items-center justify-center text-indigo-600 hover:bg-indigo-50 transition-colors viewOrderBtn"
                                    data-order='@json($order)'>
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $orders->links() }}
        </div>
          @include('admin.orders.modal')
    </div>
</x-layouts.app>
<script src="{{ asset('admin/js/order.js') }}?v={{ time() }}"></script>
