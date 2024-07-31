<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_id' => Website::factory(),
            'revenue' => $this->faker->randomFloat(2, 0, 10000),
            'impressions' => $this->faker->numberBetween(1000, 100000),
            'clicks' => $this->faker->numberBetween(100, 10000),
            'date' => $this->faker->date('Y-m-d'),
        ];
    }
}
