<?php

namespace App\Http\Controllers;

use App\BasisPengetahuan;
use App\Gejala;
use App\Penyakit;
use App\Diagnosa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('user')) {
            $role = 'peternak';
        }
        else{
            $role = 'admin';
        }

        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        if(isset($_GET['start_date']) && isset($_GET['start_date'])){
            $diagnosa = DB::table('diagnosas')
                ->join('penyakits', 'penyakits.id', '=', 'diagnosas.id_penyakit')   
                ->whereBetween(DB::raw("DATE(`diagnosas`.`created_at`)"),[$start_date , $end_date])
                ->orderBy('diagnosas.created_at', 'desc')
                ->select('diagnosas.id', 'diagnosas.created_at', 'nama_penyakit')
                ->get();
        }
        else{
            $diagnosa = DB::table('diagnosas')
                ->join('penyakits', 'penyakits.id', '=', 'diagnosas.id_penyakit')   
                ->orderBy('diagnosas.created_at', 'desc')
                ->select('diagnosas.id', 'diagnosas.created_at', 'nama_penyakit')
                ->get();
        }

        return view('diagnosa.diagnosa_list', compact(['role', 'diagnosa', 'start_date', 'end_date']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->hasRole('user')) {
            $role = 'peternak';
        }
        else{
            $role = 'admin';
        }

        $gejala = DB::table('gejalas')->get();
        $gejala_pernapasan = DB::table('gejalas')->where('jenis_gejala', 'Pernapasan')->get();
        $gejala_pencernaan = DB::table('gejalas')->where('jenis_gejala', 'Pencernaan')->get();
        $gejala_fisik = DB::table('gejalas')->where('jenis_gejala', 'Fisik')->get();
        $gejala_mata = DB::table('gejalas')->where('jenis_gejala', 'Masalah Mata')->get();
        $gejala_perilaku = DB::table('gejalas')->where('jenis_gejala', 'Perilaku')->get();
        return view('diagnosa.diagnosa_add', compact(['gejala', 'gejala_pernapasan', 'gejala_pencernaan', 'gejala_fisik', 'gejala_mata', 'gejala_perilaku', 'role']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $id_gejala = implode(",",$request->id_gejala);
        dd($id_gejala);        
        $penyakit = DB::table('penyakits')->get();

        $res = [];

        foreach($penyakit as $data){
            $bp = DB::table('basis_pengetahuans')
                ->where('id_penyakit', $data->id)
                ->orderBy('id_gejala')
                ->get();
            
            if($bp){
                $arr_bp = [];
                foreach($bp as $rules){
                    $arr_bp[] = $rules->id_gejala;
                }
            }

            if($arr_bp == $request->id_gejala){
                $res = DB::table('penyakits')->where('id', $data->id)->get();
                break;
            }
        }

        if($res){
            DB::table('diagnosas')->insert([
                'gejala'        => $id_gejala,
                'id_penyakit'   => $res[0]->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            $last_id = DB::getPdo()->lastInsertId();
            
            return redirect()->to('diagnosa/'.$last_id);
        }
        return redirect('diagnosa/create')->with('warning','Penyakit tidak terdeteksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->user()->hasRole('user')) {
            $role = 'peternak';
        }
        else{
            $role = 'admin';
        }

        $diagnosa = DB::table('diagnosas')
            ->join('penyakits', 'penyakits.id', 'diagnosas.id_penyakit')
            ->where('diagnosas.id', $id)
            ->get();

        $gejala = [];
        $id_gejala = explode(",", $diagnosa[0]->gejala);

        $get_penyakit = DB::table('basis_pengetahuans')
            // ->join('penyakits', 'penyakits.id', 'diagnosas.id_penyakit')
            ->whereIn('id_gejala', $id_gejala)
            ->where('id_penyakit', '!=', $diagnosa[0]->id_penyakit)
            ->get();

        $data = '';
        $i = 0;
        foreach($get_penyakit as $g){
            $data .= $g->id_penyakit .','; 
            $i++;
        }
        $datas = explode(',', $data);
        $freq = array_count_values($datas);
        arsort($freq);

        $ids = array_keys($freq);
        $count = array_values($freq);

        // dd($freq);
        $j = 0;
        $penyakit_lain = [];

        foreach($ids as $id){
            if($id != ''){
                $get_penyakit = DB::table('basis_pengetahuans')
                ->join('penyakits', 'penyakits.id', 'basis_pengetahuans.id_penyakit')
                ->select('nama_penyakit')
                ->where('id_penyakit', $id)
                ->get();
                
                $penyakit_lain[$j]['nama_penyakit'] = $get_penyakit[0]->nama_penyakit;
                $penyakit_lain[$j]['kemungkinan'] = (int) (($count[$j] / $get_penyakit->count())*100);

                $j++;
            }
        }

        $keys = array_column($penyakit_lain, 'kemungkinan');
        array_multisort($keys, SORT_DESC, $penyakit_lain);

        foreach($id_gejala as $id){
            $get_gejala = DB::table('gejalas')
                ->where('id', $id)
                ->first();
            array_push($gejala, $get_gejala->nama_gejala);
        }

        return view('diagnosa.diagnosa_show', compact(['diagnosa', 'role', 'gejala', 'penyakit_lain']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
