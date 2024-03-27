<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use Exception;
use Str;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    //
    public function programList() {
        $data = [];
        $data['title'] = 'Program List';
        $data['menu_active_tab'] = 'programs';
        $data['faculties'] = Faculty::where('status', '1')
        ->orderBy('title', 'asc')->get();
       
        $data['rows'] = Program::where('is_deleted','0')->orderBy('title', 'asc')->get();
        //dd($data['rows']);
        return view('admin.program.list')->with($data);
    }
    public function addProgram(Request $request) {
        $data = [];
        $data['title'] = 'Add Program';
        $data['menu_active_tab'] = 'programs';
        $data['faculties'] = Faculty::where('status', '1')
        ->orderBy('title', 'asc')->get();
        return view('admin.program.add')->with($data);
    }

    public function storeProgram(Request $request) {

        // Field Validation
        $request->validate([
            'faculty' => 'required',
            'title' => 'required|max:191|unique:programs,title',
            'shortcode' => 'required|max:191|unique:programs,shortcode',
        ]);
        
          // Insert Data
             try {
                
                  // Registration status
        if($request->registration == null || $request->registration != 1){
            $registration = 0;
        }
        else {
            $registration = 1;
        }

                // Insert Data
                $program = new Program;
                $program->faculty_id = $request->faculty;
                $program->title = $request->title;
                $program->slug = Str::slug($request->title, '-');
                $program->shortcode = $request->shortcode;
                $program->registration = $registration;
               // dd($program);
                $program->save();
                         
                 return redirect()->route('program-list')->with('success', 'Record added successfully.');
             } catch (Exception $e) {
                // dd($e);
                 return redirect()->route('program-list')->with('failed', 'Record not added.');
             }
         }

         public function editProgram(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Program';
            $data['menu_active_tab'] = 'Program-list';
            if ($id) {
                $program = Program::find($id);
                $data['program'] = Program::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($program) {
                    $data['program'] = $program;
                    
                    
                    return view('admin.program.edit')->with($data);
                } else {
                    return redirect()->route('program-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('program-list')->with('failed', 'Record not found.');
            }
        }
        public function updateProgram(Request $request, $id) {

            $request->validate([
                'faculty' => 'required',
                'title' => 'required|max:191|unique:programs,title,'.$id,
                'shortcode' => 'required|max:191|unique:programs,shortcode,'.$id,
            ]);

            // Your existing logic to update the record
         $data = Program::find($id);
         // Registration status
         if($request->registration == null || $request->registration != 1){
            $registration = 0;
        }
        else {
            $registration = 1;
        }
        
         // Update Data
         $data->faculty_id = $request->faculty;
         $data->title = $request->title;
         $data->slug = Str::slug($request->title, '-');
         $data->shortcode = $request->shortcode;
         $data->registration = $registration;
         $data->status = $request->status;
         $data->save();

     
            // Redirect or respond accordingly
            return redirect()->route('program-list')->with('success', 'Program updated successfully');
             }
         
         public function deleteProgram($id) {
             if ($id) {
                $program = Program::find($id);
                 if ($program) {
                    $program->is_deleted = '1';
                     
                    $program->save();
                 }
                 return redirect()->route('program-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('program-list')->with('failed', 'Record not found.');
             }
         }
        
}
