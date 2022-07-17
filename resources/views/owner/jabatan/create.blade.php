@extends('admin.layouts.app')

@section('title', 'Tambah Data Jabatan')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Jabatan</h1>
    </div>

    <div class="card shadow rounded" style="border: none;">
        <div class="card-body">
            <form action="{{ route('jabatan.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" placeholder="Nama Jabatan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Gaji Pokok</label>
                            <input type="number" class="form-control" name="gapok" placeholder="Rp 100.000...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Makmur</label>
                            <input type="number" class="form-control" name="tunjangan_makmur" placeholder="Rp 100.000...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Makan</label>
                            <input type="number" class="form-control" name="tunjangan_makan" placeholder="Rp 100.000...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Transportasi</label>
                            <input type="number" class="form-control" name="tunjangan_transportasi" placeholder="Rp 100.000...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Lembur</label>
                            <input type="number" class="form-control" name="tunjangan_lembur" placeholder="Rp 100.000...">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 float-right">Tambah</button>
            </form>
        </div>
    </div>

@endsection
