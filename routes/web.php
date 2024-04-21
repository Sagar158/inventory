<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'locale'])->group(function () {

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','data')->name('dashboard');
    });

    Route::name('slider.')->prefix('slider')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/show/{id}', 'show')->name('show');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getSlidersData')->name('getSlidersData');
    });

    Route::name('usertype.')->prefix('usertype')->controller(UserTypeController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('data','getUserTypeData')->name('getUserTypeData');
        Route::get('/permisions/{id}/edit','edit')->name('permissions.edit');
        Route::post('/permisions/{id}/update','update')->name('permissions.update');
    });

    Route::name('products.')->prefix('products')->controller(ProductsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('{id}/edit/', 'edit')->name('edit');
        Route::post('{id}/update/', 'update')->name('update');
        Route::get('{id}/show/', 'show')->name('show');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getProductData')->name('getProductData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
    });

    Route::name('suppliers.')->prefix('suppliers')->controller(SupplierController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getSupplierData')->name('getSupplierData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
        Route::get('getData','getData')->name('getData');
    });



    Route::name('categories.')->controller(CategoriesController::class)->prefix('categories')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getCategoryData')->name('getCategoryData');
        Route::get('getData','getData')->name('getData');
    });

    Route::name('sales.')->prefix('sales')->controller(SalesController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getProductData')->name('getProductData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
    });

    Route::name('language.')->prefix('language')->controller(LanguageController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getProductData')->name('getProductData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
    });
    Route::name('reports.')->prefix('reports')->controller(ReportingController::class)->group(function(){
        Route::get('/','index')->name('index');
    });


    Route::name('users.')->prefix('users')->controller(UserController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getUserData')->name('getUserData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('theme/change/{theme}',[ThemeController::class,'changeTheme'])->name('theme.change');
    Route::get('/change-language', [ThemeController::class, 'switchLanguage'])->name('change_language')->middleware('locale');
});

require __DIR__.'/auth.php';
