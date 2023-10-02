<?php

use App\Http\Controllers\CompanyControl;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


Route::get('/companies', [CompanyControl::class, 'index'])->middleware('auth');



// All companies
Route::get('/', [CompanyControl::class, 'index'])->name('companies.index');

// Show Create Form
Route::get('/companies/create', [CompanyControl::class, 'create'])->middleware('auth');

// Store company Data
Route::post('/companies', [CompanyControl::class, 'store'])->middleware('auth')->name('companies.store');

// Show Edit Form
Route::get('/companies/{company}/edit', [CompanyControl::class, 'edit'])->middleware('auth');

// Update company
Route::put('/companies/{company}', [CompanyControl::class, 'update'])->middleware('auth');

// Delete company
Route::delete('/companies/{company}', [CompanyControl::class, 'destroy'])->middleware('auth');



// ----------------------------


// All employees
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth')->name('employees.index');

// Show Create Form
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware('auth');

// Store employee Data
Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth')->name('employees.store');

// Show Edit Form
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->middleware('auth');

// Update employee
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->middleware('auth');

// Delete employee
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->middleware('auth');
