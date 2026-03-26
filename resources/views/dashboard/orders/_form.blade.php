 <div class="py-12">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

         {{-- Order + Customer Info --}}
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-3 gap-6">

                 <div class="md:col-span-2">
                     <h3 class="font-semibold text-lg mb-3">Order Info</h3>

                     <div class="grid grid-cols-2 gap-4 text-sm">
                         <div>
                             <div class="text-gray-500">Total</div>
                             <div class="font-semibold">{{ number_format($order->total_price, 2) }}</div>
                         </div>

                         <div>
                             <div class="text-gray-500">Date</div>
                             <div class="font-semibold">{{ $order->created_at->format('Y-m-d H:i') }}</div>
                         </div>

                         <div>
                             <div class="text-gray-500">Payment Status</div>
                             <span
                                 class="px-2 py-1 rounded text-white text-xs
                                    {{ $order->payment_status == 'paid' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                 {{ $order->payment_status }}
                             </span>
                         </div>

                         <div>
                             <div class="text-gray-500">Order Status</div>
                             <span
                                 class="px-2 py-1 rounded text-white text-xs
                                    @if ($order->order_status == 'pending') bg-yellow-500
                                    @elseif($order->order_status == 'processing') bg-blue-600
                                    @elseif($order->order_status == 'shipped') bg-indigo-600
                                    @elseif($order->order_status == 'delivered') bg-green-700
                                    @elseif($order->order_status == 'cancelled') bg-red-600 @endif">
                                 {{ $order->order_status }}
                             </span>
                         </div>
                     </div>
                 </div>

                 <div>
                     <h3 class="font-semibold text-lg mb-3">Customer</h3>
                     <div class="text-sm space-y-1">
                         <div><span class="text-gray-500">Name:</span> {{ $order->user->name }}</div>
                         <div><span class="text-gray-500">Email:</span> {{ $order->user->email }}</div>
                     </div>
                 </div>
             </div>
         </div>

         {{-- Update Status Form --}}
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <div class="p-6 text-gray-900">
                 <h3 class="font-semibold text-lg mb-4">Update Order</h3>

                 <form method="POST" action="{{ route('dashboard.orders.update', $order) }}">
                     @csrf
                     @method('PUT')
                     <div class="grid grid-cols-1 gap-4 mt-2">
                         <div>
                             <x-input-label for="order_status" :value="__('Order Status')" />
                             <x-select name="order_status" id="order_status" class="block mt-1 w-full">
                                 <option value="pending"
                                     {{ old('order_status', $order->order_status ?? '') == 'pending' ? 'selected' : '' }}>
                                     Pending
                                 </option>
                                 <option value="processing"
                                     {{ old('order_status', $order->order_status ?? '') == 'processing' ? 'selected' : '' }}>
                                     Processing
                                 </option>
                                 <option value="shipped"
                                     {{ old('order_status', $order->order_status ?? '') == 'shipped' ? 'selected' : '' }}>
                                     Shipped
                                 </option>
                                 <option value="delivered"
                                     {{ old('order_status', $order->order_status ?? '') == 'delivered' ? 'selected' : '' }}>
                                     Delivered
                                 </option>
                             </x-select>

                             <x-input-error :messages="$errors->get('order_status')" class="mt-2" />
                         </div>
                     </div>
                     <div class="grid grid-cols-1 gap-4 mt-2">
                         <div>
                             <x-input-label for="payment_status" :value="__('Payment Status')" />
                             <x-select name="payment_status" id="payment_status" class="block mt-1 w-full">
                                 <option value="pending"
                                     {{ old('payment_status', $order->payment_status ?? '') == 'pending' ? 'selected' : '' }}>
                                     Pending
                                 </option>
                                 <option value="paid"
                                     {{ old('payment_status', $order->payment_status ?? '') == 'paid' ? 'selected' : '' }}>
                                     paid
                                 </option>
                                 <option value="failed"
                                     {{ old('payment_status', $order->payment_status ?? '') == 'failed' ? 'selected' : '' }}>
                                     failed
                                 </option>

                             </x-select>

                             <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                         </div>
                     </div>

                     <div class="mt-4 flex justify-end">
                         <x-primary-button>
                             Update
                         </x-primary-button>
                     </div>
                 </form>
             </div>
         </div>

         {{-- Order Items --}}
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <div class="p-6 text-gray-900">
                 <h3 class="font-semibold text-lg mb-4">Order Items</h3>

                 <div class="overflow-x-auto">
                     <table class="min-w-full text-sm">
                         <thead>
                             <tr class="text-left text-gray-500 border-b">
                                 <th class="py-2">Product</th>
                                 <th class="py-2">Price</th>
                                 <th class="py-2">Qty</th>
                                 <th class="py-2">Subtotal</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($order->items as $item)
                                 <tr class="border-b">
                                     <td class="py-2">
                                         {{ $item->product->title_trans ?? 'Deleted product' }}
                                     </td>
                                     <td class="py-2">{{ number_format($item->price, 2) }}</td>
                                     <td class="py-2">{{ $item->quantity }}</td>
                                     <td class="py-2">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td class="py-3 text-center text-gray-500" colspan="4">
                                         No items found.
                                     </td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>

             </div>
         </div>

         {{-- Tracking (Optional) --}}
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <div class="p-6 text-gray-900">
                 <h3 class="font-semibold text-lg mb-4">Tracking</h3>
                 @php
                     $tracking = $order->tracking;
                 @endphp
                 <form method="POST" action="{{ route('dashboard.orders.tracking.update', $order) }}"
                     class="grid grid-cols-1 md:grid-cols-4 gap-4">
                     @csrf
                     @method('PUT')
                     <div>
                         <x-input-label for="tracking_number" value="Tracking #" />
                         <x-text-input id="tracking_number" name="tracking_number" class="mt-1 w-full"
                             :value="old('tracking_number', $tracking?->tracking_number)" /> <x-input-error :messages="$errors->get('tracking_number')" class="mt-2" />

                     </div>

                     <div>
                         <x-input-label for="status" value="Status" />
                            <x-text-input id="status" name="status" class="mt-1 w-full"
                                :value="old('status', $tracking?->status)" readonly />
                         <x-input-error :messages="$errors->get('status')" class="mt-2" />
                     </div>

                     <div>
                         <x-input-label for="shipping_company" value="Company" />
                         <x-text-input id="shipping_company" name="shipping_company" class="mt-1 w-full"
                             :value="old('shipping_company', $tracking?->shipping_company)" />
                         <x-input-error :messages="$errors->get('shipping_company')" class="mt-2" />
                     </div>

                     <div>
                         <x-input-label for="delivery_date" value="Delivery Date" />
                         <x-text-input id="delivery_date" type="date" name="delivery_date" class="mt-1 w-full"
                             :value="old(
                                 'delivery_date',
                                 $tracking?->delivery_date
                                     ? \Carbon\Carbon::parse($tracking->delivery_date)->format('Y-m-d')
                                     : '',
                             )" /> <x-input-error :messages="$errors->get('delivery_date')" class="mt-2" />
                     </div>

                     <div class="md:col-span-4 flex justify-end">
                         <x-primary-button>Update Tracking</x-primary-button>
                     </div>
                 </form>

                 <div class="mt-6">
                     <div class="text-sm text-gray-500 mb-2">History</div>
                     <ul class="space-y-2">
                        @if($order->tracking)
                            <li class="p-3 rounded border flex items-center justify-between">
                                <div>
                                    <div class="font-semibold">{{ $order->tracking->tracking_number }} — {{ $order->tracking->status }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ $order->tracking->shipping_company }} |
                                        {{ optional($order->tracking->status_date)->format('Y-m-d') }} |
                                        {{ optional($order->tracking->delivery_date)->format('Y-m-d') }}
                                    </div>
                                </div>

                                <form method="POST"
                                    action="{{ route('dashboard.orders.tracking.destroy', [$order, $order->tracking]) }}"
                                    onsubmit="return confirm('Delete tracking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                </form>
                            </li>
                         @else
                             <li class="text-gray-500 text-sm">No tracking yet.</li>
                         @endif

                         @if($order->tracking && $order->tracking->history)
                             @foreach($order->tracking->history as $h)
                                 <li class="p-3 rounded border flex items-center justify-between">
                                     <div>
                                         <div class="font-semibold">{{ $h['tracking_number'] }} — {{ $h['status'] }}</div>
                                         <div class="text-xs text-gray-500">
                                             {{ $h['shipping_company'] }} |
                                             {{ optional($h['status_date'])->format('Y-m-d') }} |
                                             {{ optional($h['delivery_date'])->format('Y-m-d') }}
                                         </div>
                                     </div>
                                 </li>
                             @endforeach
                         @endif


                     </ul>
                 </div>

             </div>
         </div>

     </div>
 </div>

 {{-- <div class="grid grid-cols-1 gap-4 mt-2">
                      <div>
                          <x-input-label for="order_status" :value="__('Order Status')" />
                          <x-select name="order_status" id="order_status" class="block mt-1 w-full">
                              <option value="pending" {{ old('order_status', $order->order_status ?? '') == 'pending' ? 'selected' : '' }}>
                                  Pending
                              </option>
                              <option value="processing" {{ old('order_status', $order->order_status ?? '') == 'processing' ? 'selected' : '' }}>
                                  Processing
                              </option>
                              <option value="shipped" {{ old('order_status', $order->order_status ?? '') == 'shipped' ? 'selected' : '' }}>
                                  Shipped
                              </option>
                              <option value="delivered" {{ old('order_status', $order->order_status ?? '') == 'delivered' ? 'selected' : '' }}>
                                  Delivered
                              </option>
                            </x-select>

                          <x-input-error :messages="$errors->get('order_status')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4 mt-2">
                      <div>
                          <x-input-label for="payment_status" :value="__('Payment Status')" />
                          <x-select name="payment_status" id="payment_status" class="block mt-1 w-full">
                              <option value="pending" {{ old('payment_status', $order->payment_status ?? '') == 'pending' ? 'selected' : '' }}>
                                  Pending
                              </option>
                              <option value="paid" {{ old('payment_status', $order->payment_status ?? '') == 'paid' ? 'selected' : '' }}>
                                  paid
                              </option>
                              <option value="failed" {{ old('payment_status', $order->payment_status ?? '') == 'failed' ? 'selected' : '' }}>
                                  failed
                              </option>

                            </x-select>

                          <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                      </div>
                  </div> --}}
