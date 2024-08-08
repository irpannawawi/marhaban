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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        DB::table('pengaturans')->insert([
            ['key'=> 'gpt-key','value'=> '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',],
            ['key'=> 'gpt-version','value'=> ''],
            ['key'=> 'gpt-prompt','value'=> '',],
            ['key'=> 'nama_toko','value'=> '',],
            ['key'=> 'alamat_toko','value'=> '',],
            ['key'=> 'kontak_toko','value'=> '',],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
