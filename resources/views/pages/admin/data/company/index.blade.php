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
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-center">Action</th>
                                <th scope="col" class="px-4 py-3">Nama Perusahaan</th>
                                <th scope="col" class="px-4 py-3">Logo Perusahaan</th>
                                <th scope="col" class="px-4 py-3">Alamat Perusahaan</th>
                                <th scope="col" class="px-4 py-3">Email Perusahaan</th>
                                <th scope="col" class="px-4 py-3">No Telepon Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($company)
                                <tr class="border-b">
                                    <td class="px-4 py-3">
                                        <a href="{{ route('super-admin.companies.edit', ['company' => $company->id]) }}"
                                            class="font-medium text-white bg-blue-500 px-2 py-1 rounded border hover:bg-blue-800">Edit</a>
                                    </td>
                                    <td class="px-4 py-3">{{ $company->company_name }}</td>
                                    <td class="px-4 py-3"><img class="h-20 w-20" src="{{ asset('storage/'. $company->company_logo) }}"
                                            alt="Company Logo"></td>
                                    <td class="px-4 py-3">{{ $company->company_address }}</td>
                                    <td class="px-4 py-3">{{ $company->company_email }}</td>
                                    <td class="px-4 py-3">{{ $company->company_phone }}</td>
                                </tr>
                            @else
                                <td class="px-4 py-3 text-center" colspan="6">
                                    <h1 class="text-red-500 my-4 font-bold">Data Perusahaan Belum Ada</h1>
                                    <div
                                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-center md:space-x-3 flex-shrink-0">
                                        <a type="button" href="{{ route('super-admin.companies.create') }}"
                                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Tambahkan Data Perusahaan
                                        </a>
                                    </div>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@stop
