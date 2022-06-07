<?php

namespace App\Http\Controllers;

use App\Penyakit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyakit = DB::table('penyakits')->get();
        return view('penyakit.penyakit_list', compact('penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyakit.penyakit_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file   = $request->file('gambar');
        $upload = $file->move('img_upload',$file->getClientOriginalName());
        
        if($upload){
            DB::table('penyakits')->insert([
                'kode_penyakit' => $request->kode_penyakit,
                'nama_penyakit' => $request->nama_penyakit,
                'detail'        => $request->detail,
                'solusi'        => $request->solusi,
                'gambar'        => $file->getClientOriginalName(),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
        
        return redirect('penyakit')->with('success','Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyakit $penyakit)
    {
        return view('penyakit.penyakit_edit', compact('penyakit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $file   = $request->file('gambar');
        
        if(isset($file)){
            $upload = $file->move('img_upload',$file->getClientOriginalName());

            if($upload){
                DB::table('penyakits')->where('id',$request->id)->update([
                    'kode_penyakit' => $request->kode_penyakit,
                    'nama_penyakit' => $request->nama_penyakit,
                    'detail'        => $request->detail,
                    'solusi'        => $request->solusi,
                    'gambar'        => $file->getClientOriginalName(),
                    'updated_at'    => Carbon::now(),
                ]);
            }
        }
        else{
            DB::table('penyakits')->where('id',$request->id)->update([
                'kode_penyakit' => $request->kode_penyakit,
                'nama_penyakit' => $request->nama_penyakit,
                'detail'        => $request->detail,
                'solusi'        => $request->solusi,
                'updated_at'    => Carbon::now(),
            ]);
        }
        
        return redirect('penyakit')->with('success','Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect('penyakit')->with('success','Data Berhasil Dihapus');
    }
}
