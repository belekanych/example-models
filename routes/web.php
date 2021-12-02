<?php

use App\Http\Controllers;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::prefix('/orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/', Controllers\Order\IndexController::class)->name('index');
                Route::get('/create', Controllers\Order\CreateController::class)->name('create');
                Route::get('{order}/edit', Controllers\Order\EditController::class)->name('edit');
            });
    });

Route::prefix('/api')
    ->name('api.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::prefix('/orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/statuses', Controllers\Api\Order\Status\IndexController::class)
                    ->name('statuses.index');

                Route::get('/', Controllers\Api\Order\IndexController::class)->name('index');
                Route::post('/', Controllers\Api\Order\StoreController::class)->name('store');
                Route::get('/{order}', Controllers\Api\Order\ShowController::class)->name('show');
                Route::post('/{order}', Controllers\Api\Order\UpdateController::class)->name('update');
            });

        Route::get('/clients', Controllers\Api\Client\IndexController::class)
            ->name('clients.index');
    });

require __DIR__.'/auth.php';
