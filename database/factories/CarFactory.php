<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'placas_vehiculo' => $this->faker->regexify('[A-Z]{3}[0-9]{4}'),
            'modelo' => $this->faker->state(),
            'marca' => $this->faker->city(),
            'año' => $this->faker->year(),
            'tipo' => $this->faker->randomElement(["Oficial", "Resident"])
        ];
    }
}
