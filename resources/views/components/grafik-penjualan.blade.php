<div class="card mb-4">
    <div class="card-header">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="nav-laporan" onclick="open_tab('laporan')" aria-current="page"
                    href="#">Laporan Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav-penjualan" onclick="open_tab('penjualan')" aria-current="page"
                    href="#">Trend Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav-bahan" onclick="open_tab('bahan')" href="#">Stok Bahan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav-produk" onclick="open_tab('produk')" href="#">Stok Produk</a>
            </li>
        </ul>
    </div> <!-- /.card-header -->
    <!--begin::Row Laporan Penjualan-->
    <div class="card-body tab-pane" id="laporan">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-striped table-sm table-bordered table-responsive datatable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $penjualan)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-end">{{ $penjualan->tgl_transaksi }}</td>
                                <td>{{ $penjualan->produk->nama }}</td>
                                <td class="text-center">{{ number_format($penjualan->qty, 0, ',', '.') }}</td>
                                <td class="text-end">Rp. {{ number_format($penjualan->produk->harga, 0, ',', '.') }},-</td>
                                <td class="text-end">Rp. {{ number_format($penjualan->produk->harga * $penjualan->qty, 0, ',', '.') }},-</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    </div>
    <!-- /.card-body Laporan Penjualan -->


    <!--begin::Row Grafik Penjualan-->
    <div class="card-body tab-pane d-none" id="penjualan">
        <div class="row">
            <div class="col-12">
                @foreach ($productsSold as $product)
                    <div class="item mb-2">
                        <p>{{ $product['name'] }}</p>
                        @php
                            $curr_val = $product['times'];
                            $curr_val_prc = ($maxProductSold != 0) ? ($product['times'] * 100) / $maxProductSold : 0;
                        @endphp
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $curr_val_prc }}%"
                                aria-valuenow="{{ $curr_val }}" aria-valuemin="0"
                                aria-valuemax="{{ $maxProductSold }}">{{ $curr_val }} Transaksi
                                ({{ $product['sold'] }} Pcs)
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    </div>
    <!-- /.card-body Grafik Penjualan -->


    <!--begin::Row Bahan-->
    <div class="card-body tab-pane d-none" id="bahan">
        <table class="table table-hover table-striped table-sm table-bordered w-100 datatable">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Bahan</th>
                    <th>Stok</th>
                    <th>Minimum Treshold</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahans as $bahan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $bahan->nama_bahan }}</td>
                        <td>
                            {{ $bahan->stok_bahan }} {{ $bahan->satuan_bahan }}
                            @if ($bahan->stok_bahan < $bahan->buffer_bahan)
                                <span class="text-danger float-end"> - {{ $bahan->buffer_bahan - $bahan->stok_bahan }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $bahan->buffer_bahan }} {{ $bahan->satuan_bahan }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body Produk -->


    <!--begin::Row Produk-->
    <div class="card-body tab-pane d-none" id="produk">
        <table class="table table-hover table-striped w-100 table-sm table-bordered table-responsive datatable">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Minimum Treshold</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $product->nama }}</td>
                        <td>
                            {{ $product->stok }} {{$product->satuan}}
                            @if ($product->stok < $product->buffer)
                                <span class="text-danger float-end"> - {{ $product->buffer - $product->stok }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $product->buffer }} {{$product->satuan}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body Produk -->
</div>
<script>
    function open_tab(name) {
        // remove active nav link
        $('.nav-link').removeClass('active');
        // add active nav link
        $('#nav-' + name).addClass('active');

        // hide all tab pane
        $('.tab-pane').removeClass('d-block');
        $('.tab-pane').addClass('d-none');

        // show current tab pane
        $('#' + name).removeClass('d-none');
        $('#' + name).addClass('d-block');

    }
</script>
