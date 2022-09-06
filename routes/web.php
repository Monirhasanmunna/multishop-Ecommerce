<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
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
        Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('delete');
    });

    
});
