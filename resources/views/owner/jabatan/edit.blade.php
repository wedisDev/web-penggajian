@extends('admin.layouts.app')

@section('title', 'Edit Data Jabatan')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Jabatan</h1>
    </div>

    <div class="card shadow rounded" style="border: none;">
        <div class="card-body">
            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Gaji Pokok</label>
                            <input type="number" class="form-control" name="gapok" value="{{ $jabatan->gapok }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Makmur</label>
                            <input type="number" class="form-control" name="tunjangan_makmur" value="{{$jabatan->tunjangan_makmur }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Makan</label>
                            <input type="number" class="form-control" name="tunjangan_makan" value="{{ $jabatan->tunjangan_makan }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Transportasi</label>
                            <input type="number" class="form-control" name="tunjangan_transportasi" value="{{ $jabatan->tunjangan_transportasi }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tunjangan Lembur</label>
                            <input type="number" class="form-control" name="tunjangan_lembur" value="{{ $jabatan->tunjangan_lembur }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Bonus Tahunan</label>
                    <input type="number" class="form-control" name="bonus_tahunan" value="{{ $jabatan->bonus_tahunan }}">
                </div>

                <button type="submit" class="btn btn-primary mt-3 float-right">Update</button>
            </form>
        </div>
    </div>

@endsection
