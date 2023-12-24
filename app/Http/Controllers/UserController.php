<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function CreateUser(Request $request)
    {
        $user=User::create([
            'name'       => "tenant1".$request->getHost(),
            'email'      => "tenant1@gmail.com",
            'password'   => Hash::make(123456789),
        ]);
    }
    #==========================================#
    public function users()
    {
        dd(User::all());
    }
    
}
