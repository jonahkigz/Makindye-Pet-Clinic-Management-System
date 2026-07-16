<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])
        ->name('profile.photo.remove');

    /*
    |--------------------------------------------------------------------------
    | OWNERS
    |--------------------------------------------------------------------------
    */

    Route::resource('owners', OwnerController::class);

    Route::get('/owners/{owner}/pets', [AppointmentController::class, 'petsByOwner'])
        ->name('owners.pets');

    /*
    |--------------------------------------------------------------------------
    | PETS
    |--------------------------------------------------------------------------
    */

    Route::resource('pets', PetController::class);

    /*
    |--------------------------------------------------------------------------
    | APPOINTMENTS
    |--------------------------------------------------------------------------
    */

    Route::resource('appointments', AppointmentController::class);

    Route::get(
        '/appointments/{appointment}/medical-record/create',
        [MedicalRecordController::class, 'createFromAppointment']
    )->name('appointments.medical-record.create');

    /*
    |--------------------------------------------------------------------------
    | MEDICAL RECORDS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/medical-records/{medicalRecord}/print',
        [MedicalRecordController::class, 'print']
    )->name('medical-records.print');

    Route::get(
        '/pets/{pet}/history',
        [MedicalRecordController::class, 'history']
    )->name('medical-records.history');

    Route::resource('medical-records', MedicalRecordController::class);

    /*
    |--------------------------------------------------------------------------
    | PRODUCTS AND SERVICES
    |--------------------------------------------------------------------------
    */

    Route::resource('products', ProductController::class);

    Route::resource('services', ServiceController::class);

    /*
    |--------------------------------------------------------------------------
    | INVOICES AND PAYMENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-invoices', [InvoiceController::class, 'myInvoices'])
        ->name('owner.invoices');

    Route::resource('invoices', InvoiceController::class);

    Route::resource('payments', PaymentController::class);

    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    |
    | Only administrators should manage system users.
    |
    */

    
        Route::resource('users', UserManagementController::class)
    ->middleware(function ($request, $next) {

        if (!$request->user() || $request->user()->role !== 'Administrator') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    });
 
});

require __DIR__.'/auth.php';