<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'=>$this->faker->unique()->numerify('COD######'),
            'name'=>$this->faker->word(),
            'description'=>$this->faker->text(50),
//            'price'=>$this->faker->numberBetween(1,10000),
            'price'=>$this->faker->randomNumber(6),
            'maker'=>$this->faker->company(),
            'quantity'=>$this->faker->randomNumber(4),
            'state'=>$this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
