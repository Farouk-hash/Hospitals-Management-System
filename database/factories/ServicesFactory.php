<?php

namespace Database\Factories;

use App\Models\Dashboard\Services;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ServicesFactory extends Factory
{
    protected $model = Services::class ; 

    public function definition(): array
    {
        DB::table('services')->delete();
        return [
            'name'=>$this->faker->unique()->name , 
            'price'=>$this->faker->randomFloat(8,1,8),
            'status'=>$this->faker->randomElement([true,false])
        ];
    }
}
