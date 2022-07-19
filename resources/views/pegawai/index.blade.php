@extends('admin.layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
            @if (Auth::user()->role == 'admin')
                Admin
            @elseif(Auth::user()->role == 'pegawai')
                Pegawai
            @elseif(Auth::user()->role == 'owner')
                Owner
            @endif
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="card shadow rounded" style="width: 20rem;">
        <div class="card-body">
            Nama : {{ Auth::user()->name }} <br>
            Email : {{ Auth::user()->email }} <br>
        </div>
    </div>

@endsection
