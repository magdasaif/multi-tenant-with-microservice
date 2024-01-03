<?php
namespace App\GraphQL\Queries;

use App\Models\OrderStatuse;
use App\Models\Setting;
use App\Models\Statu;
use App\Models\User;
use App\Trait\SwitchDBTrait;
use Illuminate\Http\Request;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Config;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class SubDomainUsersQuery
{
    use SwitchDBTrait;
    public function subdomainusers($root, array $args, $context, $info)
    { 
        // self::switchDB('cart');
        // Config::set('database.connections.tenant.database','eradonline_eradonline_test2_1_4');
        // eradonline_eradonline_test2_1_4
        // return  $user=User::all(); 
        // Retrieve subdomain from the request or context, depending on how you handle tenancy
        // $hostParts = explode('.', request()->getHost());
        // $subdomain = $hostParts[0]; // Extract subdomain from the host
        // Tenancy::initialize($subdomain); // Initialize tenancy for the subdomain
        $user = User::get();
        return $user;
    }
    //==========================================================================
    public function getSettingFromCart($root, array $args, $context, $info){
        self::switchDB('cart');
        return Setting::get();
    }
    //==========================================================================
    public function productStatus($root, array $args, $context, $info){
        self::switchDB('product');
        return Statu::get();
    }
    //==========================================================================
    public function orderStatus($root, array $args, $context, $info){
        self::switchDB('order');
        return OrderStatuse::get();
    }
    //==========================================================================
    // public function subdomainusers($root, array $args, $context, $info)
    // {
    //     $middleware = [
    //         PreventAccessFromCentralDomains::class,
    //         InitializeTenancyByDomain::class,
    //     ];
    //     $resolver = function () use ($root, $args, $context, $info) {
    //         return User::all();
    //     };
    //     // $result = app('Lighthouse\GraphQL')->executeMiddleware($middleware, $resolver, compact('root', 'args', 'context', 'info'));
    //     $result = app('Nuwave\Lighthouse\GraphQL')->executeMiddleware($middleware, $resolver, compact('root', 'args', 'context', 'info'));
    //     return $result;
    // }
    
}