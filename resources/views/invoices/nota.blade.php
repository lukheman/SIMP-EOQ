<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Pesanan Barang</title>


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

        #pesanan {
            border-collapse: collapse;
            margin-top: 50px;
            margin-bottom: 50px;
            width: 90%;
        }


        #pesanan td,
        #pesanan th {
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
        <h5 class="text-center"><u>Nota Pesanan Barang</u></h5>

        <table id="keterangan">
            <tr>
                <td>Pengirim</td>
                <td>:</td>
                <td>Akmal</td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td>:</td>
                <td>cici</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>jakarta</td>
            </tr>
        </table>

        <table id="pesanan">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Produk</th>
                    <th>Jumlah</th>
                    <th>Harga(Rp)</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>indomie</td>
                    <td>10</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>indomie</td>
                    <td>10</td>
                    <td>50</td>
                </tr>

                <tr>
                    <td colspan="3">total</td>
                    <td>100</td>
                </tr>

            </tbody>

        </table>

        <div class="row">
            <div class="col">
            <img src="{{ $qrcode }}" alt="qrcode">
            </div>
            <div class="col" style="text-align: center;">
                <p style="margin-bottom: 100px;"><b>UD Toko Diva Mowewe</b></p>
                <p><b><u>Kepala Toko</u></b></p>
            </div>
        </div>
    </div>

</body>

</html>
