@extends('index')

@section('content')

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Buat pelanggan baru</h2>
            <form action="{{ route('admin.datas.customer.store') }}" method="POST"
                enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nama">
                        @error('name')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="customer_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID
                            Pelanggan</label>
                        <input type="text" name="customer_id" id="customer_id" required value="{{ old('customer_id') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="ID Pelanggan">
                        @error('name')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Email">
                        @error('email')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                            Identitas</label>
                        <input type="text" name="identity" id="identity" required value="{{ old('identity') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="No Identitas">
                        @error('identity')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                            Telepon</label>
                        <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="No Telepon">
                        @error('phone')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <textarea name="address" id="address" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Alamat">{{ old('address') }}</textarea>
                        @error('address')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="loc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Lokasi</label>
                        <textarea name="loc" id="loc" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nama Lokasi">{{ old('loc') }}</textarea>
                        @error('loc')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="internet_package_id" class="block mb-2 text-sm font-medium text-gray-900 ">Pilih
                            Paket</label>
                        <select id="internet_package_id" name="internet_package_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option disabled selected class="bg-gray-200">Pilih Paket</option>
                            @foreach ($pkgs as $pkg)
                                <option value="{{ $pkg->id }}">{{ $pkg->name }} -
                                    {{ 'Rp' . number_format($pkg->price, 0, ',', '.') }}-/bulan
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                            Jatuh Tempo</label>
                        <input type="number" name="due_date" id="due_date" required min="1" max="31"
                            value="{{ old('due_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tanggal Jatuh Tempo">
                        @error('due_date')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Create Customer
                </button>
                <a href="{{ route('admin.datas.customer.index') }}"
                    class="text-blue-800 text-sm underline underline-offset-2 ml-3 hover:text-blue-300">
                    Kembali
                </a>
            </form>
        </div>
    </section>

@stop
