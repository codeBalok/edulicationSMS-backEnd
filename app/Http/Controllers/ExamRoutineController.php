<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\ExamRoutine;
use App\Models\ExamType;
use App\Models\Faculty;
use App\Models\PrintSetting;
use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class ExamRoutineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->access = 'exam-routine';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examroutineList(Request $request) {
        $data = [];
        $data['access'] = $this->access;
        $data['title'] = 'ClassRoutine List';
        $data['menu_active_tab'] = 'classroutine-list';

        
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

        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = '0';
        }

        if(!empty($request->semester) || $request->semester != null){
            $data['selected_semester'] = $semester = $request->semester;
        }
        else{
            $data['selected_semester'] = '0';
        }

        if(!empty($request->section) || $request->section != null){
            $data['selected_section'] = $section = $request->section;
        }
        else{
            $data['selected_section'] = '0';
        }

        if(!empty($request->type) || $request->type != null){
            $data['selected_type'] = $type = $request->type;
        }
        else{
            $data['selected_type'] = '0';
        }


        $data['print'] = PrintSetting::where('slug', 'exam-routine')->first();


        // Filter Search
        $data['types'] = ExamType::where('status', '1')->orderBy('title', 'asc')->get();
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();

        if(!empty($request->faculty) && !empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section)){
        $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();

        $sessions = Session::where('status', 1);
        $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['sessions'] = $sessions->orderBy('id', 'desc')->get();

        $semesters = Semester::where('status', 1);
        $semesters->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['semesters'] = $semesters->orderBy('id', 'asc')->get();

        $sections = Section::where('status', 1);
        $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester){
            $query->where('program_id', $program);
            $query->where('semester_id', $semester);
        });
        $data['sections'] = $sections->orderBy('title', 'asc')->get();}


        // Filter Routine
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section) && !empty($request->type)){

            $routines = ExamRoutine::where('status', '1');

            if(!empty($request->program)){
                $routines->where('program_id', $request->program);
            }
            if(!empty($request->session)){
                $routines->where('session_id', $request->session);
            }
            if(!empty($request->semester)){
                $routines->where('semester_id', $request->semester);
            }
            if(!empty($request->section)){
                $routines->where('section_id', $request->section);
            }
            if(!empty($request->type)){
                $routines->where('exam_type_id', $request->type);
            }

            $data['rows'] = $routines->orderBy('date', 'asc')
                            ->orderBy('start_time', 'asc')->get();   
        }


        return view('admin.exam_routine.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addExamRoutine(Request $request) {
    
        $data = [];
        $data['title'] = 'Add Exam Routine';
        $data['menu_active_tab'] = 'examroutine-list';

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

        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = '0';
        }

        if(!empty($request->semester) || $request->semester != null){
            $data['selected_semester'] = $semester = $request->semester;
        }
        else{
            $data['selected_semester'] = '0';
        }

        if(!empty($request->section) || $request->section != null){
            $data['selected_section'] = $section = $request->section;
        }
        else{
            $data['selected_section'] = '0';
        }

        if(!empty($request->type) || $request->type != null){
            $data['selected_type'] = $type = $request->type;
        }
        else{
            $data['selected_type'] = '0';
        }


        // Filter Routine
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section) && !empty($request->type)){

            $routines = ExamRoutine::where('status', '1');

            if(!empty($request->program)){
                $routines->where('program_id', $request->program);
            }
            if(!empty($request->session)){
                $routines->where('session_id', $request->session);
            }
            if(!empty($request->semester)){
                $routines->where('semester_id', $request->semester);
            }
            if(!empty($request->section)){
                $routines->where('section_id', $request->section);
            }
            if(!empty($request->type)){
                $routines->where('exam_type_id', $request->type);
            }
            $data['rows'] = $routines->orderBy('date', 'asc')
                            ->orderBy('start_time', 'asc')->get();

            $routine = [];
            foreach($data['rows'] as $row){
                $routine[] = $row->subject_id;
               
            }
            

            $subjects = Subject::where('status', 1)->whereNotIn('id', $routine);
            

            $subjects->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($program, $semester, $section){
                $query->where('program_id', $program);
                $query->where('semester_id', $semester);
                $query->where('section_id', $section);
            });
            $data['subjects'] = $subjects->orderBy('code', 'asc')->get();
        }


        // Filter Search
        if(!empty($request->faculty) && !empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section))
        {
            $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();

            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
                $query->where('program_id', $program);
            });
            $data['sessions'] = $sessions->orderBy('id', 'desc')->get();

            $semesters = Semester::where('status', 1);
            $semesters->with('programs')->whereHas('programs', function ($query) use ($program){
                $query->where('program_id', $program);
            });
            $data['semesters'] = $semesters->orderBy('id', 'asc')->get();

            $sections = Section::where('status', 1);
            $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester){
                $query->where('program_id', $program);
                $query->where('semester_id', $semester);
            });
            $data['sections'] = $sections->orderBy('title', 'asc')->get();

            $editSubjects = Subject::where('status', 1);
            $editSubjects->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($program, $semester, $section){
                $query->where('program_id', $program);
                $query->where('semester_id', $semester);
                $query->where('section_id', $section);
            });
            $data['editSubjects'] = $editSubjects->orderBy('code', 'asc')->get();
        }


        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        $data['types'] = ExamType::where('status', '1')->orderBy('title', 'asc')->get();
        $data['rooms'] = ClassRoom::where('status', '1')->orderBy('title', 'asc')->get();

        $teachers = Teacher::where('status', '1');
      
        $data['teachers'] = $teachers->orderBy('id', 'asc')->get();


        return view('admin.exam_routine.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExamRoutine(Request $request) {

        // Field Validation
        $request->validate([
            'session' => 'required',
            'program' => 'required',
            'semester' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'teachers' => 'required',
            'rooms' => 'required',
        ]);


        DB::beginTransaction();
        // Insert Data
        $examRoutine = new ExamRoutine;
        $examRoutine->subject_id = $request->subject;
        $examRoutine->exam_type_id = $request->type;
        $examRoutine->session_id = $request->session;
        $examRoutine->program_id = $request->program;
        $examRoutine->semester_id = $request->semester;
        $examRoutine->section_id = $request->section;
        $examRoutine->date = $request->date;
        $examRoutine->start_time= $request->start_time;
        $examRoutine->end_time= $request->end_time;
        $examRoutine->save();


        // Attach Data
        $examRoutine->users()->attach($request->teachers);
        $examRoutine->rooms()->attach($request->rooms);
        DB::commit();


        session()->flash('add', ('msg added successfully'));

        return redirect()->back();
    }

    public function editExamRoutine(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Exam Routine';
        $data['menu_active_tab'] = 'ExamRoutine-list';
        if ($id) {
            $examroutine = ExamRoutine::find($id);
           

            $data['examroutine'] = ExamRoutine::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
           
            if ($examroutine) {
                $data['examroutine'] = $examroutine;
                
                
                return view('admin.exam_routine.edit')->with($data);
            } else {
                return redirect()->route('examroutine-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('examroutine-list')->with('failed', 'Record not found.');
        }
    }
  
    public function update(Request $request, $id)
    {
        $request->validate([
            'session' => 'required',
            'program' => 'required',
            'semester' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'teachers' => 'required',
            'rooms' => 'required',
        ]);


        DB::beginTransaction();
        // Update Data
        $examRoutine = ExamRoutine::findOrFail($id);
        $examRoutine->subject_id = $request->subject;
        $examRoutine->exam_type_id = $request->type;
        $examRoutine->date = $request->date;
        $examRoutine->start_time= $request->start_time;
        $examRoutine->end_time= $request->end_time;
        $examRoutine->save();


        // Attach Update
        $examRoutine->users()->sync($request->teachers);
        $examRoutine->rooms()->sync($request->rooms);
        DB::commit();


        session()->flash('update', ('msg updated successfully'));

        return redirect()->back();
    }

   
    public function deleteExamRoutine($id) {
        if ($id) {
            $examroutine = ExamRoutine::find($id);
            if ($examroutine) {
                $examroutine->is_deleted = '1';
                
                $examroutine->save();
            }
            return redirect()->route('examroutine-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('examroutine-list')->with('failed', 'Record not found.');
        }
    }

    
    public function print(Request $request)
    {
        $data['path'] = 'print-setting';

        
        $data['print'] = PrintSetting::where('slug', 'exam-routine')->firstOrFail();
        
        // Filter Routine
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section) && !empty($request->type)){

            $routines = ExamRoutine::where('status', '1');

            if(!empty($request->program)){
                $routines->where('program_id', $request->program);
            }
            if(!empty($request->session)){
                $routines->where('session_id', $request->session);
            }
            if(!empty($request->semester)){
                $routines->where('semester_id', $request->semester);
            }
            if(!empty($request->section)){
                $routines->where('section_id', $request->section);
            }
            if(!empty($request->type)){
                $routines->where('exam_type_id', $request->type);
            }

            $data['rows'] = $routines->orderBy('date', 'asc')
                            ->orderBy('start_time', 'asc')->get();   
        }

        return view('admin.exam_routine.print')->with($data);
    }
}


