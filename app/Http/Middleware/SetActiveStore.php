<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SetActiveStore
{
    //بحدد مين ال active store من خلاله
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        #=================single database========================
        // $host=$request->getHttpHost(); //return localhost:8000
        // $host=$request->getHost(); //return localhost
        // // dd($host);
        // // $store=Store::where('domain',$host)->firstOrFail();//if domain not found will return not found
        // $store=Store::where('domain',$host)->first();
        // // dd($store);      
        // if($store)
        // {
        //     app()->instance('store.active',$store); // 'store.active' بخزن فيها القيمة بمتغير اسمه 
        // }
        // else
        // {
        //     app()->instance('store.active','not');
        // }
            
        // return $next($request);
        #=======================muti-databse================================
        #كل مرة ازور فيها الموقع هغير الكونكشن من الديفولد لل telant

        // $host=$request->getHttpHost(); //return localhost:8000
        $host=$request->getHost(); //return localhost
        // dd($host);
        // $store=Store::where('domain',$host)->firstOrFail();//if domain not found will return not found
        $store=Store::where('domain',$host)->first();
        // dd($store);      
        if($store)
        {
            app()->instance('store.active',$store); 
            $db_name=$store->database_options['dbname'];
            #change defualt for connection in database.php
            Config::set('database.connections.tenant.database',$db_name);
        }
        return $next($request);
    }
}
