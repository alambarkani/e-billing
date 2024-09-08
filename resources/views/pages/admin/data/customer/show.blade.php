@extends('index')
@section('title', 'Detail Pelanggan ' . $customer->name)

@section('content')

    <div class="flex items-center gap-4">
    </div>
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.data.customer.index') }}"
                       class="text-sm group  flex items-center visited:text-blue-800">
                        <svg class="w-4 h-4 text-blue-400 group-hover:text-blue-300 self-end" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m15 19-7-7 7-7"/>
                        </svg>
                        <span class="font-light group-hover:text-blue-300 text-blue-800">Kembali</span>
                    </a>
                    <a href="{{ route('admin.data.customer.edit', ['customer' => $customer->id]) }}"
                       class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Edit
                    </a>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mt-10">
                    Detail data pelanggan {{$customer->name}}
                </h2>
            </div>
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="given_id" class="inline-block text-sm text-gray-800 mt-2.5">
                            ID Pelanggan
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input disabled required id="given_id" type="text" name="given_id" value="{{$customer->given_id}}"
                                   aria-describedby="hs-validation-name"
                                   class=" py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="ID Pelanggan">

                        </div>


                    </div>

                    <div class="sm:col-span-3">
                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                            Nama
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="name" type="text" name="name" value="{{$customer->name}}"
                                   aria-describedby="hs-validation-name" disabled
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Nama Pelanggan">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Email
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="email" type="email" name="email" value="{{$customer->user->email}}"
                                   aria-describedby="hs-validation-email" disabled
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="input@email.com">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="identity" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            No Identitas (KTP/SIM/KP)
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="identity" type="text" name="identity" value="{{$customer->identity}}"
                                   aria-describedby="hs-validation-identity" disabled
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="351521376">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="phone" class="inline-block text-sm text-gray-800 mt-2.5">
                            Phone
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="flex rounded-lg shadow-sm relative">
                            <div
                                class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 dark:bg-neutral-700 dark:border-neutral-600">
                                <span class="text-sm text-gray-500 dark:text-neutral-400">+62</span>
                            </div>
                            <input required type="tel" name="phone" id="phone"
                                   value="{{Str::replaceFirst('62', '', $customer->phone)}}"
                                   aria-describedby="hs-validation-phone" disabled
                                   class="py-3 px-4 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="8xxx">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="address" class="inline-block text-sm text-gray-800 mt-2.5">
                            Alamat
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <textarea required id="address" name="address" aria-describedby="hs-validation-address" disabled
                                      class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                      rows="6" placeholder="Jl. pinggir jalan">{{$customer->address}}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product" class="inline-block text-sm text-gray-800 mt-2.5">
                            Paket
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <select data-hs-select='{
                              "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                              "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                              "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                            }' class="hidden" disabled name="product" aria-describedby="hs-validation-product">
                                <option value="{{ $customer->product_id }}">{{ $customer->product->product_name }} -
                                    {{ 'Rp' . number_format($customer->product->product_price, 0, ',', '.') }}-/bulan
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="due_date" class="inline-block text-sm text-gray-800 mt-2.5">
                            Tanggal Jatuh Tempo
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <select data-hs-select='{
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }' class="hidden" disabled name="due_date" aria-describedby="hs-validation-due_date">
                                    <option value="{{$customer->due_date}}" class="py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800">{{$customer->due_date}}</option>
                            </select>



                        </div>


                    </div>

                    @if($customer->identity_image_path)
                    <div class="sm:col-span-3">
                        <label for="identity_image" class="inline-block text-sm text-gray-800 mt-2.5">
                            Foto KTP
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <img src="{{asset('storage/images/' . $customer->identity_image_path)}}" alt="Identity Image">
                        </div>
                    </div>
                    @endif

                    @if($customer->location_image_path)
                    <div class="sm:col-span-3">
                        <label for="location_image" class="inline-block text-sm text-gray-800 mt-2.5">
                            Foto Lokasi
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                                <img src="{{asset('storage/images/' . $customer->location_image_path)}}" alt="Location Image">
                        </div>
                    </div>
                    @endif
                </div>
                <!-- End Grid -->
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->

@endsection
