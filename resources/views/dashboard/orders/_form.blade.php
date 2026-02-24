
                  <div class="grid grid-cols-1 gap-4 mt-2">
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
                  </div>
