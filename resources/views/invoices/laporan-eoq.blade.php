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
        
        .text-danger { 
            color: red;
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

        <x-kop-laporan />

        <h5 class="text-center"><u>Laporan Economic Order Quantity</u></h5>

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
                        <th>Nama Produk </th>
                        <th>Safety Stock</th>
                        <th>ROP</th>
                        <th>Jumlah harus dipesan (EOQ)</th>
                    </tr>

            </thead>

                <tbody>
                                @foreach ($data_eoq as $item)
                                <tr>
                                    @if (count($item) < 1)
                                        <td> {{ $item['produk']->nama_produk}}</td>
                                        <td class="text-center"> {{ $item['safety_stock']}}</td>
                                        <td class="text-center"> {{ $item['reorder_point']}}</td>
                                        <td class="text-center"> {{ $item['eoq']}}</td>

                                    @else
                                        <td> {{ $item['produk']->nama_produk}}</td>
                                        <td class="text-center text-danger" colspan="3">Data tidak mencukupi</td>
                                    @endif
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

<script>

function gabungKolomDenganIDYangSama(tableId) {
  const table = document.getElementById(tableId);
  if (!table) return;

  for (let row of table.rows) {
    let prevId = '';
    let prevCell = null;
    let spanCount = 1;

    for (let i = 0; i < row.cells.length;) {
      const cell = row.cells[i];
      const cellId = cell.id;

      if (cellId === prevId && prevCell) {
        spanCount++;
        prevCell.colSpan = spanCount;
        cell.remove(); // Hapus sel duplikat
        // i tetap, karena cell sudah dihapus
      } else {
        prevId = cellId;
        prevCell = cell;
        spanCount = 1;
        i++; // hanya naikkan index jika tidak menghapus
      }
    }
  }
}

// document.addEventListener('DOMContentLoaded', () => {
//   gabungKolomDenganIDYangSama('pesanan');
// });

</script>

</html>
