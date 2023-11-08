<?php

use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    /**
     * Returns a random new name
     */
    Route::get('name', function () {
        return fake()->name();
    })->name('api.name')->can('getName', User::class);

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->can('delete', 'product')
        ->name('api.products.destroy');

    Route::patch('/products/{product}/', [ProductController::class, 'update'])
        ->can('update', 'product')
        ->name('api.products.update');



}); 