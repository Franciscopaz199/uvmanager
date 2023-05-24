<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LibroFactory extends Factory
{
    protected $model = Libro::class;

    public function definition()
    {
        return [
			'titulo' => $this->faker->name,
			'autor' => $this->faker->name,
        ];
    }
}
