@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Selamat Datang di SIPABANG (Sistem Pakar Diagnosa Penyakit Ayam Bangkok)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Anda Login Sebagai ') }} {{ucfirst($role)}}
                </div>
            </div>
        </div>
    </div>
    @if($role == 'admin')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thermometer-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Gejala</span>
                    <span class="info-box-number">{{ $data['gejala'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bug"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penyakit</span>
                    <span class="info-box-number">{{ $data['penyakit'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-lightbulb"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Aturan</span>
                    <span class="info-box-number">{{ $data['basis_pengetahuan'] }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
