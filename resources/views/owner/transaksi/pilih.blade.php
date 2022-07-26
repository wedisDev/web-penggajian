@extends('admin.layouts.app')

@section('title', 'Dashboard Owner')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Pilih Cabang</h6>
            </div>
            <div class="card-body">
                <select name="" class="form-control text-dark" onchange="location = this.value;">
                    <option value="">Pilih Cabang</option>
                    @foreach ($cabang as $item)
                        <option value="{{ url('/filter-cabang-transaksi', $item->id) }}">
                            {{ $item->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

@endsection
