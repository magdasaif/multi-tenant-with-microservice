<?php

namespace App\Models;

use App\Trait\SwitchDBTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statu extends Model
{
    use HasFactory;
    // use SwitchDBTrait;
    //=====================================================================
    // public static function booted(){
        //     $service='product';
        //     //=====================================================================
        //     self::switchDB($service);
        //     //=====================================================================
        //     Log::info('------------------inside order status boot function------------------------');
    // }
    //=====================================================================
    // public static function scopeWithService($query,$service){
        //     Log::info($service);
        //     Log::info(Config::get('database.connections.tenant.database'));
        //     // $this->switchDB($service);
        
        //     self::switchDB($service);
        //     Log::info(Config::get('database.connections.tenant.database'));
        //     Log::info('------------------inside order status scope function------------------------');
        
        //     return $query;
    // }
    //=====================================================================
}
