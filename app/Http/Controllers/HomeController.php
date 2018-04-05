<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\ComputadoraEnUso;

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
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $computadoras = ComputadoraEnUso::Consulta_datos();

        return view('admin/home')->with('computadoras',$computadoras);
    }

    public function principal()
    {
        $computadoras = ComputadoraEnUso::Consulta_datos();

        return view('auth.register')->with('computadoras',$computadoras);
    }


    public function logOut(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
