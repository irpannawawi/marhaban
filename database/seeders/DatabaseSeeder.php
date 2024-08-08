<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            BahanSeeder::class,
            ProdukSeeder::class,
            TransaksiSeeder::class,
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'Staf Bahan',
            'email' => 'staf_bahan@gmail.com',
            'role' => 'staf_bahan',
            'password' => Hash::make('bahan'),
        ]);
        User::create([
            'name' => 'Staf Produk',
            'email' => 'staf_produk@gmail.com',
            'role' => 'staf_produk',
            'password' => Hash::make('produk'),
        ]);

    }
}
