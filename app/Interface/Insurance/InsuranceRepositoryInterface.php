<?php

namespace App\Interface\Insurance;

use App\Http\Requests\InsuranceRequest;
use Illuminate\Http\Request;

interface InsuranceRepositoryInterface
{
    public function index();
    public function store(InsuranceRequest $request);
    public function update(InsuranceRequest $request);
    public function destroy(Request $request);
}
