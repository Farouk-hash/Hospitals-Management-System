<?php

namespace Database\Seeders;

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
        
        Doctor::factory()->count(20)->create();
    }
}
