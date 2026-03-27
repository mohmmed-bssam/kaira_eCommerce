                  <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="title" :value="__('Title')" />
                          <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                              :value="old('title', $blog_category->title ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('title')" class="mt-2" />
                      </div>

                  </div>

                   <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="slug" :value="__('Slug')" />
                          <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                              :value="old('slug', $blog_category->slug ?? '')"  />
                          <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                      </div>
                    </div>

