<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        $test = "kucing";
        return view('home',compact('test'));
    }

    public function login()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        return redirect('/dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function cart()
    {
        return view('cart');
    }

    public function profile()
    {
        return view('profile');
    }

    public function video()
    {
        return view('video');
    }

    public function notification()
    {
        return view('notification');
    }

}
