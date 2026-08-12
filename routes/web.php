<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RegistrationController;
use App\Livewire\Registration\Wizard;
use App\Http\Controllers\DocumentPreviewController;

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
