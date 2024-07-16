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
                                            data-bs-target="#modalAddTransaksi">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table
                                    class="table table-hover table-striped table-sm table-bordered table-responsive datatable">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Nama Bahan</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Jenis Transaksi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $transaksi)
                                            <tr>
                                                <td>{{ 1 }}</td>
                                                <td>{{ $transaksi->tgl_transaksi }}</td>
                                                <td>{{ $transaksi->bahan->nama_bahan }}</td>
                                                <td>{{ $transaksi->qty . ' ' . $transaksi->bahan->satuan_bahan }}</td>
                                                <td
                                                    class="text-center text-{{ $transaksi->jenis == 'masuk' ? 'success' : 'danger' }}">
                                                    {{ $transaksi->jenis }}
                                                    <i
                                                        class="fa fa-arrow-{{ $transaksi->jenis == 'masuk' ? 'down' : 'up' }} "></i>
                                                </td>
                                                <td>
                                                    <form action="{{ route('trbahan.destroy', ['trbahan' => $transaksi]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="btn-group">
                                                            <a href="{{ route('trbahan.edit', ['trbahan' => $transaksi]) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </form>
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
    <div class="modal fade" id="modalAddTransaksi" tabindex="-1" role="dialog"
        aria-labelledby="modalAddTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTransaksiLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('trbahan.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nama_bahan">Nama Bahan</label>
                            <select class="form-control" name="id_bahan">
                                @foreach ($bahans as $bahan)
                                    <option value="{{ $bahan->id_bahan }}">{{ $bahan->nama_bahan }} ({{ $bahan->satuan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="qty">Jumlah</label>
                            <input type="number" class="form-control" id="qty" name="qty">
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan_bahan">Jenis Tansaksi</label>
                            <select class="form-control" name="jenis" id="">
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
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
