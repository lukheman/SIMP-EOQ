<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan Barang</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
        hr {
            height: 2px;
            background-color: black;
            border: none;
        }

        .container {
            width: 70%;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        #keterangan tr td:first-child {
            width: 150px;
        }

        #pesanan, #rata-rata {
            border-collapse: collapse;
            margin-top: 50px;
            margin-bottom: 50px;
            width: 90%;
        }


        #pesanan td,
        #pesanan th,
        #rata-rata td,
        #rata-rata th
        {
            border: 1px solid black;
            padding: 8px;
        }

        .row {
            display: flex;
        }

        .col {
            flex: 1;
            padding: 10px;
        }
    </style>

</head>

<body onload="window.print()">
    <div class="container">
        <h3 class="text-center">UD TOKO DIVA MOWEWE</h3>
        <hr>
        <h5 class="text-center"><u>Laporan Penjualan</u></h5>

        <table id="keterangan">
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td>{{ $periode }}</td>
            </tr>
        </table>

        <table id="pesanan">

            <thead>

                <tr>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Terjual</th>
                    <th>Total Harga (Rp.)</th>
                </tr>

            </thead>

            <tbody>
                @php
                $total = 0;
                $i = 0;
                @endphp

                @foreach ($penjualan as $item)
                <tr>
                    <td class="text-center">{{ $item->tanggal }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td style="text-align: center;">{{ $item->jumlah}}</td>
                    <td style="text-align: right;">{{ number_format($item->total_harga_jual, 2, ',', '.') }}</td>
                    @php
                    $total += $item->total_harga_jual
                    @endphp
                </tr>

                @endforeach

                <tr>
                    <td style="text-align: center;" colspan="3">Total</td>
                    <td style="text-align: right;">{{ number_format($total, 2, ',', '.')}}</td>
                </tr>

            </tbody>

        </table>

        <table id="rata-rata">

            <thead>

                <tr>
                    <th>Nama Produk</th>
                    <th>Rata-rata penjualan harian</th>
                </tr>

            </thead>

            <tbody>
                @php
                $total = 0;
                $i = 0;
                @endphp

                @foreach ($rataRata as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td class="text-center">{{ round($item->rata_rata_harian) }}</td>
                </tr>

                @endforeach


            </tbody>

        </table>

        <div class="row">
            <div class="col">
            </div>
            <div class="col" style="text-align: center;">
                <p style="margin-bottom: 100px;"><b>UD Toko Diva Mowewe</b></p>
                <p><b><u>{{ $ttd }}</u></b></p>
            </div>
        </div>
    </div>

</body>

</html>
