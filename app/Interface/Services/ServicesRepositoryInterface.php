<?php

namespace App\Interface\Services;

use App\Http\Requests\ServiceValidatedRequest;
use Illuminate\Http\Request;

interface ServicesRepositoryInterface
{
    public function index();
    public function find($id);
    public function store(ServiceValidatedRequest $request);
    public function update(Request $request);
    public function destroy(Request $request);
}