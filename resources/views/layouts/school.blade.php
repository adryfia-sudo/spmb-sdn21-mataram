<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'SD Negeri 21 Mataram')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/js/app.js'])

    <style>

        :root {
            --school-primary: #0d6efd;
            --school-primary-dark: #0b5ed7;
            --school-text: #1f2937;
            --school-muted: #64748b;
            --school-light: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--school-light);
            color: var(--school-text);
        }
	/* WATERMARK LOGO */
	.school-fixed-watermark {
    	    position: fixed;
    	    inset: 0;

    	    display: flex;
    	    align-items: center;
    	    justify-content: center;

    	    pointer-events: none;
    	    z-index: 0;

    	    overflow: hidden;
	}

	.school-fixed-watermark img {
    	    width: min(700px, 70vw);
    	    height: min(700px, 70vw);

    	    object-fit: contain;

    	    opacity: .055;
	}

	.school-navbar,
	    main,
	.school-footer {
    	    position: relative;
    	    z-index: 1;
	}

        /* =========================
           NAVBAR
        ========================= */

        .school-navbar {
            background: rgba(255, 255, 255, .96);
            border-bottom: 1px solid rgba(15, 23, 42, .08);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(12px);
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--school-text);
        }

        .school-brand-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .school-brand-name {
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
        }

        .school-brand-subtitle {
            font-size: 11px;
            color: var(--school-muted);
        }

        .school-navbar .nav-link {
            color: #334155;
            font-weight: 500;
            padding: 10px 14px;
        }
	.school-mobile-menu-button {
    	    display: none;
    	    border: 0;
    	    background: transparent;
    	    color: var(--school-text);
    	    font-size: 28px;
    	    line-height: 1;
    	    padding: 6px 8px;
	}

	.school-mobile-menu {
    	    display: none;
	}

	.school-mobile-menu .nav-link {
    	    display: block;
    	    padding: 12px 8px;
    	    border-top: 1px solid rgba(15, 23, 42, .06);
	}

	@media (max-width: 991px) {

    	.school-mobile-menu-button {
            display: block;
    	}

    	.school-mobile-menu.show {
            display: block;
    	}

}

        .school-navbar .nav-link:hover {
            color: var(--school-primary);
        }

        /* =========================
           HERO
        ========================= */

	.school-hero {
    	    position: relative;
    	    overflow: hidden;
    	    min-height: 620px;
    	    display: flex;
    	    align-items: center;
    	    background-color: var(--school-primary);
    	    background-position: center;
    	    background-size: cover;
    	    background-repeat: no-repeat;
    	    color: white;
	}

	.school-hero::before {
    	    content: "";
    	    position: absolute;
    	    inset: 0;
    	    background: rgba(15, 23, 42, .48);
    	    z-index: 0;
	}

        .school-hero-watermark {
            position: absolute;
            width: 620px;
            height: 620px;
            object-fit: contain;
            right: -80px;
            top: 50%;
            transform: translateY(-50%);
            opacity: .07;
            pointer-events: none;
        }

        .school-hero-content {
            position: relative;
            z-index: 2;
        }

        .school-hero-badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
        }

        .school-hero h1 {
            font-size: clamp(2.3rem, 5vw, 4.5rem);
            line-height: 1.05;
            font-weight: 800;
            margin-top: 20px;
        }

        .school-hero-description {
            max-width: 650px;
            font-size: 18px;
            line-height: 1.8;
            color: rgba(255,255,255,.9);
        }

        .school-hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .school-hero-logo-wrapper {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
        }

        .school-hero-logo {
            width: 280px;
            height: 280px;
            object-fit: contain;
            padding: 24px;
            background: rgba(255,255,255,.96);
            border-radius: 32px;
            box-shadow: 0 25px 70px rgba(0,0,0,.25);
        }

        /* =========================
           SECTION
        ========================= */

        .school-section {
            padding: 90px 0;
        }

        .school-section-label {
            color: var(--school-primary);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .school-section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin-top: 8px;
        }

        .school-section-description {
            color: var(--school-muted);
            max-width: 650px;
            line-height: 1.8;
        }

        /* =========================
           CARDS
        ========================= */

        .school-card {
            background: white;
            border: 1px solid rgba(15,23,42,.06);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 10px 35px rgba(15,23,42,.06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .school-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 45px rgba(15,23,42,.10);
        }

        .school-card-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: rgba(13,110,253,.10);
            font-size: 24px;
            margin-bottom: 20px;
        }

        .school-card h3,
        .school-card h4 {
            font-weight: 700;
        }

        .school-card p {
            color: var(--school-muted);
            line-height: 1.7;
        }

        /* =========================
           CONTACT
        ========================= */

        .school-contact-section {
            padding: 90px 0;
            background: white;
        }

        .school-contact-card {
            border-radius: 24px;
            padding: 35px;
            background: var(--school-light);
            border: 1px solid rgba(15,23,42,.06);
        }

        .school-contact-item {
            padding: 15px 0;
            border-bottom: 1px solid rgba(15,23,42,.08);
        }

        .school-contact-item:last-child {
            border-bottom: 0;
        }

        .school-contact-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--school-muted);
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        /* =========================
           FOOTER
        ========================= */

        .school-footer {
            background: #0f172a;
            color: white;
            padding: 55px 0 25px;
        }

        .school-footer-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            background: white;
            border-radius: 14px;
            padding: 8px;
        }

        .school-footer-text {
            color: #94a3b8;
            line-height: 1.7;
        }

        .school-footer-bottom {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.08);
            color: #94a3b8;
            font-size: 13px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 991px) {

            .school-hero {
                padding: 90px 0;
            }

            .school-hero-logo {
                width: 220px;
                height: 220px;
            }

            .school-hero-watermark {
                width: 450px;
                height: 450px;
                right: -120px;
                opacity: .06;
            }

        }

        @media (max-width: 576px) {

            .school-hero {
                min-height: auto;
                padding: 70px 0;
            }

            .school-hero h1 {
                font-size: 2.4rem;
            }

            .school-hero-description {
                font-size: 16px;
            }

            .school-hero-logo {
                width: 180px;
                height: 180px;
                padding: 18px;
            }

            .school-hero-watermark {
                width: 350px;
                height: 350px;
                right: -100px;
            }

            .school-section,
            .school-contact-section {
                padding: 65px 0;
            }

        }

    </style>

