<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get()->load('roles');
        return $users;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->input('user');
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt('123456');
        $role = Role::where('name', $data['role'])->first();

        $user->save();

        $user->roles()->attach($role);
        return response('success');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
