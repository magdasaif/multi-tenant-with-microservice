<?php

namespace App\Models;

use App\Trait\SwitchDBTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    // use SwitchDBTrait;

    // public static function booted(){
    //     $service='cart';
    //     //=====================================================================
    //     // $db_name=tenant()->id.'_'.$service;
    //     // Config::set('database.connections.tenant.database',$db_name);
    //     //=====================================================================
    //     self::switchDB($service);
    //     //=====================================================================
    //     Log::info('------------------inside setting boot function------------------------');
    // }
}
