<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MountainController;
use App\Http\Controllers\Admin\HikingScheduleController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\User\TicketController as UserTicketController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');

            // Master Data
            Route::resource('mountains', MountainController::class);
            Route::resource('hiking-schedules', HikingScheduleController::class);

            // Ticket Validation
            Route::get('/tickets', [AdminTicketController::class, 'index'])
                ->name('tickets.index');

            Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])
                ->name('tickets.show');

            Route::patch('/tickets/{ticket}/approve', [AdminTicketController::class, 'approve'])
                ->name('tickets.approve');

            Route::patch('/tickets/{ticket}/reject', [AdminTicketController::class, 'reject'])
                ->name('tickets.reject');
        });

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:user')
        ->prefix('user')
        ->name('user.')
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('users.dashboard');
            })->name('dashboard');

            // Ticket Booking
            Route::get('/tickets', [UserTicketController::class, 'index'])
                ->name('tickets.index');

            Route::get('/tickets/create', [UserTicketController::class, 'create'])
                ->name('tickets.create');

            Route::post('/tickets', [UserTicketController::class, 'store'])
                ->name('tickets.store');

            Route::get('/tickets/{ticket}', [UserTicketController::class, 'show'])
                ->name('tickets.show');
        });

    /*
    |--------------------------------------------------------------------------
    | PROFILE (SHARED)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
