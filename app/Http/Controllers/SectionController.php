<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramSemesterSection;
use App\Models\Section;
use Exception;
use DB;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public function sectionList() {
        $data = [];
        $data['title'] = 'Section List';
        $data['menu_active_tab'] = 'section-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
            $data['rows'] = Section::orderBy('id', 'desc')->get();
//dd($data['programs']);
        return view('admin.section.list')->with($data);
    }


    public function addSection(Request $request) {
        $data = [];
        $data['title'] = 'Add section';
        $data['menu_active_tab'] = 'section-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
        $data['rows'] = Section::orderBy('id', 'desc')->get();
        return view('admin.section.add')->with($data);
    }

    public function storeSection(Request $request) {

        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:sections,title',
            'seat' => 'nullable|numeric',
            'programs' => 'required',
            'semesters' => 'required',
            'items' => 'required',
        ]);

       
        try{
            // Insert Data
            DB::beginTransaction();
            $section = new Section;
            $section->title = $request->title;
            $section->seat = $request->seat;
            $section->save();

            
            // Insert Or Update Data
            foreach($request->items as $item){

                $programSemesterSection = ProgramSemesterSection::updateOrCreate(
                [
                    'program_id' => $request->programs[$item - 1],  
                    'semester_id' => $request->semesters[$item - 1], 
                    'section_id' => $section->id
                ],[
                    'program_id' => $request->programs[$item - 1],  
                    'semester_id' => $request->semesters[$item - 1], 
                    'section_id' => $section->id
                ]);
            }
                DB::commit();
                return redirect()->route('section-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('section-list')->with('failed', 'Record not added.');
            }
        }

        public function editSection(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Section';
            $data['menu_active_tab'] = 'Section-list';
            if ($id) {
                $section = Section::find($id);
                $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')->get();

                $data['section'] = Section::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($section) {
                    $data['section'] = $section;
                    
                    
                    return view('admin.section.edit')->with($data);
                } else {
                    return redirect()->route('section-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('section-list')->with('failed', 'Record not found.');
            }
        }
        public function updateSection(Request $request, $id) {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:sections,title,'.$id,
            'seat' => 'nullable|numeric',
            'programs' => 'required',
            'semesters' => 'required',
            'items' => 'required',
        ]);
         // Your existing logic to update the record
         $data = Section::find($id);
        try{
            // Update Data
            DB::beginTransaction();
            $data->title = $request->title;
            $data->seat = $request->seat;
            $data->status = $request->status;
            $data->save();


            // Delete Data
            $data->programSemesters()->delete();

            // Insert Or Update Data
            foreach($request->items as $item){

                $programSemesterSection = ProgramSemesterSection::updateOrCreate(
                [
                    'program_id' => $request->programs[$item - 1],  
                    'semester_id' => $request->semesters[$item - 1], 
                    'section_id' => $data->id
                ],[
                    'program_id' => $request->programs[$item - 1],  
                    'semester_id' => $request->semesters[$item - 1], 
                    'section_id' => $data->id
                ]);
            }
            DB::commit();

            // Redirect or respond accordingly
         return redirect()->route('section-list')->with('success', 'Section updated successfully');
        }
        catch(Exception $e){
            
            // Redirect or respond accordingly
            return redirect()->route('section-list')->with('failed', 'Section not updated.');
        }
         
    }
         
         public function deleteBatch($id) {
             if ($id) {
                 $batch = Batch::find($id);
                 if ($batch) {
                     $batch->is_deleted = '1';
                     
                     $batch->save();
                 }
                 return redirect()->route('batch-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('batch-list')->with('failed', 'Record not found.');
             }
         }
}
