<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="p-1">
                                        <h3 class="card-title float-left">
                                            Transaksi Bahan Baku
                                        </h3>
                                    </div>
                                    <div class="p-1">
                                        <button class="btn btn-primary btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#modalAddBahanBaku">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nama Bahan</th>
                                            <th>Julmah</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bahans as $bahan)
                                            <tr>
                                                <td>{{ $bahan->id_bahan }}</td>
                                                <td>{{ $bahan->created_at }}</td>
                                                <td>{{ $bahan->nama_bahan }}</td>
                                                <td>20 Kg</td>
                                                <td>Masuk <i class="fa fa-arrow-down text-success"></i></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">Edit</button>
                                                    <a href="{{ route('bahan.destroy', ['id'=>$bahan->id_bahan]) }}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modals --}}

    {{-- add bahan baku --}}
    <div class="modal fade" id="modalAddBahanBaku" tabindex="-1" role="dialog"
        aria-labelledby="modalAddBahanBakuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddBahanBakuLabel">Tambah Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bahan.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bahan">Nama Bahan</label>
                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan">
                        </div>
                        <div class="form-group">
                            <label for="stok_bahan">Stok Bahan</label>
                            <input type="number" class="form-control" id="stok_bahan" name="stok_bahan">
                        </div>
                        <div class="form-group">
                            <label for="satuan_bahan">Satuan Bahan</label>
                            <input type="text" class="form-control" id="satuan_bahan" name="satuan_bahan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- ./add bahan baku --}}

</x-app-layout>
