@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Data Gejala</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="gejala/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Gejala</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20px" class="text-center">No</th>
                                <th>Kode Gejala</th>
                                <th>Nama Gejala</th>
                                <th style="width: 125px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gejala as $key => $data)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $data->kode_gejala }}</td>
                                    <td>{{ $data->nama_gejala }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('gejala.destroy',$data->id) }}" method="POST">
                                            <a class="btn btn-warning btn-sm" href="{{ route('gejala.edit',$data->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
