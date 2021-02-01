<?php

namespace Database\Factories;

use App\Models\RentalOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RentalOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'make' => $this->faker->word(),
        ];
    }
}
