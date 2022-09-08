<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\UserController;
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
    return view('welcome');
});

require __DIR__.'/auth.php';



Route::group(['as'=>'app.','prefix'=>'app','namespace'=>'Backend','middleware'=>['auth','web']],function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['as'=>'role.','prefix'=>'role'],function(){

        Route::get('/index',[RoleController::class,'index'])->name('index');
        Route::get('/create',[RoleController::class,'create'])->name('create');
        Route::post('/store',[RoleController::class,'store'])->name('store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[RoleController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[RoleController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'user.','prefix'=>'user'],function(){

        Route::get('/index',[UserController::class,'index'])->name('index');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::post('/store',[UserController::class,'store'])->name('store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('update');
        Route::get('/status/update',[UserController::class,'statusUpdate'])->name('status.update');
        Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'category.','prefix'=>'category'],function(){

        Route::get('/index',[CategoryController::class,'index'])->name('index');
        Route::get('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/store',[CategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[CategoryController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[CategoryController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'subcategory.','prefix'=>'subcategory'],function(){

        Route::get('/index',[SubCategoryController::class,'index'])->name('index');
        Route::get('/create',[SubCategoryController::class,'create'])->name('create');
        Route::post('/store',[SubCategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[SubCategoryController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[SubCategoryController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[SubCategoryController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'color.','prefix'=>'color'],function(){

        Route::get('/index',[ColorController::class,'index'])->name('index');
        Route::get('/create',[ColorController::class,'create'])->name('create');
        Route::post('/store',[ColorController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ColorController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[ColorController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[ColorController::class,'destroy'])->name('delete');
    });

});
