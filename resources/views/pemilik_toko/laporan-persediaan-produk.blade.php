@extends('layouts.main')

@section('title', 'Pemilik Toko')

@section('sidebar-menu')

@include('pemilik_toko.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">



        <a href="{{ route('pemiliktoko.cetak-laporan-persediaan-produk') }}" class="btn btn-primary"
            id="btn-cetak-laporan-persediaan-produk">Cetak Laporan Persediaan Produk</a>


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
                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1">Nama Produk</th>

                                <th class="sorting" tabindex="0" aria-controls="table_persediaan" rowspan="1"
                                    colspan="1">Persediaan</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                            <tr>
                                <td> {{ $item->nama_produk }}</td>
                                <td> {{ $item->persediaan }}</td>

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
