<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database - Edit Bahan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('bahan.update', ['bahan' => $bahan]) }}" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Bahan</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="nama_bahan">Nama Bahan</label>
                                <input type="text" class="form-control" id="edit_nama_bahan" value="{{ $bahan->nama_bahan }}" name="nama_bahan" required>
                            </div>
                            <div class="form-group">
                                <label for="stok_bahan">Stok Bahan</label>
                                <input type="number" disabled class="form-control" id="edit_stok_bahan" value="{{ $bahan->stok_bahan }}" name="stok_bahan" readonly  required>
                            </div>
                            <div class="form-group">
                                <label for="satuan_bahan">Satuan Bahan</label>
                                <input type="text" class="form-control" value="{{ $bahan->satuan_bahan }}"  name="satuan_bahan" required>
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
