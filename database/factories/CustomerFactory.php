<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "full_name" => $this->faker->name,
            "number" => $this->faker->numerify('###-###-####'),
            'pictures' => $this->faker->image('public/uploads/customers', 640, 480, null, false),
        ];
    }
}
