@extends('admin.layouts.app')

@section('title', 'Dashboard Data Bonus Omzet')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Omzet</h1>
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah
                Omzet</button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Omzet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableGolongan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cabang</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Omzet</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($omzet as $item)
                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Omzet</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('omzet.update', $item->id) }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf

                                                <div class="form-group">
                                                    <input type="text" name="id_omzet" value="{{ $item->id_omzet }}"
                                                        hidden>
                                                    <label for="">Cabang</label>
                                                    <select name="id" class="form-control" id="">
                                                        <option value="">Pilih Cabang</option>
                                                        @foreach ($omzet as $item2)
                                                            <option value="{{ $item2->id }}"
                                                                {{ $item2->id == $item->id ? 'selected' : '' }}>
                                                                {{ $item2->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Omzet</label>
                                                    <input type="number" class="form-control" name="omzet"
                                                        value="{{ $item->omzet }}">
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
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->year }}</td>
                                <td>{{ $item->omzet }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#modalEdit{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="#" class="btn btn-sm btn-danger delete"
                                        data-id="{{ $item->id_omzet }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Omzet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('omzet.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Cabang</label>
                            <select name="id_cabang" class="form-control" id="">
                                <option value="">Pilih Cabang</option>
                                @foreach ($create_omzet as $item2)
                                    <option value="{{ $item2->id }}">
                                        {{ $item2->nama_cabang }}</option>
                                @endforeach
                            </select>
                            <label for="" class="mt-3">Bulan</label>
                            <input type="month" class="form-control" name="bulan" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Omzet</label>
                            <input type="number" class="form-control" name="omzet" value="{{ old('omzet') }}"
                                placeholder="0">
                        </div>

                        <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
                    </form>
                </div>
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
            var bonusId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/omzet/delete/" + bonusId + ""
                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak terhapus");
                    }
                });
        });
    </script>
@endpush
