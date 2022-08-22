@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Edit Data Gejala</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('gejala.update',$gejala->id) }}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $gejala->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Gejala</label>
                                    <input type="text" class="form-control" name="kode_gejala" placeholder="Kode Gejala" value="{{ $gejala->kode_gejala }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Gejala</label>
                                    <input type="text" class="form-control" name="nama_gejala" placeholder="Nama Gejala" value="{{ $gejala->nama_gejala }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Gejala</label>
                                    <select class="form-control" name="jenis_gejala" required>
                                        <option value"Pernapasan" {{ ( $gejala->jenis_gejala == 'Pernapasan') ? 'selected' : '' }}>Pernapasan</option>
                                        <option value"Pencernaan" {{ ( $gejala->jenis_gejala == 'Pencernaan') ? 'selected' : '' }}>Pencernaan</option>
                                        <option value" {{ ( $gejala->jenis_gejala == 'Fisik') ? 'selected' : '' }}>Fisik</option>
                                        <option value"Masalah Mata" {{ ( $gejala->jenis_gejala == 'Masalah Mata') ? 'selected' : '' }}>Masalah Mata</option>
                                        <option value"Perilaku" {{ ( $gejala->jenis_gejala == 'Perilaku') ? 'selected' : '' }}>Perilaku</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
