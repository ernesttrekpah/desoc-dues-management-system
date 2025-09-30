<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DueController;
use App\Http\Controllers\DuesPaymentController;
use App\Http\Controllers\DuesPaymentReportController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SouvenirController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root → login page
Route::get('/', fn() => redirect()->route('login'))->name('index');

// Login
Route::get('/login', fn() => view('auth.index'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Lock, Unlock & Logout (Protected by auth)
Route::middleware('auth')->group(function () {
    // Lock Screen view
    Route::get('/lock', fn() => view('auth.lock'))->name('lock');

    // Lock action
    Route::post('/lock', [AuthController::class, 'lock'])->name('lock.action');

    // Unlock action
    Route::post('/unlock', [AuthController::class, 'unlock'])->name('unlock');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Dashboard (Protected by auth + locked middleware)
Route::middleware(['auth', 'locked'])->prefix('dashboard')->group(function () {
    Route::get('/', fn() => view('dashboard.index.index'))->name('dashboard');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/export/pdf', [StudentController::class, 'exportPdf'])->name('students.exportPdf');

    // Levels (CRUD explicit)
    Route::get('/levels', [LevelController::class, 'index'])->name('dashboard.levels');
    Route::get('/levels/create', [LevelController::class, 'create'])->name('dashboard.levels.create');
    Route::post('/levels', [LevelController::class, 'store'])->name('dashboard.levels.store');
    Route::get('/levels/{level}/edit', [LevelController::class, 'edit'])->name('dashboard.levels.edit');
    Route::put('/levels/{level}', [LevelController::class, 'update'])->name('dashboard.levels.update');
    Route::delete('/levels/{level}', [LevelController::class, 'destroy'])->name('dashboard.levels.destroy');
    Route::get('/levels/export/pdf', [LevelController::class, 'exportPdf'])->name('dashboard.levels.export.pdf');

    // Academic Years
    Route::get('/academic-years', [AcademicYearController::class, 'index'])->name('dashboard.academic_year');
    Route::get('/academic-years/create', [AcademicYearController::class, 'create'])->name('academic_year.create');
    Route::post('/academic-years', [AcademicYearController::class, 'store'])->name('academic_year.store');
    Route::get('/academic-years/{academicYear}/edit', [AcademicYearController::class, 'edit'])->name('academic_year.edit');
    Route::put('/academic-years/{academicYear}', [AcademicYearController::class, 'update'])->name('academic_year.update');
    Route::delete('/academic-years/{academicYear}', [AcademicYearController::class, 'destroy'])->name('academic_year.destroy');
    Route::get('/academic-years/export/pdf', [AcademicYearController::class, 'exportPdf'])->name('academic_year.exportPdf');

    // Dues Setup

    Route::get('/dues-setup', [DueController::class, 'index'])->name('dues.index');
    Route::get('/dues/create', [DueController::class, 'create'])->name('dues.create');
    Route::post('/dues', [DueController::class, 'store'])->name('dues.store');
    Route::get('/dues/{due}/edit', [DueController::class, 'edit'])->name('dues.edit');
    Route::put('/dues/{due}', [DueController::class, 'update'])->name('dues.update');
    Route::delete('/dues/{due}', [DueController::class, 'destroy'])->name('dues.destroy');
    Route::get('/dues/export/pdf', [DueController::class, 'exportPdf'])->name('dues.exportPdf');

    // Dues Payments
    Route::get('/dues-payments', [DuesPaymentController::class, 'index'])->name('dues_payments.index');
    Route::get('/dues-payments/create', [DuesPaymentController::class, 'create'])->name('dues_payments.create');
    Route::post('/dues-payments', [DuesPaymentController::class, 'store'])->name('dues_payments.store');
    Route::get('/dues-payments/{duesPayment}/edit', [DuesPaymentController::class, 'edit'])->name('dues_payments.edit');
    Route::put('/dues-payments/{duesPayment}', [DuesPaymentController::class, 'update'])->name('dues_payments.update');
    Route::delete('/dues-payments/{duesPayment}', [DuesPaymentController::class, 'destroy'])->name('dues_payments.destroy');

    // Ajax Routes
    Route::get('/students/{student}/info', [DuesPaymentController::class, 'getStudentInfo'])
        ->name('students.info');

    Route::get('/souvenirs/{level_id}/{academic_year_id}', [DuesPaymentController::class, 'getSouvenirs'])
        ->name('souvenirs.byLevelYear');

    Route::get('/students/by-year-level/{academic_year_id}/{level_id}',
        [DuesPaymentController::class, 'getStudentsByYearAndLevel'])
        ->name('students.byYearLevel');

// Export PDF
    Route::get('/dues-payments/export/pdf', [DuesPaymentController::class, 'exportPdf'])->name('dues_payments.exportPdf');

    // Souvenirs

    // Souvenirs
    Route::get('/souvenirs', [SouvenirController::class, 'index'])->name('souvenirs.index');
    Route::get('/souvenirs/create', [SouvenirController::class, 'create'])->name('souvenirs.create');
    Route::post('/souvenirs', [SouvenirController::class, 'store'])->name('souvenirs.store');
    Route::get('/souvenirs/{souvenir}/edit', [SouvenirController::class, 'edit'])->name('souvenirs.edit');
    Route::put('/souvenirs/{souvenir}', [SouvenirController::class, 'update'])->name('souvenirs.update');
    Route::delete('/souvenirs/{souvenir}', [SouvenirController::class, 'destroy'])->name('souvenirs.destroy');
    Route::get('/souvenirs/export/pdf', [SouvenirController::class, 'exportPdf'])->name('souvenirs.exportPdf');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/export/pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');

    // My Profile
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

    // Help
    Route::get('/help', fn() => view('dashboard.help.index'))->name('dashboard.help');

    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/dues', [DuesPaymentReportController::class, 'duesReport'])->name('dashboard.report.dues');
        Route::get('/dues/pdf', [DuesPaymentReportController::class, 'duesReportPdf'])->name('dashboard.report.dues.pdf');
    });

});
