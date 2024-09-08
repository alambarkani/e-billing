@extends('index')

@section('content')
<div class="mx-4 min-h-screen max-w-screen-xl sm:mx-8 xl:mx-auto">
    <h1 class="border-b py-6 text-4xl font-semibold">Settings</h1>
    <div class="grid grid-cols-8 pt-3 sm:grid-cols-10">
        <div class="relative my-4 w-56 sm:hidden">
            <input class="peer hidden" type="checkbox" name="select-1" id="select-1" />
            <label for="select-1" class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700 ring-blue-700 peer-checked:ring">Accounts </label>
            <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-slate-700 transition peer-checked:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
            <ul class="max-h-0 select-none flex-col overflow-hidden rounded-b-lg shadow-md transition-all duration-300 peer-checked:max-h-56 peer-checked:py-3">
                <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Accounts</li>
                <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Team</li>
                <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Others</li>
            </ul>
        </div>

        <div class="col-span-2 hidden sm:block">
            <nav aria-label="Tabs" role="tablist" aria-orientation="vertical" class="flex flex-col items-start">
                <button type="button" id="account-tabs-item" aria-selected="true" data-hs-tab="#account-tabs" aria-controls="account-tabs" role="tab" class="active hs-tab-active:border-l-blue-700 hs-tab-active:text-blue-700 transition hover:border-l-blue-700 mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold hover:text-blue-700">Account</button>
                <button type="button" id="general-tabs-item" aria-selected="false" data-hs-tab="#general-tabs" aria-controls="general-tabs" role="tab" class="hs-tab-active:border-l-blue-700 hs-tab-active:text-blue-700 mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">General</button>
            </nav>
        </div>

        <div class="col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow" id="account-tabs" role="tabpanel" aria-labelledby="account-tabs-item">
            <div class="pt-4">
                <h1 class="py-2 text-2xl font-semibold">Account settings</h1>
                <!-- <p class="font- text-slate-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p> -->
            </div>
            <hr class="mt-4 mb-8" />
            <p class="py-2 text-xl font-semibold">Email Address</p>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <p class="text-gray-600">Your email address is <strong>{{Auth::user()->email}}</strong></p>
                <button class="inline-flex text-sm font-semibold text-blue-600 underline decoration-2">Change</button>
            </div>
            <hr class="mt-4 mb-8" />
            <p class="py-2 text-xl font-semibold">Password</p>
            <div class="flex items-center">
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-3">
                    <label for="login-password">
                        <span class="text-sm text-gray-500">Current Password</span>
                        <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
                            <input type="password" id="login-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" placeholder="***********" />
                        </div>
                    </label>
                    <label for="login-password">
                        <span class="text-sm text-gray-500">New Password</span>
                        <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
                            <input type="password" id="login-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" placeholder="***********" />
                        </div>
                    </label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-5 ml-2 h-6 w-6 cursor-pointer text-sm font-semibold text-gray-600 underline decoration-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </div>
            <p class="mt-2">Can't remember your current password. <a class="text-sm font-semibold text-blue-600 underline decoration-2" href="#">Recover Account</a></p>
            <button class="mt-4 rounded-lg bg-blue-600 px-4 py-2 text-white">Save Password</button>
            <hr class="mt-4 mb-8" />

        </div>


        <div class="hidden col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow" id="general-tabs" role="tabpanel" aria-labelledby="account-tabs-item">
            <div class="pt-4">
                <h1 class="py-2 text-2xl font-semibold">General settings</h1>
                <!-- <p class="font- text-slate-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p> -->
            </div>
            <hr class="mt-4 mb-8" />
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-500">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        Card link
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection