<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Exception;
use Str;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    //
    public function facultyList() {
        $data = [];
        $data['title'] = 'Faculty List';
        $data['menu_active_tab'] = 'faculties';
        $data['faculty'] = Faculty::where('is_deleted','0')->orderBy('id', 'DESC')->get();

        return view('admin.faculty.list')->with($data);
    }
    public function addFaculty(Request $request) {
        $data = [];
        $data['title'] = 'Add Faculty';
        $data['menu_active_tab'] = 'faculties';
        return view('admin.faculty.add')->with($data);
    }
    public function storeFaculty(Request $request) {

       // Field Validation
       $request->validate([
        'title' => 'required|max:191|unique:faculties,title',
    ]);

       
         // Insert Data
            try {
               
                  // Insert Data
                    $faculty = new Faculty;
                    $faculty->title = $request->title;
                    $faculty->slug = Str::slug($request->title, '-');
                    $faculty->shortcode = $request->shortcode;
                    //dd($faculty);
                    $faculty->save();
                        
                return redirect()->route('faculty-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('faculty-list')->with('failed', 'Record not added.');
            }
        }
        public function editFaculty(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Faculty';
            $data['menu_active_tab'] = 'Faculties';
            if ($id) {
                //dd($id);
                $faculty = Faculty::find($id);
                $data['faculty'] = Faculty::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($faculty) {
                    $data['faculty'] = $faculty;
                    return view('admin.faculty.edit')->with($data);
                } else {
                    return redirect()->route('faculty-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('faculty-list')->with('failed', 'Record not found.');
            }
        }

        public function updateFaculty(Request $request, $id) {
            $faculty = Faculty::find($id);

             // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:faculties,title,'.$faculty->id,
        ]);

        // Update Data
        $faculty->title = $request->title;
        $faculty->slug = Str::slug($request->title, '-');
        $faculty->shortcode = $request->shortcode;
        $faculty->status = $request->status;
        $faculty->save();


       // Redirect or respond accordingly
        return redirect()->route('faculty-list')->with('success', 'Faculty updated successfully');
        }
        public function deleteFaculty($id) {
            if ($id) {
                $faculty = Faculty::find($id);
                if ($faculty) {
                    $faculty->is_deleted = '1';
                    
                    $faculty->save();
                }
                return redirect()->route('faculty-list')->with('success', 'Record deleted.');
            } else {
                return redirect()->route('faculty-list')->with('failed', 'Record not found.');
            }
        }
}
