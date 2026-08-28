<?php

namespace App\Livewire\Registration;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\Registration;
use App\Models\RegistrationPath;
use App\Models\AcademicYear;
use App\Models\RegistrationPeriod;
use App\Models\StudentAddress;
use App\Livewire\Registration\Concerns\HasAddressData;
use App\Livewire\Registration\Concerns\HasFatherData;
use App\Livewire\Registration\Concerns\HasMotherData;
use App\Livewire\Registration\Concerns\HasGuardianData;
use App\Livewire\Registration\Concerns\HasDocumentData;

class Wizard extends Component
{
    use HasAddressData, HasFatherData, HasMotherData, HasGuardianData, HasDocumentData;
    
    public int $step = 1;
    public bool $confirmation = false;

    public ?Registration $registration = null;

    /*
    |--------------------------------------------------------------------------
    | Step 1 - Jalur Pendaftaran
    |--------------------------------------------------------------------------
    */

    public $registration_path_id = null;

    public $paths = [];

    /*
    |--------------------------------------------------------------------------
    | Step 2 - Data Peserta
    |--------------------------------------------------------------------------
    */

    public $full_name = '';

    public $nik = '';

    public $nisn = '';

    public $gender = '';

    public $birth_place = '';

    public $birth_date = '';

    public $religion = '';

    public $special_needs = '';

    public $previous_school = '';

    public $family_card_number = '';

    public $birth_certificate_number = '';

    public $previous_school_type = '';

    public $siblings_count = null;

    public $child_order = null;

    public $phone = '';

    public $height = '';

    public $weight = '';

    public $head_circumference = '';

    public $distance_category = '';

    public $distance_km = null;
    public $transportation ='';
    public $travel_time = '';    


    /*
    |--------------------------------------------------------------------------
    | Mount
    |--------------------------------------------------------------------------
    */

    public function mount(): void
    {
        $this->paths = RegistrationPath::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $this->initializeAddressData();
        $this->initializeDocumentData();
    }
public function updatedDistanceCategory($value): void
{
    Log::info('SPMB DISTANCE CATEGORY BERUBAH', [
        'value' => $value,
        'type' => gettype($value),
    ]);

    if ($value === 'less_than_1_km') {
        $this->distance_km = null;

        Log::info('SPMB DISTANCE: kurang dari 1 KM, distance_km dikosongkan');
    }

    if ($value === 'more_than_1_km') {
        Log::info('SPMB DISTANCE: lebih dari 1 KM, distance_km wajib diisi');
    }
}
/*
|--------------------------------------------------------------------------
| Step 1 Validation
|--------------------------------------------------------------------------
*/

protected function validateStepOne(): void
{
    $this->validate([
        'registration_path_id' => [
            'required',
            'exists:registration_paths,id',
        ],
    ]);
}


/**
 *--------------------------------------------------------------------------
 * Step 2 Validation
 *--------------------------------------------------------------------------
 */
protected function validateStepTwo(): void
{
    Log::info('SPMB VALIDASI DISTANCE', [
        'distance_category' => $this->distance_category,
        'distance_category_type' => gettype($this->distance_category),
        'distance_km' => $this->distance_km,
        'distance_km_type' => gettype($this->distance_km),
    ]);

    $this->validate(
        [
            /*
            |--------------------------------------------------------------------------
            | Data Siswa
            |--------------------------------------------------------------------------
            */

            'full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'nik' => [
                'required',
                'digits:16',
                Rule::unique('registrations', 'nik'),
            ],

            'nisn' => [
                'nullable',
                'digits:10',
                Rule::unique('registrations', 'nisn'),
            ],

            'gender' => [
                'required',
                'in:L,P',
            ],

            'birth_place' => [
                'required',
                'string',
                'max:255',
            ],

            'birth_date' => [
                'required',
                'date',
            ],

            'religion' => [
                'required',
                'string',
                'max:50',
            ],

            'special_needs' => [
                'nullable',
                'string',
                'max:255',
            ],

            'previous_school' => [
                'nullable',
                'string',
                'max:255',
            ],

            'family_card_number' => [
                'required',
                'digits:16',
            ],

            'birth_certificate_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'previous_school_type' => [
                'nullable',
                'string',
                'max:50',
            ],

            'siblings_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'child_order' => [
                'nullable',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            /*
            |--------------------------------------------------------------------------
            | Data Fisik
            |--------------------------------------------------------------------------
            */

            'height' => [
                'required',
                'numeric',
                'min:30',
                'max:250',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:5',
                'max:250',
            ],

            'head_circumference' => [
                'required',
                'numeric',
                'min:20',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | Jarak ke Sekolah
            |--------------------------------------------------------------------------
            */

            'distance_category' => [
                'required',
                'in:less_than_1_km,more_than_1_km',
            ],

            'distance_km' => [
                'nullable',
                'numeric',
                'min:1.01',
                'max:100',
                'required_if:distance_category,more_than_1_km',
            ],

            /*
            |--------------------------------------------------------------------------
            | Moda Transportasi
            |--------------------------------------------------------------------------
            */

            'transportation' => [
                'required',
                'in:jalan_kaki,sepeda,sepeda_motor,ojek,mobil_pribadi,angkutan_umum,mobil_bus_antar_jemput,lainnya',
            ],

            /*
            |--------------------------------------------------------------------------
            | Lama Perjalanan
            |--------------------------------------------------------------------------
            */

            'travel_time' => [
                'required',
                'integer',
                'min:1',
                'max:300',
            ],
        ],
        [
            /*
            |--------------------------------------------------------------------------
            | Pesan Duplikasi NIK / NISN
            |--------------------------------------------------------------------------
            */

            'nik.unique' =>
                'NIK tersebut sudah pernah digunakan untuk pendaftaran.',

            'nisn.unique' =>
                'NISN tersebut sudah pernah digunakan untuk pendaftaran.',
        ]
    );
}

