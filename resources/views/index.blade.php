<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="{{asset('storage/' . \App\Models\Company::first()->company_logo ?? '')}}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>
</head>

<body>
    <div>
        @include('partials.navbar')
        @include('partials.sidebar')
    </div>
    <div class="p-4 sm:ml-64">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- <script src="/js/select.js"></script> --}}
    <script src="/js/currency.js"></script>
    <script src="/js/script.js"></script>
    @yield('scripts')
</body>

</html>
