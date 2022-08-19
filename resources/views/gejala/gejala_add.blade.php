@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Tambah Data Gejala</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('gejala.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Gejala</label>
                                    <input type="text" class="form-control" name="kode_gejala" placeholder="Kode Gejala" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Gejala</label>
                                    <input type="text" class="form-control" name="nama_gejala" placeholder="Nama Gejala" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Gejala</label>
                                    <input type="text" class="form-control" name="jenis_gejala" placeholder="Jenis Gejala" required>
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
