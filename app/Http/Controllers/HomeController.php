<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'admin']);
        return view('home');
    }

    public function hadSeen(Request $request)
    {
        dd('hadSeen');
        $user = new User();
        $user->name = time();
        $user->email = time();
        $user->password = bcrypt('123456');

        $user->save();
    }
}
