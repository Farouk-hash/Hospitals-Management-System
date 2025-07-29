<?php 
namespace Database\Factories;

use App\Models\Dashboard\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorFactory extends Factory
{
    protected $model = Doctor::class ;
    public function definition(): array
    {

        return [
            'name'=>$this->faker->unique()->name , 
            'email'=>$this->faker->unique()->safeEmail , 
            'times'=>$this->faker->randomElement(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'password'=>$this->faker->password ,
        ];
    }
}  