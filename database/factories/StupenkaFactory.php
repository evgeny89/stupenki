<?php

namespace Database\Factories;

use App\Models\Stupenka;
use Illuminate\Database\Eloquent\Factories\Factory;

class StupenkaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stupenka::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'count' => $this->faker->numberBetween(10, 1000),
            'location' => $this->faker->address(),
        ];
    }
}
