@extends('admin.layouts.app')

@section('title', 'Dashboard Data Pegawai')

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#modalTambah">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Tambah Pegawai
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_pegawai"
                        value="{{ $pegawai->nama_pegawai }}">
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
                    <label for="">Status</label>
                    <input type="text" class="form-control" name="status"
                        value="{{ $pegawai->status }}">
                </div>

                <div class="form-group">
                    <label for="">Jumlah Anak</label>
                    <input type="number" class="form-control" name="jumlah_anak"
                        value="{{ $pegawai->jumlah_anak }}">
                </div>

                <button type="submit"
                    class="btn btn-primary float-right mt-3">Edit</button>
            </form>
        </div>
    </div>

@endsection
