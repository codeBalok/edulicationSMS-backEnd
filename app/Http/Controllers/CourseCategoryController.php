<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Auth;
class CourseCategoryController extends Controller
{
   
    public function coursecategoryList() {
        $data = [];
        $data['title'] = 'Course Category List';
        $data['menu_active_tab'] = 'coursecategory';
        $data['rows'] = CourseCategory::where('is_deleted','0')->where('created_by', Auth::user()->id)->orderBy('name', 'asc')->get();
        //dd($data['rows']);
        return view('admin.course_category.list')->with($data);
    }

    public function addCourseCategory(Request $request) {
        $data = [];
        $data['title'] = 'Add Course Category';
        $data['menu_active_tab'] = 'add-coursecategory';
      
        return view('admin.course_category.add')->with($data);
    }

    public function storeCourseCategory(Request $request) {
        
        $rules = [
             'name' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
             $data = $request->input();
            try {
                $data = new CourseCategory();
                        $data->name = $request->input('name');
                        $data->description = $request->input('description');
                        if($request->status == "1"){
                            $data->status = "A";
                        }else{
                            $data->status = "D";
                        }
                        $data->created_by =  \Auth::user()->id ? \Auth::user()->id : null;
                        $data->is_deleted = "0";
                        $data->save();
                return redirect()->route('coursecategory-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('coursecategory-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function editCourseCategory(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Course Category';
        $data['menu_active_tab'] = 'course-category-list';
        if ($id) {
            $coursecategory = CourseCategory::find($id);
           
            if ($coursecategory) {
                $data['coursecategory'] = $coursecategory;
                return view('admin.course_category.edit')->with($data);
            } else {
                return redirect()->route('coursecategory-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('coursecategory-list')->with('failed', 'Record not found.');
        }
    }

    public function updateCourseCategory(Request $request, $id) {
        if ($id) {
            $request->validate([
                'name' => 'required',
                
            ]);
            $coursecategory = CourseCategory::find($id);
            if ($coursecategory) {
                $coursecategory->name = $request->input('name');
                $coursecategory->description = $request->input('description');
                if($request->status == "1"){
                    $coursecategory->status = "A";
                }else{
                    $coursecategory->status = "D";
                }
                $coursecategory->save();
                // dd($coursecategory);
            }
            return redirect()->route('coursecategory-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('coursecategory-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteCourseCategory($id) {
        if ($id) {
            $coursecategory = CourseCategory::find($id);
            if ($coursecategory) {
                $coursecategory->is_deleted = '1';
                //  $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $coursecategory->save();
            }

            return redirect()->route('coursecategory-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('coursecategory-list')->with('failed', 'Record not found.');
        }
    
    }


}
