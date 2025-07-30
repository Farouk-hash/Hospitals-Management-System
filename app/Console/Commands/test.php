<?php

namespace App\Console\Commands;

use App;
use App\Http\Controllers\Dashboard\Sections;
use App\Models\Admin;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\DoctorTranslation;
use App\Models\Dashboard\Image;
use App\Models\Dashboard\Section;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // User::create(['name'=>'Farouk' , 'email'=>'Farouk@gmail.com','password'=>123]);
        // Admin::create(['name'=>'Raffat' , 'email'=>'Raffat@gmail.com','password'=>123]);

        // represent users ; 
        // $users = User::select(['id','name','email','email_verified_at'])->get();
        // $rows = $users->map(function($user) {
        //         return [
        //             $user->id,
        //             $user->name,
        //             $user->email,
        //             $user->email_verified_at,
        //         ];
        //     })->toArray();
        // $this->table(
        //     ['id','name','email','email_verified_at'],
        //         $rows        
        //     );
        $doctor = Doctor::with(['section'])->find('96');
        var_dump($doctor->section->name);
    }
}
