@extends('index')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 mt-12 sm:p-5">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('errors'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <span class="font-medium">{{ session('errors') }}</span>
            </div>
        @endif
        @if ($errors->first())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @endif
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a type="button" href="{{ route('super-admin.wa-gateway.device.create') }}"
                           class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            Add Device
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Device Number</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Package</th>
                            <th scope="col" class="px-4 py-3">Quota</th>
                            <th scope="col" class="px-4 py-3 text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse ($devices['data'] as $index => $device)
                            <tr class="border-b">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $device['device'] }}</td>
                                <td class="px-4 py-3">{{ $device['name'] }}</td>
                                <td class="px-4 py-3 {{$device['status'] == 'connect' ? 'text-green-500' : 'text-red-500'}}">{{ $device['status'] }}</td>
                                <td class="px-4 py-3">{{ $device['package'] }}</td>
                                <td class="px-4 py-3">{{ $device['quota'] }}</td>
                                <td class="px-4 py-3 flex items-center justify-center">
                                    @if($device['status'] == 'disconnect')
                                        <!-- Action Button -->
                                        <button data-modal-target="device-connect-modal-{{$device['token']}}"
                                                data-modal-toggle="device-connect-modal-{{$device['token']}}"
                                                type="button"
                                                class="flex gap-1 items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                 viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
                                            </svg>
                                            Connect
                                        </button>

                                        <!-- Connect Modal-->
                                        <div id="device-connect-modal-{{$device['token']}}" data-modal-backdrop="static"
                                             tabindex="-1" aria-hidden="true"
                                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Connect Device
                                                        </h3>
                                                        <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="device-connect-modal-{{$device['token']}}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                      stroke-linejoin="round" stroke-width="2"
                                                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5 space-y-4 flex justify-center">
                                                        <div class="flex flex-col gap-1">
                                                            <p id="qr-desc-{{$index}}" class="hidden">Silahkan masuk ke whatsapp lalu tautkan perangkat dengan qr code berikut</p>
                                                            <img id="qr-img-{{$index}}" src="" alt="qr" class="hidden">
                                                        </div>
                                                        <div id="spinner-loading-qr-{{$index}}"
                                                             class="hidden items-center justify-center w-56 h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                                            <div role="status">
                                                                <svg aria-hidden="true"
                                                                     class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                                     viewBox="0 0 100 101" fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                                        fill="currentColor"/>
                                                                    <path
                                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                                        fill="currentFill"/>
                                                                </svg>
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div
                                                        class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button
                                                            onclick="connectDevice('{{$device['token']}}', '{{$device['device']}}', '{{$index}}')"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                            Generate QR Code
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button data-modal-target="device-disconnect-modal-{{$device['token']}}"
                                                data-modal-toggle="device-disconnect-modal-{{$device['token']}}"
                                                type="button"
                                                class="focus:outline-none flex items-center gap-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                 viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
                                            </svg>
                                            Disconnect
                                        </button>

                                        <!-- Disconnect Modal -->
                                        <div id="device-disconnect-modal-{{ $device['token'] }}" tabindex="-1"
                                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="device-disconnect-modal-{{ $device['token'] }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                             aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                            Are you sure you want to disconnect
                                                            <span
                                                                class="text-blue-800 font-bold">{{ $device['device'] }}</span>
                                                        </h3>
                                                        <form action="{{route( 'super-admin.wa-gateway.device.disconnecting', ['token' => urlencode($device['token'])]) }}"
                                                              method="POST">
                                                            @csrf
                                                            <button
                                                                data-modal-hide="device-disconnect-modal-{{ $device['token'] }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button
                                                            data-modal-hide="device-disconnect-modal-{{ $device['token'] }}"
                                                            type="button"
                                                            class="py-2.5 px-5 text-sm font-medium text-gray-900 hover:underline hover:text-blue-700">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <a href="{{ route('super-admin.wa-gateway.device.edit', ['token' => urlencode($device['token'])]) }}"
                                       class="text-white flex gap-1 items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        Edit</a>
                                    <button data-modal-target="device-delete-modal-{{ $device['token'] }}"
                                            data-modal-toggle="device-delete-modal-{{ $device['token'] }}" type="button"
                                            class="focus:outline-none text-white flex items-center gap-1 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                        Delete
                                    </button>

                                    <!-- Modal -->

                                    <!-- Delete Modal -->
                                    <div id="device-delete-modal-{{ $device['token'] }}" tabindex="-1"
                                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="device-delete-modal-{{$device['token']}}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        Are you sure you want to delete this product?</h3>
                                                    <button
                                                        data-modal-hide="device-delete-modal-{{$device['token']}}"
                                                        onclick="deleteDevice('{{$device['token']}}')"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Yes, I'm sure
                                                    </button>
                                                    <button data-modal-hide="device-delete-modal-{{$device['token']}}"
                                                            type="button"
                                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        No, cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Otp Modal -->
                                    <button id="otp-modal-btn-{{$device['token']}}"
                                            data-modal-target="otp-modal-{{$device['token']}}"
                                            data-modal-toggle="otp-modal-{{$device['token']}}"
                                            class="bg-teal-500 hidden">Open otp
                                    </button>
                                    <!-- Main modal -->
                                    <div id="otp-modal-{{$device['token']}}" tabindex="-1"
                                         aria-hidden="true"
                                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative dark:bg-gray-700 max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                                                <header
                                                    class="mb-8 flex flex-col items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <div class="flex w-full justify-between">
                                                        <div></div>
                                                        <button type="button"
                                                                class="relative start-6 bottom-6 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="otp-modal-{{$device['token']}}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 14 14">
                                                                <path stroke="currentColor"
                                                                      stroke-linecap="round"
                                                                      stroke-linejoin="round" stroke-width="2"
                                                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <h1 class="text-2xl font-bold mb-1">Mobile Phone
                                                        Verification</h1>
                                                    <p class="text-[15px] text-slate-500">Enter the 6-digit
                                                        verification code that was sent to your phone
                                                        number.</p>
                                                </header>
                                                <div class="p-4 md:p-5">
                                                    <form method="POST" id="otp-form" class="space-y-4"
                                                          action="{{route('super-admin.wa-gateway.device.destroy', ['token' => $device['token']])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="flex items-center justify-center gap-3">
                                                            <input
                                                                name="otp"
                                                                type="text"
                                                                class="text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                                                pattern="\d*" maxlength="6"/>
                                                        </div>
                                                        <div class="max-w-[260px] mx-auto mt-4">
                                                            <button type="submit"
                                                                    data-modal-hide="otp-modal-{{$device['token']}}"
                                                                    class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">
                                                                Verify
                                                                Account
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="text-sm text-slate-500 mt-4">Didn't receive
                                                    code? <a
                                                        class="font-medium text-indigo-500 hover:text-indigo-600"
                                                        href="#">Resend</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @empty
                                    <td class="col-span-7">
                                        Data belum ada
                                    </td>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        function connectDevice(token, device, index) {
            const load = document.getElementById(`spinner-loading-qr-${index}`);
            load.classList.add('flex');
            load.classList.remove('hidden');
            const encodedToken = encodeURIComponent(token);
            console.log(token);
            console.log(device);
            console.log(index);
            $.ajax({
                url: '/super-admin/wa-gateway/device/connect/' + encodedToken,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    device: device
                },
                success: function (response) {
                    const qr = document.getElementById(`qr-img-${index}`);
                    const desc = document.getElementById(`qr-desc-${index}`);

                    setTimeout(function () {
                        load.classList.add('hidden');
                        load.classList.remove('flex');
                        if(!response.status){
                            desc.after(`${response.reason}`)
                        }else{
                            qr.src = `data:image/png;base64,${response.url ?? ''}`;
                            qr.classList.remove('hidden');
                            desc.classList.remove('hidden');
                        }
                    }, 2000);
                }
            })
        }

        function deleteDevice(token) {
            const encodedToken = encodeURIComponent(token)
            $.ajax({
                url: '/super-admin/wa-gateway/device/delete/' + encodedToken,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    console.log(response);
                    // Show the OTP modal
                    const otpbtn = document.getElementById(`otp-modal-btn-${token}`);
                    otpbtn.click();
                }
            })
        }
    </script>
@endsection
