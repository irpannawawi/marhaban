<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Bahan - Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('trbahan.update', ['trbahan' => $transaksi]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                            <label for="nama_bahan">Nama Bahan</label>
                            <input class="form-control" value="{{ $transaksi->bahan->nama_bahan }}" disabled/>
                            <input type="hidden" name="id_bahan" value="{{ $transaksi->id_bahan }}" />
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="tgl_transaksi">Tanggal</label>
                            <input type="text" value="{{ \Illuminate\Support\Carbon::parse($transaksi->tgl_transaksi)->format('Y-m-d') }}" class="form-control" id="tgl_transaksi" name="tgl_transaksi">
                        </div>

                        <div class="form-group mb-3">
                            <label for="qty">Jumlah</label>
                            <input type="number" value="{{ $transaksi->qty }}" class="form-control" id="qty" name="qty">
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan_bahan">Jenis Tansaksi</label>
                            <input disabled class="form-control disabled"value="{{ $transaksi->jenis }}">
                            <input type="hidden" name="jenis" id="" value="{{ $transaksi->jenis }}">
                        </div>

                        <a href="{{ route('trbahan.index') }}" class="btn btn-secondary"  >Close</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>