@extends('index')
@section('title', 'Detail User ' . $user->name)

@section('content')
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto">
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <div class="flex items-center gap-4">
                <a href="{{ route('super-admin.users.index') }}"
                   class="text-sm group  flex items-center visited:text-blue-800">
                    <svg class="w-4 h-4 text-blue-400 group-hover:text-blue-300 self-end" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m15 19-7-7 7-7"/>
                    </svg>
                    <span class="font-light group-hover:text-blue-300 text-blue-800">Kembali</span>
                </a>
                <a href="{{ route('super-admin.users.edit', ['user' => $user->id]) }}"
                   class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Edit
                </a>
                </div>
            </div>
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                    <div class="sm:col-span-3">
                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                            Nama
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required disabled id="name" type="text" name="name" value="{{ $user->name ?? ''}}"
                                   aria-describedby="hs-validation-name"
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Nama">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="username" class="inline-block text-sm text-gray-800 mt-2.5">
                            Username
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="username" disabled type="text" name="username" value="{{ $user->user->username ?? ''}}"
                                   aria-describedby="hs-validation-name"
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Username">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Email
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <input required id="email" disabled type="email" name="email" value="{{ $user->user->email ?? ''}}"
                                   aria-describedby="hs-validation-email"
                                   class="  py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   placeholder="input@email.com">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="due_date" class="inline-block text-sm text-gray-800 mt-2.5">
                            Authorize
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="relative">
                            <select data-hs-select='{
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }' class="hidden" disabled name="authorize" aria-describedby="hs-validation-due_date">
                                <option value="admin" class="py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800">Admin</option>
                                <option value="super-admin" class="py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800">Super Admin</option>
                            </select>
                        </div>


                    </div>
                </div>
                <!-- End Grid -->
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
@endsection
