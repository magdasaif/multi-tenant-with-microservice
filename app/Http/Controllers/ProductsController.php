<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        # get 'store.active' value from middleware through the below line
        // $store=app()->make('store.active'); //return domain that accessed now 
        # the below line will get all products that related with 'store.active'
        // return $store->products;
        #return all products not related with specific store
        // dd("sss");
        // return Product::all();
    }
} 
