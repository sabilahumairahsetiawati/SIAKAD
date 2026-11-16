<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <!-- <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet"> -->

    <!-- CSS SIAKAD -->
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">

    <!-- CSS halaman -->
    @yield('styles')

    <!-- CSS tambahan dari push -->
    @stack('styles')
</head>

<body class="bg-body-tertiary">

    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">

            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">

                @include('layouts.partials.flash')

                @yield('content')

                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                    - D3 Teknik Informatika
                </footer>

            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- JavaScript halaman -->
    @yield('scripts')

    <!-- JavaScript tambahan dari push -->
    @stack('scripts')

</body>
</html>