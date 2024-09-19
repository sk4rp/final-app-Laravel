<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferSubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/', static function () {
    return view('layouts.app');
})->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/redirect/{offerId}', [ClickController::class, 'handleRedirect'])->name('redirect');

    Route::middleware('role:admin')->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('admin/offers', [AdminController::class, 'offers'])->name('admin.offers.index');
        Route::get('admin/offers/{offer}/edit', [AdminController::class, 'editOffer'])->name('admin.offers.edit');
        Route::put('admin/offers/{offer}', [AdminController::class, 'updateOffer'])->name('admin.offers.update');
        Route::post('admin/offers/{offer}/deactivate', [AdminController::class, 'deactivateOffer'])->name('admin.offers.deactivate');
        Route::post('admin/offers/{offer}/activate', [AdminController::class, 'activateOffer'])->name('admin.offers.activate');
        Route::delete('admin/offers/{offer}', [AdminController::class, 'destroyOffer'])->name('admin.offers.destroy');
        Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users.index');
        Route::get('admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::get('admin/statistics', [AdminController::class, 'systemStatistics'])->name('admin.statistics');
    });

    Route::middleware('role:advertiser')->group(function () {
        Route::get('advertiser/offers', [OfferController::class, 'index'])->name('advertiser.offers.index');
        Route::get('advertiser/offers/create', [OfferController::class, 'create'])->name('advertiser.offers.create');
        Route::post('advertiser/offers', [OfferController::class, 'store'])->name('advertiser.offers.store');
        Route::get('advertiser/offers/{offer}/edit', [OfferController::class, 'edit'])->name('advertiser.offers.edit');
        Route::put('advertiser/offers/{offer}', [OfferController::class, 'update'])->name('advertiser.offers.update');
        Route::delete('advertiser/offers/{offer}', [OfferController::class, 'destroy'])->name('advertiser.offers.destroy');
    });

    Route::middleware('role:webmaster')->group(function () {
        Route::get('webmaster/subscriptions', [OfferSubscriptionController::class, 'index'])->name('webmaster.subscriptions.index');
        Route::get('webmaster/subscriptions/create', [OfferSubscriptionController::class, 'create'])->name('webmaster.subscriptions.create');
        Route::post('webmaster/subscriptions', [OfferSubscriptionController::class, 'store'])->name('webmaster.subscriptions.store');
        Route::get('webmaster/subscriptions/{subscription}', [OfferSubscriptionController::class, 'show'])->name('webmaster.subscriptions.show');
    });
});


