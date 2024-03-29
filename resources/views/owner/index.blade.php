@extends('admin.layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
            @if (Auth::user()->role == 'admin')
                Admin
            @elseif(Auth::user()->role == 'pegawai')
                Pegawai
            @elseif(Auth::user()->role == 'owner')
                Owner
            @endif
        </h1>
        <form action="{{ url('/year-filter') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-8">
                    <select name="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @foreach ($tahun as $item)
                            <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div id="chartOmzet"></div>
    <div id="chartTahun"></div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            Highcharts.chart('chartOmzet', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Omzet Tahun <?= $tahun_pilih ?>'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Omzet'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.date} <br>{point.name}</span>: <b>{point.y:.0f}</b><br/>'
                },
                series: [{
                    name: "Omzet",
                    colorByPoint: true,
                    data: {!! json_encode($datas) !!}
                }],
            });
        });


        $(document).ready(function() {
            Highcharts.chart('chartTahun', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Omzet Pertahun'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: {!! json_encode($c) !!},
                },
                yAxis: {
                    title: {
                        text: 'Omzet'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.date} <br>{point.name}</span>: <b>{point.y:.0f}</b><br/>'
                },
                series: [{
                    name: "Omzet",
                    colorByPoint: true,
                    data: {!! json_encode($d) !!},
                }],
            });
        });
    </script>
@endpush
