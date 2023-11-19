<?php

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Models\User;
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

    Route::post('/admin/create', [ProductController::class, 'create'])
        ->can('create', 'product')
        ->name('api.products.create');
    
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->can('delete', 'product')
        ->name('api.products.destroy');

    Route::patch('/products/{product}/', [ProductController::class, 'update'])
        ->can('update', 'product')
        ->name('api.products.update');

    Route::post('/products/{product}/images', [ProductController::class, 'storeImage'])
        ->can('update', 'product')
        ->name('api.products.images.store');

    Route::post('/orderitems/create/{product}', [OrderItemController::class, 'create'])
        ->name('api.orderitems.create');

    Route::get('/orderitems', [OrderItemController::class, 'index'])
        ->name('api.orderitems.get');

    Route::delete('/orderitems/delete/{orderItem}', [OrderItemController::class, 'destroy'])
        ->name('api.orderitems.delete');

    Route::post('/checkout', [OrderController::class, 'checkout'])
        ->name('api.checkout');

    Route::post('/calc/mult', [CalculatorController::class, 'multiply'])
        ->name('api.calculator.multiply');

    Route::post('/calc/div', [CalculatorController::class, 'multiply'])
        ->can('divide', User::class)
        ->name('api.calculator.divide');
}); 

Route::post('/calc/add', [CalculatorController::class, 'add'])
    ->name('api.calculator.add');
