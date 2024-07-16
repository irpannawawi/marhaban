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
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="p-1">
                                        <h3 class="card-title float-left">
                                            Bahan Baku
                                        </h3>
                                    </div>
                                    <div class="p-1">
                                        <button class="btn btn-primary btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#modalAddBahanBaku">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table datatable table-sm table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Bahan</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($bahans as $bahan)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $bahan->nama_bahan }}</td>
                                                <td class="text-center">{{ $bahan->stok_bahan }}</td>
                                                <td class="text-center">{{ $bahan->satuan_bahan }}</td>
                                                <td class="text-right">
                                                    <form action="{{ route('bahan.destroy', ['bahan' => $bahan]) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="btn-group">
                                                            <a href="{{ route('bahan.edit', ['bahan' => $bahan]) }}"
                                                                class="btn btn-sm btn-warning">Edit</a>
                                                            <button
                                                                href="{{ route('bahan.destroy', ['bahan' => $bahan]) }}"
                                                                class="btn btn-sm btn-danger" type="submit"
                                                                onclick="return confirm('Hapus Bahan Baku?')">Delete</button>
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
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="p-1">
                                        <h3 class="card-title float-left">
                                            Produk
                                        </h3>
                                    </div>
                                    <div class="p-1">
                                        <button class="btn btn-primary btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#modalAddProduk">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($produks as $produk)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $produk->nama }}</td>
                                                <td>{{ $produk->deskripsi }}</td>
                                                <td class="text-center">{{ $produk->stok . ' ' . $produk->satuan }}</td>
                                                <td class="text-center">Rp. {{ number_format($produk->harga, '0', ',', '.') }},-</td>
                                                <td class="text-right">
                                                    <form action="{{ route('produk.destroy', ['produk' => $produk->id_produk]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="btn-group">
                                                            <a href="{{ route('produk.edit', ['produk' => $produk->id_produk]) }}"
                                                                class="btn btn-sm btn-warning">Edit</a>
                                                            <button
                                                                href="{{ route('produk.destroy', ['produk' => $produk->id_produk]) }}"
                                                                class="btn btn-sm btn-danger" type="submit"
                                                                onclick="return confirm('Hapus Produk?')">Delete</button>
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
    @include('database.components.add_bahan_baku')
    @include('database.components.add_produk')



</x-app-layout>
