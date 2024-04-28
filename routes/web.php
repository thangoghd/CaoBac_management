<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecieveNoteController;
use App\Http\Controllers\ReportController;

route::get('/', [HomeController::class, 'userIndex']);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {

// });

Route::middleware(['isadmin'])->group(function () {
    // Route admin
    Route::get('/dashboard', [AdminController::class, 'adminIndex'])->name('dashboard');


        // Product routes
        Route::prefix('product')->group(function () {
            Route::get('/view_category', [CategoryController::class, 'viewCategory'])->name('view.category');
            Route::post('/add_category', [CategoryController::class, 'addCategory'])->name('add.category');
            Route::get('/delete_category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    
            Route::get('/add_product', [ProductController::class, 'addProduct'])->name('add.product');
            Route::get('/view_product', [ProductController::class, 'viewProduct'])->name('view.product');
            Route::post('/create_product', [ProductController::class, 'createProduct'])->name('create.product');
            Route::get('/delete_product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
            Route::get('/get_product/{id}', [ProductController::class, 'getProduct'])->name('get.product');
            Route::put('/update_product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
        });
    
        // Customer routes
        Route::prefix(('customer'))->group(function(){
            route::get('/add_customer', [CustomerController::class,'addCustomer'])->name('add.customer');
            route::post('/create_customer', [CustomerController::class,'createCustomer'])->name('create.customer');
            route::get('/view_customers', [CustomerController::class,'viewCustomers'])->name('view.customers');
            route::get('/get_customer/{id}', [CustomerController::class,'getCustomer'])->name('get.customer');
            route::put('/update_customer', [CustomerController::class,'updateCustomer'])->name('update.customer');
            route::get('/delete_customer/{id}', [CustomerController::class,'deleteCustomer'])->name('delete.customer');
        });
    
        //Order routes
        Route::prefix(('order'))->group(function(){
            route::post('/quick_createcustomer', [OrderController::class, 'createCustomer'])->name('quick.customer');
            route::get('/add_order', [OrderController::class, 'addOrder'])->name('add.order');
            route::post('/create_order', [OrderController::class, 'createOrder'])->name('create.order');
            route::post('/search_customer', [OrderController::class, 'searchCustomer'])->name('search.customer');
            route::post('/search_product', [OrderController::class, 'searchProduct'])->name('search.product');
            route::post('/get_detailed_product', [OrderController::class, 'getDetailedProduct'])->name('get.detailed.product');
            route::get('/view_orders', [OrderController::class, 'viewOrders'])->name('view.orders');
            
            // Detailed order
            route::get('/detailed_order', [OrderController::class, 'viewDetailed'])->name('detailed.order');
        });
    
        // Report routes
        Route::prefix(('report'))->group(function(){
            route::get('/revenue_report', [ReportController::class, 'revenueReports'])->name('revenue.report');
        });
    
        // Recieve goods routes
        Route::prefix(('recieve'))->group(function(){
            route::get('/add_recievenote', [RecieveNoteController::class, 'addRecieveNote'])->name('add.recienote');
            route::post('/create_recievenote', [RecieveNoteController::class, 'createRecieveNote'])->name('create.recienote');
            route::get('/view_recievenotes', [RecieveNoteController::class, 'viewRecieveNotes'])->name('view.recienotes');
            route::get('/detailed_recievenote', [RecievenoteController::class, 'viewDetailed'])->name('detailed.recievenote');
        });
    
        // Delivery goods routes
        Route::prefix(('delivery'))->group(function(){
            route::get('/add_deliverynote', [DeliveryNoteController::class, 'addDeliveryNote'])->name('add.delinote');
        });
    
        // Gererate PDF file
        route::get('/generate_pdf', [PdfController::class, 'exportRecieNote'])->name('pdf.recienote');
});