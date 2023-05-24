<?php

namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocenteFactory extends Factory
{
    protected $model = Docente::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'especialidad' => $this->faker->name,
			'telefono' => $this->faker->name,
			'email' => $this->faker->name,
        ];
    }
}
