<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubdomainController;

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
#routes related centeral domain
// Auth::routes();
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/users', [UserController::class, 'users']);
 Route::get('/allusers', function () {dd(User::all());});

Route::get('/createsubdomain', [SubdomainController::class, 'CreateTenant']);

// //to apply for all routes
// Route::middleware('SetActiveStore')->group(function () {
//     // Route::get('/products', [ProductsController::class, 'store']);
  
//     Route::get('/createsubdomain', [SubdomainController::class, 'CreateTenant']);
// });


