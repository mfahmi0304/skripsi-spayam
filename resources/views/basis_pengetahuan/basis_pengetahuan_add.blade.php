@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Tambah Data Basis Pengetahuan</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('basis_pengetahuan.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penyakit</label>
                                    <select name="id_penyakit" class="form-control select2" required>
                                        <option value=""> -- Pilih -- </option>
                                        @foreach($penyakit as $data)
                                            <option value="{{$data->id}}">{{$data->nama_penyakit}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Gejala</label>
                                    <select name="id_gejala" class="form-control select2" required>
                                        <option value=""> -- Pilih -- </option>
                                        @foreach($gejala as $data)
                                            <option value="{{$data->id}}">{{$data->nama_gejala}}</option>
                                        @endforeach
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
