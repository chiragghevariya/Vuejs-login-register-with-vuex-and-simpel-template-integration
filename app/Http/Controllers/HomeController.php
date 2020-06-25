<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.app');
    }    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('layouts.dashboard.app');
    }

    public function welcome(){

        return "welcome page";
    }

    public function SocialSignup($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        dd($user);exit;
        return response()->json($user);
    }

    public function callBackGithub(){
        
        return view('layouts.app');
    }
}
