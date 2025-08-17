<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interface\Interface_Doctors_Panel\raysRepostioryInterface;
use Illuminate\Http\Request;

class RaysController extends Controller
{
    protected $rayRepositoryInterface ;
    public function __construct(raysRepostioryInterface $rayRepositoryInterface){
        $this->rayRepositoryInterface = $rayRepositoryInterface ; 
    }
    public function index(){
        return $this->rayRepositoryInterface->index();
    }
    public function edit(int $ray_id){
        return $this->rayRepositoryInterface->edit($ray_id);
    }
    public function update(Request $request){
        return $this->rayRepositoryInterface->update($request);
    }
    public function destroy(Request $request){
        return $this->rayRepositoryInterface->destroy($request);
    } 
    public function show_ray_images(int $ray_id){
        return $this->rayRepositoryInterface->show_ray_images($ray_id);
    }
}
