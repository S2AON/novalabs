<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'chasis' => $this->faker->word(),
            'category' => $this->faker->randomElement(['SUV','SEDAN','4x4']),
            'transmission' => $this->faker->randomElement(['A','M']),
            'passenger_capacity' => $this->faker->randomDigit(5),
            'trunk_capacity' => $this->faker->randomDigit(3),
            'features' => $this->faker->text(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomDigit(),
            'status' => false,
        ];
    }
}
