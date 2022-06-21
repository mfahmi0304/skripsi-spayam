<?php

namespace App\Http\Controllers;

use App\BasisPengetahuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasisPengetahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basis_pengetahuan = DB::table('basis_pengetahuans')
        ->join('gejalas', 'gejalas.id', '=', 'basis_pengetahuans.id_gejala')   
        ->join('penyakits', 'penyakits.id', '=', 'basis_pengetahuans.id_penyakit')   
        ->select('basis_pengetahuans.*', 'gejalas.nama_gejala', 'penyakits.nama_penyakit')
        ->get();
        return view('basis_pengetahuan.basis_pengetahuan_list', compact('basis_pengetahuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gejala = DB::table('gejalas')->get();
        $penyakit = DB::table('penyakits')->get();
        return view('basis_pengetahuan.basis_pengetahuan_add', compact(['gejala', 'penyakit']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('basis_pengetahuans')->insert([
            'id_gejala'   => $request->id_gejala,
            'id_penyakit'   => $request->id_penyakit,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        return redirect('basis_pengetahuan')->with('success','Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function show(BasisPengetahuan $basisPengetahuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function edit(BasisPengetahuan $basisPengetahuan)
    {
        $gejala = DB::table('gejalas')->get();
        $penyakit = DB::table('penyakits')->get();
        return view('basis_pengetahuan.basis_pengetahuan_edit', compact(['basisPengetahuan', 'gejala', 'penyakit']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BasisPengetahuan $basisPengetahuan)
    {
        DB::table('basis_pengetahuans')->where('id',$request->id)->update([
            'id_gejala'     => $request->id_gejala,
            'id_penyakit'   => $request->id_penyakit,
            'updated_at'    => Carbon::now(),
        ]);
        return redirect('basis_pengetahuan')->with('success','Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasisPengetahuan $basisPengetahuan)
    {
        $basisPengetahuan->delete();
        return redirect('basis_pengetahuan')->with('success','Data Berhasil Dihapus');
    }
}
