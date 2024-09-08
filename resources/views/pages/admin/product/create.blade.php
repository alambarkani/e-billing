@extends('index')

@section('title', 'Buat Product Baru')

@section('content')
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">
                    Buat produk baru
                </h2>
                <p class="text-sm text-gray-600">
                    Buat produk paket internet baru
                </p>
            </div>

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                            Nama
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="name" type="text" name="name" value="{{old('name')}}" aria-describedby="hs-validation-name" class="@error('name')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Nama paket">
                            @error('name')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('name')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-name">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="description" class="inline-block text-sm text-gray-800 mt-2.5">
                            Description
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="description" name="description" type="text" value="{{old('description')}}" aria-describedby="hs-validation-given" class="@error('description')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Deskripsi paket">
                            @error('description')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('description')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="price" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Harga
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="price" type="text" name="price" value="{{old('price')}}" aria-describedby="hs-validation-price"
                                   class="@error('price')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="Rp" pattern="^\Rp\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency">
                            @error('price')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('price')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <!-- End Grid -->

                <div class="mt-5 flex justify-end gap-x-2">
                    <a href="{{ route('admin.product.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
@endsection
