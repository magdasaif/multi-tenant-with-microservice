<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Store;
use App\Events\StoreCreated;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::BeginTransaction();
        
            try
            {
                #=======store======
                $store= Store::create([
                    'name'   => $data['name'],
                    'domain' => $data['name'].'.localhost',
                ]);
                #==========================================================================#
                $db_name="tenancywithmicroservices_{$store->id}";  #اسم الداتا بيز 
                // dd("tenancy_store_{$store->id}");
                #update on store table for database_options column
                $store->database_options=["dbname"=>$db_name,];
                $store->save();
                #=========user============
                $user=User::create([
                    'store_id'   => $store->id,
                    'name'       => $data['name'],
                    'email'      => $data['email'],
                    'password'   => Hash::make($data['password']),
                ]);
                #===============fire event for create store==========
                #محتاجة ابعت الاستور اللى اتكريت للايفنت ده 
                event(new StoreCreated($store));
                #====================================================
                DB::commit();
            }catch(Exception $e)
            {
                DB::rollBack();

                throw $e;
                
            }
        
      
    }
}
