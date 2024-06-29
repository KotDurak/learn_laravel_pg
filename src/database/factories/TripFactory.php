<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countPoints = rand(2, 9);
        $pointsArr = [];

        for($i = 0; $i < $countPoints; $i++) {
            $pointsArr[chr($i + 65)] = [
                'street' => fake()->streetAddress,
                'lat'   => fake()->latitude,
                'lon'   => fake()->longitude,
                'house' => fake()->address,
            ];
        }

        return [
            'route' => fake(),
            'description' => fake()->text(),
            'route'  => json_encode($pointsArr),
            'status'    => fake()->randomElement(['new', 'work', 'rejected', 'completed'])
        ];
    }
}
