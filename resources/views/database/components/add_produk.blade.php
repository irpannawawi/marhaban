
    {{-- add Produk --}}
    <div class="modal fade" id="modalAddProduk" tabindex="-1" role="dialog"
        aria-labelledby="modalAddProdukLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddProdukLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('produk.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nama">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="deskripsi">Deskripsi <small>(Rekomendasi: Cantumkan komposisi bahan)</small></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Produk" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="satuan Produk" autocomplete="off" required>
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
    {{-- ./add Produk --}}