<?php

namespace App\Http\Controllers;

use App\Models\EnrollSubject;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
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

class EnrollSubjectController extends Controller {

    public function enrollsubjectList(Request $request) {
        $data = [];
        $data['title'] = 'EnrollSubject List';
        $data['menu_active_tab'] = 'enrollsubject-list';
        $data['faculties'] = Faculty::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['rows'] = EnrollSubject::orderBy('id', 'desc')->get();

        return view('admin.enrollsubject.list')->with($data);
    }

    public function addEnrollSubject(Request $request) {
        $data = [];
        $data['title'] = 'Add EnrollSubject';
        $data['menu_active_tab'] = 'add-enrollsubject';
        $data['enrollsubject'] = EnrollSubject::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        return view('admin.enrollsubject.add')->with($data);
    }

    public function storeEnrollsubject(Request $request) {
       
        // Field Validation
        $request->validate([
            'program' => 'required',
            'semester' => 'required',
            'section' => 'required',
            'subjects' => 'required',
        ]);

        // $data = $request->input();
        try {
             // Insert Data
        $enrollSubject = EnrollSubject::firstOrCreate(
            ['program_id' => $request->program, 'semester_id' => $request->semester, 'section_id' => $request->section],
            ['program_id' => $request->program, 'semester_id' => $request->semester, 'section_id' => $request->section]
        );

        // Attach Update
        $enrollSubject->subjects()->sync($request->subjects);

            return redirect()->route('enrollsubject-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('enrollsubject-list')->with('failed', 'Record not added.');
        }
    }

    public function editEnrollsubject(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit EnrollSubject';
        $data['menu_active_tab'] = 'enrollsubject-list';
        $enrollSubject = EnrollSubject::find($id);
       
        $data['row'] = $enrollSubject;
        $data['rows'] = EnrollSubject::orderBy('id', 'desc')->get();

        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        $data['programs'] = Program::where('faculty_id', $enrollSubject->program->faculty_id)->where('status', '1')->orderBy('title', 'asc')->get();

        $semesters = Semester::where('status', 1);
        $semesters->with('programs')->whereHas('programs', function ($query) use ($enrollSubject){
            $query->where('program_id', $enrollSubject->program_id);
        });
        $data['semesters'] = $semesters->orderBy('id', 'asc')->get();

        $sections = Section::where('status', 1);
        $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($enrollSubject){
            $query->where('program_id', $enrollSubject->program_id);
            $query->where('semester_id', $enrollSubject->semester_id);
        });
        $data['sections'] = $sections->orderBy('title', 'asc')->get();

        $subjects = Subject::where('status', 1);
        $subjects->with('programs')->whereHas('programs', function ($query) use ($enrollSubject){
            $query->where('program_id', $enrollSubject->program_id);
        });
        $data['subjects'] = $subjects->orderBy('code', 'asc')->get();
        return view('admin.enrollsubject.edit')->with($data);
    }

    public function updateEnrollsubject(Request $request, $id) {
        // Field Validation
        $request->validate([
            'program' => 'required',
            'semester' => 'required',
            'section' => 'required',
            'subjects' => 'required',
        ]);
        $enrollSubject=EnrollSubject::find($id);
        $enroll = EnrollSubject::where('id', '!=', $id)->where('program_id', $request->program)->where('semester_id', $request->semester)->where('section_id', $request->section)->first();

        if(isset($enroll)){
            return redirect()->route('enrollsubject-list')->with('failed', 'Record already exist.');
        }
        else
        {
            // Update Data
            $enrollSubject->program_id = $request->program;
            $enrollSubject->semester_id = $request->semester;
            $enrollSubject->section_id = $request->section;
            $enrollSubject->save();

            // Attach Update
            $enrollSubject->subjects()->sync($request->subjects);

            return redirect()->route('enrollsubject-list')->with('success', 'Record Updated.');
        }
        }
    

    public function deleteEnrollsubject($id) {
        if ($id) {
            $enrollsubject= EnrollSubject::find($id);
            if ($enrollsubject) {
                $enrollsubject->is_deleted = '1';
                $enrollsubject->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $enrollsubject->save();
            }
            return redirect()->route('enrollsubject-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('enrollsubject-list')->with('failed', 'Record not found.');
        }
    }

}
