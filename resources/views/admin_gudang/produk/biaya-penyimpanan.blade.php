@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">

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
                            <tr class="text-center">
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Biaya Penyimpanan (Rp.)</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                            <tr>
                                <td class="text-center"> {{ $item->kode_produk }}</td>
                                <td> {{ $item->nama_produk }}</td>
                                <td class="text-center"> {{  number_format($item->biayaPenyimpanan->biaya, 0, ',', '.') }}</td>
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

<script>

    $(document).ready(function () {

    });



</script>
@endsection
