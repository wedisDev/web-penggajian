<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi Masuk</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">


    <style>
        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        @media (max-width: 768px) {
            body {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h1 align="center">Kantin Tante</h1>
        <p align="center">{{ $pegawai[0]->nama_cabang . ' ' . $pegawai[0]->alamat }}</p>
        <p align="center">Telp. 021-89898989815</p>

        <div class="line" style="border: 2px #A2B5BB solid;"></div>
        <br>
        <h2 align="center">Data Diri</h2>

        <br>
        <div class="row">
            <div class="col-md-6">
                <span style="font-size: 20px;">ID PEGAWAI :
                    {{ $pegawai[0]->id_pegawai }}</span><br>
                <span style="font-size: 20px;">Nama : {{ $pegawai[0]->nama_pegawai }}</span><br>
                <span style="font-size: 20px;">Jabatan : {{ $pegawai[0]->nama_jabatan }}</span><br>
                <span style="font-size: 20px;">Status : {{ $pegawai[0]->nama_golongan }}</span><br>
                <span style="font-size: 20px;">Jumlah Anak : {{ $pegawai[0]->jumlah_anak }}</span>
                <br>
                <span style="font-size: 20px;">Tanggal Cetak : {{ $tanggal }}</span>
            </div>
        </div>

        <br><br>
        <div class="line" style="border: 2px #A2B5BB solid;"></div>
        <br>
        <h2 align="center">Penerimaan</h2>
        <br>

        @php
            $tunjangan = $pegawai[0]->tunjangan_makan + $pegawai[0]->tunjangan_makmur + $pegawai[0]->tunjangan_transport + $pegawai[0]->lembur * $pegawai[0]->tunjangan_lembur + $pegawai[0]->tunjangan_menikah + $pegawai[0]->jumlah_anak * $pegawai[0]->tunjangan_anak;
        @endphp

        <div class="container" style="margin-left: 10px">
            <div class="row">
                <div class="col-6">
                    <span style="font-size: 20px;">Gaji Pokok : Rp {{ number_format($pegawai[0]->gapok) }}</span><br>
                    <span style="font-size: 20px;">Lembur :
                        {{ $pegawai[0]->lembur . ' x ' . $pegawai[0]->tunjangan_lembur }}</span><br>
                    <span style="font-size: 20px;">Alpha : {{ $pegawai[0]->alpha }}</span><br>
                    <span style="font-size: 20px;">Bonus Omzet : {{ $pegawai[0]->bonus_omzet }}</span><br>
                    <span style="font-size: 20px;">tunjangan makmur : Rp
                        {{ number_format($pegawai[0]->tunjangan_makmur) }}</span><br>
                    <span style="font-size: 20px;">Pelanggaran : Rp
                        {{ number_format($pegawai[0]->pelanggaran) }}</span><br>


                </div>
                <div class="col-6">
                    <span style="font-size: 20px;">Tunjangan Makan {{ $masuk }} x
                        {{ $pegawai[0]->tunjangan_makan }}
                        : Rp
                        {{ number_format($tunjangan_makan) }}</span><br>
                    <span style="font-size: 20px;">Tunjangan Transportasi :
                        {{ $masuk . ' x Rp' . number_format($pegawai[0]->tunjangan_transportasi) . ' = Rp' . number_format($pegawai[0]->tunjangan_transportasi * $masuk) }}</span><br>
                    <span style="font-size: 20px;">tunjangan lembur : Rp
                        {{ number_format($pegawai[0]->tunjangan_lembur * $pegawai[0]->lembur) }}</span><br>
                    <span style="font-size: 20px;">tunjangan menikah : Rp
                        {{ number_format($pegawai[0]->tunjangan_menikah) }}</span><br>
                    <span style="font-size: 20px;">tunjangan anak : Rp
                        {{ number_format($pegawai[0]->tunjangan_anak) }}</span><br>
                </div>
            </div>
        </div>

        <br><br>
        <h4>Total Penerimaan : Rp {{ number_format($pegawai[0]->total) }}</h4>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
</body>

</html>
