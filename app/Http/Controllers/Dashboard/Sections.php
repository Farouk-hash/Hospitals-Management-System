<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class Sections extends Controller
{
    
    private $section ; 
    public function __construct(SectionRepositoryInterface $section){
        $this->section = $section ;
    }
    public function index(){
        return $this->section->index();
    }
    public function store(Request $request){
        return $this->section->store($request);
    }
    public function update(Request $request){
        return $this->section->update($request);
    }
    public function destroy(Request $request){
        return $this->section->destroy($request);
    }
}
