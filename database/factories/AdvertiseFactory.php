<?php

namespace Database\Factories;

use App\Models\Advertise;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertiseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(200),
            'description' => $this->faker->realText(1000),
            'price' => $this->faker->unique()->numberBetween(400000, 1000000),
            'user_id' => 1,
            'category_id' => 1,
        ];
    }
}
