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

        <x-kop-laporan />

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
                    <th>Rata-rata Harian</th>
                    <th>Harga Satuan (Rp.)</th>
                    <th>Total Harga (Rp.)</th>
                </tr>

            </thead>

                <tbody>
                    @foreach ($groupedPenjualan as $group)
                    @foreach ($group['items'] as $index => $item)
                    <tr>
                        <td class="text-center">{{ $item->tanggal }}</td>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td style="text-align: center;">{{ $item->jumlah }} {{ $item->unit }}</td>
                        @if ($index === 0)
                        <td rowspan="{{ $group['rowspan'] }}" style="text-align: center;">
                            {{ number_format($group['rata_rata_harian'], 2, ',', '.') }}
                        </td>
                        @endif
                        <td style="text-align: right;">{{ number_format( $item->unit === 'bal' ? $item->produk->harga_jual : $item->produk->harga_jual_unit_kecil, 2, ',', '.') }} /{{ $item->unit}}</td>
                        <td style="text-align: right;">{{ number_format($item->total_harga_jual, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong>{{ number_format($total, 2, ',', '.') }}</strong></td>
                    </tr>
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
