<?php

namespace Database\Factories;

use App\Models\Dashboard\Section;
use Illuminate\Database\Eloquent\Factories\Factory;


class SectionFactory extends Factory
{
    protected $model = Section::class ; 
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name ,
        ];
    }
}
