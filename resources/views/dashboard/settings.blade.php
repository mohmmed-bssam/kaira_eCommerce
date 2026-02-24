<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.settings') }}
            </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dashboard.settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h3 class="text-lg font-bold">General Settings</h3>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="site_logo" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Site Logo')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="site_logo" class="block mt-1 w-full" type="file" name="site_logo"
                                    accept="image/*" />
                                @if (isset($settings['site_logo']))
                                    <img class="p-0.5 mt-1 border rounded" width="80"
                                        src="{{ asset($settings['site_logo']) }}" alt="Site Logo" class="mt-2 h-16">
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="call_us" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Call Us')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="call_us" class="block mt-1 w-full" type="text" name="call_us"
                                    :value="$settings['call_us'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="mail_us" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Mail Us')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="mail_us" class="block mt-1 w-full" type="email" name="mail_us"
                                    :value="$settings['mail_us'] ?? ''" />
                            </div>
                        </div>
                        <x-primary-button class="mt-6">Save</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
