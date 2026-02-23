                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="title_en" :value="__('English Title')" />
                          <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title_en"
                              :value="old('title_en', $product->title['en'] ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="title_ar" :value="__('Arabic Title')" />
                          <x-text-input id="title_ar" class="block mt-1 w-full" type="text" name="title_ar"
                              :value="old('title_ar', $product->title['ar'] ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
                      </div>
                  </div>

                  <div class="mt-4">
                      <x-input-label for="image" />
                      <x-text-input accept="image/*" id="image" class="block mt-1 w-full" type="file"
                          name="image" />
                      @if ($product && $product->image)
                          <img src="{{ asset($product->image->path) }}" alt="product Image" width="100">
                      @endif
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
                  <div class="grid grid-cols-1 gap-4 mt-2">
                      <div>
                          <x-input-label for="slug" :value="__('Slug')" />
                          <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                              :value="old('slug', $product->slug ?? '')" />
                          <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="content_en" :value="__('English Content')" />
                          <x-textarea id="content_en" rows="5" class="block mt-1 w-full"
                              name="content_en">{{ old('content_en', $product->content['en'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('content_en')" class="mt-2" />
                      </div>
                      <div class="mt-4">
                          <x-input-label for="content_ar" :value="__('Arabic Content')" />
                          <x-textarea id="content_ar" rows="5" class="block mt-1 w-full"
                              name="content_ar">{{ old('content_ar', $product->content['ar'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('content_ar')" class="mt-2" />

                      </div>
                  </div>
                  <div class="grid grid-cols-3 gap-4 mt-4">
                      <div>
                          <x-input-label for="price" :value="__('Price')" />
                          <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                              step="0.01" min="0" :value="old('price', $product->price ?? '')" />
                          <x-input-error :messages="$errors->get('price')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="stock" :value="__('Stock')" />
                          <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                              min="0" :value="old('stock', $product->stock ?? '')" />
                          <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="sales_count" :value="__('Sales Count')" />
                          <x-text-input id="sales_count" class="block mt-1 w-full" type="number" name="sales_count"
                              min="0" :value="old('sales_count', $product->sales_count ?? '')" />
                          <x-input-error :messages="$errors->get('sales_count')" class="mt-2" />
                      </div>

                  </div>
                  <div class="grid grid-cols-1 gap-4">
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- {{ __('Select Category') }} --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title_trans  }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                  </div>

