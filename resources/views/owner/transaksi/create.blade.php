@extends('admin.layouts.app')

@section('title', 'Dashboard Tambah Transaksi')

@section('content')
    {{-- @php
        dd($pegawai);
    @endphp --}}

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
                    <label for="">ID Pegawai </label>
                    <input type="text" class="form-control" name="pegawai_id" value="{{ $pegawai[0]->id }}"
                        id="id_pegawai" placeholder="ID Pegawai" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="data_nama" placeholder="Nama"
                                value="{{ $pegawai[0]->nama_pegawai }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="data_jabatan"
                                value="{{ $pegawai[0]->nama_jabatan }}" placeholder="Jabatan" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control" name="status" id="data_status" placeholder="Status"
                                value="{{ $pegawai[0]->nama_golongan }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jumlah Anak</label>
                            <input type="text" class="form-control" name="jumlah_anak" id="data_jumlah_anak"
                                value="{{ $pegawai[0]->jumlah_anak }}" placeholder="Jumlah Anak" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            {{-- <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan"> --}}
                            <select class="form-control" name="bulan" id="bulan" placeholder="Bulan">
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
                            </select>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Pelanggaran</label>
                            <input type="text" class="form-control" name="pelanggaran" id="pelanggaran"
                                placeholder="Pelanggaran">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alpha</label>
                            <input type="text" class="form-control" name="alpha" id="alpha"
                                placeholder="Alpha">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Omzet</label>

                            <input type="text" name="id_pegawai" value="{{ $pegawai[0]->id }}" hidden>
                            <input type="text" class="form-control" name="omzet" id="jumlah_omzet"
                                placeholder="Omzet">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Bonus Omzet</label>
                            <input type="text" class="form-control" name="bonus_omzet" id="bonus_omzet"
                                value="{{ $pegawai[0]->bonus_tahunan }}" placeholder="Bonus Omzet" readonly>
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
                        console.log(data)
                        $('#bonus_omzet').val(0);
                        $('#bonus_omzet').prop('readonly', true);
                        $('#total').val(data.hitung);
                    } else {
                        console.log(data)
                        $('#bonus_omzet').prop('readonly', false);
                        $('#bonus_omzet').val(data.bonus.bonus);
                        $('#total').val(data.hitung);
                    }
                }
            })
        });
    </script>
@endpush
