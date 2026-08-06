<?php

namespace App\Livewire\Registration;

use Livewire\Component;
use App\Models\Registration;
use App\Models\RegistrationPath;

class Wizard extends Component
{
    public int $step = 1;

    public ?Registration $registration = null;

    public $registration_path_id = null;

    public $paths = [];

    public $full_name = '';

    public $nik = '';

    public $nisn = '';

    public $family_card_number = '';

    public function mount()
    {
        $this->paths = RegistrationPath::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    protected function validateStepOne()
    {
        $this->validate([
            'registration_path_id' => [
                'required',
                'exists:registration_paths,id',
            ],
        ]);
    }
    protected function validateStepTwo()
    {
    $this->validate([
        'full_name' => 'required|min:3',
        'nik' => 'required|digits:16',
        'family_card_number' => 'required|digits:16',
        'nisn' => 'nullable|digits_between:8,10',
    ]);
    }
    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validateStepOne();
        }
        if ($this->step == 2) {
            $this->validateStepTwo();

        }

        if ($this->step < 8) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function render()
    {
        return view('livewire.registration.wizard')
            ->layout('layouts.front');
    }
}
