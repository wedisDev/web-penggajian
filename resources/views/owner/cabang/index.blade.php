@extends('admin.layouts.app')

@section('title', 'Dashboard Data Cabang')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cabang.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Cabang</label>
                            <input type="text" class="form-control" name="nama_cabang" placeholder="Royal ...">
                        </div>

                        <div class="form-group">
                            <label for="">Alamat Cabang</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Jl.royal ...">
                        </div>

                        <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Cabang</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#modalTambah">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Tambah Cabang
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Cabang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableCabang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Cabang</th>
                            <th>Alamat Cabang</th>
                            @if (Auth::user()->role == 'owner')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabang as $item)
                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Cabang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('cabang.update', $item->id) }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Nama Cabang</label>
                                                    <input type="text" class="form-control" name="nama_cabang"
                                                        value="{{ $item->nama_cabang }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Alamat Cabang</label>
                                                    <input type="text" class="form-control" name="alamat"
                                                        value="{{ $item->alamat }}">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-primary float-right mt-3">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_cabang }}</td>
                                <td>{{ $item->alamat }}</td>
                                @if (Auth::user()->role == 'owner')
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#modalEdit{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="#" class="btn btn-sm btn-danger delete"
                                            data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                @endif
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
            $('#tableCabang').DataTable();
        });
    </script>

    <script>
        $('.delete').click(function() {
            var cabangId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/cabang/delete/" + cabangId + ""
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
