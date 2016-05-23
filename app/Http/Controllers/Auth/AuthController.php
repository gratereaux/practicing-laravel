<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Practicante;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';
    protected $username = 'username';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'username' => 'required|max:60|min:4',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    
    protected function register(){
        return view('admin.auth.register');
    }

    protected function postRegister(UserRequest $request){
        $exist = Practicante::where('email', $request->email)->get();
        
        if (count($exist) == 1){
            $user = new User($request->all());
            $user->password = bcrypt($request->password);
            $user->save();

            Flash::success("Se ha registrado el usuario ".$user->name." de manera exitosa! Ya puedes hacer login");
            
            return redirect()->route('admin.auth.login');
        }else{
            Flash::success("El correo no es válido");
            return redirect()->route('admin.auth.register');
        }
    }


    protected function getLogin(){
        return view('admin.auth.login');
    }
}
