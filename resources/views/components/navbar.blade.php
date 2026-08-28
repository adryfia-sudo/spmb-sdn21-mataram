<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">

            @if($school && $school?->logo)
                <img src="{{ asset('storage/'.$school->logo) }}"
                     width="45"
                     class="me-2">
            @endif

            {{ $school?->school_name ?? 'SPMB SD Negeri 21 Mataram' }}

        </a>

        <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

<li class="nav-item">
    <a class="nav-link" href="{{ route('front.profile') }}">
        Profil
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('front.schedule') }}">
        Jadwal
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('front.paths') }}">
        Jalur
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('front.requirements') }}">
        Persyaratan
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('registration.status') }}">
        Cek Status
    </a>
</li>

            </ul>

        </div>

    </div>
</nav>
