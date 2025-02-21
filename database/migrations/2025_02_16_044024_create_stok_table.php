<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto-increment)
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade'); // Foreign Key ke barang
            $table->integer('jumlah_masuk')->default(0); // Jumlah stok masuk (default: 0)
            $table->integer('jumlah_keluar')->default(0); // Jumlah stok keluar (default: 0)
            $table->integer('stok_akhir'); // Stok akhir setelah transaksi
            $table->date('tanggal'); // Tanggal pencatatan stok
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
