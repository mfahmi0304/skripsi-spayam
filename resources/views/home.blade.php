@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">{{ __('Selamat Datang di SIPABANG (Sistem Pakar Diagnosa Penyakit Ayam Bangkok)') }}</div>

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
                    <span class="info-box-text">Basis Pengetahuan</span>
                    <span class="info-box-number">{{ $data['basis_pengetahuan'] }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- BAR CHART -->
            @php
                $nama_gejala = [];
                $count_gejala = [];
                foreach($data['gejala_terbanyak'] as $g){
                    array_push($nama_gejala, $g['nama_gejala']);
                    array_push($count_gejala, $g['total']);
                }
            @endphp
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Gejala Terbanyak</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChartGejala" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-6">
            <!-- BAR CHART -->
            @php
                $nama_penyakit = [];
                $count_penyakit = [];
                foreach($data['penyakit_terbanyak'] as $p){
                    array_push($nama_penyakit, $p->nama_penyakit);
                    array_push($count_penyakit, $p->total);
                }
            @endphp
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Penyakit Terbanyak</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChartPenyakit" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    var areaChartDataGejala = {
        labels  : <?= json_encode($nama_gejala)?>,
        datasets: [
            {
                label               : 'Jumlah',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : <?= json_encode($count_gejala)?>
            },
        ]
    }

    var areaChartDataPenyakit = {
        labels  : <?= json_encode($nama_penyakit)?>,
        datasets: [
            {
                label               : 'Jumlah',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : <?= json_encode($count_penyakit)?>
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines : {
                    display : false,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : false,
                }
            }]
        }
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartGejala = $('#barChartGejala').get(0).getContext('2d')
    var barChartDataGejala = $.extend(true, {}, areaChartDataGejala)
    var temp0 = areaChartDataGejala.datasets[0]
    barChartDataGejala.datasets[0] = temp0

    var barChartPenyakit = $('#barChartPenyakit').get(0).getContext('2d')
    var barChartDataPenyakit = $.extend(true, {}, areaChartDataPenyakit)
    var temp1 = areaChartDataPenyakit.datasets[0]
    barChartDataPenyakit.datasets[0] = temp1

    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }

    new Chart(barChartGejala, {
        type: 'bar',
        data: barChartDataGejala,
        options: barChartOptions
    })

    new Chart(barChartPenyakit, {
        type: 'bar',
        data: barChartDataPenyakit,
        options: barChartOptions
    })
</script>
@endsection
