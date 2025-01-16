<?php

use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');        // List all products
    Route::get('/products/create', 'create')->name('products.create'); // Show create form
    Route::post('/products', 'store')->name('products.store');        // Store new product
    Route::get('/products/{product}', 'show')->name('products.show'); // Show a single product
    Route::get('/products/{product}/edit', 'edit')->name('products.edit'); // Show edit form
    Route::put('/products/{product}', 'update')->name('products.update'); // Update product
    Route::delete('/products/{product}', 'destroy')->name('products.destroy'); // Delete product
});