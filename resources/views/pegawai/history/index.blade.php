@extends('admin.layouts.app')

@section('title', 'Dashboard Data Gaji Pegawai')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Gaji {{ Auth::user()->name }}</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Gaji Pegawai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tablePegawai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jabatan</th>
                            <th>Pelanggaran</th>
                            <th>Lembur</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>Total gaji</th>
                            <th>Slip Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>{{ $item->pelanggaran }}</td>
                                <td>{{ $item->lembur }}</td>
                                <td>{{ $item->nama_golongan }}</td>
                                <td>{{ $item->jumlah_anak }}</td>
                                <td>{{ number_format($item->total) }}</td>
                                <td>
                                    <a href="{{ url('/slip-gaji', $item->id_pegawai) }}" class="btn btn-success">Slip
                                        Gaji</a>
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
            $('#tablePegawai').DataTable();
        });
    </script>
@endpush
