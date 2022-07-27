@extends('admin.layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard {{ Auth::user()->name }}
        </h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow rounded" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    ID Pegawai 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->id_pegawai }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Nama 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->nama_pegawai }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Alamat 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->alamat }}
                </div>
            </div> 
            <div class="row">
                <div class="col-md-2">
                    Jabatan 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->nama_jabatan }}
                </div>
            </div> 
            <div class="row">
                <div class="col-md-2">
                    Cabang 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->nama_cabang }}
                </div>
            </div> 
            <div class="row">
                <div class="col-md-2">
                    Tahun Masuk 
                </div>
                <div class="col-md-4">
                    : &nbsp; {{ $data[0]->tahun_masuk }}
                </div>
            </div> 
        </div>
    </div>

@endsection
