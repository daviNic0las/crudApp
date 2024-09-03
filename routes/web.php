<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectorController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'delete'])->name('profile.delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('dashboard', [HomeController::class,'index'])->name('admin.index');

    Route::get('/products', [ProductController::class,'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class,'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('products.edit');
    Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/destroy/{id}', [ProductController::class,'destroy'])->name('products.destroy');

    Route::get('/employee', [EmployeeController::class,'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class,'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class,'store'])->name('employee.store');
    Route::get('/employee/edit/{id}', [EmployeeController::class,'edit'])->name('employee.edit');
    Route::put('/employee/edit/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/destroy/{id}', [EmployeeController::class,'destroy'])->name('employee.destroy');

    Route::get('/category', [CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/destroy/{id}', [CategoryController::class,'destroy'])->name('category.destroy');

    Route::get('/sector', [SectorController::class,'index'])->name('sector.index');
    Route::get('/sector/create', [SectorController::class,'create'])->name('sector.create');
    Route::post('/sector/store', [SectorController::class,'store'])->name('sector.store');
    Route::get('/sector/edit/{id}', [SectorController::class,'edit'])->name('sector.edit');
    Route::put('/sector/edit/{id}', [SectorController::class, 'update'])->name('sector.update');
    Route::get('/sector/destroy/{id}', [SectorController::class,'destroy'])->name('sector.destroy');
});

require __DIR__.'/auth.php';


