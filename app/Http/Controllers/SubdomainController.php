<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    #create tenant 
    public function CreateTenant()
    {
        $tenant1 = Tenant::create(['id' => 'tenant4']);
        $tenant1->domains()->create(['domain' => 'tenant4.localhost']);

    }
}
