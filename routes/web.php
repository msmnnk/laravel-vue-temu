<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Include the default register / login routes.
 */
require __DIR__.'/defaults.php';

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

Route::get('/example1', function () {
    // Render component and pass props
    return Inertia::render('Example1', [
        'initialNames' => [
            'Alice',
            'Bob',
            'Carol'
        ]
    ]);
})->name('example1');

Route::get('/example2', function () {
    return Inertia::render('Example2');
})->name('example2');

// Route::get('/products', [ProductController::class, 'index'])
//     ->name('products.index')
//     ->can('viewAny', Product::class);

Route::get('ping', function () {
    return Auth::user();
});

Route::resource('products', ProductController::class);