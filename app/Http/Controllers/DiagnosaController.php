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
    public function index()
    {
        return redirect('diagnosa/create');
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
        return view('diagnosa.diagnosa_add', compact(['gejala', 'role']));
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

        return view('diagnosa.diagnosa_show', compact(['diagnosa', 'role']));
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
