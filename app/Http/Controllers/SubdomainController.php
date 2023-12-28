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
        $tenant1 = Tenant::create([
            'id' => $request->target . "_" . $request->tenant_name,
            // 'tenancy_db_name' => ['customname1'],
        ]);
        // $tenant1->update([
        //     'data' => [
        //         'tenancy_db_name' => ["db1,db2"]
        // ]]); 
        // $tenant1->save();
               // Get the tenant's database names
        $databaseNames = $tenant1->tenancy_db_name;
        // Loop through each database name and create the corresponding database
        foreach ($databaseNames as $databaseName) {
            // Create the database
            DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");
        
            // Switch to the tenant's database connection
            tenancy()->init($tenant1);
            tenancy()->initializeDatabase();
        
            // Run the tenant's migrations
            Artisan::call('migrate', ['--database' => tenancy()->getTenantConnectionName()]);
        }
        $tenant1->domains()->create(['domain' => $request->target."_".$request->tenant_name.'.localhost']);
        return "create tenant  and  domain done";
    }  
}
