<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        //dd( $request->path());
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if (!Auth::check() && $request->path() == 'login') {
            return view('welcome');
        }
        if ($request->path() == 'login') {
            return redirect('/');
        }
        if ($request->path() == 'register') {
            return redirect('/');
        }
        return view('welcome');
    }
}
