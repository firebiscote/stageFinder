<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\support\Str;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'wage' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 3.90, $max = 25.99),
            'comment' => $this->faker->text($maxNbChars = 1000),
            'start' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'end' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'seat' => $this->faker->numberBetween($min = 1, $max = 10),
            'locality_id' => $this->faker->numberBetween($min = 1, $max = 9),
            'company_id' => $this->faker->numberBetween($min = 1, $max = 9),
        ];
    }
}
