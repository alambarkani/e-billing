@extends('index')

@section('content')
    <form class="mt-20 ml-8" action="{{ route('superadmin.wagw.conn.update') }}" method="POST">
        @csrf
        <div>
            <a href="https://md.fonnte.com/new/device.php"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Atur koneksi dan nomor telepon di web resmi fonnte.com
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        <div class="my-5">
            <label for="apikey" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Api Token</label>
            <input type="text" id="apikey" value="{{ env('FONNTE_API_KEY') }}" name="fonnte_api_key"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Dapatkan token di web resmi fonnte.com" required />
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        <a href="{{ route('admin.messages.index') }}" class="ml-5 underline text-primary-800 underline-offset-2">Kembali</a>
    </form>
@endsection
