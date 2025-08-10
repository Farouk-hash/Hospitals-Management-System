<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interface\Interface_Doctors_Panel\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public $invoicesRepositoryInterface ; 
    public function __construct(InvoicesRepositoryInterface $invoicesRepositoryInterface){
        $this->invoicesRepositoryInterface = $invoicesRepositoryInterface ; 
    }
    public function index(){
        return $this->invoicesRepositoryInterface->index();
    }
}
