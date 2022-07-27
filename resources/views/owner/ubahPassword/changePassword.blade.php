@extends('admin.layouts.app')

@section('title', 'Ubah Password')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                <h3>Ubah Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/ubah-password-store', $data->id) }}" method="post">
                    {{-- {{ method_field('PUT') }} --}}
                    @csrf
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Password Baru">
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Ubah</button>
                </form>
            </div>
        </div>
    </div>

@endsection
