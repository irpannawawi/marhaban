<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database - Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('produk.update', ['produk' => $produk]) }}" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Produk</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('patch')
                            <div class="form-group mb-2">
                                <label for="nama">Nama Produk</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Produk" value="{{ $produk->nama }}" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" required>{{ $produk->deskripsi }}</textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    placeholder="Harga Produk" value="{{ $produk->harga }}" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    placeholder="Stok Produk" value="{{ $produk->stok }}" autocomplete="off" readonly required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan"
                                    placeholder="satuan Produk" value="{{ $produk->satuan }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('database') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
