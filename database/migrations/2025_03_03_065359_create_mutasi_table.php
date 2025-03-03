<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// mutasi berfungsi untuk mencatat log pemasukan dan pengeluaran barang
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->nullOnDelete();
            $table->integer('jumlah');
            $table->date('tanggal')->default(DB::raw('CURRENT_DATE'));
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
