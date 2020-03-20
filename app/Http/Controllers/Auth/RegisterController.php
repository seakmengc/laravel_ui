<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'username' => ['required', 'string', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'max:100', 'confirmed'],
            'first_name' => 'required|max:50|alpha',
            'last_name' => 'required|max:50|alpha',
            'dob' => 'required|date|before:today',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|digits_between:8,10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        $user = User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);

        $user->identity()->create([
            'first_name' => ucfirst($data['last_name']),
            'last_name' => ucfirst($data['last_name']),
            'dob' => $data['dob'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);

        DB::commit();

        return $user;
    }
}
