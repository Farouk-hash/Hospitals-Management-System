<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceValidatedRequest;
use App\Interface\Services\ServicesRepositoryInterface;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected $serviceInterface ;
    public function __construct(ServicesRepositoryInterface $serviceInterface){
        $this->serviceInterface = $serviceInterface ; 
    }
    public function index(){
        return $this->serviceInterface->index();
    }
    public function store(ServiceValidatedRequest $request){
        return $this->serviceInterface->store($request);
    }
    public function update(Request $request){
        return $this->serviceInterface->update($request);
    }
    public function destroy(Request $request){
        return $this->serviceInterface->destroy($request);
    }
}
