@extends('admin.layouts.app')

@section('title', 'Dashboard Tambah Data Pegawai')

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Pegawai</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama lengkap ...">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option>Pilih Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Jl.Royal ...">
                </div>

                <div class="form-group">
                    <label for="">Jabatan</label>
                    <select name="id_jabatan" class="form-control" id="">
                        <option value="">Pilih jabatan</option>
                        @foreach ($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Cabang</label>
                    <select name="id_cabang" class="form-control" id="">
                        <option value="">Pilih Cabang</option>
                        @foreach ($cabang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" name="status">
                        <option>Pilih Status</option>
                        @foreach ($golongan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_golongan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Tahun Masuk</label>
                    <input type="date" class="form-control" name="tahun_masuk">
                </div>

                <div class="form-group">
                    <label for="">Jumlah Anak</label>
                    <input type="number" class="form-control" name="jumlah_anak" placeholder="Jumlah Anak ...">
                </div>

                <button type="submit" class="btn btn-primary float-right mt-3">Tambah</button>
            </form>
        </div>
    </div>

@endsection
