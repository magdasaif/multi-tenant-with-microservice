<?php

namespace App\Http\Controllers;

use App\Models\OrderStatuse;
use App\Models\User;
use App\Models\Setting;
use App\Models\Statu;
use App\Trait\SwitchDBTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class TenantController extends Controller
{
    use SwitchDBTrait;
    
    //=================================================================       
    public function setting(){
        //=================================================================
        // here , when switch to known service 
        self::switchDB('cart');
        return Setting::all();
        //=================================================================
        // here , when access requested db of known service       
            // return Config::get('database.default');
            // $service='cart';
            // $db_name=tenant()->id.'_'.$service;
            // Config::set('database.connections.tenant.database',$db_name);

            // $setting=Setting::all();
            // if(isset($setting)){
            //     return $setting;
            // }
        //=================================================================  
        // here , when loop all tenant db and check table found or no , if found --> access it       
            // return request()->getHost();
            // $tenant_details= tenant();
            // $dbs=$tenant_details->tenancy_db_names;
            // $dbs=json_decode($dbs);
            // foreach($dbs as $db){
                
            //     Config::set('database.connections.tenant.database',$db);
            //     // Config::set("database.connections.default",$db);

            //     if (Schema::hasTable('settings')) {

            //         $setting=Setting::all();
            //         if(isset($setting)){
            //             return $setting;
            //         }
            //     }
            // }
        //=================================================================       
        // return 'no data';
        //=================================================================       
            // $request = app(Request::class);
            // $hostParts = explode('.', $request->getHost());
            // $subdomain = $hostParts[0]; // Extract subdomain from the host
            // Tenancy::initialize($subdomain); // Initialize tenancy for the subdomain
            // $user = User::all();
        
            // return $user;
            // return DB::getDefaultConnection();
            // return  $user=User::all();
        //=================================================================       
    }
    //=================================================================       
    public function orderStatus() {
        self::switchDB('order');
        return OrderStatuse::all();     
    }
    //=================================================================       
       public function productStatus() {
        self::switchDB('product');
        return Statu::get();     
        // return Statu::withService('product')->get();     
    }
    //=================================================================       
    public function eradUsers(){
        // return 'ddd';
        return User::get();
    }
    //=================================================================       
}
