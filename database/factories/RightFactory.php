<?php

namespace Database\Factories;

use App\Models\Right;
use Illuminate\Database\Eloquent\Factories\Factory;

class RightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Right::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SFx1' => $this->faker->boolean,
            'SFx2' => $this->faker->boolean,
            'SFx3' => $this->faker->boolean,
            'SFx4' => $this->faker->boolean,
            'SFx5' => $this->faker->boolean,
            'SFx6' => $this->faker->boolean,
            'SFx7' => $this->faker->boolean,
            'SFx8' => $this->faker->boolean,
            'SFx9' => $this->faker->boolean,
            'SFx10' => $this->faker->boolean,
            'SFx11' => $this->faker->boolean,
            'SFx12' => $this->faker->boolean,
            'SFx13' => $this->faker->boolean,
            'SFx14' => $this->faker->boolean,
            'SFx15' => $this->faker->boolean,
            'SFx16' => $this->faker->boolean,
            'SFx17' => $this->faker->boolean,
            'SFx18' => $this->faker->boolean,
            'SFx19' => $this->faker->boolean,
            'SFx20' => $this->faker->boolean,
            'SFx21' => $this->faker->boolean,
            'SFx22' => $this->faker->boolean,
            'SFx23' => $this->faker->boolean,
            'SFx24' => $this->faker->boolean,
            'SFx25' => $this->faker->boolean,
            'SFx26' => $this->faker->boolean,
            'SFx27' => $this->faker->boolean,
            'SFx28' => $this->faker->boolean,
            'SFx29' => $this->faker->boolean,
            'SFx30' => $this->faker->boolean,
            'SFx31' => $this->faker->boolean,
            'SFx32' => $this->faker->boolean,
            'SFx33' => $this->faker->boolean,
            'SFx34' => $this->faker->boolean,
            'SFx35' => $this->faker->boolean,
        ];
    }
}
