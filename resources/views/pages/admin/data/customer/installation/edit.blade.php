@extends('index')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update Instalasi</h2>
            <form action="{{ route('admin.data.installation.update', ['installation' => $installation]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer</label>
                        <input type="text" name="name" id="name" value="{{ $installation->customer->name }}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Nama">
                        @error('name')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="given_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Langganan</label>
                        <input type="text" name="given_id" id="given_id" value="{{ $installation->given_id }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="ID langganan">
                        @error('given_id')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="product"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paket</label>
                        <input type="text" name="product" id="product" value="{{ $installation->product->name }} | {{ 'Rp' . number_format($installation->product->price, 0, ',', '.') }}-/bulan" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Paket">
                        @error('product')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                            Jatuh Tempo</label>
                        <select name="due_date" id="due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @for($i=1;$i <= 31; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Lokasi</label>
                        <textarea name="location" id="location"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Nama Lokasi">{{ $installation->location_address }}</textarea>
                        @error('loc')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-8">
                    <button type="submit"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update
                    </button>
                    <a href="{{ route('admin.data.installation.index') }}"
                       class="text-blue-800 text-sm underline underline-offset-2 hover:text-blue-300">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
