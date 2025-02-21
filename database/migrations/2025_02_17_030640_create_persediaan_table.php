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
        Schema::create('persediaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->onDelete('cascade');
            // $table->integer('stock');
            $table->date('periode');
            $table->integer('lead_time');
            $table->integer('reorder_point')->default(0);
            $table->integer('safety_stock')->default(0);
            $table->integer('eoq')->default(0);
            $table->integer('rata_rata_penggunaan');
            $table->decimal('biaya_penyimpanan', 10, 2);
            $table->decimal('biaya_pemesanan', 10, 2);
            $table->integer('pembelian')->default(0);
            $table->integer('penggunaan')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan');
    }
};
