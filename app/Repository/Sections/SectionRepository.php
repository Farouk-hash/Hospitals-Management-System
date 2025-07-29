<?php 
namespace App\Repository\Sections ;

use App\Interface\Sections\SectionRepositoryInterface;
use App\Models\Dashboard\Section;


class SectionRepository implements SectionRepositoryInterface{

    public function index(){
        // $sections = Section::all();
        $sections = Section::all();
        // dd($sections[0]->translation);
        return view('dashboard.sections.index' , compact('sections'));
    }
    public function store($request){
        $name = $request->input('name');
        Section::create(['name'=>$name]);
        return redirect()->route('dashboard.sections.index');
    }
    public function update($request){
        $sectionID = $request->input('id');
        $section = Section::findOrFail($sectionID);
        $sectionName = $request->input('name');
        $section->update(['name'=>$sectionName]);
        return redirect()->route('dashboard.sections.index');
    }
    public function destroy($request){
        $sectionID = $request->input('id');
        $section = Section::findOrFail($sectionID);
        $section->delete();
        return redirect()->route('dashboard.sections.index');
    }
}