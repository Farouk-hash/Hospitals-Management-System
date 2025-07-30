<?php 
namespace App\Repository\Sections ;

use App\Interface\Sections\SectionRepositoryInterface;
use App\Models\Dashboard\Section;


class SectionRepository implements SectionRepositoryInterface{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        // $sections = Section::all();
        $sections = Section::all();
        // dd($sections[0]->translation);
        return view('dashboard.sections.index' , compact('sections'));
    }
    /**
     * Summary of store
     * @param mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($request){
        $name = $request->input('name');
        $description = $request->input('description');
        Section::create(['name'=>$name , 'description'=>$description]);
        return redirect()->route('dashboard.sections.index');
    }
    /**
     * Summary of update
     * @param mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($request){
        $sectionID = $request->input('id');
        $section = Section::findOrFail($sectionID);
        $sectionName = $request->input('name');
        $sectionDescription = $request->input('description');
        $section->update(['name'=>$sectionName, 'description'=>$sectionDescription]);
        return redirect()->route('dashboard.sections.index');
    }
    /**
     * Summary of destroy
     * @param mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($request){
        $sectionID = $request->input('id');
        $section = Section::findOrFail($sectionID);
        $section->delete();
        return redirect()->route('dashboard.sections.index');
    }
}