<?php

namespace App\Http\Controllers;

use App\Gejala;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gejala = DB::table('gejalas')->get();
        return view('gejala.gejala_list', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gejala.gejala_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('gejalas')->insert([
            'kode_gejala'   => $request->kode_gejala,
            'nama_gejala'   => $request->nama_gejala,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        return redirect('gejala')->with('success','Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function show(Gejala $gejala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function edit(Gejala $gejala)
    {
        return view('gejala.gejala_edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gejala $gejala)
    {
        DB::table('gejalas')->where('id',$request->id)->update([
            'kode_gejala'   => $request->kode_gejala,
            'nama_gejala'   => $request->nama_gejala,
            'updated_at'    => Carbon::now(),
        ]);
        return redirect('gejala')->with('success','Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect('gejala')->with('success','Data Berhasil Dihapus');
    }
}
