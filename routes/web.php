<?php

use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\BeaconController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SuperAdmin\OrganizationController;
use App\Http\Controllers\SuperAdmin\SubscriptionController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ReportController as UserReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('auth.login'))->name('home');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->name('superadmin.')->group(function (): void {
    Route::resource('organizations', OrganizationController::class)->except(['show']);
    Route::resource('subscriptions', SubscriptionController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('assets', AssetController::class);
    Route::get('beacons', [BeaconController::class, 'index'])->name('beacons.index');
    Route::post('beacons/{asset}/assign', [BeaconController::class, 'assign'])->name('beacons.assign');
    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('reports/pdf', [AdminReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('reports/excel', [AdminReportController::class, 'excel'])->name('reports.excel');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function (): void {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('reports/pdf', [UserReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('reports/excel', [UserReportController::class, 'excel'])->name('reports.excel');
});
