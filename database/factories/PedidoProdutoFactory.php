<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'produto_id' => $this->faker->numberBetween(1, 100),
            'quantidade' => $this->faker->numberBetween(1, 60)
        ];
    }
}
