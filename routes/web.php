<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubdomainController;
use App\Http\Controllers\CentralDomainController;

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
Route::get('/users', function () {dd(User::all());});
Route::get('/createsubdomain/{tenant_name}', [SubdomainController::class, 'CreateTenant']);
Route::get('/users/{user}'                 , [UserController::class, 'show']);
Route::get('/users/{user_id}/posts'        , [UserController::class, 'postOfUser']);
Route::get('/usersrelations'               , [UserController::class, 'usersrelations']);
Route::get('/subdomainsusers'              , [CentralDomainController::class, 'index']);










//===========================================================================//
// //to apply for all routes
// Route::middleware('SetActiveStore')->group(function () {
//     // Route::get('/products', [ProductsController::class, 'store']);
  
//     Route::get('/createsubdomain', [SubdomainController::class, 'CreateTenant']);
// });



// Route::get('/users/{user}', function ($user_id){

//  $user=User::find($user_id);
//     $fields = request()->input('fields', 'id,name');

//     $fieldsArray = explode(',', $fields);

//      $user = $user->only($fieldsArray);

//     return response()->json($user);
// });