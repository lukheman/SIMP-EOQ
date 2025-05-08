@extends('layouts.main')

@section('title', 'Admin Gudang')

@section('sidebar-menu')

@include('admin_gudang.menu')

@endsection

@section('content')

<x-produk.persediaan-produk />

@endsection

@section('custom-script')
<script>
$(document).ready(function() {

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
