<?php

// namespace App\Http\Controllers;

// use App\Models\Tenant;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Config;
// use Illuminate\Support\Facades\Artisan;

// class SubdomainController extends Controller
// {
//     #create tenant 
//     public function CreateTenant(Request $request)
//     {
//         $tenant = Tenant::create([
//             'id' => $request->target . "_" . $request->tenant_name  ,
//         //     "tenancy_db_names"=>json_encode(
//         //         [
//         //             "product_service"    =>    'multitenant_sidalih_product3',
//         //             "auth_service"       =>    'multitenant_sidalih_auth3',
//         //             "cart_service"       =>    'multitenant_sidalih_cart3'
//         //         ])
//         ]);
//         #==========================================================================#
        
//         $tenancy_db_names = ['multitenant_sidalih_product0', 'multitenant_sidalih_cart0', 'multitenant_sidalih_auth0'];
//         foreach ($tenancy_db_names as $dbName)
//         {
//             // Create a unique connection name for each database
//             $connectionName = $dbName.'_tenant';
//             // Set the database configuration dynamically
//             Config::set("database.connections.$connectionName", [
//             // Config::set('database.connections.tenant', [
//                 'driver' => env('DB_CONNECTION', 'mysql'),
//                 'host' => env('DB_HOST', '127.0.0.1'),
//                 'port' => env('DB_PORT', '3306'),
//                 'database' => $dbName,
//                 'username' => env('DB_USERNAME', 'root'),
//                 'password' => env('DB_PASSWORD', 'murabbadev'),
//             ]);
//             // Create the respective database
//             DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`");
//             Artisan::call('migrate',
//             [
//                 '--path'       =>  'database/migrations/sidalih/productservice',
//                 '--database'   =>  $connectionName,
//                 '--force'      =>   true, #علشان ينفذ الميجريت بدون ما يسأل 
//             ]); 
//         }
//         $tenant->domains()->create(['domain' => $request->target."_".$request->tenant_name.'.localhost']);
//         // #==========================================================================#
//         // // 'name' =>json_encode(["tenancy_db_names"=>"multitenant_sidalih_product"] );
//         // // $tenancy_db_namesarr[]=["tenancy_db_names"=>"multitenant_sidalih_product"];
//         // $tenant->tenancy_db_name = json_encode(["tenancy_db_names"=>'multitenant_sidalih_product0', 'multitenant_sidalih_cart0', 'multitenant_sidalih_auth0'] ); 
       
//             $tenant->tenancy_db_name =json_encode(
//             [
//                 "product_service"    =>    'multitenant_sidalih_product0',
//                 "auth_service"       =>    'multitenant_sidalih_auth0',
//                 "cart_service"       =>    'multitenant_sidalih_cart0'
//             ]);
//              $tenant->save();
//         // #==========================================================================#
//         // return "create tenant  and  domain done";
//    }
    
//    //=======================================
//     public function UpdateDbTenant(Request $request)
//     {
//         $tenant=Tenant::where("id","sidalih_coupons")->first();
//         // $tenant->data = json_encode(["tenancy_db_names"=>'multitenant_sidalih_product', 'multitenant_sidalih_cart', 'multitenant_sidalih_auth'] ); 
//          $tenant->tenancy_db_name = json_encode(
//             [
//                 "product_service"    =>    'multitenant_sidalih_product1',
//                 "auth_service"       =>    'multitenant_sidalih_auth1',
//                 "cart_service"       =>    'multitenant_sidalih_cart1'
//             ]); 
//         $tenant->save();
//         return "done";
//     }  
// }

