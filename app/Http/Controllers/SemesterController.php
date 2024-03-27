<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Semester;
use Exception;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //
    public function semesterList() {
        $data = [];
        $data['title'] = 'Semester List';
        $data['menu_active_tab'] = 'semester-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
            $data['rows'] = Semester::orderBy('id', 'desc')->get();
//dd($data['programs']);
        return view('admin.semester.list')->with($data);
    }


    public function addSemester(Request $request) {
        $data = [];
        $data['title'] = 'Add semester';
        $data['menu_active_tab'] = 'semester-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
        $data['rows'] = Semester::orderBy('id', 'desc')->get();
        return view('admin.semester.add')->with($data);
    }

    public function storeSemester(Request $request) {

        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:semesters,title',
            'year' => 'required',
            'programs' => 'required',
        ]);

       
         // Insert Data
            try {
               
                $semester = new Semester;
               
                $semester->title = $request->title;
                $semester->year = $request->year;
                $semester->save();
        
                $semester->programs()->attach($request->programs);
        
                        
                return redirect()->route('semester-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('semester-list')->with('failed', 'Record not added.');
            }
        }
        public function editSemester(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Semester';
            $data['menu_active_tab'] = 'Semester-list';
            if ($id) {
                $semester = Semester::find($id);
                $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')->get();

                $data['semester'] = Semester::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($semester) {
                    $data['semester'] = $semester;
                    
                    
                    return view('admin.semester.edit')->with($data);
                } else {
                    return redirect()->route('semester-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('semester-list')->with('failed', 'Record not found.');
            }
        }
        public function updateSemester(Request $request, $id) {
            //field validation
            $request->validate([
                'title' => 'required|max:191|unique:semesters,title,'.$id,
                'year' => 'required',
                'programs' => 'required',
            ]);

            // Your existing logic to update the record
            $data = Semester::find($id);

            // Update Data
            $data->title = $request->title;
            $data->year = $request->year;
            $data->status = $request->status;
            $data->save();

            $data->programs()->sync($request->programs);
     
         // Redirect or respond accordingly
         return redirect()->route('semester-list')->with('success', 'Semester updated successfully');
             }
         
         public function deleteSemester($id) {
             if ($id) {
                $semester = Semester::find($id);
                 if ($semester) {
                    $semester->is_deleted = '1';
                     
                    $semester->save();
                 }
                 return redirect()->route('semester-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('semester-list')->with('failed', 'Record not found.');
             }
         }
}
