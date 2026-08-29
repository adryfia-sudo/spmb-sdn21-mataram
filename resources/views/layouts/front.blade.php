<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'SPMB SD Negeri 21 Mataram')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite(['resources/js/app.js'])

    {{-- CSS aplikasi --}}
    {{-- @vite(['resources/css/app.css']) --}}

    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }

        .hero {
            background: linear-gradient(135deg,#0d6efd,#0b5ed7);
            color: white;
            padding: 90px 0;
        }

        footer {
            background: #0d6efd;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
    </style>

</head>

<body>

    @include('components.navbar')

    {{-- 
        Halaman Blade biasa:
        front.home menggunakan @section('content')
    --}}
    @yield('content')

    {{-- 
        Livewire:
        Wizard menggunakan ->layout('layouts.front')
        sehingga Livewire menyediakan $slot
    --}}
    @isset($slot)
        {{ $slot }}
    @endisset

    @include('components.footer')



    @livewireScripts

</body>
</html>
