{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji {{ $pegawai[0]->nama_pegawai }}</title>
</head>

<body>
    <div class="card" style="border: 3px #000 solid;">
        <div class="header" style="margin: 30px;">
            <h1>PT. Karya Anugerah</h1>
            <p>Jl. Raya Cikarang No.1, Cikarang Barat, Cikarang, Bekasi, Jawa Barat, Indonesia</p>
            <p>Telp. 021-898989898</p>
        </div>

        <div class="line" style="border: 2px #A2B5BB solid; margin-left: 30px; margin-right: 30px;"></div>
        <h2 align="center">Data Diri</h2>

        <br>
        <div class="data-diri" style="margin-left: 30px;">
            <span style="font-size: 20px;">ID</span> <span style="font-size: 20px;">:</span> <span
                style="font-size: 20px;">{{ $pegawai[0]->id_pegawai }}</span><br>
            <span style="font-size: 20px;">Nama</span> <span style="font-size: 20px;">:</span> <span
                style="font-size: 20px;">{{ $pegawai[0]->nama_pegawai }}</span><br>
            <span style="font-size: 20px;">Jabatan</span> <span style="font-size: 20px;">:</span> <span
                style="font-size: 20px;">{{ $pegawai[0]->nama_jabatan }}</span><br>
            <span style="font-size: 20px;">Status</span> <span style="font-size: 20px;">:</span> <span
                style="font-size: 20px;">{{ $pegawai[0]->nama_golongan }}</span>
        </div>
        <br>
        <div class="line" style="border: 2px #000 solid; padding: -10px;">
            <h2 style=" margin-left: 30px;">Penerimaan</h2>
        </div>
        <div class="penerimaan" style="margin-left: 30px;">
            <br>
            <span style="font-size: 20px;">ID</span> <span style="font-size: 20px;">:</span> <span
                style="font-size: 20px;">{{ $pegawai[0]->id_pegawai }}</span><br>
        </div>

    </div>

</body>

</html> --}}

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
        /* body {
            font-family: arial;
        } */
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

            /* h1 {
                font-size: 24px;
            } */
        }

        /* table {
            border-collapse: collapse;
        } */
    </style>
</head>

<body>
    <div class="container-fluid">
        <h1 align="center">PT. Karya Anugerah</h1>
        <p align="center">Jl. Raya Cikarang No.1, Cikarang Barat, Cikarang, Bekasi, Jawa Barat, Indonesia</p>
        <p align="center">Telp. 021-898989898</p>

        <div class="line" style="border: 2px #A2B5BB solid;"></div>
        <br>
        <h2 align="center">Data Diri</h2>

        <br>
        <div class="row">
            <div class="col-md-6">
                <span style="font-size: 20px;">ID : {{ $pegawai[0]->id_pegawai }}</span><br>
                <span style="font-size: 20px;">Nama : {{ $pegawai[0]->nama_pegawai }}</span><br>
                <span style="font-size: 20px;">Jabatan : {{ $pegawai[0]->nama_jabatan }}</span><br>
                <span style="font-size: 20px;">Status : {{ $pegawai[0]->nama_golongan }}</span>
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

        <span style="font-size: 20px;">Gaji Pokok : {{ $pegawai[0]->gapok }}</span><br>
        <span style="font-size: 20px;">Tunjangan : {{ $tunjangan }}</span><br>
        <span style="font-size: 20px;">Lembur : {{ $pegawai[0]->lembur }}</span><br>
        <span style="font-size: 20px;">Tunjangan Transportasi : {{ $pegawai[0]->tunjangan_transportasi }}</span><br>
        <span style="font-size: 20px;">Tunjangan Makan : {{ $pegawai[0]->tunjangan_makan }}</span><br>

        <br><br>
        <h4>Total Penerimaan : {{ $pegawai[0]->total }}</h4>

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
