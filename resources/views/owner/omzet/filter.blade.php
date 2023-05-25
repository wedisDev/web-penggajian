@extends('admin.layouts.app')

@section('title', 'Dashboard Data Bonus Omzet')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Omzet</h1>
        <div class="d-flex justify-content-center">
            <form action="{{ route('filter.omzet') }}" method="post">
                @csrf
                <input type="date" name="date" class="btn btn-outline-primary mr-2">
                <button type="submit" class="btn btn-primary shadow-sm">
                    Filter Date
                </button>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Omzet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tableGolongan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cabang</th>
                            <th>Bulan</th>
                            <th>Omzet</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($omzet as $item)
                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Bonus Omzet</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('omzet.update', $item->id) }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf

                                                <div class="form-group">
                                                    <input type="text" name="id_omzet" value="{{ $item->id_omzet }}"
                                                        hidden>
                                                    <label for="">Cabang</label>
                                                    <select name="id" class="form-control" id="">
                                                        <option value="">Pilih Cabang</option>
                                                        @foreach ($omzet as $item2)
                                                            <option value="{{ $item2->id }}"
                                                                {{ $item2->id == $item->id ? 'selected' : '' }}>
                                                                {{ $item2->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Omzet</label>
                                                    <input type="number" class="form-control" name="omzet"
                                                        value="{{ $item->omzet }}">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-primary float-right mt-3">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_cabang }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->omzet }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#modalEdit{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableGolongan').DataTable();
        });
    </script>
@endpush
