<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use App\Trait\BelongToStoreTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $connection="tenant";
    use HasFactory;
    // use  BelongToStoreTrait;//used for single database 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
   
}

