<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LocalityController,
    OfferController,
    StudentController,
    DelegateController,
    TutorController,
    CompanyController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('/', OfferController::class);

    Route::resource('students', StudentController::class);
    Route::post('students/changeState', [StudentController::class, 'changeState'])->name('students.changeState');
    Route::get('center/{slug}/students', [StudentController::class, 'index'])->name('students.center');
    Route::get('promotion/{slug}/students', [StudentController::class, 'index'])->name('students.promotion');
    Route::post('search/students', [StudentController::class, 'search'])->name('students.search');

    Route::resource('delegates', DelegateController::class);
    Route::post('delegates/changeState', [DelegateController::class, 'changeState'])->name('delegates.changeState');
    Route::get('center/{slug}/delegates', [DelegateController::class, 'index'])->name('delegates.center');
    Route::get('promotion/{slug}/delegates', [DelegateController::class, 'index'])->name('delegates.promotion');
    Route::post('search/delegates', [DelegateController::class, 'search'])->name('delegates.search');

    Route::resource('tutors', TutorController::class);
    Route::get('center/{slug}/tutors', [TutorController::class, 'index'])->name('tutors.center');
    Route::get('promotion/{slug}/tutors', [TutorController::class, 'index'])->name('tutors.promotion');
    Route::post('search/tutors', [TutorController::class, 'search'])->name('tutors.search');

    Route::resource('offers', OfferController::class);
    Route::get('locality/{slug}/offers', [OfferController::class, 'index'])->name('offers.locality');
    Route::get('promotion/{slug}/offers', [OfferController::class, 'index'])->name('offers.promotion');
    Route::get('skill/{slug}/offers', [OfferController::class, 'index'])->name('offers.skill');
    Route::get('company/{slug}/offers', [OfferController::class, 'index'])->name('offers.company');
    Route::post('apply/offers', [OfferController::class, 'apply'])->name('offers.apply');
    Route::post('apply/changeState', [OfferController::class, 'changeState'])->name('offers.changeState');
    Route::post('apply/sendEmail', [OfferController::class, 'sendEmail'])->name('offers.sendEmail');
    Route::get('wishlist', [OfferController::class, 'wishlist'])->name('offers.wishlist');
    Route::post('addWish/offers', [OfferController::class, 'addWish'])->name('offers.addWish');
    Route::post('removeWish/offers', [OfferController::class, 'removeWish'])->name('offers.removeWish');
    Route::get('query', [OfferController::class, 'query'])->name('offers.query');
    Route::post('search/offers', [OfferController::class, 'search'])->name('offers.search');

    Route::resource('companies', CompanyController::class);
    Route::get('line/{line}/companies', [CompanyController::class, 'index'])->name('companies.line');
    Route::post('rate/company', [CompanyController::class, 'rate'])->name('companies.rate');
    Route::post('rate/storeRating', [CompanyController::class, 'storeRating'])->name('companies.storeRating');
    Route::post('search/companies', [CompanyController::class, 'search'])->name('companies.search');
});