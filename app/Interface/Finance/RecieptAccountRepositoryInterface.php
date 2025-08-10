<?php

namespace App\Interface\Finance;

use Illuminate\Http\Request;

interface RecieptAccountRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit(int $receiept_account_id);
    public function update(Request $request);
    public function destroy(Request $request);
    public function show(int $receiept_account_id);
}
