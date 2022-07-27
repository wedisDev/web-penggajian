@extends('admin.layouts.app')

@section('title', 'Dashboard Tambah Transaksi')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Transaksi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">ID Pegawai</label>
                    <input type="text" class="form-control" name="pegawai_id" id="id_pegawai" placeholder="ID Pegawai">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="data_nama" placeholder="Nama"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="data_jabatan"
                                placeholder="Jabatan" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control" name="status" id="data_status" placeholder="Status"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jumlah Anak</label>
                            <input type="text" class="form-control" name="jumlah_anak" id="data_jumlah_anak"
                                placeholder="Jumlah Anak" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Lembur</label>
                            <input type="text" class="form-control" name="lembur" id="lembur" placeholder="Lembur">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" name="tahun" id="tahun"
                                value="{{ date('Y') }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pelanggaran</label>
                            <input type="text" class="form-control" name="pelanggaran" id="pelanggaran"
                                placeholder="Pelanggaran">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Omzet</label>
                            <input type="text" name="id_pegawai" value="{{ $pegawai[0]->id_pegawai }}" hidden>
                            <input type="text" class="form-control" name="omzet" id="jumlah_omzet" placeholder="Omzet">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Bonus Omzet</label>
                            <input type="text" class="form-control" name="bonus_omzet" id="bonus_omzet"
                                placeholder="Bonus Omzet" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="text" class="form-control" name="total" id="total"
                                placeholder="Total" readonly>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#id_pegawai').on('change', function(e) {
            var pegawai_id = e.target.value;
            $.ajax({
                url: '/data-transaksi',
                method: 'GET',
                data: {
                    pegawai_id: pegawai_id
                },
                success: function(data) {
                    console.log(data);
                    $('#data_nama').val(data.nama_pegawai);
                    $('#data_jabatan').val(data.nama_jabatan);
                    $('#data_status').val(data.nama_golongan);
                    $('#data_jumlah_anak').val(data.jumlah_anak);
                }
            })
        });

        $('#jumlah_omzet').on('change', function(e) {
            var omzet = e.target.value;
            $.ajax({
                url: '/hitung-omzet/' + {{ $pegawai[0]->id_cabang }},
                method: 'GET',
                data: {
                    omzet: omzet
                },
                success: function(data) {
                    console.log(data);
                    if (data.bonus == 0) {
                        $('#bonus_omzet').val(0);
                        $('#total').val(data.hitung);
                    } else {
                        $('#bonus_omzet').val(data.bonus.bonus);
                        $('#total').val(data.hitung);
                    }
                }
            })
        });
    </script>
@endpush
