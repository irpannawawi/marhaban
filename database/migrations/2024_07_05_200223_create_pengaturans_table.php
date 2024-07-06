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
            ['key'=> 'gpt-key','value'=> '',],
            ['key'=> 'gpt-version','value'=> ''],
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
