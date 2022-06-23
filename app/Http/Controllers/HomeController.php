<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {
        $gejala = DB::table('gejalas')->count();
        $penyakit = DB::table('penyakits')->count();
        $basis_pengetahuan = DB::table('basis_pengetahuans')->count();

        $data = array(
            'gejala'     => $gejala,
            'penyakit'     => $penyakit,
            'basis_pengetahuan' => $basis_pengetahuan
        );

        return view('home', compact('data'));
    }
}
