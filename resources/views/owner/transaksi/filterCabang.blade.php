@extends('admin.layouts.app')

@section('title', 'Dashboard Data Transaksi')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
        <div class="row">
            <div class="col-md-6 ">
                <select name="" class="form-control text-dark" onchange="location = this.value;">
                    <option value="">Pilih Cabang</option>
                    @foreach ($cabangs as $item)
                        <option value="{{ url('/filter-cabang-transaksi', $item->id) }}">
                            {{ $item->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-1" align="right">
                {{-- <a href="{{ url('/tambah-transaksi', $cabang->id, $item->id_cabang) }}" --}}
                <button type="button" data-toggle="modal" data-target="#modalPilihPegawai"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Pilih Pegawai
                </button>
            </div>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableTransaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Status</th>
                            <th>Lembur</th>
                            <th>Pelanggaran</th>
                            <th>Alpha</th>
                            <th>Bulan</th>
                            <th>Omzet</th>
                            <th>Total</th>
                            @if (Auth::user()->role == 'owner')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($pegawai))
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pegawai }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->lembur }}</td>
                                    <td>{{ $item->pelanggaran }}</td>
                                    <td>{{ $item->alpha }}</td>
                                    <td>{{ $item->bulan }}</td>
                                    <td>{{ number_format($item->omzet) }}</td>
                                    <td>{{ number_format($item->total) }}</td>
                                    @if (Auth::user()->role == 'owner')
                                        <td>
                                            <a href="{{ route('transaksi.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger delete"
                                                data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <td>Data Kosong</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade " id="modalPilihPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <select name="" class="form-control text-dark" onchange="location = this.value;">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($pilih_pegawai as $item)
                                        {{-- <option value="{{ url('/tambah-transaksi', $item->id, '/', $item->id_cabang) }}"> --}}
                                        <option value="/tambah-transaksi/{{ $item->pegawai_id }}/{{ $item->cabang_id }}">
                                            {{ $item->nama_pegawai }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableTransaksi').DataTable();
        });

        $('.delete').click(function() {
            var transaksiId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/transaksi/delete/" + transaksiId + ""
                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus");
                    }
                });
        });
    </script>
@endpush
