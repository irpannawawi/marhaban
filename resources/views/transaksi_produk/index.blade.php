<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Produk') }}
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
                                            Transaksi Produk
                                        </h3>
                                    </div>
                                    <div class="p-1">
                                        <button class="btn mx-3 btn-warning btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#modalAddTransaksiMasuk">Masuk</button>

                                        <button class="btn btn-success btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#modalAddTransaksiJual">Jual <i
                                                class="fa fa-dollar"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-6 float-end">
                                        <form action="{{ route('trproduk.index') }}">
                                            @csrf
                                            <x-filter />
                                        </form>
                                    </div>
                                </div>
                                <table
                                    class="table table-hover table-striped table-sm table-bordered table-responsive datatable">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Jenis Transaksi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $transaksi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaksi->tgl_transaksi }}</td>
                                                <td>{{ $transaksi->produk->nama }}</td>
                                                <td>{{ $transaksi->qty . ' ' . $transaksi->produk->satuan }}</td>
                                                <td
                                                    class="text-center text-{{ $transaksi->jenis == 'masuk' ? 'success' : 'danger' }}">
                                                    {{ $transaksi->jenis }}
                                                    <i
                                                        class="fa fa-arrow-{{ $transaksi->jenis == 'masuk' ? 'down' : 'up' }} "></i>
                                                </td>
                                                <td class="text-end">
                                                    <form
                                                        action="{{ route('trproduk.destroy', ['trproduk' => $transaksi]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="btn-group">
                                                            @if ($transaksi->jenis == 'keluar')
                                                                
                                                            <button type="button" class="btn btn-sm btn-info"
                                                            onclick="print_trx('{{ $transaksi->id }}')">Print</button>
                                                            @endif
                                                            <a href="{{ route('trproduk.edit', ['trproduk' => $transaksi]) }}"
                                                                class="btn btn-sm btn-warning">Edit</a>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Delete</button>
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

    {{-- add trx masuk --}}
    <div class="modal fade" id="modalAddTransaksiMasuk" tabindex="-1" role="dialog"
        aria-labelledby="modalAddTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTransaksiLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('trproduk.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="masuk">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nama_bahan">Nama Produk</label>
                            <select class="form-control" name="id_produk">
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id_produk }}">{{ $produk->nama }}
                                        ({{ $produk->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="qty">Jumlah</label>
                            <input type="number" class="form-control" id="qty" name="qty">
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
    {{-- ./add trx masuk --}}


    {{-- add trx jual --}}
    <div class="modal fade" id="modalAddTransaksiJual" tabindex="-1" role="dialog"
        aria-labelledby="modalAddTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTransaksiLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('trproduk.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="keluar">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nama_bahan">Nama Produk</label>
                            <select class="form-control" name="id_produk">
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id_produk }}">{{ $produk->nama }}
                                        ({{ $produk->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="qty">Jumlah</label>
                            <input type="number" class="form-control" id="qty" name="qty">
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
    {{-- ./add trx jual --}}
    <script>
        function print_trx(id) {
            window.open("{{ url('trproduk/print/') }}/" + id, "Print", "width=600,height=600");
        }

        @if (session()->has('print'))
                    print_trx({{ session()->get('msg')['id'] }});
        @endif
    </script>
</x-app-layout>
