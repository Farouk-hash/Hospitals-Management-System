<?php

namespace App\Console\Commands;

use App;
use App\Http\Controllers\Dashboard\Sections;
use App\Models\Admin;
use App\Models\Dashboard\Ambulance;
use App\Models\Dashboard\Appointment;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\DoctorTranslation;
use App\Models\Dashboard\Image;
use App\Models\Dashboard\Section;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // //     );
        // $doctor = Doctor::with(['section'])->find('96');
        // var_dump($doctor->section->name);
        // echo Str::slug('farouk-Ahmed');
        // var_dump(Appointment::all());
        // $doctors = Doctor::find(369);
        // var_dump($doctors->appointments[3]->name);
            $ambulance = Ambulance::with('translations.carType')->find(6);
            $translation = $ambulance->translate('ar');

            // get the relation query (carType() returns a query builder)
            $query = $translation->carType();

            // get SQL and bindings
            $sql = $query->toSql();
            $bindings = $query->getBindings();

            // merge them for readability
            $finalSql = vsprintf(str_replace('?', "'%s'", $sql), $bindings);

            // print the full query
            dd($query->name);
    }
}
