@extends('index')

@section('content')
    @php
        use Carbon\Carbon;
        $customer = Auth::user()->load('customer')->customer;
        $invoice = $customer->invoice->all();

        $subtotal = 0;
        foreach ($invoice as $index => $inv) {
            $subtotal += $customer->internetPackage->price;
        }
    @endphp
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto mt-14">
        <div class="flex items-center justify-between mb-8">
            <div class="flex flex-col gap-3">
                @if ($company)
                    <div class="flex items-center">
                        <img class="h-8 w-auto mr-2" src="/storage/{{ $company->logo }}" alt="Logo" />
                        <div class="text-gray-700 font-semibold text-lg">{{ $company->name }}</div>
                    </div>
                    <div class="flex flex-col">
                        <div>{{ $company->address }}</div>
                        <div>{{ $company->email }}</div>
                        <div>{{ $company->phone }}</div>
                    </div>
                @endif
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">INVOICE</div>
                <div class="text-sm">Invoice # :
                    {{ $customer->invoice->first()->invoice_ref }} </div>
                <div class="text-sm">Jatuh Tempo : {{ Carbon::parse($customer->due_date)->format('d') }} </div>
                <div class="text-sm">ID Pelanggan : {{ $customer->customer_id }} </div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Pelanggan</h2>
            <div class="text-gray-700 mb-2">{{ Auth::user()->name }}</div>
            <div class="text-gray-700 mb-2">{{ $customer->phone }}</div>
            <div class="text-gray-700 mb-2">{{ $customer->address }}</div>
            <div class="text-gray-700">{{ Auth::user()->email }}</div>
        </div>
        <table class="w-full text-left mb-8">
            <thead>
                <tr>
                    <th class="text-gray-700 font-bold uppercase py-2">Item</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Deskripsi</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-4 text-gray-700">{{ $customer->internetPackage->name }}
                    </td>
                    <td class="py-4 text-gray-700">
                        {{ Carbon::parse($customer->invoice->first()->month)->format('F Y') }}
                    </td>
                    <td class="py-4 text-gray-700">
                        Rp{{ number_format($customer->internetPackage->price, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">Rp{{ number_format($subtotal, 0, ',', '.') }}</div>
        </div>
        <div class="text-right mb-8">
            <div class="text-gray-700 mr-2">Denda:</div>
            <div class="text-gray-700">$25.50</div>

        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">$450.50</div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments are subject to fees.</div>
            <div class="text-gray-700 mb-2">Please make checks payable to Your Company Name and mail to:</div>
            <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
        </div>
    </div>
@endsection
