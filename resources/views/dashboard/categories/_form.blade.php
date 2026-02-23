                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="title_en" :value="__('English Title')" />
                          <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title_en"
                              :value="old('title_en', $category->title['en'] ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="title_ar" :value="__('Arabic Title')" />
                          <x-text-input id="title_ar" class="block mt-1 w-full" type="text" name="title_ar"
                              :value="old('title_ar', $category->title['ar'] ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
                      </div>
                  </div>

                  <div class="mt-4">
                      <x-input-label for="image" />
                      <x-text-input accept="image/*" id="image" class="block mt-1 w-full" type="file"
                          name="image" />
                      @if ($category && $category->image)
                          <img src="{{ asset($category->image->path) }}" alt="category Image" width="100">
                      @endif
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
                   <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="slug" :value="__('Slug')" />
                          <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                              :value="old('slug', $category->slug ?? '')"  />
                          <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                      </div>
                    </div>

