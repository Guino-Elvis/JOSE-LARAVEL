<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = Producto::factory(120)->create();

        foreach ($produtos as $produto) {
            Image::factory(1)->create([
                'imageable_id' => $produto->id,
                'imageable_type' => Producto::class
            ]);
        }
    }
}
