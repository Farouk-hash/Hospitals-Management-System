<?php 
namespace App\Interface\Sections ;

interface SectionRepositoryInterface{
    public function index();
    public function show(int $section_id);
    public function store($request);
    public function update($request);
    public function destroy($request);
}