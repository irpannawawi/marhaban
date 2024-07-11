<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bahan>
 */
class BahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));
        return [
            'nama_bahan'=> $faker->dairyName(), 
            'stok_bahan'=> $faker->numberBetween(0, 100),
            'satuan_bahan'=>'kg',
        ];
    }
}
