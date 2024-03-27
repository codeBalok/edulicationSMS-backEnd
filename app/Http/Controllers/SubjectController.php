<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use DB;

class SubjectController extends Controller {

    public function list(Request $request) {
        $data = [];
        $data['title'] = 'Subject List';
        $data['menu_active_tab'] = 'subject-list';
        if(!empty($request->faculty) || $request->faculty != null){
            $data['selected_faculty'] = $faculty = $request->faculty;
        }
        else{
            $data['selected_faculty'] = '0';
        }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
            
        }
        else{
            $data['selected_program'] = '0';
        }

        if(!empty($request->subject_type) || $request->subject_type != null){
            $data['selected_subject_type'] = $subject_type = $request->subject_type;
        }
        else{
            $data['selected_subject_type'] = Null;
        }
        
        if(!empty($request->class_type) || $request->class_type != null){
            $data['selected_class_type'] = $class_type = $request->class_type;
        }
        else{
            $data['selected_class_type'] = Null;
        }

       
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        if(!empty($request->faculty) || $request->faculty != '0'){
        $data['programs'] = Program::where('faculty_id', $request->faculty)->where('status', '1')->orderBy('title', 'asc')->get();
        
        }
        

        // Subject Search
        $subject = Subject::where('id', '!=', null);

        if(!empty($request->faculty) && $request->faculty != '0'){
            $subject->with('programs.faculty')->whereHas('programs.faculty', function ($query) use ($faculty){
                $query->where('id', $faculty);
            });
        }
        if(!empty($request->program) && $request->program != '0'){
            $subject->with('programs')->whereHas('programs', function ($query) use ($program){
                $query->where('id', $program);
            });
        }
        if(!empty($request->subject_type)){
            if($subject_type == 2){
                $subject_type = 0;
            }
            $subject->where('subject_type', $subject_type);
        }
        if(!empty($request->class_type)){
            $subject->where('class_type', $class_type);
        }

        $data['rows'] = $subject->orderBy('title', 'asc')->get();

        return view('admin.subject.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Subject';
        $data['menu_active_tab'] = 'add-subject';
        $data['subject'] = Subject::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        return view('admin.subject.add')->with($data);
    }

    public function store(Request $request) {
       
        $request->validate([
            'title' => 'required|max:191|unique:subject,title',
            'code' => 'required|max:191|unique:subject,code',
            'credit_hour' => 'required|numeric',
            'subject_type' => 'required',
            'class_type' => 'required',
        ]);

        // $data = $request->input();
        try {
             DB::beginTransaction();
        // Insert Data
        $subject = new Subject;
        $subject->title = $request->title;
        $subject->code = $request->code;
        $subject->credit_hour = $request->credit_hour;
        $subject->subject_type = $request->subject_type;
        $subject->class_type = $request->class_type;
        $subject->total_marks = $request->total_marks;
        $subject->passing_marks = $request->passing_marks;
        $subject->description = $request->description;
        $subject->save();

        // Attach
        $subject->programs()->attach($request->programs);
        DB::commit();

            return redirect()->route('subject-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('subject-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Subject';
        $data['menu_active_tab'] = 'subject-list';
        if ($id) {
            $subject = \App\Models\Subject::find($id);
            $data['subject'] = Subject::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($subject) {
                $data['subject'] = $subject;
                return view('admin.subject.edit')->with($data);
            } else {
                return redirect()->route('subject-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('subject-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            
            $data = $request->input();
            $subject= \App\Models\Subject::find($id);
            if ($subject) {
                $subject->title = $data['title'];
                $subject->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $subject->save();

                return redirect()->route('subject-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('subject-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $subject= \App\Models\Subject::find($id);
            if ($subject) {
                $subject->is_deleted = '1';
                $subject->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $subject->save();
            }
            return redirect()->route('subject-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('subject-list')->with('failed', 'Record not found.');
        }
    }

}
