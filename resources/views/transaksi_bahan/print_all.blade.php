<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 10mm 10mm 10mm;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .th, .td {
            padding: 5px;
            border: 1px solid black;
        }
        
        .tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <table style="border: 0px;">
            <tr>
                <td rowspan="2" style="width: 10%">
                    <div style="text-align: center;"><img src="{{ asset('static/images/logo.png') }}" width="100" alt="Logo"></div>
                </td>
                <td>
                    <h1 align="center">Laporan Transaksi Bahan Baku<br>
                        <small>tgl</small></h1>
                </td>
            </tr>

        </table>
        <table>
            <thead>
                <tr class="tr">
                    <th class="th" style="width: 15%">Tanggal</th>
                    <th class="th" style="width: 40%">Bahan</th>
                    <th class="th" style="width: 15%">Q.</th>
                    <th class="th" style="width: 15%">Jenis</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksi as $tr)
                    <tr class="tr">
                        <td class="td">{{ Illuminate\Support\Carbon::parse($tr->created_at)->format('d-m-Y') }}</td>
                        <td class="td">{{ $tr->bahan->nama_bahan }}</td>
                        <td class="td" style="text-align: center">{{ $tr->qty }}</td>
                        <td class="td" style="text-align: {{ $tr->jenis == 'masuk' ? 'left' : 'right' }}">{{ $tr->jenis }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="centered">Terimakasih telah berbelanja!
            <br>marhaban.com
        </p>
    </div>

    <script>
        // window.print();
    </script>
</body>

</html>
