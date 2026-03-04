<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.customers') }}
            </h2>
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
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Total Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Payments Count
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Created At
                                    </th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $customer->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $customer->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ $customer->payments->sum('amount') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $customer->payments->count() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $customer->created_at->format('Y-m-d') }}
                                        </td>



                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            No customers found.
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
