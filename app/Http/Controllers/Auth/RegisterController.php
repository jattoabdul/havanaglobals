<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tel' => 'required|string|max:16',
            'password' => 'required|string|min:6',
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
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function guestRegister(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|string|max:250',
			'last_name' => 'required|string|max:250',
			'email' => 'required|email|max:255|unique:users,email',
			'tel' => 'required|string|max:16'
		]);

		$user = new User();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->tel = $request->tel;
		$user->save();

		Auth::loginUsingId($user->id);

		if(!$request->ajax())
		{
			return redirect()->back();
		}
	}
}
