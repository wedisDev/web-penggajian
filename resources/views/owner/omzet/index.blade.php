@extends('admin.layouts.app')

@section('title', 'Dashboard Data Bonus Omzet')

@section('content')

    <!-- Modal -->
    {{-- <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Omzet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('omzet.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Cabang</label>
                            <select name="id" class="form-control" id="">
                                <option value="">Pilih Cabang</option>
                                @foreach ($omzet as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Total Omzet</label>
                            <input type="number" class="form-control" name="bonus" placeholder="Rp 100.000....">
                        </div>

                        <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Omzet</h1>
        <div class="d-flex justify-content-center">
            {{-- <form action="{{ route('filter.omzet') }}" method="post">
                @csrf
                <input type="date" name="date" class="btn btn-outline-primary mr-2">
                <button type="submit" class="btn btn-primary shadow-sm">
                    Filter Date
                </button>
            </form> --}}
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah
                Omzet</button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Omzet</h6>
            {{-- <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalCreate">Tambah
                Omzet</button> --}}
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
                            {{-- @if (Auth::user()->role == 'owner') --}}
                            <th>Actions</th>
                            {{-- @endif --}}
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

                                                {{-- <div class="form-group">
                                                    <label for="">Jabatan</label>
                                                    <select name="id_jabatan" class="form-control" id="">
                                                        <option value="">Pilih Jabatan</option>
                                                        @foreach ($jabatan as $item2)
                                                            <option value="{{ $item2->id }}"
                                                                {{ $item2->id == $item->id_jabatan ? 'selected' : '' }}>
                                                                {{ $item2->nama_jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}

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
                                {{-- @if (Auth::user()->role == 'owner') --}}
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#modalEdit{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="#" class="btn btn-sm btn-danger delete"
                                        data-id="{{ $item->id_omzet }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                {{-- @endif --}}
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
                            {{-- <input type="text" name="id_omzet" value="{{ $item->id_omzet }}" hidden> --}}
                            <label for="">Cabang</label>
                            <select name="id_cabang" class="form-control" id="">
                                <option value="">Pilih Cabang</option>
                                @foreach ($omzet as $item2)
                                    <option value="{{ $item2->id }}">
                                        {{ $item2->nama_cabang }}</option>
                                @endforeach
                            </select>
                            <label for="" class="mt-3">Bulan</label>
                            {{-- <select class="form-control" name="bulan" id="bulan" placeholder="Bulan">
                                <option selected value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select> --}}
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
