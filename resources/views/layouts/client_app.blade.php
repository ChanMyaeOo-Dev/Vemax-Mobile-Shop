<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('addToCartScript')
    @stack('editCart')
    @stack('updateQty')
</head>

<body>
    <div class="container-fluid bg-light">
        <div class="row min-vh-100 d-flex flex-column align-items-center">
            <div
                class="front_end_navbar col-md-12 d-flex justify-content-center border-bottom bg-white position-sticky top-0 z-2">
                @include('front_end.components.navbar')
            </div>

            <div class="col-md-10 p-3">
                <main class="mt-3">
                    @yield('content')
                </main>
            </div>


        </div>
    </div>
    <p class="w-100 bg-white mx-0 mb-0 p-3 text-center shadow">
        Copyrights All reserve. @2024
    </p>

    @if (session('message'))
        <script type="module">
            showToast("{{ Session::get('message') }}");
        </script>
    @endif
</body>

</html>
