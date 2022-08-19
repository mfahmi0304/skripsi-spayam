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
    public function index(Request $request)
    {
        if($request->user()->hasRole('user')) {
            $role = 'peternak';
        }
        else{
            $role = 'admin';
        }

        $gejala = DB::table('gejalas')->count();
        $penyakit = DB::table('penyakits')->count();
        $basis_pengetahuan = DB::table('basis_pengetahuans')->count();

        $penyakit_terbanyak = DB::table('diagnosas')
        ->join('penyakits', 'penyakits.id', 'diagnosas.id_penyakit')
        ->where(DB::raw("MONTH(`diagnosas`.`created_at`)"),date("m"))
        ->select('nama_penyakit', DB::raw('count(*) as total'))
        ->groupBy('nama_penyakit')
        ->orderBy('total', 'desc')
        ->get();

        $gejala_penyakit = DB::table('diagnosas')
        ->select('gejala')
        ->where(DB::raw("MONTH(`diagnosas`.`created_at`)"),date("m"))
        ->get();

        $data = '';
        $i = 0;
        foreach($gejala_penyakit as $g){
            $data .= $g->gejala .','; 
            $i++;
        }
        $datas = explode(',', $data);
        $freq = array_count_values($datas);
        arsort($freq);

        $ids = array_keys($freq);
        $count = array_values($freq);

        $ids = array_slice($ids, 0,5);
        $count = array_slice($count, 0,5);

        $j = 0;
        $gejala_terbanyak = [];
        foreach($ids as $id){
            $get_gejala = DB::table('gejalas')
            ->select('nama_gejala')
            ->where('id', $id)
            ->get();

            $gejala_terbanyak[$j]['nama_gejala'] = $get_gejala[0]->nama_gejala;
            $gejala_terbanyak[$j]['total'] = $count[$j];

            $j++;
        }

        $data = array(
            'gejala'            => $gejala,
            'penyakit'          => $penyakit,
            'basis_pengetahuan' => $basis_pengetahuan,
            'gejala_terbanyak'  => $gejala_terbanyak,
            'penyakit_terbanyak'=> $penyakit_terbanyak
        );

        return view('home', compact(['data', 'role']));
    }
}
