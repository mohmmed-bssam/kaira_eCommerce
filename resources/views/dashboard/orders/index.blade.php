<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.orders') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead
                                class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        #
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Payment
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>

                                        <td class="px-6 py-4">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->total_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded text-white text-xs
                                                 {{ $order->payment_status == 'paid' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                                {{ $order->payment_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-white text-xs bg-blue-600">
                                                {{ $order->order_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                {{-- View --}}
                                                <a href="{{ route('dashboard.orders.show', $order) }}" title="View"
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 15.75A3.75 3.75 0 1 0 12 8.25a3.75 3.75 0 0 0 0 7.5z" />
                                                    </svg>
                                                </a>

                                                {{-- Cancel (اختياري إخفاؤه لو Delivered/Cancelled) --}}
                                                @if (!in_array($order->order_status, ['delivered', 'cancelled']))
                                                    <form method="POST"
                                                        action="{{ route('dashboard.orders.update', $order) }}"
                                                        onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="order_status" value="cancelled">
                                                        <input type="hidden" name="payment_status"
                                                            value="{{ $order->payment_status }}">

                                                        <button type="submit" title="Cancel Order"
                                                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600 hover:bg-red-100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.8"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>

                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            No orders found.
                                        </td>
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
