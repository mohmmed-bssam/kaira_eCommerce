<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Blog Post') }}
            </h2>
            <a class="bg-green-600 p-1 px-8 rounded text-white hover:bg-green-500 duration-200"
                href="{{ route('dashboard.blog-posts.index') }}">{{ __('All blog posts') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <form method="POST" action="{{ route('dashboard.blog-posts.update', $blog_post->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.blog-posts._form')
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update blog post') }}
                            </x-primary-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
