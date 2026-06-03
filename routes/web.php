<?php

use Illuminate\Support\Facades\Route;


$locales = config('app.locales');
$default = config('app.default_locale', 'ru');

foreach ($locales as $locale) {

    Route::prefix($locale === $default ? '' : $locale)
        ->name($locale . '.')
        ->group(function () {

            Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');
            Route::get('/delivery', [\App\Http\Controllers\PageController::class, 'delivery'])->name('delivery');
            Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
            Route::get('/contacts', [\App\Http\Controllers\PageController::class, 'contacts'])->name('contacts');
            Route::get('/faq', [\App\Http\Controllers\PageController::class, 'faq'])->name('faq');
            Route::get('/reviews', [\App\Http\Controllers\PageController::class, 'reviews'])->name('reviews');

            Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'services'])->name('services');
//            Route::get('/services/cartridge-refill', [\App\Http\Controllers\ServiceController::class, 'cartridgeRefill'])->name('services.cartridge-refill');
//            Route::get('/services/printer-repair', [\App\Http\Controllers\ServiceController::class, 'printerRepair'])->name('services.printer-repair');
//            Route::get('/services/pc-repair', [\App\Http\Controllers\ServiceController::class, 'pcRepair'])->name('services.pc-repair');
            Route::get('/services/{service}', [\App\Http\Controllers\ServiceController::class, 'service'])->name('service');
        });
}
