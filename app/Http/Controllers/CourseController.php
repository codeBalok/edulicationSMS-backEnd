<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function courseList() {
        $data = [];
        $data['title'] = 'Course List';
        $data['menu_active_tab'] = 'course-list';
       
            $data['rows'] = Course::orderBy('id', 'desc')->get();

        return view('admin.course.list')->with($data);
    }


    public function addcourse(Request $request) {
        $data = [];
        $data['title'] = 'Add Course';
        $data['menu_active_tab'] = 'course-list';
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        $data['rows'] = Course::orderBy('id', 'desc')->get();
        return view('admin.course.add')->with($data);
    }

    public function storeCourse(Request $request) {

        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:courses,title',
            'code' => 'required|max:191|unique:courses,code',
            'credit_hour' => 'required|numeric',
            'subject_type' => 'required',
            'class_type' => 'required',
        ]);
       
         // Insert Data
            try {
               
                $batch = new Batch;
                $batch->title = $request->title;
                $batch->start_date = $request->start_date;
                $batch->save();
        
                $batch->programs()->attach($request->programs);
        
                        
                return redirect()->route('batch-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('batch-list')->with('failed', 'Record not added.');
            }
        }
    
}
