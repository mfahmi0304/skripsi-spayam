@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Hasil Diagnosa Penyakit Ayam Bangkok</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            @php
                                $penyakit = explode("(", $diagnosa[0]->nama_penyakit);
                            @endphp

                            <h3>{{$penyakit[0]}}</h3>
                            <h4><i>({{$penyakit[1]}}</i></h4>
                            <p>{{$diagnosa[0]->detail}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <img src="{{ asset('img_upload/'.$diagnosa[0]->gambar) }}" width="350px">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="card-title">Solusi</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>{{$diagnosa[0]->solusi}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
