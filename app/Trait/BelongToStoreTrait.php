<?php
namespace App\Trait;
use App\Models\Store;

trait BelongToStoreTrait 
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    //=======================================//
    // protected static function booted()
    // {
    //     static::addGlobalScope('store', function ($query) {
    //     $store=app()->make('store.active'); //return domain that accessed now 
    //     $query->where('store_id', $store->id);
    //     });
    // }
    //=======================================//
    /*
     معرفة بالشكل ده static دى فانكشن 
      boot +BelongToStoreTrait
      علشان الموديل اول ما يرن يتعرف عليها ع انها فانكشن booted 
      وف نفس الوقت لو فى فى الموديل فانكشن booted ميحلص للفانكشن الموجودة فى ال
      trait
       دى الغاء كانها مش موجودة 
       والحالة دى تستخدم مع ال
       trait
    */
    //=======================================//
    protected static function bootBelongToStoreTrait()
    {
        if(app()->make('store.active')=='not'){}
        else
        {
            static::addGlobalScope('store', function ($query) {
            $store=app()->make('store.active'); //return domain that accessed now 
            $query->where('store_id', $store->id);
            });
        }
    }
}

?>
