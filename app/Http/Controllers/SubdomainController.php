<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SubdomainController extends Controller
{
    #create tenant 
    public function CreateTenantOld(Request $request)
    {
        // dd(($request->tenant_name));
        //multitenant--->name
        $tenant1 = Tenant::create(['id' =>$request->target."_".$request->tenant_name/*,'target' =>$request->target*/]);
        $tenant1->domains()->create(['domain' => $request->target."_".$request->tenant_name.'.localhost']);
        return "create tenant  and  domain done";
    }
    #=======================================================================================================#
    public function CreateTenant(Request $request)
    {
        // $tenant1 = Tenant::create([
        //     'id' => $request->target . "_" . $request->tenant_name,
        //     'tenancy_db_name' => ["db1,db2"]
        // ]);
        //        // Get the tenant's database names
        // $databaseNames = $tenant1->tenancy_db_name;
        // // Loop through each database name and create the corresponding database
        // foreach ($databaseNames as $databaseName) {
        //     // Create the database
        //     DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");
        
        //     // Switch to the tenant's database connection
        //     tenancy()->init($tenant1);
        //     tenancy()->initializeDatabase();
        
        //     // Run the tenant's migrations
        //     Artisan::call('migrate', ['--database' => tenancy()->getTenantConnectionName()]);
        // }
        // $tenant1->domains()->create(['domain' => $request->target."_".$request->tenant_name.'.localhost']);
        // return "create tenant  and  domain done";



    //     $tenant1 = Tenant::create([
    //         'id' => $request->target . "_" . $request->tenant_name,
    //     ]);
        
    //     // Get the tenant's database names
    //     $databaseNames = ['customname1', 'customname2'];
        
    //     // Loop through each database name and create the corresponding database
    //     foreach ($databaseNames as $databaseName) {
    //         // Create the database
    //         DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");
        
    //         // // Assign the database name to the tenant's connection
    //         // $tenant1->tenancy_db_name = $databaseName;
        
    //         // // Switch to the tenant's database connection
    //         // tenancy()->init($tenant1);
    //         // tenancy()->initializeDatabase();
        
    //         // // Run the tenant's migrations
    //         // Artisan::call('migrate', ['--database' => tenancy()->getTenantConnectionName()]);
    //         // Create the database
    // DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");

    // // Assign the database name to the tenant's connection
    // $tenant1->tenancy_db_name = $databaseName;

    // // Set the tenant's database connection dynamically
    // config(['database.connections.tenant.database' => $databaseName]);

    // // Run the tenant's migrations
    // Artisan::call('migrate', ['--database' => 'tenant']);
    //     }



                $tenant = Tenant::create([
                  'id' => $request->target . "_" . $request->tenant_name,
                //   'tenancy_db_names' => ['multitenant_sidalih_product0000', 'multitenant_sidalih_cart0000','multitenant_sidalih_auth0000'],
                ]);

                // // Create the respective databases and run migrations
                foreach ($tenant->tenancy_db_names as $dbName) {
                    DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`");

                    // // Run migrations for each database
                    config(['database.connections.tenant.database' => $dbName]);
                    Artisan::call('migrate', ['--database' => 'tenant']);


                    #==========================================================================#
                    // DB::statement("CREATE DATABASE IF NOT EXISTS $dbName");#true
                    // DB::purge('tenant');
                    // config(['database.connections.tenant.database' => $dbName]);
                    // DB::reconnect('mysql');
                    
                     #==========================================================================#
                }
    }  
}
