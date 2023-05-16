@extends('admin.layouts.app')

@section('title', 'Dashboard Data Gaji Pegawai')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Gaji Pegawai</h1>
        <select name="" class="form-control text-dark" style="width: 20%;" onchange="location = this.value;">
            <option value="">Pilih Cabang</option>
            @foreach ($cabang as $item)
                <option value="{{ url('/filter-gaji-cabang', $item->id) }}">
                    {{ $item->nama_cabang }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow ">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Data Gaji Pegawai</h6>
            <select name="" class="form-control text-dark" style="width: 20%;" onchange="location = this.value;">
                <option selected disabled>Pilih Tahun</option>
                @foreach ($tahun as $item)
                    <option value="{{ url('/gaji-pegawai', $item->tahun) }}">
                        {{ $item->tahun }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tablePegawai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pelanggaran</th>
                            <th>Lembur</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>Total gaji</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Slip Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            @php
                                // dd($item);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>{{ $item->pelanggaran }}</td>
                                <td>{{ $item->lembur }}</td>
                                <td>{{ $item->nama_golongan }}</td>
                                <td>{{ $item->jumlah_anak }}</td>
                                <td>{{ number_format($item->total) }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>
                                    <a href="{{ url('/slip-gaji/' . $item->bulan . '/' . $item->tahun . '/' . $item->id) }}"
                                        class="btn btn-success">Slip
                                        Gaji</a>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#modalHapus{{ $item->id_pegawai }}"
                                        class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalHapus{{ $item->id_pegawai }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Yakin ingin
                                                menghapus?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary mr-2"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ route('deleteGaji', $item->id) }}"
                                                    class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script>
        $('.delete').click(function() {
            var pegawaiId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/pegawai/delete/" + pegawaiId + ""
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
