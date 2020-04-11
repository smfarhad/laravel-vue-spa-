<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Http\Controllers\API\AuthController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return Auth::id();
        // return $user = User::find(Auth::id());
        //return $user->notifications;
        // return $token = JWTAuth::getToken();
        // return auth('api')->check();
        return view('home');
    }
}
