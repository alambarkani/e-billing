<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">
                    Registrasi
                </h2>
                <p class="text-sm text-gray-600">
                    Masukkan data yang sesuai
                </p>
            </div>

            <form action="{{ route('register-post') }}" method="POST" enctype="multipart/form-data">
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
                            <input required id="name" type="text" name="name" value="{{old('name')}}" aria-describedby="hs-validation-name" class="@error('name')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama Pelanggan">
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
                        <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Email
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="email" type="email" name="email" value="{{old('email')}}" aria-describedby="hs-validation-email" class="@error('email')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="input@email.com">
                            @error('email')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <input required id="identity" type="text" name="identity" value="{{old('identity')}}" aria-describedby="hs-validation-identity" class="@error('identity')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="351521376">
                            @error('identity')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <div class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 dark:bg-neutral-700 dark:border-neutral-600">
                                <span class="text-sm text-gray-500 dark:text-neutral-400">62</span>
                            </div>
                            <input required type="tel" name="phone" id="phone" value="{{old('phone')}}" aria-describedby="hs-validation-phone" class="@error('phone')border-red-500 @enderror py-3 px-4 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="8xxx">
                            @error('phone')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            <textarea required id="address" name="address" aria-describedby="hs-validation-address" class="@error('address')border-red-500 @enderror py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="6" placeholder="Jl. pinggir jalan">{{old('address')}}</textarea>
                            @error('address')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                        <label for="identity_image_path" class="inline-block text-sm text-gray-800 mt-2.5">
                            Foto Identitas (KTP/SIM/KP)
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <label for="identity_image_input" class="sr-only">Choose file</label>
                        <input type="file" name="identity_image_path" id="identity_image_input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                            file:bg-gray-50 file:border-0
                            file:me-4
                            file:py-3 file:px-4
                           ">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="location_image_path" class="inline-block text-sm text-gray-800 mt-2.5">
                            Foto Lokasi
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <label for="location_image_input" class="sr-only">Choose file</label>
                        <input type="file" name="location_image_path" id="location_image_input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                            file:bg-gray-50 file:border-0
                            file:me-4
                            file:py-3 file:px-4
                           ">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="product" class="inline-block text-sm text-gray-800 mt-2.5">
                            Pilih Paket
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <select data-hs-select='{
                              "hasSearch": true,
                              "searchPlaceholder": "Search...",
                              "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
                              "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                              "placeholder": "Pilih paket...",
                              "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                              "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                              "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                              "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                              "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
                              "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                            }' class="hidden" name="product" aria-describedby="hs-validation-product">
                                <option value="">Choose</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }} -
                                        {{ 'Rp' . number_format($product->product_price, 0, ',', '.') }}-/bulan
                                    </option>
                                @endforeach
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
                        <label for="username" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Username
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="username" type="text" name="username" value="{{old('username')}}" aria-describedby="hs-validation-username" class="@error('username')border-red-500 @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Username12345">
                            @error('username')
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error('username')
                        @if($message == 'validation.unique')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">Username sudah terpakai</p>
                        @else
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @endif
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="password" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Password
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <div class="relative">
                                <input id="hs-toggle-password-multi-toggle-np" name="password" type="password" class="@error('password')border-red-500 @enderror py-3 ps-4 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter password">
                                <button type="button" data-hs-toggle-password='{
          "target": ["#hs-toggle-password-multi-toggle", "#hs-toggle-password-multi-toggle-np"]
        }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                                    <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                        <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                        <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                        <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                        @if($message == 'validation.required')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">Password harus diisi dan harus match</p>
                        @else
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @endif
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Confirm Password
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <div class="relative">
                                <input id="hs-toggle-password-multi-toggle" name="password_confirmation" type="password" class="@error('password_confirmation')border-red-500 @enderror py-3 ps-4 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Confirm password">
                                <button type="button" data-hs-toggle-password='{
          "target": ["#hs-toggle-password-multi-toggle", "#hs-toggle-password-multi-toggle-np"]
        }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                                    <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                        <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                        <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                        <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password_confirmation')
                        @if($message == 'validation.required')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">Password harus diisi dan harus match</p>
                        @else
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-phone">{{$message}}</p>
                        @endif
                        @enderror
                    </div>
                </div>
                <!-- End Grid -->

                <div class="mt-5 flex justify-center gap-x-2 flex-col text-center">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm text-center font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Sign Up
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{route('login')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
</body>

</html>
