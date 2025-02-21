@extends('layouts.main')

@section('title', 'Toko Kecil')

@section('sidebar-menu')
@include('reseller.menu')
@endsection

@section('content')
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <div id="table_pesanan_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">


                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <!-- TODO: buat menjadi lebih estetik -->
                    <table id="table_pesanan" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="table_pesanan_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="table_pesanan" rowspan="1"
                                    colspan="1" aria-sort="ascending">Tanggal
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Nama Produk</th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Jumlah
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Total Harga (Rp.)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="table_pesanan" rowspan="1" colspan="1">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pesanan as $item)
                            <tr>
                                <td> {{ $item->tanggal }}</td>
                                <td> {{ $item->produk->nama_produk }}</td>
                                <td> {{ $item->jumlah }}</td>
                                <td> {{ number_format($item->harga, 0, ',', '.')}}</td>
                                <td> {{ $item->status }}</td>
                                <!-- <td> -->
                                <!--     <div class="btn-group"> -->
                                <!--         <button class="btn btn-sm btn-primary btn-update-produk" data-toggle="modal" -->
                                <!--             data-target="#modalUpdateProduk" -->
                                <!--             data-id-produk="{{ $item->id }}">Edit</button> -->
                                <!--         <button class="btn btn-sm btn-danger btn-delete-produk" -->
                                <!--             data-id-produk="{{ $item->id }}">Hapus</button> -->
                                <!--     </div> -->
                                <!-- </td> -->
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
                    <div class="dataTables_paginate paging_simple_numbers" id="table_pesanan_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
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
