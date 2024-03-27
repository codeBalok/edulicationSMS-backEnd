<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Exception;
use Illuminate\Http\Request;
use Validator;
use DB;

class ExamTypeController extends Controller
{
    public function examtypeList() {
        $data = [];
        $data['title'] = 'Exam type List';
        $data['menu_active_tab'] = 'examtype-list';
        $data['rows'] = ExamType::orderBy('contribution', 'desc')->get();

        return view('admin.exam_type.list')->with($data);
    }


    public function addExamType(Request $request) {
        $data = [];
        $data['title'] = 'Add exam type';
        $data['menu_active_tab'] = 'add-examtype';
        return view('admin.exam_type.add')->with($data);
    }

    public function storeExamType(Request $request) {
         // Field Validation
         $request->validate([
            'title' => 'required|max:191|unique:exam_types,title',
            'marks' => 'required|numeric',
            // 'contribution' => 'required|numeric',
        ]);
            try{
                // Insert Data
                $examType = new ExamType;
                $examType->title = $request->title;
                $examType->marks = $request->marks;
                // $examType->contribution = $request->contribution;
                $examType->description = $request->description;
                $examType->save();

                return redirect()->route('examtype-list')->with('success', 'Record added successfully.');
            }
            catch (Exception $e) {
               //dd($e);
                return redirect()->route('examtype-list')->with('failed', 'Record not added.');
            }
        }
    
    public function editExamType(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Exam Type';
        $data['menu_active_tab'] = 'examtype-list';
        if ($id) {
            $examtype = ExamType::find($id);
            $data['examtype'] = ExamType::where('status', '1')->orderBy('contribution', 'desc')->get();
            if ($examtype) {
                $data['examtype'] = $examtype;
                
                return view('admin.exam_type.edit')->with($data);
            } else {
                return redirect()->route('examtype-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('examtype-list')->with('failed', 'Record not found.');
        }
    }
    public function updateExamType(Request $request, $id) {
        
        if ($id) {
            
           // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:exam_types,title,'.$id,
            'marks' => 'required|numeric',
            // 'contribution' => 'required|numeric',
        ]);

           
            $data = $request->input();
            $examtype = ExamType::find($id);
             if ($examtype) {
            // Update Data
                $data->title = $request->title;
                $data->marks = $request->marks;
                // $examType->contribution = $request->contribution;
                $data->description = $request->description;
                $data->status = $request->status;
                $data->save();
          
            }
           
            return redirect()->route('examtype-list')->with('success', 'Record Updated.');
        
    }
}
    public function deleteExamType($id) {
        if ($id) {
            $examtype = ExamType::find($id);
            if ($examtype) {
                $examtype->is_deleted = '1';
                
                $examtype->save();
            }
            return redirect()->route('examtype-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('examtype-list')->with('failed', 'Record not found.');
        }
    }
}
