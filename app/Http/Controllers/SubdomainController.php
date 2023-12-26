<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    #create tenant 
    public function CreateTenant(Request $request)
    {
        // dd(($request->tenant_name));
        $tenant1 = Tenant::create(['id' => $request->tenant_name]);
        $tenant1->domains()->create(['domain' => $request->tenant_name.'.localhost']);
        return "done";

    }
}
