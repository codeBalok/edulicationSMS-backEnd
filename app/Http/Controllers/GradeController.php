<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Toastr;

class GradeController extends Controller
{
    //
    public function gradeList() {
        $data = [];
        $data['title'] = 'Grade List';
        $data['menu_active_tab'] = 'grade-list';
        $data['grade'] = Grade::where('is_deleted', '0')->orderBy('id', 'DESC')->get();

        return view('admin.grade.list')->with($data);
    }


    public function addGrade(Request $request) {
        $data = [];
        $data['title'] = 'Add grade';
        $data['menu_active_tab'] = 'add-grade';
        return view('admin.grade.add')->with($data);
    }
    public function storeGrade(Request $request) {

        // Field Validation
        $request->validate([
            'grade' => 'required|max:191|unique:grade,grade',
            'point' => 'required|numeric|unique:grade,point',
            'min_marks' => 'required|numeric|unique:grade,min_marks',
            'max_marks' => 'required|numeric|unique:grade,max_marks',
        ]);

       
         // Insert Data
            try {
               
                $data = new Grade();
                $data->grade = $request->input('grade');
                $data->point = $request->input('point');
                $data->min_marks = $request->input('min_marks');
                $data->max_marks = $request->input('max_marks');
               
                        $data->save();
                        
                return redirect()->route('grade-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('grade-list')->with('failed', 'Record not added.');
            }
        }
    

    public function editGrade(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Grade';
        $data['menu_active_tab'] = 'Grade-list';
        if ($id) {
            $grade = Grade::find($id);
            $data['grade'] = Grade::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
           
            if ($grade) {
                $data['grade'] = $grade;
                
                
                return view('admin.grade.edit')->with($data);
            } else {
                return redirect()->route('grade-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('grade-list')->with('failed', 'Record not found.');
        }
    }
    public function updateGrade(Request $request, $id) {

       // Your existing logic to update the record
    $data = Grade::find($id);
   // dd($data);
    $data->grade = $request->input('grade');
    $data->point = $request->input('point');
   
    // Check for duplicate min_marks
    if ($request->input('min_marks') != $data->min_marks && Grade::where('min_marks', $request->input('min_marks'))->exists()) {
        
        return redirect()->back()->with('error', 'The minimum marks value is already taken.');
    }

    // Check for duplicate max_marks
    if ($request->input('max_marks') != $data->max_marks && Grade::where('max_marks', $request->input('max_marks'))->exists()) {
        
        return redirect()->back()->with('error', 'The maximum marks value is already taken.');
    }

    $data->min_marks = $request->input('min_marks');
    $data->max_marks = $request->input('max_marks');
    $data->status = $request->input('status');
    $data->save();

    // Redirect or respond accordingly
    return redirect()->route('grade-list')->with('success', 'Grade updated successfully');
        }
    
    public function deleteGrade($id) {
        if ($id) {
            $grade = Grade::find($id);
            if ($grade) {
                $grade->is_deleted = '1';
                
                $grade->save();
            }
            return redirect()->route('grade-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('grade-list')->with('failed', 'Record not found.');
        }
    }
   
}
