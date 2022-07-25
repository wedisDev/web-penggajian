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
    </div>

    <div id="chartOmzet"></div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            Highcharts.chart('chartOmzet', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Barang Masuk'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: {!! json_encode($b) !!},
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
                    name: "Bulan",
                    colorByPoint: true,
                    data: {!! json_encode($a) !!}
                }],
            });
        });
    </script>
@endpush
