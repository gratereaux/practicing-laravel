<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    
	public function index(Request $request){

		$users = User::search($request->name)->orderBy('id', 'DESC')->paginate(5);

		return view('admin.users.users')->with('users', $users);
	}

	public function create(){
		return view('admin.users.create');
	}

	public function store(UserRequest $request){

		$user = new User($request->all());
		$user->password = bcrypt($request->password);
		$user->save();

		Flash::success("Se ha registrado el usuario ".$user->name." de manera exitosa!");
		
		return redirect()->route('admin.users.index');

	}

	public function destroy($id){
		
		$user = User::find($id);
		$nombre = $user->name;

		$user->delete();

		Flash::error("El usuario ".$nombre." ha sido eliminado de manera exitosa!");
		
		return redirect()->route('admin.users.index');
		
	}

	public function edit($id){

		$user = User::find($id);
		return view('admin.users.edit')->with('user', $user);

	}

	public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
    	$user->type = $request->type;

        $user->save();

        Flash::warning("El usuario ".$user->name." ha sido editado de manera exitosa!");
		
		return redirect()->route('admin.users.index');

    }

}
