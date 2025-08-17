<?php 

namespace App\Interface\Interface_Doctors_Panel;

use Illuminate\Http\Request;

interface raysRepostioryInterface{

    public function index();
    public function edit(int $ray_id);
    
    public function update(Request $request);
    public function destroy(Request $request);
    public function show_ray_images(int $ray_id);
}