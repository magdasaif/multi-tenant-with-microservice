<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateStoreDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StoreCreated $event)
    {
        $store=$event->store;  #بيانات الاستور
        $db_name="tenancy_store_{$store->id}";  #اسم الداتا بيز 
        #==========================================================================#
        #update on store table for database_options column
        // $store->database_options=["dbname"=>$db_name,];
        #==========================================================================#
        $old_connection=Config::get('database.connections.mysql.database',$db_name);
        #change defualt for connection in database.php
        Config::set('database.connections.tenant.database',$db_name);
        #==========================================================================#
        #create batabase
        // DB::statement("CREATE DATABASE '{$db_name}'");#wrong
        DB::statement("CREATE DATABASE $db_name");#true
       #==========================================================================#
        #db migration through Artisan 
        #Artisan::call() -->بعمل من خلاله كول لاى كوماند انا عايزاه
        #migrate--> بياخد اكتر من براميتر (path ,database)
        Artisan::call('migrate',
        [
            '--path'       =>  'database/migrations/tenants',
            '--database'   =>   'tenant',
            '--force'      =>   true, #علشان ينفذ الميجريت بدون ما يسأل 
        ]);
        #==========================================================================#
        #reurn connection to defualt
        Config::set('database.connections.mysql.database',$old_connection);
        #==========================================================================#
    }
}
