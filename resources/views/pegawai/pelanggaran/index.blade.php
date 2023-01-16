@extends('admin.layouts.app')

@section('title', 'Dashboard Data Pelanggaran Pegawai')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pelanggaran Pegawai</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pelanggaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableRincian">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pelanggaran</th>
                            <th>Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>{{ $item->pelanggaran }}</td>
                                <td>@php
                                    if ($item->bulan == 1) {
                                        echo 'Januari';
                                    } elseif ($item->bulan == 2) {
                                        echo 'Februari';
                                    } elseif ($item->bulan == 3) {
                                        echo 'Maret';
                                    } elseif ($item->bulan == 4) {
                                        echo 'April';
                                    } elseif ($item->bulan == 5) {
                                        echo 'Mei';
                                    } elseif ($item->bulan == 6) {
                                        echo 'Juni';
                                    } elseif ($item->bulan == 7) {
                                        echo 'Juli';
                                    } elseif ($item->bulan == 8) {
                                        echo 'Agustus';
                                    } elseif ($item->bulan == 9) {
                                        echo 'September';
                                    } elseif ($item->bulan == 10) {
                                        echo 'Oktober';
                                    } elseif ($item->bulan == 11) {
                                        echo 'November';
                                    } elseif ($item->bulan == 12) {
                                        echo 'Desember';
                                    }
                                @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableRincian').DataTable();
        });
    </script>
@endpush
