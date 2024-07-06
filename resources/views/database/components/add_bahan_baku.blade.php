
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
                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" required>
                        </div>
                        <div class="form-group">
                            <label for="stok_bahan">Stok Bahan</label>
                            <input type="number" class="form-control" id="stok_bahan" name="stok_bahan" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan_bahan">Satuan Bahan</label>
                            <input type="text" class="form-control" id="satuan_bahan" name="satuan_bahan" required>
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