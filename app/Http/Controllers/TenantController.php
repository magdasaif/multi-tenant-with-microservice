<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class TenantController extends Controller
{
    
    public function testCart()
    {
        // return request()->getHost();
        $tenant_details= tenant();
        $dbs=$tenant_details->tenancy_db_names;
        $dbs=json_decode($dbs);
        foreach($dbs as $db){
            
            Config::set('database.connections.tenant.database',$db);
            Config::set("database.connections.default",$db);

            if (Schema::hasTable('settings')) {

                $setting=Setting::all();
                if(isset($setting)){
                    return $setting;
                }
            }
        }
        return 'no data';


        // $request = app(Request::class);
        // $hostParts = explode('.', $request->getHost());
        // $subdomain = $hostParts[0]; // Extract subdomain from the host
        // Tenancy::initialize($subdomain); // Initialize tenancy for the subdomain
        // $user = User::all();
    
        // return $user;
        // return DB::getDefaultConnection();
      return  $user=User::all();
    }
 
    
}
