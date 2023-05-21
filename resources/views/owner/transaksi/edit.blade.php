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
            <form action="{{ route('transaksi.update', $pegawai[0]->id_pegawai) }}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                    <label for="">ID Pegawai</label>
                    <input type="text" class="form-control" name="pegawai_id" id="id_pegawai"
                        value="{{ $pegawai[0]->id_pegawai }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="data_nama"
                                value="{{ $pegawai[0]->nama_pegawai }}" readonly>
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
                            <input type="text" class="form-control" name="status" id="data_status"
                                value="{{ $pegawai[0]->nama_golongan }}" readonly>
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
                            {{-- <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan"> --}}
                            <select class="form-control" name="bulan" id="bulan" placeholder="Bulan">
                                <option {{ $pegawai[0]->bulan == 1 ? 'selected' : '' }} value="1">Januari</option>
                                <option {{ $pegawai[0]->bulan == 2 ? 'selected' : '' }} value="2">Februari</option>
                                <option {{ $pegawai[0]->bulan == 3 ? 'selected' : '' }} value="3">Maret</option>
                                <option {{ $pegawai[0]->bulan == 4 ? 'selected' : '' }} value="4">April</option>
                                <option {{ $pegawai[0]->bulan == 5 ? 'selected' : '' }} value="5">Mei</option>
                                <option {{ $pegawai[0]->bulan == 6 ? 'selected' : '' }} value="6">Juni</option>
                                <option {{ $pegawai[0]->bulan == 7 ? 'selected' : '' }} value="7">Juli</option>
                                <option {{ $pegawai[0]->bulan == 8 ? 'selected' : '' }} value="8">Agustus</option>
                                <option {{ $pegawai[0]->bulan == 9 ? 'selected' : '' }} value="9">September</option>
                                <option {{ $pegawai[0]->bulan == 10 ? 'selected' : '' }} value="10">Oktober</option>
                                <option {{ $pegawai[0]->bulan == 11 ? 'selected' : '' }} value="11">November</option>
                                <option {{ $pegawai[0]->bulan == 12 ? 'selected' : '' }} value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Lembur</label>
                            <input type="text" class="form-control" name="lembur" id="lembur"
                                value="{{ $pegawai[0]->lembur }}">
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
                                value="{{ $pegawai[0]->pelanggaran }}" placeholder="Pelanggaran">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alpha</label>
                            <input type="text" class="form-control" name="alpha" id="alpha"
                                value="{{ $pegawai[0]->alpha }}" placeholder="Alpha">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Omzet</label>
                            <input type="text" id="id_cabang" value="{{ $pegawai[0]->id_cabang }}" hidden>
                            <input type="text" name="id_pegawai" value="{{ $pegawai[0]->id }}" hidden>
                            {{-- <input type="text" class="form-control" name="omzet" value="{{ $pegawai[0]->omzet }}" --}}
                            <input type="text" class="form-control" name="omzet" id="jumlah_omzet" readonly
                                placeholder="Omzet">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Bonus Omzet</label>
                            {{-- <input type="text" class="form-control" name="bonus_omzet" id="bonus_omzet"
                                value="{{ $pegawai[0]->bonus_tahunan }}" placeholder="Bonus Omzet" readonly> --}}
                            <input type="text" class="form-control" name="bonus_omzet" id="bonus_omzet"
                                {{-- value="{{ $bonus }}" placeholder="Bonus Omzet" --}} {{-- value="{{ $bonus }}" --}} placeholder="Bonus Omzet" readonly>
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
        // $('#id_pegawai').on('change', function(e) {
        //     var pegawai_id = e.target.value;
        //     $.ajax({
        //         url: '/data-transaksi',
        //         method: 'GET',
        //         data: {
        //             pegawai_id: pegawai_id
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             $('#data_nama').val(data.nama_pegawai);
        //             $('#data_jabatan').val(data.nama_jabatan);
        //             $('#data_status').val(data.nama_golongan);
        //             $('#data_jumlah_anak').val(data.jumlah_anak);
        //         }
        //     })
        // });

        // $('#jumlah_omzet').on('change', function(e) {
        //     var omzet = e.target.value;
        //     $.ajax({
        //         url: '/hitung-omzet/' + {{ $pegawai[0]->id_cabang }},
        //         method: 'GET',
        //         data: {
        //             omzet: omzet
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             if (data.bonus == 0) {
        //                 $('#bonus_omzet').val(0);
        //                 $('#total').val(data.hitung);
        //             } else {
        //                 $('#bonus_omzet').val(data.bonus.bonus);
        //                 $('#total').val(data.hitung);
        //             }
        //         }
        //     })
        // });
        var month = 1;
        // $('jumlah_omzet').on('change', function(e) {
        //     console.log('iniiii')
        // })
        var omzet = {!! $pegawai[0]->omzet !!}
        var bonus_omzet = {!! $pegawai[0]->bonus_omzet !!}
        $('#jumlah_omzet').val(omzet)
        $('#bonus_omzet').val(bonus_omzet);
        $('#bulan').on('change', function(e) {
            var month = e.target.value;
            var id_cabang = document.getElementById("id_cabang").value;
            // console.log(id_cabang, month);
            $.ajax({
                url: `/buat-omzet/${id_cabang}/${month}`,
                method: 'GET',
                // data:
                success: function(data) {
                    console.log(data.data.omzet);
                    if (data.data.omzet === undefined) {
                        $('#jumlah_omzet').val(0)
                    } else {
                        $('#jumlah_omzet').val(data.data.omzet)
                    }

                    $.ajax({
                        url: `/hitung-bonus-omzet/${month}/` + {{ $pegawai[0]->id_cabang }},
                        method: 'GET',
                        // data: {
                        //     omzet: data.data.omzet
                        // },
                        success: function(data) {
                            console.log('Bonus Omzet: ' + data.bonus_omzet);
                            if (data.bonus_omzet == 0) {
                                // console.log(e.target.value)
                                $('#bonus_omzet').val(data.bonus_omzet);
                                // $('#bonus_omzet').prop('readonly', true);
                                // $('#total').val(data.hitung);
                            } else {
                                // console.log(e.target.value)
                                // $('#bonus_omzet').prop('readonly', false);
                                $('#bonus_omzet').val(data.bonus_omzet);
                                // $('#total').val(data.hitung);
                            }
                        }
                    })
                }
            })

            // var jumlah_omzet = document.getElementById("jumlah_omzet").value;
            // console.log(`Bonus Omzet: ${jumlah_omzet}`)
            // $.ajax({
            //     url: '/hitung-omzet/' + {{ $pegawai[0]->id_cabang }} + month,
            //     method: 'GET',
            //     data: {
            //         omzet: jumlah_omzet
            //     },
            //     success: function(data) {
            //         console.log(data);
            //         if (data.bonus == 0) {
            //             console.log(e.target.value)
            //             $('#bonus_omzet').val(0);
            //             $('#bonus_omzet').prop('readonly', true);
            //             $('#total').val(data.hitung);
            //         } else {
            //             console.log(e.target.value)
            //             $('#bonus_omzet').prop('readonly', false);
            //             $('#bonus_omzet').val(data.bonus.bonus);
            //             $('#total').val(data.hitung);
            //         }
            //     }
            // })
        });
        // jumlah_omzet

        $('#id_pegawai').on('change', function(e) {
            var pegawai_id = e.target.value;
            $.ajax({
                url: '/data-transaksi',
                method: 'GET',
                data: {
                    pegawai_id: pegawai_id
                },
                success: function(data) {
                    // console.log(data);
                    $('#data_nama').val(data.nama_pegawai);
                    $('#data_jabatan').val(data.nama_jabatan);
                    $('#data_status').val(data.nama_golongan);
                    $('#data_jumlah_anak').val(data.jumlah_anak);
                }
            })
        });
    </script>
@endpush
