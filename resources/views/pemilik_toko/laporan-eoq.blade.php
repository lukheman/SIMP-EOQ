@extends('layouts.main')

@section('title', 'Admin Toko')

@section('sidebar-menu')

@include('admin_toko.menu')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">

                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-cetak-laporan-eoq">
                    <i class="fas fa-print"></i>
                    Cetak Laporan EOQ</button>

            </div>
            <div class="card-body">


                <div id="table_produk_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                        </div>
                        <div class="col-sm-12 col-md-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table_produk" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="table_produk_info">
                                <thead>
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Nama Produk </th>
                                        <th>Safety Stock</th>
                                        <th>ROP</th>
                                        <th>Jumlah harus dipesan (EOQ)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data_eoq as $item)
                                    <tr>
                                        <td> {{ $item['periode']}}</td>
                                        <td> {{ $item['nama_produk']}}</td>
                                        <td> {{ $item['safety_stock']}}</td>
                                        <td> {{ $item['reorder_point']}}</td>
                                        <td> {{ $item['eoq']}}</td>
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
                            <div class="dataTables_paginate paging_simple_numbers" id="table_produk_paginate">
                                <ul class="pagination">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

<div class="modal fade show" id="modal-cetak-laporan-eoq" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Periode Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('laporan-eoq') }}" method="post">
                <input type="hidden" name="ttd" value="Admin Toko">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <input type="month" class="form-control" name="periode" id="periode">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-print"></i>
                        Cetak</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <!-- end modal-cetak-laporan-penjualan -->
</div>
@endsection

@section('custom-script')

<script>

$(function () {

    $('#table_produk').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
    });

});

</script>

@endsection
