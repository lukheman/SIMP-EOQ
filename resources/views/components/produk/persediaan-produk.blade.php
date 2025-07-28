<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                </div>
                <div class="col-sm-12 col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="datatable_info">
                        <thead>
                            <tr class="text-center">

                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga Beli/bal (Rp.)</th>
                                <th>Harga Jual/bal (Rp.)</th>
                                <th>Persediaan (pcs)</th>
                                <th>Persediaan (bal)</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                            <tr>
                                <td class="text-center"> {{ $item->kode_produk }}</td>
                                <td> {{ $item->nama_produk }}</td>
                                <td class="text-right"> {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td class="text-right"> {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                <td class="text-center"> {{ $item->persediaan->jumlah }}</td>
                                <td class="text-center"> {{ $item->persediaan->jumlah/$item->tingkat_konversi }}</td>
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
                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
