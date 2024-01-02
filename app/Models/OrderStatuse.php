<?php

namespace App\Models;

use App\Trait\SwitchDBTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatuse extends Model
{
    use HasFactory;
    // use SwitchDBTrait;
    // public static function booted(){
    //     $service='order';
    //     //=====================================================================
    //     self::switchDB($service);
    //     //=====================================================================
    //     Log::info('------------------inside order status boot function------------------------');
    // }
}
