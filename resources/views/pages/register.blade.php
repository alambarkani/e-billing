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
    <section class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                    alt="logo">
                Flowbite
            </a>
            @if (session('success'))
                <div>
                    <span class="text-green-500">{{ session('success') }}</span>
                </div>
            @endif
            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Registrasi
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Pelanggan</label>
                            <input name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                placeholder="Nama Pelanggan" required="">
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">No Telp</label>
                            <input type="tel" name="phone" id="phone" placeholder="No Telp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                required="">
                        </div>
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat</label>
                            <textarea type="text" name="address" id="address" placeholder="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                required=""></textarea>
                        </div>
                        <div>
                            <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 ">identity</label>
                            <input type="text" name="identity" id="identity" placeholder="identity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                required="">
                        </div>
                        <div>
                            <label for="ktp_image" class="block mb-2 text-sm font-medium text-gray-900 ">Foto
                                ktp_image</label>
                            <input type="file" name="ktp_image" id="ktp_image" placeholder="ktp_image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                required="">
                        </div>
                        <div>
                            <label for="house_image" class="block mb-2 text-sm font-medium text-gray-900 ">Foto
                                rumah</label>
                            <input type="file" name="house_image" id="house_image" placeholder="house_image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5      "
                                required="">
                        </div>

                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Pilih
                                Paket</label>
                            <select id="countries" name="internet_package_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5      ">
                                <option selected>Pilih Paket</option>
                                @foreach ($pkgs as $pkg)
                                    <option value="{{ $pkg->id }}">{{ $pkg->name }} -
                                        {{ 'Rp' . number_format($pkg->price, 0, ',', '.') }}-/bulan
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">Daftar</button>
                        <p class="text-sm font-light text-gray-500 ">
                            Already have an account? <a href="{{ route('login') }}"
                                class="font-medium text-primary-600 hover:underline ">Login
                                here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
