@extends('admin.layouts.app')

@section('title', 'Dashboard Edit Transaksi')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Transaksi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.update', $pegawai[0]->id) }}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                    <label for="">ID Pegawai</label>
                    <input type="text" class="form-control" name="pegawai_id" id="id_pegawai" value="{{ $pegawai[0]->id_pegawai }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="data_nama" value="{{ $pegawai[0]->nama_pegawai }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="data_jabatan"
                                value="{{ $pegawai[0]->nama_jabatan }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control" name="status" id="data_status" value="{{ $pegawai[0]->nama_golongan }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jumlah Anak</label>
                            <input type="text" class="form-control" name="jumlah_anak" id="data_jumlah_anak"
                                value="{{ $pegawai[0]->jumlah_anak }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <input type="text" class="form-control" name="bulan" id="bulan" value="{{ $pegawai[0]->bulan }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Lembur</label>
                            <input type="text" class="form-control" name="lembur" id="lembur" value="{{ $pegawai[0]->lembur }}">
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
                                value="{{ $pegawai[0]->pelanggaran }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Omzet</label>
                            <input type="text" name="id_pegawai" value="{{ $pegawai[0]->id_pegawai }}" hidden>
                            <input type="text" class="form-control" name="omzet" id="jumlah_omzet" value="{{ $pegawai[0]->omzet }}">
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
                                value="{{ $pegawai[0]->total }}" readonly>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mt-3">Ubah</button>
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
