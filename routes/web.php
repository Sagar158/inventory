<?php

use Illuminate\Support\Facades\Route;
use App\Models\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Frontend\HomeController;

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

Route::controller(HomeController::class)->middleware(['locale'])->group(function () {
    Route::get('/','index')->name('home');
    Route::get('product','products')->name('product');
    Route::get('product/{productId}/detials','productDetails')->name('product.details');
    Route::get('contactus','contactus')->name('contactus');
    Route::post('contact/store','contactStore')->name('contactStore');
    Route::get('view-cart','viewCart')->name('viewCart');
    Route::get('checkout','checkout')->name('checkout');
    Route::post('order/place','orderPlace')->name('product.placeOrder');
    Route::get('order/track','trackOrder')->name('order.track');
    Route::get('thankyou/{orderId}','thankyou')->name('order.thankyou');
    Route::get('my-orders','myOrders')->name('my-orders');

});

Route::middleware(['auth', 'locale'])->group(function () {

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','data')->name('dashboard');
    });

    // Route::name('slider.')->prefix('slider')->controller(SliderController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('/create', 'create')->name('create');
    //     Route::post('/store', 'store')->name('store');
    //     Route::get('/edit/{id}', 'edit')->name('edit');
    //     Route::post('/update/{id}', 'update')->name('update');
    //     Route::get('/show/{id}', 'show')->name('show');
    //     Route::post('/delete/{id}', 'destroy')->name('destroy');
    //     Route::get('data','getSlidersData')->name('getSlidersData');
    // });

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
        Route::get('fetchData','fetchData')->name('fetchData');
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
        Route::get('fetchProductAmount','fetchProductAmount')->name('fetchProductAmount');
        Route::post('cancel/{orderId}','cancel')->name('cancel');
    });

    Route::name('notification.')->prefix('notifications')->controller(NotificationController::class)->group(function(){
        Route::get('markAllNotificationsAsRead','markAllNotificationsAsRead')->name('clear');
        Route::get('viewNotification','viewNotification')->name('view');
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
        Route::get('getReportData','getReportData')->name('getReportData');
        Route::get('/export-pdf', 'exportPDF')->name('exportPDF');
        Route::get('/export-excel', 'exportExcel')->name('exportExcel');


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

    Route::name('contact-us.')->prefix('contact-us')->controller(ContactUsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('data','getContactData')->name('getContactData');
        Route::get('show/{id}','show')->name('show');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/information', 'information')->name('information');
        Route::post('information/update/{id}', 'update')->name('information.update');
    });

    Route::name('sales.')->prefix('sales')->controller(SalesController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('getSalesData','getSalesData')->name('getSalesData');
        Route::get('details/{id}/show/','show')->name('show');
        Route::post('change/status', 'changeStatus')->name('change.status');
        Route::post('assigned/employee','assignedToEmployee')->name('assignedToEmployee');
        Route::get('{orderId}/receipt','downloadReceipt')->name('downloadReceipt');

    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('theme/change/{theme}',[ThemeController::class,'changeTheme'])->name('theme.change');
});

Route::get('/change-language', [ThemeController::class, 'switchLanguage'])->name('change_language')->middleware('locale');
require __DIR__.'/auth.php';
