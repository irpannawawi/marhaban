<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Receipt example</title>
        <style>
            * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 75px;
    max-width: 75px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
        </style>
    </head>
    <body>
        <div class="ticket">
            <img src="{{asset('static/images/logo.png')}}" width="50" alt="Logo">
            <h1>RECEIPT</h1>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Q.</th>
                        <th class="description">Produk</th>
                        <th class="price">Rp.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="quantity centered">{{ $transaksi->qty }}</td>
                        <td class="description">{{ $transaksi->produk->nama }}</td>
                        <td class="price">{{ number_format($transaksi->qty * $transaksi->produk->harga, 0, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL</td>
                        <td class="price">{{ number_format($transaksi->qty * $transaksi->produk->harga, 0, ',', '.')}}</td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">Terimakasih telah berbelanja!
                <br>marhaban.com</p>
        </div>

        <script>
            window.print();
        </script>
    </body>
</html>