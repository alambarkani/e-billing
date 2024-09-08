@extends('index')

@section('content')

    <section class="bg-gray-50 dark:bg-gray-900 p-3 mt-12 sm:p-5">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('errors'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ session('errors') }}</span>
            </div>
        @endif
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" method="GET"
                            action="{{ route('admin.datas.internetpackage.index') }}">
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
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a type="button" href="{{ route('admin.datas.internetpackage.create') }}"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambahkan Paket
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Nama Paket</th>
                                <th scope="col" class="px-4 py-3">Harga</th>
                                <th scope="col" class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pkgs as $pkg)
                                <tr class="border-b">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $pkg->name }}</td>
                                    <td class="px-4 py-3">{{ 'Rp' . number_format($pkg->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 flex items-center gap-2 justify-center">
                                        <a href="{{ route('admin.datas.internetpackage.edit', ['internetpackage' => $pkg->id]) }}"
                                            class="font-medium text-white bg-blue-500 px-2 py-1 rounded border hover:bg-blue-800">Edit</a>
                                        <button data-modal-target="pkg-delete-modal-{{ $pkg->id }}"
                                            data-modal-toggle="pkg-delete-modal-{{ $pkg->id }}" type="button"
                                            class="font-medium text-white bg-red-500 px-2 py-1 rounded border hover:bg-red-800">Delete</button>
                                        {{-- Delete Modal --}}
                                        @include('components.modals.delete', [
                                            'item' => $pkg,
                                            'tab' => 'pkg',
                                            'routing' => route('admin.datas.internetpackage.destroy', [
                                                'internetpackage' => $pkg->id,
                                            ]),
                                        ])

                                        <a href="{{ route('admin.datas.internetpackage.show', ['internetpackage' => $pkg->id]) }}"
                                            class="font-medium text-blue-600 hover:underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data belum ada
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                {{-- Pagination --}}
                {!! $pkgs->links() !!}
            </div>
        </div>
    </section>

@stop
