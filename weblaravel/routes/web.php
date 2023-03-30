<?php

use App\Http\Controllers\Admin\AddEmployeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\ListEmployeController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\App;
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



Route::get('/', function(){
    return redirect()->route('login');
})->name('starter_pages');

// Route::get('/login',function(){
//     return view('login');
// })->name('login');
// Route::get('/',function(){
//     return 
// });
// Route::get('/listt',[CustomerController::class,'product'])->name('listcustomer');
Route::prefix('admin')->group(function(){
    Route::get('/users/login',[LoginController::class,'login'])->name('login');
    Route::get('/users/logout',[LoginController::class,'logout'])->name('logout');
    Route::post('/users/login/home',[LoginController::class,'home'])->name('home');

    Route:: middleware(['auth'])->group(function(){
        Route::get('/main',[MainController::class,'index'])->name('admin');
        
        Route::prefix('/addemploye')->group(function(){
            Route::get('/add',[AddEmployeController::class,'create'])->name('addemploye');
            Route::post(('/add'),[AddEmployeController::class,'store']);
        });
        
        Route::prefix('/listemploye')->group(function(){
            
            Route::get('/',[AddEmployeController::class,'product'])->name('listemploye');
            Route::get(('/edit/{id}'),[AddEmployeController::class,'getEdit'])->name('employe_edit');
            Route::post(('/edit/{id}'),[AddEmployeController::class,'postEdit'])->name('post_employe_edit');
            Route::get(('/delete/{id}'),[AddEmployeController::class,'getDelete'])->name('employe_delete');
        });
        
        Route::prefix('/addcustomer')->group(function(){
            Route::get('/add',[CustomerController::class,'create'])->name('addcustomer');
            Route::post(('/add'),[CustomerController::class,'store']);
        });
        Route::prefix('/listcustomer')->group(function(){
            // route::resource('/','CustomerController');
            Route::get('/',[CustomerController::class,'product'])->name('listcustomer');
            Route::post(('/addemail'),[CustomerController::class,'postemail'])->name('customer_postemail');
            Route::get(('/addemail/{id}'),[CustomerController::class,'getemail'])->name('customer_getemail');
            Route::get(('/edit/{id}'),[CustomerController::class,'getEdit'])->name('customer_edit');
            Route::post(('/edit'),[CustomerController::class,'postEdit'])->name('post_customer_edit');
            Route::delete(('/delete'),[CustomerController::class,'getdelete'])->name('customer_delete');
            Route::delete(('/delete/email/{id}'),[CustomerController::class,'getdelete_email'])->name('customer_delete_email');
            Route::delete(('/delete1/{id}'),[CustomerController::class,'getdelete_1'])->name('customer_delete_1');
            Route::get(('/editcustomer/{id}'),[CustomerController::class,'getEditcustomer'])->name('customer_edit1');
            Route::post(('/editcustomer/{id}'),[CustomerController::class,'postEditcustomer'])->name('post_customer_edit1');

        });
        Route::prefix('/import-export-excel')->group(function(){
            Route::get(('/'),[CustomerController::class,'getExcel'])->name('excel');
            Route::get('exportEmploye',[ExcelController::class,'exportEmploye'])->name('exportEmploye');
            Route::post('importEmploye',[ExcelController::class,'importEmploye'])->name('importEmploye');
            Route::get('exportCustomer',[ExcelController::class,'exportCustomer'])->name('exportCustomer');
            Route::post('importCustomer',[ExcelController::class,'importCustomer'])->name('importCustomer');
        });
        #upload
        Route::post('/addemploye/upload',[UploadController::class,'index']);
 });
});
 

