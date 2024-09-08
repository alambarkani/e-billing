@extends('index')

@section('content')

    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">

            <div
                class="max-w-sm bg-green-500 border pt-6 border-gray-200 rounded-lg shadow text-center flex flex-col justify-between">
                <div href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">??</h5>
                </div>
                <p class="mb-3 font-normal text-gray-200">Data Pelanggan</p>
                <a href="{{ route('admin.data.customer.index') }}"
                    class="inline-flex justify-center items-center px-3 py-2 mt-6 text-sm font-medium text-center text-white bg-green-600 rounded-br-lg rounded-bl-lg hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-green-300">
                    Selengkapnya
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div
                class="max-w-sm bg-blue-500 border pt-6 border-gray-200 rounded-lg shadow text-center flex flex-col justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">??</h5>
                </div>
                <p class="mb-3 font-normal text-gray-200">Pembayaran</p>
                <a href="{{ route('payment.index') }}"
                    class="inline-flex justify-center items-center px-3 py-2 mt-6 text-sm font-medium text-center text-white bg-blue-600 rounded-br-lg rounded-bl-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300">
                    Selengkapnya
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div
                class="max-w-sm bg-red-500 border pt-6 border-gray-200 rounded-lg shadow text-center flex flex-col justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">??</h5>
                </div>
                <p class="mb-3 font-normal text-gray-200">Tagihan Bulan Ini</p>
                <a href="{{ route('invoice.bill') }}"
                    class="inline-flex justify-center items-center px-3 py-2 mt-6 text-sm font-medium text-center text-white bg-red-600 rounded-br-lg rounded-bl-lg hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                    Selengkapnya
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

@stop
