<?php

namespace App\Http\Controllers;

use App\Events\CustomerOrder;
use App\Mail\CreatedUserMail;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('123456');
        $role = Role::where('name', $request->role)->first();
        $user->save();
        $user->message = $request->message;
        $user->roles()->attach($role);
        // send email here
        event(new CustomerOrder($user));
        // ----
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
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|unique:users,email,' . $id . '|email',
        ]);

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return response([
            'user' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response([
            'result' => 'success'
        ], 200);
    }
}
