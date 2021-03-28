<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => $this->faker->companyEmail,
            'line' => $this->faker->domainWord,
            'trainee' => $this->faker->numberBetween($min = 1, $max = 3000),
            'confidence' => $this->faker->randomDigit+1,
        ];
    }
}
