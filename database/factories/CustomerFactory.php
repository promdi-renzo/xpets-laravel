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
            "first_name" => $this->faker->name,
            "last_name"  => $this->faker->name,
            "phone_number" => $this->faker->numerify('###-###-####'),
            'images' => $this->faker->image('public/uploads/customers', 640, 480, null, false),
        ];
    }
}
