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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Cari</label>
                                <button class="form-control btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        let date1 = `<?=$start_date?>`;
        let date2 = `<?=$end_date?>`;

        if(date1 && date2){
            $('#start_date').val(date1);
            $('#end_date').val(date2);
        }
    });

    $('.btn-search').click(function() {

        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        window.location.href = '/diagnosa?start_date='+start_date+'&end_date='+end_date;
    });
</script>
@endsection
