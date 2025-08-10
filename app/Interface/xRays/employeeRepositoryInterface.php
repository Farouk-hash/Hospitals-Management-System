<?php

namespace App\Interface\xRays;

use App\Http\Requests\ServiceValidatedRequest;
use Illuminate\Http\Request;

interface employeeRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function destroy(Request $request);
}