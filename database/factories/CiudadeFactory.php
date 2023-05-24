<?php

namespace Database\Factories;

use App\Models\Ciudade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CiudadeFactory extends Factory
{
    protected $model = Ciudade::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'codigo_postal' => $this->faker->name,
        ];
    }
}
