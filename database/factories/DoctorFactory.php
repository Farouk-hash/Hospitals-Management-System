<?php 
namespace Database\Factories;

use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\Section;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorFactory extends Factory
{
    protected $model = Doctor::class ;
    public function definition(): array
    {
        $sections = Section::pluck('id')->toArray();
        return [
            'name'=>$this->faker->unique()->name , 
            'email'=>$this->faker->unique()->safeEmail , 
            'times'=>$this->faker->randomElement(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'password'=>$this->faker->password ,
            'section_id'=> $this->faker->randomElement($sections),
            'phone'=>$this->faker->phoneNumber(),
            'status'=>$this->faker->randomElement([true,false]),
        ];
    }
}  