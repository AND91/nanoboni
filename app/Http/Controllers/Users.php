<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\TypeRegister;

use App\User;

class Users extends BaseController {
  use RegistersUsers;

  public function index() {
    $data['users'] = User::all();

    return view('users/index')->with($data);
  }

  public function register() {
    $data['type_register'] = TypeRegister::all();

    return view('users/register')->with($data);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @return \App\User
   */
  protected function create(Request $request)
  {
    $data = [
      'name' => $request['name'],
      'profile' => $request['profile'],
      'email' => $request['email'],
      'password' => $request['password'],
      'password_confirmation' => $request['password_confirmation'],
    ];
    $validate = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'profile' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required', 'min:8'],
    ]);

    if ($validate->fails()) {
      return redirect()->route('cadastrarUsuario')->withInput()->withErrors($validate);
    } else {
      $user = User::create([
        'name' => $request['name'],
        'profile' => $request['profile'],
        'email' => $request['email'],
        'password' => Hash::make($request['password'])
      ]);

      return redirect('usuarios/detalhe/'.$user->id);
    }
  }

  public function detail($id) {
    $data['user'] = User::find($id);
    $data['type_register'] = TypeRegister::all();

    return view('users/detail')->with($data);
  }

  /**
   * Update user instance after a valid registration.
   *
   * @return \App\User
   */
  protected function updateUser(Request $request)
  {
    $data = [
      'name' => $request['name'],
      'profile' => $request['profile'],
      'email' => $request['email'],
    ];
    $validator = [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'profile' => ['required'],
    ];
    if (!empty($request['password'])) {
      $data['password'] = $request['password'];
      $validator['password'] = ['required', 'string', 'min:8'];
    }
    $validate = Validator::make($data, $validator);

    if ($validate->fails()) {
      return redirect()->route('detalheUsuario', ['id' => $request->id_user])->withInput()->withErrors($validate);
    } else {
      $user = User::find($request->id_user);
      $data = [
        'name' => $request['name'],
        'profile' => $request['profile'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
      ];
      $user->update($data);

      return redirect()->route('detalheUsuario', ['id' => $request->id_user]);
    }
  }
}
