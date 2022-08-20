@extends('layouts.app')

@section('content')
<style>
    .text-justify{
        text-align: justify;
        text-justify: inter-word;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <h5>Gejala</h5>
                @foreach($gejala as $key => $data)
                    {{$key+1}} . {{$data}} <br>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Hasil Diagnosa Penyakit Ayam Bangkok</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            @php
                                $penyakit = explode("(", $diagnosa[0]->nama_penyakit);
                            @endphp

                            <h3><b>{{$penyakit[0]}}</b></h3>
                            <h4><i>({{$penyakit[1]}}</i></h4>
                            <h6><span class="badge badge-danger">Kemungkinan: 100%</span></h6>

                            <p class="text-justify">{{$diagnosa[0]->detail}}</p>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right">
                            <img src="{{ asset('img_upload/'.$diagnosa[0]->gambar) }}" width="100%">
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
                                    <p class="text-justify">{{$diagnosa[0]->solusi}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="card-title">Kemungkinan Penyakit Lain</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                @foreach($penyakit_lain as $key => $data)
                                    {{$key+1}} . {{$data['nama_penyakit']}} : {{$data['kemungkinan']}}%<br>
                                @endforeach
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
