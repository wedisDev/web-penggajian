@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Page Heading -->
    @php
        // dd($bulan);
    @endphp
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard Admin
        </h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
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

    {{-- <div id="test"></div> --}}
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <div class="mr-3" id="chartOmzet1"></div>
        <div class="mr-3" id="chartOmzet2"></div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <div class="mr-3" id="chartOmzet3"></div>
        <div class="mr-3" id="chartOmzet4"></div>
        {{-- <div id="chartOmzet"></div> --}}
    </div>

    @php
        // dd($datas1, $datas2, $datas3, $datas4);
        // dd($nama1[0]);
    @endphp

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            Highcharts.chart('chartOmzet1', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Omzet Kantin Tante Royal Perbulan tahun <?= $tahun_pilih ?>'
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
                    data: {!! json_encode($datas1) !!}
                }],
            });
        });

        $(document).ready(function() {
            Highcharts.chart('chartOmzet2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Omzet Kantin Tante DTC Perbulan tahun <?= $tahun_pilih ?>'
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
                    data: {!! json_encode($datas2) !!}
                }],
            });
        });

        $(document).ready(function() {
            Highcharts.chart('chartOmzet3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Omzet Kantin Tante Pasar Atom Perbulan tahun <?= $tahun_pilih ?>'
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
                    data: {!! json_encode($datas3) !!}
                }],
            });
        });

        $(document).ready(function() {
            Highcharts.chart('chartOmzet4', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Omzet Kantin Tante Embong Wungu Perbulan tahun <?= $tahun_pilih ?>'
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
                    data: {!! json_encode($datas4) !!}
                }],
            });
        });


        // $(document).ready(function() {
        //     Highcharts.chart('chartTahun', {
        //         chart: {
        //             type: 'column'
        //         },
        //         title: {
        //             text: 'Data Omzet Pertahun'
        //         },
        //         accessibility: {
        //             announceNewData: {
        //                 enabled: true
        //             }
        //         },
        //         xAxis: {
        //             categories: {!! json_encode($c) !!},
        //         },
        //         yAxis: {
        //             title: {
        //                 text: 'Omzet'
        //             }
        //         },
        //         legend: {
        //             enabled: false
        //         },
        //         plotOptions: {
        //             series: {
        //                 borderWidth: 0,
        //                 dataLabels: {
        //                     enabled: true,
        //                     format: '{point.y:.0f}'
        //                 }
        //             }
        //         },
        //         tooltip: {
        //             headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        //             pointFormat: '<span style="color:{point.color}">{point.date} <br>{point.name}</span>: <b>{point.y:.0f}</b><br/>'
        //         },
        //         series: [{
        //             name: "Omzet",
        //             colorByPoint: true,
        //             data: {!! json_encode($d) !!},
        //         }],
        //     });
        // });
    </script>
@endpush
