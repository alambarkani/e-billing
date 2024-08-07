<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800 flex flex-col justify-between">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- Kelola Data --}}
            <li x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group  hover:bg-gray-700"
                    aria-controls="data-dropdown" data-collapse-toggle="data-dropdown">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kelola Data</span>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24" x-show="!open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14 8-4 4 4 4" />
                    </svg>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24" x-show="open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 10 4 4 4-4" />
                    </svg>
                </button>
                <ul id="data-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.datas.customer.index') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Pelanggan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Diskon</a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.companies.index') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Perusahaan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Tipe Pembayaran</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.notif') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Notifikasi</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.index') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            WA Gateway</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.datas.internetpackage.index') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Paket
                            Internet</a>
                    </li>
                </ul>
            </li>

            <!-- Ticket -->
            <li x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group  hover:bg-gray-700"
                    aria-controls="ticket-dropdown" data-collapse-toggle="ticket-dropdown">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path
                            d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ticket</span>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24" x-show="!open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14 8-4 4 4 4" />
                    </svg>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24" x-show="open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 10 4 4 4-4" />
                    </svg>
                </button>
                <ul id="ticket-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Ticket Pelanggan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Data
                            Ticket General</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Pengumuman</a>
                    </li>
                </ul>
            </li>
            <li x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group  hover:bg-gray-700"
                    aria-controls="transaksi-dropdown" data-collapse-toggle="transaksi-dropdown">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaksi</span>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" x-show="!open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14 8-4 4 4 4" />
                    </svg>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" x-show="open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 10 4 4 4-4" />
                    </svg>
                </button>
                <ul id="transaksi-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Pembayaran
                            Langganan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Pembayaran
                            Umum</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group  hover:bg-gray-700">Pengeluaran</a>
                    </li>
                </ul>
            </li>
            <li x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group  hover:bg-gray-700"
                    aria-controls="payment-dropdown" data-collapse-toggle="payment-dropdown">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 18 21">
                        <path
                            d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Payment Gateway</span>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" x-show="!open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14 8-4 4 4 4" />
                    </svg>
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" x-show="open">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 10 4 4 4-4" />
                    </svg>
                </button>
                <ul id="payment-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Data
                            Payment Gateway</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Data
                            Call Back</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
            <li>
                <a href="#"
                    class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-gray-700  group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white :text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 17 20">
                        <path
                            d="M7.958 19.393a7.7 7.7 0 0 1-6.715-3.439c-2.868-4.832 0-9.376.944-10.654l.091-.122a3.286 3.286 0 0 0 .765-3.288A1 1 0 0 1 4.6.8c.133.1.313.212.525.347A10.451 10.451 0 0 1 10.6 9.3c.5-1.06.772-2.213.8-3.385a1 1 0 0 1 1.592-.758c1.636 1.205 4.638 6.081 2.019 10.441a8.177 8.177 0 0 1-7.053 3.795Z" />
                    </svg>
                    <span class="ms-3">Logs</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-gray-700  group">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Setting</span>
                </a>
            </li>
            <li>
                <a href="/admin/users"
                    class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-gray-700  group">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Users</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="hover:bg-gray-700 group rounded-lg">
                    @csrf
                    @method('DELETE')
                    <button class="flex items-center p-2 text-white transition duration-75 group">
                        <svg class="w-6 h-6 text-red-800 group-hover:text-red-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                        </svg>
                        <span class="ms-3">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
