<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_bahan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bahan')->unsigned();
            $table->date('tgl_transaksi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('qty');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_bahan');
    }
};
