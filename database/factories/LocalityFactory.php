<?php

namespace Database\Factories;

use App\Models\Locality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\support\Str;

class LocalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Locality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->city;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
