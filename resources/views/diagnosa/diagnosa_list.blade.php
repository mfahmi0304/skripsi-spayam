@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Data Riwayat Diagnosa</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="diagnosa/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Diagnosa</a>
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
                                <th>Tanggal Diagnosa</th>
                                <th>Hasil Diagnosa</th>
                                <th style="width: 125px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diagnosa as $key => $data)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>
                                        @php
                                            $tanggal = date('d/m/Y', strtotime($data->created_at));
                                            $jam = date('H:i:s', strtotime($data->created_at));
                                        @endphp
                                        {{ $tanggal }} {{$jam}}
                                    </td>
                                    <td>{{ $data->nama_penyakit }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('diagnosa.show',$data->id) }}"><i class="fas fa-eye"></i> Detail</a>
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
