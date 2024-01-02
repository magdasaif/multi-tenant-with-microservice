<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SubdomainController extends Controller
{
    #create tenant 
    public function CreateTenant(Request $request)
    {
        $project_name=$request->target;
        $domain=$request->tenant_name;
        #==========================================================================#
        $all_dbs=[];
        $directories = array_map('class_basename', File::directories(database_path('migrations/'.$project_name)));
        if(count($directories)>0){//microservice
            // return Config::get('database.connections');
            // $dbs=[$request->tenant_name.'_xx',$request->tenant_name.'_yy'];
            #==========================================================================#
            //create dbs fore each dirctory in selected project/target
            #==========================================================================#
            foreach($directories as $dir){
                // Config::set('tenancy.migration_parameters.--path',database_path('migrations/'.$project_name.'/',$dir));
                #==========================================================================#
                //create new driver for each directory
                #change defualt for connection in database.php
                $db=$project_name.'_'.$domain.'_'.$dir;
                Config::set("database.connections.$db", [
                    'driver' => env('DB_CONNECTION', 'mysql'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => $db,
                    'username' => env('DB_USERNAME', 'root'),
                    'password' => env('DB_PASSWORD', 'murabbadev'),
                ]);
                Config::set("database.connections.default",$db);
                // Config::set('database.connections.tenant.database',$db);
                #==========================================================================#
                #create batabase
                DB::statement("CREATE DATABASE IF NOT EXISTS `".$db."`");#true
                $all_dbs[]=$db;
               #==========================================================================#
                #db migration through Artisan for each db
                #Artisan::call() -->بعمل من خلاله كول لاى كوماند انا عايزاه
                #migrate--> بياخد اكتر من براميتر (path ,database)
                Artisan::call('migrate',
                [
                    '--path'       =>  'database/migrations/'.$project_name.'/'.$dir,
                    // '--database'   =>   'tenant',
                    '--database'   =>   $db,
                    '--force'      =>   true, #علشان ينفذ الميجريت بدون ما يسأل 
                ]);
                #==========================================================================#
                #reurn connection to defualt
                // Config::set("database.connections.default",'mysql');
                // DB::setDefaultConnection('mysql');
                #==========================================================================#
            }
        }else{//monolitic
            //==============================================================
            //update config data
            Config::set('tenancy.database.prefix',$project_name.'_');
            Config::set('tenancy.migration_parameters.--path',database_path('migrations/'.$project_name));
            $all_dbs[]=$project_name;
            //==============================================================
        }
        #==========================================================================#
        //create reqested tenant and connect it with created dbs
        #==========================================================================#
        $tenant_id= $project_name . "_" . $domain ;
        $tenant = Tenant::create([
            'id' => $tenant_id ,
        ]);
        $tenant->domains()->create(['domain' => $tenant_id.'.localhost']);
        #==========================================================================#
        //use CustomColumns function to apply changes on any new columns
        #==========================================================================#
        $tenant->custom_columns='tenancy_db_names';
        $tenant->tenancy_db_names =json_encode($all_dbs);
        $tenant->save();
        #==========================================================================#
        return 'done ';
        //=======================================================================
            // $tenant = Tenant::create([
            //     'id'       => $request->target . "_" . $request->tenant_name  ,
            // ]);
            // // return $tenant;
            // #==========================================================================#
            
            // // $tenancy_db_names = ['multitenant_sidalih_product', 'multitenant_sidalih_cart', 'multitenant_sidalih_auth'];
            // $tenancy_db_names = ['multitenant_sidalih_product'];
            // foreach ($tenancy_db_names as $dbName)
            // {
            //     // Create a unique connection name for each database
            //     $connectionName = $dbName.'_tenant';
            //     // Set the database configuration dynamically
            //     Config::set("database.connections.$connectionName", [
            //     // Config::set('database.connections.tenant', [
            //         'driver' => env('DB_CONNECTION', 'mysql'),
            //         'host' => env('DB_HOST', '127.0.0.1'),
            //         'port' => env('DB_PORT', '3306'),
            //         'database' => $dbName,
            //         'username' => env('DB_USERNAME', 'root'),
            //         'password' => env('DB_PASSWORD', 'murabbadev'),
            //     ]);
            //     // Create the respective database
            //     DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`");

            //     DB::setDefaultConnection($connectionName);
            //     Artisan::call('migrate',
            //     [
            //         '--path'       =>  'database/migrations/sidalih/productservice',
            //         '--database'   =>  $connectionName,
            //         '--force'      =>   true, #علشان ينفذ الميجريت بدون ما يسأل 
            //     ]); 
            // }
            // $tenant->domains()->create(['domain' => $request->target."_".$request->tenant_name.'.localhost']);
            // // #==========================================================================#
        
            //     // $tenant->tenancy_db_name =json_encode(
            //     // [
            //     //     "product_service"    =>    'multitenant_sidalih_product0',
            //     //     "auth_service"       =>    'multitenant_sidalih_auth0',
            //     //     "cart_service"       =>    'multitenant_sidalih_cart0'
            //     // ]);
            //     //  $tenant->save();
        // #==========================================================================#
        return "create tenant  and  domain done";
   }
    
   //=======================================
    public function UpdateDbTenant(Request $request)
    {
        $tenant=Tenant::where("id","sidalih_coupons")->first();
        // $tenant->data = json_encode(["tenancy_db_names"=>'multitenant_sidalih_product', 'multitenant_sidalih_cart', 'multitenant_sidalih_auth'] ); 
         $tenant->tenancy_db_name = json_encode(
            [
                "product_service"    =>    'multitenant_sidalih_product1',
                "auth_service"       =>    'multitenant_sidalih_auth1',
                "cart_service"       =>    'multitenant_sidalih_cart1'
            ]); 
        $tenant->save();
        return "done";
    }  
}

