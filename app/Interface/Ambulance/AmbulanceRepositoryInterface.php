<?php

namespace App\Interface\Ambulance;

use Illuminate\Http\Request;

interface AmbulanceRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request);
    public function destroy(Request $request);
}
