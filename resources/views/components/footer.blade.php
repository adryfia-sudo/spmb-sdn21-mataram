<footer>

<div class="container">

    <div class="row">

        <div class="col-md-6">

            <h5>{{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}</h5>

            <p>

                {{ $school?->address ?? '-' }}

            </p>

        </div>

        <div class="col-md-3">

            <h6>Kontak</h6>

            <p>

                {{ $school?->phone ?? '-' }}

                <br>

                {{ $school?->email ?? '-' }}

            </p>

        </div>

        <div class="col-md-3">

            <h6>Website</h6>

            <p>

                {{ $school?->website ?? '-' }}

            </p>

        </div>

    </div>

    <hr>

    <div class="text-center">

        © {{ date('Y') }}

        {{ $school->school_name ?? 'SD Negeri 21 Mataram' }}

    </div>

</div>

</footer>
