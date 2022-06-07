@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Edit Data Penyakit</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('penyakit.update',$penyakit->id) }}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $penyakit->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Penyakit</label>
                                    <input type="text" class="form-control" name="kode_penyakit" placeholder="Kode Penyakit" value="{{ $penyakit->kode_penyakit }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Penyakit</label>
                                    <input type="text" class="form-control" name="nama_penyakit" placeholder="Nama Penyakit" value="{{ $penyakit->nama_penyakit }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" rows="3" name="detail" placeholder="Deskripsi Penyakit" required>{{ $penyakit->detail }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Solusi</label>
                                    <textarea class="form-control" rows="3" name="solusi" placeholder="Solusi" required>{{ $penyakit->solusi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
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
