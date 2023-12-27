<?php
namespace App\GraphQL\Queries;
use App\Models\User;
use Illuminate\Http\Request;
use Stancl\Tenancy\Facades\Tenancy;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class SubDomainUsersQuery
{
    
    public function subdomainusers($root, array $args, $context, $info)
    {
        // return  $user=User::all(); 
        // Retrieve subdomain from the request or context, depending on how you handle tenancy
        $hostParts = explode('.', request()->getHost());
        $subdomain = $hostParts[0]; // Extract subdomain from the host
        Tenancy::initialize($subdomain); // Initialize tenancy for the subdomain
        $user = User::all();
        return $user;
    }

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