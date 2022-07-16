@extends('admin.layouts.app')

@section('title', 'Dashboard Data Jabatan')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Tambah Jabatan
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableJabatan">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Makmur</th>
                            <th>Tunjangan Makan</th>
                            <th>Tunjangan Transportasi</th>
                            <th>Tunjangan Lembur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($jabatan))
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gapok }}</td>
                                    <td>{{ $item->tunjangan_makmur }}</td>
                                    <td>{{ $item->tunjangan_makan }}</td>
                                    <td>{{ $item->tunjangan_transportasi }}</td>
                                    <td>{{ $item->tunjangan_lembur }}</td>
                                    <td>
                                        <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger delete"
                                            data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                        {{-- <a href="{{ route('golongan.delete', $item->id) }}"
                                            class="btn btn-danger">Delete</a> --}}

                                    </td>
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

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableJabatan').DataTable();
        });

        $('.delete').click(function() {
            var jabatan = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/jabatan/delete/" + jabatan + ""
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
