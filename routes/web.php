<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;





Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
Route::resource('owners', OwnerController::class);
});

Route::resource('pets', PetController::class);
Route::middleware(['auth'])->group(function () {
Route::resource('pets', PetController::class);
});
Route::resource('appointments', AppointmentController::class);
Route::resource('medical-records', MedicalRecordController::class);
Route::resource('products', ProductController::class);
Route::resource('services', ServiceController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('payments', PaymentController::class);
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserManagementController::class);
    Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::resource('users', UserController::class);
});
});
Route::middleware(['auth'])->group(function () {

    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users.index');

});
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserManagementController::class);
});
    Route::get('/appointments/{appointment}/medical-record/create', [MedicalRecordController::class, 'createFromAppointment'])
    ->name('appointments.medical-record.create');
Route::get('/appointments/{appointment}/medical-record/create',
    [MedicalRecordController::class, 'createFromAppointment']
)->name('appointments.medical-record.create');
Route::resource('medical-records', MedicalRecordController::class);
Route::get('/owners/{owner}/pets', [AppointmentController::class, 'petsByOwner'])
    ->name('owners.pets');
Route::get('/medical-records/{medicalRecord}/print', [MedicalRecordController::class, 'print'])
    ->name('medical-records.print');
Route::get('/my-invoices', [InvoiceController::class, 'myInvoices'])
    ->name('owner.invoices')
    ->middleware('auth');
Route::get('/pets/{pet}/history', [MedicalRecordController::class, 'history'])
    ->name('medical-records.history');
});

require __DIR__.'/auth.php';
