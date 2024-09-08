@extends('index')
@section('title', 'Edit Pelanggan ' . $customer->name)

@section('content')
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto">
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">
                    Edit data pelanggan
                </h2>
                <p class="text-sm text-gray-600">
                    Ubah data pelanggan
                </p>
            </div>

            <form action="{{ route('admin.data.customer.update', ['customer' => $customer]) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="given_id" class="inline-block text-sm text-gray-800 mt-2.5">
                            ID Pelanggan
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="given_id" type="text" name="given_id" value="{{$customer->given_id}}"
                                   aria-describedby="hs-validation-name"
                                   class="@error('given_id')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="ID Pelanggan">
                            @error('given_id')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('given_id')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-name">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                            Nama
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="name" type="text" name="name" value="{{$customer->name}}"
                                   aria-describedby="hs-validation-name"
                                   class="@error('name')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Nama Pelanggan">
                            @error('name')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
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
                        <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Email
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="email" type="email" name="email" value="{{$customer->user->email}}"
                                   aria-describedby="hs-validation-email"
                                   class="@error('email')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="input@email.com">
                            @error('email')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('email')
                        @if($message == 'validation.unique')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">Email sudah terpakai</p>
                        @else
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @endif
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="identity" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            No Identitas (KTP/SIM/KP)
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="identity" type="text" name="identity" value="{{$customer->identity}}"
                                   aria-describedby="hs-validation-identity"
                                   class="@error('identity')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="351521376">
                            @error('identity')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('identity')
                        @if($message == 'validation.unique')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">No Identitas sudah dipakai</p>
                        @else
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @endif
                        @enderror
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
                                <span class="text-sm text-gray-500 dark:text-neutral-400">62</span>
                            </div>
                            <input required type="tel" name="phone" id="phone"
                                   value="{{Str::replaceFirst('62', '', $customer->phone)}}"
                                   aria-describedby="hs-validation-phone"
                                   class="@error('phone')border-red-500 @enderror py-3 px-4 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="8xxx">
                            @error('phone')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('phone')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="address" class="inline-block text-sm text-gray-800 mt-2.5">
                            Alamat
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <textarea required id="address" name="address" aria-describedby="hs-validation-address"
                                      class="@error('address')border-red-500 @enderror py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                      rows="6" placeholder="Jl. pinggir jalan">{{$customer->address}}</textarea>
                            @error('address')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('address')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-address">{{$message}}</p>
                        @enderror
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
                            }' class="hidden" disabled aria-describedby="hs-validation-product">
                                <option selected>{{ $customer->product->product_name }} -
                                    {{ 'Rp' . number_format($customer->product->product_price, 0, ',', '.') }}-/bulan
                                </option>
                                <input type="text" class="hidden" value="{{ $customer->product_id }}" name="product">
                            </select>
                            @error('product')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('product')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-product">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="due_date" class="inline-block text-sm text-gray-800 mt-2.5">
                            Tanggal Jatuh Tempo
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <select data-hs-select='{
                          "placeholder": "Select option...",
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-neutral-900 dark:border-neutral-700",
                          "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                          "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }' class="hidden" name="due_date" aria-describedby="hs-validation-due_date">
                                @for($i=1;$i <= 31; $i++)
                                    <option value="{{$i}}" class="py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800">{{$i}}</option>
                                @endfor
                            </select>
                            @error('due_date')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('due_date')
                        <p class="text-sm text-red-600 mt-2" id="hs-validation-due_date">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <!-- End Grid -->

                <div class="mt-5 flex justify-end gap-x-2">
                    <a href="{{ route('admin.data.customer.index') }}"
                       class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
@endsection
