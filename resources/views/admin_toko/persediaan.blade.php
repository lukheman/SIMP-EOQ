@extends('layouts.main')

@section('title', 'Admin Toko')

@section('sidebar-menu')

@include('admin_toko.menu')

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
                    <table id="table_persediaan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_persediaan_info">
                        <thead>
                            <tr>
                                <!-- <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1" -->
                                <!--     colspan="1">Periode</th> -->
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1">Nama Produk</th>

                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1">Persediaan</th>

                                <!-- <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1" -->
                                <!--     colspan="1">Persediaan -->
                                <!-- </th> -->

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                            <tr>
                                <td> {{ $item->nama_produk }}</td>
                                <td> {{ $item->persediaan }}</td>

                                <!-- <td> {{ $item->penggunaan }}</td> -->
                                <!-- <td> {{ $item->rata_rata_penggunaan }}</td> -->
                                <!-- <td> {{ $item->biaya_penyimpanan }}</td> -->
                                <!-- <td> {{ $item->biaya_pemesanan }}</td> -->

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
    $(function () {

        $('#table_persediaan').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>



@endsection
