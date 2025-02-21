@extends('layouts.main')

@section('title', 'Admin Toko')

@section('sidebar-menu')
@include('admin_toko.menu')
@endsection

@section('content')


<div class="card">
    <div class="card-header">

        <div class="btn btn-primary">Tambah Produk</div>

    </div>
    <div class="card-body">
        <div id="table_persediaan_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <!-- <div class="dt-buttons btn-group flex-wrap"> <button -->
                    <!--         class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="table_persediaan" -->
                    <!--         type="button"><span>Copy</span></button> <button -->
                    <!--         class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="table_persediaan" -->
                    <!--         type="button"><span>CSV</span></button> <button -->
                    <!--         class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="table_persediaan" -->
                    <!--         type="button"><span>Excel</span></button> <button -->
                    <!--         class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="table_persediaan" -->
                    <!--         type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" -->
                    <!--         tabindex="0" aria-controls="table_persediaan" type="button"><span>Print</span></button> -->
                    <!--     <div class="btn-group"><button -->
                    <!--             class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" -->
                    <!--             aria-controls="table_persediaan" type="button" aria-haspopup="true"><span>Column -->
                    <!--                 visibility</span><span class="dt-down-arrow"></span></button></div> -->
                    <!-- </div> -->

                </div>
                <div class="col-sm-12 col-md-6">
                    <!-- <div id="table_persediaan_filter" class="dataTables_filter"><label>Search:<input type="search" -->
                    <!--             class="form-control form-control-sm" placeholder="" aria-controls="table_persediaan"></label> -->
                    <!-- </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_persediaan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_persediaan_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_persediaan"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Nama Produk</th>
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">Alamat
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1" aria-label="Engine version: activate to sort column ascending">Tanggal
                                    Pesan
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1">Nota
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1" aria-label="Engine version: activate to sort column ascending">
                                    Konfirmasi Pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sepatu</td>
                                <td>Bombana</td>
                                <td>10-10-2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Cetak</button>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary">Ya</button>
                                        <button class="btn btn-sm btn-danger">Tidak</button>
                                    </div>
                                </td>
                            </tr>
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
@endsection
