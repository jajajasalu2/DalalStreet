<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Team;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

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
	    'id' => 'required',
	    'team' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
	$team = Team::where('id','=',$data['team'])->first();
	if (empty($team)) {
		$team = new Team;
		$team->id = $data['team'];
		$team->balance = 1000000;	
		DB::insert("insert into teams (id,balance) values($team->id,$team->balance);");
	}
	$user_id = $data['id'];
	$team_id = $data['team'];
	DB::insert("insert into user_teams (user_id,team_id) values($user_id,$team_id);");
        return User::create([
	    'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
	    'role' => 3,
            'password' => Hash::make($data['password']),
        ]);
    }
}
