<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Knjiga;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;


class KnjigaFactory extends Factory
{
    protected $model = Knjiga::class;
    public function definition()
    {
        return [
            'naslov' => $this->faker->sentence,
            'autor' => $this->faker->name,
            'godina_izdanja' => $this->faker->year,
        ];
    }
}
