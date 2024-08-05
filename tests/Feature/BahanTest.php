<?php

namespace Tests\Feature;

use App\Models\Bahan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BahanTest extends TestCase
{

    public function test_halaman_database_dapat_ditampilkan_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->get('/database');
        
        $response->assertStatus(200);
    }
    
    public function test_user_dapat_menambahkan_bahan()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
        ->post('/bahan', [
            'nama_bahan'=> 'Terigu',
            'satuan_bahan'=> 'Kg',
            'stok_bahan'=> 0,
        ]);
    
        $response->assertRedirect();
    }

    public function test_user_dapat_menghapus_bahan()
    {
        $user = User::factory()->create();
        $bahan = Bahan::factory()->create();
        $response = $this->actingAs($user)
        ->delete('/bahan', [
            'bahan'=> $bahan,
        ]);
        $response->assertRedirect();
    }
}
