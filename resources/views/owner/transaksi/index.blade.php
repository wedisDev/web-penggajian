@extends('admin.layouts.app')

@section('title', 'Dashboard Data Transaksi')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Tambah Transaksi
        </a>
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
                            <th>Nama</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Makmur</th>
                            <th>Tunjangan Makan</th>
                            <th>Tunjangan Transportasi</th>
                            <th>Tunjangan Lembur</th>
                            <th>Bonus Tahunan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (!empty($jabatan))
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td>{{ $item->gapok }}</td>
                                    <td>{{ $item->tunjangan_makmur }}</td>
                                    <td>{{ $item->tunjangan_makan }}</td>
                                    <td>{{ $item->tunjangan_transportasi }}</td>
                                    <td>{{ $item->tunjangan_lembur }}</td>
                                    <td>{{ $item->bonus_tahunan }}</td>
                                    <td>
                                        <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger delete"
                                            data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>Data Kosong</td>
                        @endif --}}

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
