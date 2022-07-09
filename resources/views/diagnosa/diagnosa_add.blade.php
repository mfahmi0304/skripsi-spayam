@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Diagnosa Penyakit Ayam Bangkok</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('diagnosa.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gejala</th>
                                            <th class="text-center">( <i class="fas fa-check"></i> )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach($gejala as $data)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$data->nama_gejala}}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="id_gejala[]" value="{{$data->id}}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
