<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.products') }}
            </h2>
            <a class="bg-green-600 p-1 px-8 rounded text-white hover:bg-green-500 duration-200"
                href="{{ route('dashboard.products.create') }}">{{ __('Add product') }}</a>
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
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset($product->image->path) }}"
                                                width="80"  alt="">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->title_trans }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->category->title_trans }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->stock }}
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2 text-center">
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                class="text-blue-600 hover:underline"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>

                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            No products found.
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
