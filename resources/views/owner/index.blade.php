@extends('admin.layouts.app')

@section('title', 'Dashboard Owner')

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
    </div>
@endsection