</head>

<body>
 @if($school?->logo)
        <div
            class="school-fixed-watermark"
            aria-hidden="true"
        >
            <img
                src="{{ asset('storage/' . $school->logo) }}"
                alt=""
            >
        </div>
    @endif

   {{-- NAVBAR --}}

<nav class="school-navbar">

    <div class="container">

        <div class="d-flex align-items-center justify-content-between py-2">

            {{-- BRAND --}}

            <a
                href="{{ route('school.home') }}"
                class="school-brand"
            >

                @if($school?->logo)

                    <img
                        src="{{ asset('storage/' . $school->logo) }}"
                        alt="{{ $school->school_name }}"
                        class="school-brand-logo"
                    >

                @endif

                <div>

                    <div class="school-brand-name">
                        {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}
                    </div>

                    <div class="school-brand-subtitle">
                        Website Resmi Sekolah
                    </div>

                </div>

            </a>


            {{-- DESKTOP NAVBAR --}}

            <div class="d-none d-lg-flex align-items-center">

                @foreach($menus as $menu)

                    @if($menu->type === 'external')

                        <a
                            href="{{ $menu->url }}"
                            class="nav-link"
                            @if($menu->open_new_tab)
                                target="_blank"
                                rel="noopener"
                            @endif
                        >
                            {{ $menu->label }}
                        </a>

                    @else

                        <a
                            href="{{ $menu->route_name ? route($menu->route_name) : '#' }}"
                            class="nav-link"
                        >
                            {{ $menu->label }}
                        </a>

                    @endif

                @endforeach

<a
    href="{{ url('/admin/login') }}"
    class="nav-link"
>
    Login Admin
</a>
            </div>


            {{-- MOBILE HAMBURGER --}}

            <button
                type="button"
                class="school-mobile-menu-button d-lg-none"
                onclick="document.getElementById('schoolMobileMenu').classList.toggle('show')"
                aria-label="Buka menu"
            >
                ☰
            </button>

        </div>


        {{-- MOBILE NAVBAR --}}

        <div
            id="schoolMobileMenu"
            class="school-mobile-menu"
        >

            @foreach($menus as $menu)

                @if($menu->type === 'external')

                    <a
                        href="{{ $menu->url }}"
                        class="nav-link"
                        @if($menu->open_new_tab)
                            target="_blank"
                            rel="noopener"
                        @endif
                    >
                        {{ $menu->label }}
                    </a>

                @else

                    <a
                        href="{{ $menu->route_name ? route($menu->route_name) : '#' }}"
                        class="nav-link"
                    >
                        {{ $menu->label }}
                    </a>

                @endif

            @endforeach

<a
    href="{{ url('/admin/login') }}"
    class="nav-link"
>
    Login Admin
</a>
        </div>

    </div>

</nav>


    {{-- CONTENT --}}

    @yield('content')


    {{-- FOOTER --}}

    <footer class="school-footer">

        <div class="container">

            <div class="row g-4">

                <div class="col-lg-6">

                    @if($school?->logo)

                        <img
                            src="{{ asset('storage/' . $school->logo) }}"
                            alt="{{ $school->school_name }}"
                            class="school-footer-logo mb-3"
                        >

                    @endif

                    <h5 class="fw-bold">
                        {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}
                    </h5>

                    <p class="school-footer-text mb-0">
                        Website resmi sekolah untuk menyampaikan
                        informasi, berita, pengumuman, dan layanan sekolah.
                    </p>

                </div>


                <div class="col-lg-6">

                    <h6 class="fw-bold mb-3">
                        Kontak Sekolah
                    </h6>

                    @if($school?->address)

                        <p class="school-footer-text mb-2">
                            {{ $school->address }}
                        </p>

                    @endif

                    @if($school?->phone)

                        <p class="school-footer-text mb-1">
                            Telepon: {{ $school->phone }}
                        </p>

                    @endif

                    @if($school?->email)

                        <p class="school-footer-text mb-1">
                            Email: {{ $school->email }}
                        </p>

                    @endif

                </div>

            </div>


            <div class="school-footer-bottom text-center">

                © {{ date('Y') }}
                {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}

            </div>

        </div>

    </footer>

</body>
</html>
