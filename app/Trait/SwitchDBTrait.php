<?php
namespace App\Trait;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

trait SwitchDBTrait 
{
    public static function switchDB($service){
        // $service='cart';
        $db_name=tenant()->id.'_'.$service;
        Config::set('database.connections.tenant.database',$db_name);
    }

    // public function switchDB($service){
    //     // $service='cart';
    //     $db_name=tenant()->id.'_'.$service;
    //     Config::set('database.connections.tenant.database',$db_name);
    //     Config::set('database.default','tenant');
    //     Log::info('--------------------inside trait-----------------');
    //     Log::info($db_name);
    // }

}

