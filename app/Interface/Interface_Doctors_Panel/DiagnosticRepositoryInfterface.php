<?php 

namespace App\Interface\Interface_Doctors_Panel;

use Illuminate\Http\Request;

interface DiagnosticRepositoryInfterface{

    public function index();
    public function store(Request $request);
    public function store_diagnostic_review(Request $request);
    public function store_diagnostic_lab(Request $request);
    public function store_diagnostic_ray(Request $request);
    public function show(int $patient_id);
    public function show_ray_images(int $ray_id);
}