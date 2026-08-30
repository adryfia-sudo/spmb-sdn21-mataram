<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RegistrationController;
use App\Livewire\Registration\Wizard;
use App\Http\Controllers\DocumentPreviewController;
use App\Http\Controllers\RegistrationProofController;
use App\Http\Controllers\Front\RegistrationStatusController;
use App\Http\Controllers\Front\InformationController;

Route::middleware('auth')->group(function () {
    Route::get(
        '/admin/documents/{document}/preview',
        DocumentPreviewController::class
    )->name('admin.documents.preview');
});
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/profil', [InformationController::class, 'profile'])
    ->name('front.profile');

Route::get('/jadwal', [InformationController::class, 'schedule'])
    ->name('front.schedule');

Route::get('/jalur', [InformationController::class, 'paths'])
    ->name('front.paths');

Route::get('/persyaratan', [InformationController::class, 'requirements'])
    ->name('front.requirements');

Route::get('/daftar', Wizard::class)
    ->name('registration.create');

Route::post('/daftar', [RegistrationController::class, 'store'])
    ->name('registration.store');

/*
|--------------------------------------------------------------------------
| CEK STATUS PENDAFTARAN
|--------------------------------------------------------------------------
*/

Route::get('/status-pendaftaran', [RegistrationStatusController::class, 'index'])
    ->name('registration.status');

Route::post('/status-pendaftaran', [RegistrationStatusController::class, 'check'])
    ->name('registration.status.check');

Route::get('/pendaftaran/berhasil/{registration}', [RegistrationController::class, 'success'])
    ->name('registration.success');

Route::get(
    '/pendaftaran/{registration}/bukti',
    [RegistrationProofController::class, 'preview']
)->name('registration.proof.preview');

Route::get(
    '/pendaftaran/{registration}/bukti/download',
    [RegistrationProofController::class, 'download']
)->name('registration.proof.download');
