<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RegistrationController;
use App\Livewire\Registration\Wizard;
use App\Http\Controllers\DocumentPreviewController;
use App\Http\Controllers\RegistrationProofController;

Route::middleware('auth')->group(function () {
    Route::get(
        '/admin/documents/{document}/preview',
        DocumentPreviewController::class
    )->name('admin.documents.preview');
});
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/daftar', wizard::class)
    ->name('registration.create');

Route::post('/daftar', [RegistrationController::class, 'store'])
    ->name('registration.store');

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
