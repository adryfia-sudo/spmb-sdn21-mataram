<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SPMB SD Negeri 21 Mataram')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    {{-- CSS aplikasi (jika nanti memakai Vite) --}}
    {{-- @vite(['resources/css/app.css']) --}}

    @livewireStyles
    
    <style>

        body{

            font-family:'Inter',sans-serif;

            background:#f8fafc;

        }

        .navbar{

            box-shadow:0 2px 8px rgba(0,0,0,.05);

        }

        .hero{

            background:linear-gradient(135deg,#0d6efd,#0b5ed7);

            color:white;

            padding:90px 0;

        }

        footer{

            background:#0d6efd;

            color:white;

            padding:40px 0;

            margin-top:60px;

        }

    </style>

</head>

<body>

@include('components.navbar')

<main class="min-vh-100" >

{{ $slot }}

</main>

@include('components.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- JS aplikasi --}}
    {{-- @vite(['resources/js/app.js']) --}}

    @livewireScripts

</body>

</html>
