<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
    $products = Product::query()->get();

    // dd($products);

    return view('products.index', compact('products'));
})->name('products.index');

Route::prefix('/products')
    ->name('products.')
    ->controller(ProductController::class)
    ->group(function() {

    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('{id}/show', 'show')->name('show')
        ->where([
        'id' => '[0-9]+',
    ]);
    Route::patch('{id}/update', 'update')->name('update')
    ->where([
        'id' => '[0-9]+',
    ]);
    Route::get('{id}/delete', 'destroy')->name('destroy')
    ->where([
        'id' => '[0-9]+',
    ]);
    
}); 

Route::prefix('/blogs')
    ->name('blogs.')
    ->controller(BlogController::class)
    ->group(function() {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{blog:slug}/show', 'show')->name('show');
    Route::patch('/{blog:slug}/update', 'update')->name('update');
    Route::get('/{blog:slug}/destroy', 'destroy')->name('destroy');
    
}); 
