<?php

namespace App\Console\Commands;

use App;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;

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
        $users = Admin::select(['id','name','email','email_verified_at'])->get();
        $rows = $users->map(function($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->email_verified_at,
                ];
            })->toArray();
        $this->table(
            ['id','name','email','email_verified_at'],
                $rows        
            );
        dd([
            'App Locale' => App::getLocale(),
            'Session Locale' => session('locale'),            
        ]);

    }
}
