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
            'name'       => "tenancy".$request->getHost(),
            'email'      => "tenancy.@gmail.com",
            'password'   => Hash::make(123456789),
        ]);
        return "done" ;
    }
    #==========================================#
    public function users()
    {
      return  $user=User::all();
    }
    //=====================================
    public function tests()
    {
       return[ 'message'    => "test done"];
    }
    //=====================================
    public function show($user)
    {
        $user=User::find($user);
        if($user)
        {
            $fields = request()->input('fields', 'id,name');

            $fieldsArray = explode(',', $fields);
        
            $user = $user->only($fieldsArray);
        
            return response()->json($user);
        }
        else
        {
            return response()->json(["message"   => "user not found"]);
        } 
    }
    //=====================================
    public function postOfUser($user)
    {
        $user=User::find($user);
        if($user)
        {
            return response()->json($user->posts);
        }
        else
        {
            return response()->json(["message"   => "user not found"]);
        } 
    }
    //=====================================
    public function usersrelations()
    {
        $query = User::query();
        $filter = request()->input('filter');
        $relations= $filter['include'];
        // return ($relations);
        return $query->with($relations)->get();
        // foreach((array)$relations as $key=>$value){
        //     // return $key;
        //    $query->with($key);  
        // }
        // // return 'fff';
        // $users = $query->get();
        // return response()->json($users);
        //=========================================================
    }
    
}
