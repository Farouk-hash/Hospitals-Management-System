<?php

namespace Database\Factories;

use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\Image;
use Illuminate\Database\Eloquent\Factories\Factory;


class ImageFactory extends Factory
{
    protected $model = Image::class ; 
    public function definition(): array
    {
        $doctors = Doctor::pluck('id')->toArray() ;
        return [
            'url'=>$this->faker->url , 
            'imageable_id'=> $this->faker->randomElement($doctors),
            'imageable_type'=>'App\Models\Dashboard\Doctor'
        ];
    }
}
