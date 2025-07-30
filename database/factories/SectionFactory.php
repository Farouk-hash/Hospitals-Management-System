<?php

namespace Database\Factories;

use App\Models\Dashboard\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class SectionFactory extends Factory
{
    protected $model = Section::class ; 
    public function definition(): array
    {
        DB::table('sections')->delete();

        return [
            'name'=>$this->faker->name ,
            'description'=>$this->faker->text(100) , 
        ];
    }
}