/*
|--------------------------------------------------------------------------
| Step 8 Validation
|--------------------------------------------------------------------------
*/

protected function validateStepEight(): void
{
    $this->validate(
        [
            'confirmation' => [
                'accepted',
            ],
        ],
        [
            'confirmation.accepted' =>
                'Anda harus menyatakan bahwa data yang dimasukkan sudah benar.',
        ]
    );
}

      /*
      |--------------------------------------------------------------------------
      | Next Step
      |--------------------------------------------------------------------------
      */

public function nextStep(): void
{
    /*
    |--------------------------------------------------------------------------
    | Step 1
    |--------------------------------------------------------------------------
    */
    if ($this->step === 1) {
        $this->validateStepOne();

        $this->step = 2;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 2 - Data Peserta
    |--------------------------------------------------------------------------
    */
if ($this->step === 2) {
    $this->validateStepTwo();

    $this->step = 3;

    Log::info('SPMB STEP BERUBAH KE 3', [
        'step' => $this->step,
        'city' => $this->city,
        'district' => $this->district,
        'village' => $this->village,
    ]);

    return;
}

    /*
    |--------------------------------------------------------------------------
    | Step 3 - Alamat
    |--------------------------------------------------------------------------
    */
    if ($this->step === 3) {
        $this->validateStepThree();

        $this->step = 4;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 4 - Ayah
    |--------------------------------------------------------------------------
    */
    if ($this->step === 4) {
        $this->validateStepFour();

        $this->step = 5;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 5 - Ibu
    |--------------------------------------------------------------------------
    */
    if ($this->step === 5) {
        $this->validateStepFive();

        $this->step = 6;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 6 - Wali
    |--------------------------------------------------------------------------
    */
    if ($this->step === 6) {
        $this->validateStepSix();

        $this->step = 7;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 7 - Dokumen
    |--------------------------------------------------------------------------
    */
    if ($this->step === 7) {
        $this->validateStepSeven();

        $this->step = 8;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Step 8 - Konfirmasi & Kirim
    |--------------------------------------------------------------------------
    */
    if ($this->step === 8) {
        $this->validateStepEight();

        $this->submit();

        return;
    }
}

    public function previousStep(): void
{

    if ($this->step > 1) {
        $this->step--;

        return;
    }
}
    /*
    |--------------------------------------------------------------------------
    | Submit Registration
    |--------------------------------------------------------------------------
    */

    
       public function submit(): void
    {
    \Log::info('SPMB SUBMIT: method dipanggil', [
        'step' => $this->step,
    ]);

    $this->validateStepOne();

    \Log::info('SPMB SUBMIT: step 1 lolos');

    $this->validateStepTwo();

    \Log::info('SPMB SUBMIT: step 2 lolos');

    $this->validateStepThree();

    \Log::info('SPMB SUBMIT: step 3 lolos');

    $this->validateStepFour();

    \Log::info('SPMB SUBMIT: step 4 lolos');

    $this->validateStepFive();

    \Log::info('SPMB SUBMIT: step 5 lolos');

    $this->validateStepSix();

    \Log::info('SPMB SUBMIT: step 6 lolos');

    $this->validateStepSeven();

    \Log::info('SPMB SUBMIT: step 7 lolos');

    $this->validateStepEight();

    \Log::info('SPMB SUBMIT: step 8 lolos');

    // lanjutkan kode Anda...{
        /*
        |--------------------------------------------------------------------------
        | Validasi terakhir
        |--------------------------------------------------------------------------
        */

        /*$this->validateStepOne();
        $this->validateStepTwo();
        $this->validateStepThree();
        $this->validateStepFour();
        $this->validateStepFive();
        $this->validateStepSix();
        $this->validateStepSeven();
        $this->validateStepEight();*/
        /*
        |--------------------------------------------------------------------------
        | Ambil Tahun Pelajaran aktif
        |--------------------------------------------------------------------------
        */

        $academicYear = AcademicYear::query()
            ->where('is_active', true)
            ->first();
Log::info('SPMB SUBMIT: academic year ditemukan', [
    'id' => $academicYear?->id,
    'name' => $academicYear?->name,
]);

if (! $academicYear) {

    Log::warning(
        'SPMB SUBMIT: academic year tidak ditemukan'
    );

    $this->addError(
        'registration',
        'Tahun pelajaran aktif belum tersedia.'
    );

    return;
}


/*
|--------------------------------------------------------------------------
| Ambil Periode Pendaftaran aktif
|--------------------------------------------------------------------------
*/

Log::info(
    'SPMB SUBMIT: academic year valid'
);

$registrationPeriod = RegistrationPeriod::query()
    ->where('is_active', true)
    ->where('academic_year_id', $academicYear->id)
    ->first();

Log::info(
    'SPMB SUBMIT: registration period ditemukan',
    [
        'id' => $registrationPeriod?->id,
    ]
);

if (! $registrationPeriod) {

    Log::warning(
        'SPMB SUBMIT: registration period tidak ditemukan'
    );

    $this->addError(
        'registration',
        'Periode pendaftaran aktif belum tersedia.'
    );

    return;
}

Log::info(
    'SPMB SUBMIT: registration period valid'
);
        /*
        |--------------------------------------------------------------------------
        | Simpan menggunakan transaction
        |--------------------------------------------------------------------------
        */
Log::info('SPMB SUBMIT: masuk ke try transaction');
        try {
            DB::transaction(function () use (
                $academicYear,
                $registrationPeriod
            ) {
Log::info(
            'SPMB SUBMIT: transaction dimulai'
        );
                /*
                |--------------------------------------------------------------------------
                | Ambil jalur pendaftaran
                |--------------------------------------------------------------------------
                */

                $path = RegistrationPath::query()
                    ->where('id', $this->registration_path_id)
                    ->where('is_active', true)
                    ->lockForUpdate()
                    ->first();

                if (! $path) {
                    throw new \RuntimeException(
                        'Jalur pendaftaran tidak tersedia atau sudah tidak aktif.'
                    );
                }
Log::info('SPMB SUBMIT: registration path ditemukan', [
    'id' => $path->id,
    'name' => $path->name ?? null,
]);
                /*
                |--------------------------------------------------------------------------
                | Buat Registration
                |--------------------------------------------------------------------------
                */
Log::info('SPMB SUBMIT: akan membuat registration');

Log::info('SPMB SUBMIT: data registration', [
    'academic_year_id' => $academicYear->id,
    'registration_period_id' => $registrationPeriod->id,
    'registration_path_id' => $path->id,
    'full_name' => $this->full_name,
    'nik' => $this->nik,
    'nisn' => $this->nisn ?: null,
    'family_card_number' => $this->family_card_number,
    'birth_certificate_number' => $this->birth_certificate_number ?: null,
    'gender' => $this->gender,
    'birth_place' => $this->birth_place,
    'birth_date' => $this->birth_date,
    'religion' => $this->religion,
    'status' => 'pending',
]);
try{
Log::info('SPMB SUBMIT: field tambahan', [
    'special_needs' => $this->special_needs,
    'siblings_count' => $this->siblings_count,
    'child_order' => $this->child_order,
]);

                $registration = Registration::create([
                    'academic_year_id' => $academicYear->id,

                    'registration_period_id' => $registrationPeriod->id,

                    'registration_path_id' => $path->id,

                    'registration_number' => null,

                    'full_name' => $this->full_name,

                    'nik' => $this->nik,

                    'nisn' => $this->nisn ?: null,

                    'family_card_number' => $this->family_card_number,

                    'birth_certificate_number' =>
                        $this->birth_certificate_number ?: null,

                    'previous_school' =>
                        $this->previous_school ?: null,

                    'previous_school_type' =>
                        $this->previous_school_type ?: null,

                    'gender' => $this->gender,

                    'birth_place' => $this->birth_place,

                    'birth_date' => $this->birth_date,

                    'religion' => $this->religion,

                    'special_needs' =>
                        (bool) $this->special_needs,

                    'siblings_count' =>
                        $this->siblings_count ?? 0,

                    'child_order' =>
                        $this->child_order ?? 1,

                    'phone' => $this->phone,

                    'height' => $this->height,

                    'weight' => $this->weight,

                    'head_circumference' => $this->head_circumference,

                    'distance_category' => $this->distance_category,

                    'distance_km' => $this->distance_km ?: null,
		    'transportation' => $this->transportation,
                    'travel_time' => $this->travel_time,

                    'status' => 'pending',
                ]);

Log::info('SPMB SUBMIT: registration berhasil dibuat', [

    'id' => $registration->id,
]);
} catch (\Throwable $e) {

    Log::error(
        'SPMB SUBMIT: Registration::create GAGAL',
        [
            'class' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]
    );

    throw $e;
}           

                /*
                |--------------------------------------------------------------------------
                | Buat Nomor Pendaftaran
                |--------------------------------------------------------------------------
                |
                | Contoh:
                | SPMB-2026-00001
                |
                */

                $registrationNumber = sprintf(
                    'SPMB-%s-%05d',
                    now()->format('Y'),
                    $registration->id
                );

                $registration->update([
                    'registration_number' => $registrationNumber,
                ]);
                /*
                |--------------------------------------------------------------------------
                | Simpan Data Orang Tua
                |--------------------------------------------------------------------------
                */

                $this->saveFatherData($registration);

                $this->saveMotherData($registration);

                $this->saveGuardianData($registration);


                /*
                |--------------------------------------------------------------------------
                | Upload Dokumen
                |--------------------------------------------------------------------------
                */
Log::info('SPMB SUBMIT: mulai upload dokumen', [
    'registration_id' => $registration->id,
    'registration_number' => $registration->registration_number,
]);

                $this->saveDocuments($registration);
Log::info('SPMB SUBMIT: upload dokumen selesai');

                /*
                |--------------------------------------------------------------------------
                | Simpan alamat
                |--------------------------------------------------------------------------
                */

                StudentAddress::create([
                    'registration_id' => $registration->id,

                    'address' => $this->address,

                    'province' => $this->province,

                    'city' => $this->city,

                    'district' => $this->district,

                    'village' => $this->village,

                    'hamlet' => $this->hamlet ?: null,

                    'rt' => $this->rt ?: null,

                    'rw' => $this->rw ?: null,

                    'postal_code' => $this->postal_code ?: null,

                    'latitude' => $this->latitude,

                    'longitude' => $this->longitude,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Simpan object registration
                |--------------------------------------------------------------------------
                */

                $this->registration = $registration;
            });

        } catch (\RuntimeException $e) {

            $this->addError(
                'registration',
                $e->getMessage()
            );

            return;

        } catch (\Throwable $e) {

            report($e);

            $this->addError(
                'registration',
               'ERROR: ' . $e->getMessage()
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Berhasil
        |--------------------------------------------------------------------------
        */

        session()->flash(
            'registration_success',
            'Pendaftaran berhasil disimpan.'
        );


        /*
        |--------------------------------------------------------------------------
        | Untuk sementara tampilkan halaman sukses
        |--------------------------------------------------------------------------
        */

        $this->step = 9;
    }

 protected function saveGuardianData($registration): void
    {
        if ($this->guardian_status === 'none') {
            return;
        }

        \App\Models\StudentGuardian::updateOrCreate(
            [
                'registration_id' => $registration->id,
            ],
            [
                'full_name' => $this->guardian_full_name,
                'family_relation' => $this->guardian_family_relation,
                'nik' => $this->guardian_nik ?: null,
                'birth_year' => $this->guardian_birth_year ?: null,
                'education' => $this->guardian_education ?: null,
                'job' => $this->guardian_job ?: null,
                'income' => $this->guardian_income ?: null,
                'phone' => $this->guardian_phone ?: null,
                'address' => $this->guardian_address ?: null,
            ],
        );
    }
    public function render()
    {
        return view('livewire.registration.wizard')
            ->layout('layouts.front');
    }
}
