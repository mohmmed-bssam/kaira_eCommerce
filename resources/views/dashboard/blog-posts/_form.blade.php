                  <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="title" :value="__('Title')" />
                          <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                              :value="old('title', $blog_post->title ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title')" class="mt-2" />
                      </div>

                  </div>

                  <div class="mt-4">
                      <x-input-label for="image" />
                      <x-text-input accept="image/*" id="image" class="block mt-1 w-full" type="file"
                          name="image" />
                      @if ($blog_post && $blog_post->image)
                          <img src="{{ asset($blog_post->image->path) }}" alt="product Image" width="100">
                      @endif
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
                  <div class="grid grid-cols-1 gap-4 mt-2">
                      <div>
                          <x-input-label for="slug" :value="__('Slug')" />
                          <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                              :value="old('slug', $blog_post->slug ?? '')" />
                          <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                      </div>
                  </div>

                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="excerpt" :value="__('Excerpt')" />
                          <x-textarea id="excerpt" rows="5" class="block mt-1 w-full"
                              name="excerpt">{{ old('excerpt', $blog_post->excerpt ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />

                      </div>
                      <div class="mt-4">
                          <x-input-label for="content" :value="__('Content')" />
                          <x-textarea id="content" rows="5" class="block mt-1 w-full"
                              name="content">{{ old('content', $blog_post->content ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('content')" class="mt-2" />
                      </div>

                  </div>

                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="category_id" :value="__('Category')" />
                          <select id="category_id" name="category_id"
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                              <option value="" disabled>-- {{ __('Select Category') }} --</option>
                              @foreach ($categories as $category)
                                  <option value="{{ $category->id }}"
                                      {{ old('category_id', $blog_post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                      {{ $category->title }}
                                  </option>
                              @endforeach
                          </select>
                          <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="status" :value="__('Status')" />
                          <select id="status" name="status"
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                              <option value="" disabled>-- {{ __('Select Status') }} --</option>
                              <option value="draft"
                                  {{ old('status', $blog_post->status ?? '') == 'draft' ? 'selected' : '' }}>
                                  {{ __('Draft') }}
                              </option>
                              <option value="published"
                                  {{ old('status', $blog_post->status ?? '') == 'published' ? 'selected' : '' }}>
                                  {{ __('Published') }}
                              </option>
                          </select>
                          <x-input-error :messages="$errors->get('status')" class="mt-2" />
                      </div>
                  </div>
