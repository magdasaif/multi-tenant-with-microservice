<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
    #app.com             -->  centeral domain
    #tenant1.app.com     -->   subdoamin
/*

*/
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class, #بيمنع ال subdomain access from centeral domain
])->group(function () { 
    #roues related tenants
    // Route::get('/', function () {dd(User::all());});
    Route::get('/users', [UserController::class, 'users']);

    Route::get('/createuser', [UserController::class, 'CreateUser']);

});
