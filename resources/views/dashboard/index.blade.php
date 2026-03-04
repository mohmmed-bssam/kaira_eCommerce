<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Orders Total --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Total Orders</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['orders_total'] }}</div>
                </div>

                {{-- Pending Orders --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Pending Orders</div>
                    <div class="mt-2 text-3xl font-bold text-yellow-600">{{ $stats['orders_pending'] }}</div>
                </div>

                {{-- Delivered Orders --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Delivered Orders</div>
                    <div class="mt-2 text-3xl font-bold text-green-700">{{ $stats['orders_delivered'] }}</div>
                </div>

                {{-- Customers --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Customers</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['customers_total'] }}</div>
                </div>

                {{-- Products --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Products</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['products_total'] }}</div>
                </div>

                {{-- Low stock --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Low Stock (&lt; 5)</div>
                    <div class="mt-2 text-3xl font-bold text-red-600">{{ $stats['products_low_stock'] }}</div>
                </div>

                {{-- Messages --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Messages</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['messages_total'] }}</div>
                </div>

                {{-- Quick links --}}
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-sm text-gray-500">Quick Actions</div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ route('dashboard.orders.index') }}"
                           class="px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                            Orders
                        </a>
                        <a href="{{ route('dashboard.products.index') }}"
                           class="px-3 py-2 rounded bg-gray-900 text-white text-sm hover:bg-gray-800">
                            Products
                        </a>
                        <a href="{{ route('dashboard.categories.index') }}"
                           class="px-3 py-2 rounded bg-gray-700 text-white text-sm hover:bg-gray-600">
                            Categories
                        </a>
                    </div>
                </div>
            </div>

            {{-- Latest Orders --}}
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-lg text-gray-900">Latest Orders</h3>
                        <a href="{{ route('dashboard.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            View all
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b">
                                    <th class="py-2">#</th>
                                    <th class="py-2">Customer</th>
                                    <th class="py-2">Total</th>
                                    <th class="py-2">Payment</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Date</th>
                                    <th class="py-2 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestOrders as $order)
                                    <tr class="border-b">
                                        <td class="py-2">{{ $order->id }}</td>
                                        <td class="py-2">{{ $order->user->name ?? '—' }}</td>
                                        <td class="py-2">{{ number_format($order->total_price, 2) }}</td>

                                        <td class="py-2">
                                            <span class="px-2 py-1 rounded text-white text-xs
                                                {{ $order->payment_status === 'paid' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                                {{ $order->payment_status }}
                                            </span>
                                        </td>

                                        <td class="py-2">
                                            @php
                                                $statusClass = match($order->order_status) {
                                                    'pending' => 'bg-yellow-500',
                                                    'processing' => 'bg-blue-600',
                                                    'shipped' => 'bg-indigo-600',
                                                    'delivered' => 'bg-green-700',
                                                    'cancelled' => 'bg-red-600',
                                                    default => 'bg-gray-600',
                                                };
                                            @endphp
                                            <span class="px-2 py-1 rounded text-white text-xs {{ $statusClass }}">
                                                {{ $order->order_status }}
                                            </span>
                                        </td>

                                        <td class="py-2">{{ $order->created_at->format('Y-m-d') }}</td>

                                        <td class="py-2 text-right">
                                            <a href="{{ route('dashboard.orders.show', $order) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200"
                                               title="View">
                                                👁
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-4 text-center text-gray-500">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
