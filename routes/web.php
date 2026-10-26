<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\RoomCatalogController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NewsController;

Route::get('/', [PageController::class, 'home'])
    ->name('home');

Route::middleware([
    'auth',
    'verified',
])->group(function (): void {
    Route::get('/account', [AccountController::class, 'index'])
        ->name('account.index');
    Route::patch('/account/profile', [AccountController::class, 'updateProfile'])
        ->name('account.profile.update');
    Route::patch('/account/password', [AccountController::class, 'updatePassword'])
        ->name('account.password.update');
    Route::get(
        '/account/requests/{contactRequest}',
        [AccountController::class, 'showRequest']
    )->name('account.requests.show');
    Route::post(
        '/account/notifications/read-all',
        [AccountController::class, 'markAllNotificationsAsRead']
    )->name('account.notifications.read-all');

    Route::get(
        '/account/notifications/{notification}',
        [AccountController::class, 'markNotificationAsRead']
    )->name('account.notifications.read');
});

Route::post(
    '/contact-request',
    [ContactRequestController::class, 'store']
)
    ->middleware('throttle:5,1')
    ->name('contact-request.store');

Route::get(
    '/rooms',
    [RoomCatalogController::class, 'index']
)->name('rooms.index');

Route::get(
    '/rooms/{roomType}',
    [RoomCatalogController::class, 'show']
)->name('rooms.show');


Route::view('/booking', 'pages.booking')
    ->name('booking');

Route::view('/lk', 'pages.lk')
    ->name('lk');

Route::view('/otzyvy', 'pages.reviews')
    ->name('reviews');
	
Route::get('/offers', [PromotionController::class, 'index'])
    ->name('offers.index');

Route::get('/offers/{slug}', [PromotionController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9\-]+')
    ->name('offers.show');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{news}', [NewsController::class, 'show'])
    ->name('news.show');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9\-]+')
    ->name('pages.show');