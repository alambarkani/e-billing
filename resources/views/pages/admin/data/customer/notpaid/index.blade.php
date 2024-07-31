@extends('index')

@section('content')

    <section class="bg-gray-50 dark:bg-gray-900 p-3 mt-12 sm:p-5">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" method="GET" action="{{ route('admin.datas.customer.index') }}">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="keyword" value="{{ request('keyword') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">No Identitas</th>
                                <th scope="col" class="px-4 py-3">No Telepon</th>
                                <th scope="col" class="px-4 py-3">Alamat</th>
                                <th scope="col" class="px-4 py-3">Nama Lokasi</th>
                                <th scope="col" class="px-4 py-3">Paket Langganan</th>
                                <th scope="col" class="px-4 py-3">Status Langganan</th>
                                <th scope="col" class="px-4 py-3">Terakhir Pembayaran</th>
                                <th scope="col" class="px-4 py-3">Tanggal Jatuh Tempo</th>
                                <th scope="col" class="px-4 py-3">Account</th>
                                <th scope="col" class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers->count())
                                @forelse ($customers as $customer)
                                    <tr class="border-b">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">{{ $customer->user->name }}</td>
                                        <td class="px-4 py-3">{{ $customer->identity }}</td>
                                        <td class="px-4 py-3">{{ $customer->phone }}</td>
                                        <td class="px-4 py-3">{{ $customer->address }}</td>
                                        <td class="px-4 py-3">{{ $customer->location_name }}</td>
                                        <td class="px-4 py-3">{{ $customer->internetPackage->name }}</td>
                                        <td
                                            class="px-4 py-3 font-bold {{ $customer->status ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $customer->status ? 'on' : 'off' }}</td>
                                        <td class="px-4 py-3">{{ $customer->last_payment }}</td>
                                        <td class="px-4 py-3">{{ $customer->due_date->day }}</td>
                                        <td class="px-4 py-3">{{ $customer->user->account }}</td>
                                        <td class="px-4 py-3 flex flex-col items-center gap-1 justify-center">
                                            <button data-modal-target="acc-paid-modal-{{ $customer->id }}"
                                                data-modal-toggle="acc-paid-modal-{{ $customer->id }}" type="button"
                                                class="font-medium text-white bg-green-500 px-2 py-1 rounded border hover:bg-green-800">Sudah
                                                Bayar</button>
                                            {{-- Acc Modal --}}
                                            <div id="acc-paid-modal-{{ $customer->id }}" tabindex="-1"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="acc-paid-modal-{{ $customer->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                Yakin
                                                                <span
                                                                    class="text-blue-800 font-bold">{{ $customer->role ?? ($customer->user->role ?? '') }}</span>
                                                                <span
                                                                    class="text-blue-600">{{ $customer->name ?? ($customer->user->name ?? ($customer->id ?? '')) }}</span>
                                                                Sudah melakukan pembayaran?
                                                            </h3>
                                                            <form
                                                                action="{{ route('admin.datas.customer.paid.confirm', ['customer' => $customer->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button
                                                                    data-modal-hide="acc-paid-modal-{{ $customer->id }}"
                                                                    type="submit"
                                                                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Iya, Acc
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="acc-paid-modal-{{ $customer->id }}"
                                                                type="button"
                                                                class="py-2.5 px-5 text-sm font-medium text-gray-900 hover:underline hover:text-blue-700">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12"
                                        class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        Data belum ada
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


                {{-- Pagination --}}
                {!! $customers->links() !!}
            </div>
        </div>
    </section>

@stop
