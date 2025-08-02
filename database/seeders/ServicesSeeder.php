<?php

namespace Database\Seeders;

use App\Models\Dashboard\Services;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Services::factory()->count(20)->create();
    }
}
