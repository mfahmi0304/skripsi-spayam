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
                    <!-- <form action="{{ route('diagnosa.store') }}" method="POST">
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
                    </form> -->
                    <div class="col-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-step_1" data-toggle="pill" href="#step_1" role="tab" aria-controls="step_1" aria-selected="true">Pernapasan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-step_2" data-toggle="pill" href="#step_2" role="tab" aria-controls="step_2" aria-selected="false">Pencernaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-step_3" data-toggle="pill" href="#step_3" role="tab" aria-controls="step_3" aria-selected="false">Fisik</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-step_4" data-toggle="pill" href="#step_4" role="tab" aria-controls="step_4" aria-selected="false">Masalah Mata</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-step_5" data-toggle="pill" href="#step_5" role="tab" aria-controls="step_5" aria-selected="false">Perilaku</a>
                                    </li>
                                </ul>
                            </div>
                            <form action="{{ route('diagnosa.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="step_1" role="tabpanel" aria-labelledby="tab-step_1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">
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
                                                            @foreach($gejala_pernapasan as $data)
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
                                                    <a class="btn btn-sm btn-primary btnNext">Selanjutnya</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="step_2" role="tabpanel" aria-labelledby="tab-step_2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">
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
                                                            @foreach($gejala_pencernaan as $data)
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
                                                    <a class="btn btn-sm btn-warning btnPrev">Sebelumnya</a>
                                                    <a class="btn btn-sm btn-primary btnNext">Selanjutnya</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="step_3" role="tabpanel" aria-labelledby="tab-step_3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">
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
                                                            @foreach($gejala_fisik as $data)
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
                                                    <a class="btn btn-sm btn-warning btnPrev">Sebelumnya</a>
                                                    <a class="btn btn-sm btn-primary btnNext">Selanjutnya</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="step_4" role="tabpanel" aria-labelledby="tab-step_4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">
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
                                                            @foreach($gejala_mata as $data)
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
                                                    <a class="btn btn-sm btn-warning btnPrev">Sebelumnya</a>
                                                    <a class="btn btn-sm btn-primary btnNext">Selanjutnya</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="step_5" role="tabpanel" aria-labelledby="tab-step_5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">
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
                                                            @foreach($gejala_perilaku as $data)
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="btn btn-sm btn-warning btnPrev">Sebelumnya</a>
                                                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    $('.btnNext').click(function(){
        console.log('a');
        $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
    });

    $('.btnPrev').click(function(){
        $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
    });
</script>
@endsection
