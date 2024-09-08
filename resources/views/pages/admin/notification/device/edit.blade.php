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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ubah Nama Device</h2>
            <form action="{{ route('super-admin.wa-gateway.device.update', ['token' => urlencode($token)]) }}" method="POST"
                  enctype="application/x-www-form-urlencoded">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="name" id="name" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Nama">
                        @error('name')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Ubah
                </button>
                <a href="{{ route('super-admin.wa-gateway.device') }}"
                   class="text-blue-800 text-sm underline underline-offset-2 ml-3 hover:text-blue-300">
                    Kembali
                </a>
            </form>
        </div>
    </section>

    <div class="">
        <h1 class="text-xl font-bold">Note!</h1>
        <p>Fonnte tidak memperbolehkan untuk edit nomor device, kalau ingin ganti cukup tambahkan device lain dan ganti connection ke device baru.
            Jika device yang lama tidak dibutuhkan maka boleh dihapus
        </p>
    </div>

@endsection
