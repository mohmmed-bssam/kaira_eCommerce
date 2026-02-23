                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="title_en" :value="__('English Title')" />
                          <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title_en"
                              :value="old('title_en', $slider->title['en'] ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="title_ar" :value="__('Arabic Title')" />
                          <x-text-input id="title_ar" class="block mt-1 w-full" type="text" name="title_ar"
                              :value="old('title_ar', $slider->title['ar'] ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
                      </div>
                  </div>

                  <div class="mt-4">
                      <x-input-label for="image" />
                      <x-text-input accept="image/*" id="image" class="block mt-1 w-full" type="file"
                          name="image" />
                      @if ($slider && $slider->image)
                          <img src="{{ asset($slider->image->path) }}" alt="Slider Image" width="100">
                      @endif
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="content_en" :value="__('English Content')" />
                          <x-textarea id="content_en" rows="5" class="block mt-1 w-full"
                              name="content_en">{{ old('content_en', $slider->content['en'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('content_en')" class="mt-2" />
                      </div>
                      <div class="mt-4">
                          <x-input-label for="content_ar" :value="__('Arabic Content')" />
                          <x-textarea id="content_ar" rows="5" class="block mt-1 w-full"
                              name="content_ar">{{ old('content_ar', $slider->content['ar'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('content_ar')" class="mt-2" />
                      </div>
                  </div>
