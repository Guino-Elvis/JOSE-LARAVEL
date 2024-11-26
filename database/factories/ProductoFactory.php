<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->text(50),
            'precio' => $this->faker->randomFloat(2, 10, 1000), 
            'stock' => $this->faker->numberBetween(0, 100),
            'activo' => $this->faker->randomElement([1]),
            'sku' => $this->faker->unique()->regexify('SKU-[A-Z0-9]{5}'),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
