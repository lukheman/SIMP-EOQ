@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <!-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-add-persediaan" -->
        <!--     id="btn-add-persediaan"> Tambah Persediaan</button> -->

    </div>
    <div class="card-body">
        <div id="table_persediaan_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_pesanan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_pesanan_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Tanggal Pesan
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Nama
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Alamat
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Nama Produk</th>
                                <!-- <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1"> -->
                                <!--     Total Harga (Rp.) -->
                                <!-- </th> -->
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Nota</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Status</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pesanan as $item)
                            <tr>
                                <td> {{ $item->tanggal }}</td>
                                <td> {{ $item->user->name }}</td>
                                <td></td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td>
                                    <form action="{{ route('admintoko.nota') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id_transaksi">
                                        <button class="btn btn-sm btn-primary {{ $item->status == 'pending' ||
                                        $item->status == 'ditolak' ? 'disabled' : '' }}">Cetak</button>
                                    </form>
                                </td>
                                <td>
                                    @if ($item->status === 'pending')
                                    <span class="badge bg-primary">{{ $item->status }}</span>
                                    @elseif($item->status === 'diproses')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                    @elseif($item->status === 'dikirim')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                    @elseif($item->status === 'ditolak')
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success btn-setujui-pesanan" data-toggle="modal"
                                            data-target="#" data-id-transaksi="{{ $item->id }}">Setujui</button>
                                        <button class="btn btn-sm btn-warning btn-kirim-pesanan"
                                            data-id-transaksi="{{ $item->id }}">Dikirim</button>
                                        <button class="btn btn-sm btn-danger btn-tolak-pesanan"
                                            data-id-transaksi="{{ $item->id }}">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="table_persediaan_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal-add-persediaan - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-add-persediaan" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-add-persediaan">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama-produk">Nama Produk</label>
                        <select name="id_produk" id="nama-produk" class="form-control">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <input type="month" name="periode" id="periode" class="form-control" min="0"
                            placeholder="Periode">
                    </div>

                    <!-- <div class="form-group"> -->
                    <!--     <label for="stock">Stok</label> -->
                    <!--     <input type="number" name="stock" id="stock" class="form-control" min="0" -->
                    <!--         placeholder="Stok Produk"> -->
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <!--     <label for="stock-min">Stok Minimal</label> -->
                    <!--     <input type="number" name="stock_min" id="stock-min" class="form-control" min="0" -->
                    <!--         placeholder="Stok Minimal"> -->
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <!--     <label for="stock-max">Stok Maksimal</label> -->
                    <!--     <input type="number" name="stock_max" id="stock-max" class="form-control" min="0" -->
                    <!--         placeholder="Stok Minimal"> -->
                    <!-- </div> -->

                    <div class="form-group">
                        <label for="lead-time">Waktu Tunggu</label>
                        <input type="number" name="lead_time" id="lead-time" class="form-control" min="0"
                            placeholder="Waktu Tunggu">
                    </div>

                    <div class="form-group">
                        <label for="rata-rata-penggunaan">Rata-rata penggunaan</label>
                        <input type="number" class="form-control" name="rata_rata_penggunaan" id="rata-rata-penggunaan"
                            placeholder="Rata-rata penggunaan" min="0">
                    </div>

                    <div class="form-group">
                        <label for="biaya-penyimpanan">Biaya Penyimpanan</label>
                        <input type="number" class="form-control" name="biaya_penyimpanan" id="biaya-penyimpanan"
                            placeholder="Biaya Penyimpanan" min="0">
                    </div>

                    <div class="form-group">
                        <label for="biaya-pemesanan">Biaya Pemesanan</label>
                        <input type="number" class="form-control" name="biaya_pemesanan" id="biaya-pemesanan"
                            placeholder="Biaya Pemesanan" min="0">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-add-persediaan -->

<!-- modal-update-persediaan - modal untuk menampilkan form tambah data produk -->
<div class="modal fade show" id="modal-update-persediaan" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Persediaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-update-persediaan">
                @csrf
                <div class="modal-body">

                    <input type="hidden" id="id-persediaan" disabled>

                    <div class="form-group">
                        <label for="nama-produk">Nama Produk</label>

                        <!-- <select name="id_produk" id="nama-produk" class="form-control"> -->
                        <!-- </select> -->
                        <input type="text" name="id_produk" id="nama-produk" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0"
                            placeholder="Stok Produk" readonly>
                    </div>

                    <!-- <div class="form-group"> -->
                    <!--     <label for="stock-min">Stok Minimal</label> -->
                    <!--     <input type="number" name="stock_min" id="stock-min" class="form-control" min="0" -->
                    <!--         placeholder="Stok Minimal"> -->
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <!--     <label for="stock-max">Stok Maksimal</label> -->
                    <!--     <input type="number" name="stock_max" id="stock-max" class="form-control" min="0" -->
                    <!--         placeholder="Stok Minimal"> -->
                    <!-- </div> -->

                    <div class="form-group">
                        <label for="lead-time">Waktu Tunggu</label>
                        <input type="number" name="lead_time" id="lead-time" class="form-control" min="0"
                            placeholder="Waktu Tunggu">
                    </div>

                    <div class="form-group">
                        <label for="rata-rata-penggunaan">Rata-rata penggunaan</label>
                        <input type="number" class="form-control" name="rata_rata_penggunaan" id="rata-rata-penggunaan"
                            placeholder="Rata-rata penggunaan" min="0">
                    </div>

                    <div class="form-group">
                        <label for="biaya-penyimpanan">Biaya Penyimpanan</label>
                        <input type="number" class="form-control" name="biaya_penyimpanan" id="biaya-penyimpanan"
                            placeholder="Biaya Penyimpanan" min="0">
                    </div>

                    <div class="form-group">
                        <label for="biaya-pemesanan">Biaya Pemesanan</label>
                        <input type="number" class="form-control" name="biaya_pemesanan" id="biaya-pemesanan"
                            placeholder="Biaya Pemesanan" min="0">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-update-persediaan -->
@endsection

@section('custom-script')

<script>

    $(document).ready(() => {

        $('.btn-setujui-pesanan').click(function () {
            // TODO: jika telah disetujui maka disabled tombol Setujui

            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'diproses'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        $('.btn-kirim-pesanan').click(function () {
            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'dikirim'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        $('.btn-tolak-pesanan').click(function () {
            let idTransaksi = $(this).data('id-transaksi');

            $.ajax({
                url: `{{ route('transaksi.update', '')}}/${idTransaksi}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': 'ditolak'
                },
                success: function (data) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(() => window.location.reload());
                },
                error: function (error) {
                    console.log(error)
                }

            });
        });

        // $('.btn-cetak-nota').click(function () {
        //     let idTransaksi = $(this).data('id-transaksi');
        //
        //     $.ajax({
        //         url: '{{ route('admintoko.nota')}}',
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             'id_transaksi': idTransaksi,
        //         },
        //         success: function (data) {
        //             console.log('success');
        //             window.location.reload();
        //         },
        //         error: function (error) {
        //             console.log(error)
        //
        //         }
        //     })
        // });

    });
</script>

<script>
    $(function () {

        $('#table_pesanan').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>
@endsection
