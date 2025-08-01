<?php

namespace Database\Seeders;

use App\Models\Dashboard\Appointment;
use App\Models\Dashboard\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $doctors = Doctor::factory()->count(20)->create();
        
        $appointments_array = Appointment::inRandomOrder()->limit(3)->pluck('id')->toArray();
        $doctors->each(function($doctor)use($appointments_array){
            $doctor->appointments()->attach($appointments_array);

        });
    }
}
