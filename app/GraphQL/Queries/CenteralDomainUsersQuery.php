<?php
namespace App\GraphQL\Queries;
use App\Models\User;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;

class CenteralDomainUsersQuery
{
    public function centeraldomainusers($root, array $args, $context, $info)
    {
        $tenants =Tenant::all();
        $users = [];
        foreach ($tenants as $tenant) {
            // Switch to the subdomain tenant's database connection
            Tenancy::initialize($tenant);
            // Retrieve users from the subdomain tenant's database
            $tenantusers= User::all();
            // Merge the users into the main users array
            $users = array_merge($users, $tenantusers->toArray());
        }
        return $users;
    }
}