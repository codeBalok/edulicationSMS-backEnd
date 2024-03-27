<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Subject;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function filterBatch(Request $request)
    {
        $data=$request->all();

        $rows = Program::where('status', 1);
        $rows->with('batches')->whereHas('batches', function ($query) use ($data){
            $query->where('batch_id', $data['batch']);
        });
        $programs = $rows->orderBy('title', 'asc')->get();

        return response()->json($programs);
    }
    
    public function filterProgram(Request $request)
    {
        //
        $data=$request->all();

        $programs = Program::where('faculty_id', $data['faculty'])->where('status', 1)->orderBy('title', 'asc')->get();
       
        return response()->json($programs);
    }

    public function filterSession(Request $request)
    {
        //
        $data=$request->all();

        $rows = Session::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $sessions = $rows->orderBy('id', 'desc')->get();

        return response()->json($sessions);
    }

    public function filterSemester(Request $request)
    {
        //
        $data=$request->all();

        $rows = Semester::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $semesters = $rows->orderBy('id', 'asc')->get();

        return response()->json($semesters);
    }

    public function filterSection(Request $request)
    {
        //
        $data=$request->all();

        $rows = Section::where('status', 1);
        $rows->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($data){
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
        });
        $sections = $rows->orderBy('title', 'asc')->get();

        return response()->json($sections);
    }

    public function filterSubject(Request $request)
    {
        //
        $data=$request->all();

        $rows = Subject::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterEnrollSubject(Request $request)
    {
        //
        $data=$request->all();

        $rows = Subject::where('status', 1);
        $rows->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($data){
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
            $query->where('section_id', $data['section']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }
}
