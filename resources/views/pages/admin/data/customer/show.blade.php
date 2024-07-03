@extends('index')

@section('content')

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Pelanggan {{ $customer->user->name }}</h2>
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input disabled type="text" name="name" id="name" required value="{{ $customer->user->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nama">
                </div>
                <div class="sm:col-span-2">
                    <label for="customer_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID
                        Pelanggan</label>
                    <input disabled type="text" name="customer_id" id="customer_id" required
                        value="{{ $customer->customer_id }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="ID Pelanggan">
                </div>
                <div>
                    <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                        Identitas</label>
                    <input disabled type="text" name="identity" id="identity" required value="{{ $customer->identity }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="No Identitas">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                        Telepon</label>
                    <input disabled type="tel" name="phone" id="phone" required value="{{ $customer->phone }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="No Telepon">
                </div>
                <div class="sm:col-span-2">
                    <label for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <textarea name="address" id="address" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Alamat">{{ $customer->address }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label for="loc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Lokasi</label>
                    <textarea name="loc" id="loc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nama Lokasi">{{ $customer->location_name }}</textarea>
                </div>
                <div>
                    <label for="internet_package_id" class="block mb-2 text-sm font-medium text-gray-900 ">Pilih
                        Paket</label>
                    <select id="internet_package_id" name="internet_package_id" disabled
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option disabled selected class="bg-gray-200">Pilih Paket</option>
                        @foreach ($pkgs as $pkg)
                            <option {{ $customer->internet_package_id == $pkg->id ? 'selected' : '' }}
                                value="{{ $pkg->id }}">{{ $pkg->name }} -
                                {{ 'Rp' . number_format($pkg->price, 0, ',', '.') }}-/bulan
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Jatuh Tempo</label>
                    <input disabled type="number" name="due_date" id="due_date" required min="1" max="31"
                        value="{{ $customer->due_date }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Tanggal Jatuh Tempo">
                </div>
                <div>
                    <label for="account"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account</label>
                    <input disabled type="text" name="account" id="account" required
                        value="{{ $customer->user->account }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Account">
                </div>
                <div>
                    <div class="sm:col-span-2">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input disabled type="text" name="password" id="password"
                            value="{{ $customer->user->password }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="••••••••">
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.datas.customer.edit', ['customer' => $customer->id]) }}"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Edit
            </a>
            <a href="{{ route('admin.datas.customer.index') }}"
                class="text-blue-800 text-sm underline underline-offset-2 ml-3 hover:text-blue-300">
                Kembali
            </a>
        </div>
    </section>

@stop
