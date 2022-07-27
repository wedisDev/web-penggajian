@extends('admin.layouts.app')

@section('title', 'Dashboard Data Golongan')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Golongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('golongan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" name="status" class="form-control" placeholder="Menikah ....">
                        </div>

                        <div class="form-group">
                            <label for="">Tunjangan Menikah</label>
                            <input type="text" class="form-control" name="tunjangan_menikah"
                                placeholder="Rp 100.000....">
                        </div>

                        <div class="form-group">
                            <label for="">Tunjangan Anak</label>
                            <input type="text" class="form-control" name="tunjangan_anak" placeholder="Rp 100.000....">
                        </div>

                        <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Golongan</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#modalTambah">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Tambah Golongan
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Golongan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableGolongan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tunjangan Menikah</th>
                            <th>Tunjangan Anak</th>
                            @if (Auth::user()->role == 'owner')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($golongan as $item)
                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Golongan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('golongan.update', $item->id) }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <input type="text" name="status" class="form-control"
                                                        value="{{ $item->status }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Tunjangan Menikah</label>
                                                    <input type="text" class="form-control" name="tunjangan_menikah"
                                                        value="{{ $item->tunjangan_menikah }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Tunjangan Anak</label>
                                                    <input type="text" class="form-control" name="tunjangan_anak"
                                                        value="{{ $item->tunjangan_anak }}">
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
                                <td>{{ $item->tunjangan_menikah }}</td>
                                <td>{{ $item->tunjangan_anak }}</td>
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
            $('#tableGolongan').DataTable();
        });
    </script>

    <script>
        $('.delete').click(function() {
            var golonganId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/golongan/delete/" + golonganId + ""
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
