<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\ClassRoutine;
use App\Models\Faculty;
use App\Models\PrintSetting;
use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;

use Illuminate\Http\Request;
use DB;

class ClassRoutineController extends Controller
{
   public function __construct() {
    $this->access = 'class-routine';
   }
    public function classroutineList(Request $request) {
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


       $data['print'] = PrintSetting::where('slug', 'class-routine')->first();

        // Search Filter
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


        // Routine Filter
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section)){

            $routines = ClassRoutine::where('status', '1');

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
            $data['rows'] = $routines->orderBy('start_time', 'asc')->get();   
        }


        return view('admin.class_routine.list')->with($data);
    }


    public function addClassRoutine(Request $request) {
        $data = [];
        $data['title'] = 'Add Class Routine';
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


        // Search Filter
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();

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

        $subjects = Subject::where('status', 1);
        $subjects->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($program, $semester, $section){
            $query->where('program_id', $program);
            $query->where('semester_id', $semester);
            $query->where('section_id', $section);
        });
        $data['subjects'] = $subjects->orderBy('code', 'asc')->get();
        }


        $data['rooms'] = ClassRoom::where('status', '1')->orderBy('title', 'asc')->get();

        $data['teachers'] = Teacher::where('status', '1')->orderBy('id', 'asc')->get();
        
        //$data['teachers'] = $teachers->orderBy('id', 'asc')->get();


        // Routine Filter
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section)){

            $routines = ClassRoutine::where('status', '1');

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
            $data['rows'] = $routines->orderBy('start_time', 'asc')->get();   
        }
    
        return view('admin.class_routine.add')->with($data);
    }

    public function storeClassRoutine(Request $request) {

       // Field Validation
       $request->validate([
        'session' => 'required',
        'program' => 'required',
        'semester' => 'required',
        'section' => 'required',
        'subject' => 'required',
        'teacher' => 'required',
        'room' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
    ]);
    

    DB::beginTransaction();
       
    //dd($request->all());
        
    if($request->subject){
        $data = $request->except('_token');
        $subject_count = count($data['subject']);
        $day = $request->day;
        $program = $request->program;
        $session = $request->session;
        $section = $request->section;
        $semester = $request->semester;

       
       
        for($j = 0; $j < $subject_count; $j++){
            $start = $data['start_time'][$j];
            //dd($start);
            $end = $data['end_time'][$j];
            //dd($end);
            // Check Routine
            /*$check = ClassRoutine::where('subject_id', $data['subject'][$j])->where('teacher_id', $data['teacher'][$j])->where('session_id', $session)->where('program_id', $program)->where('semester_id', $semester)->where('section_id', $section)
            ->where('room_id', $data['room'][$j])->where('day', $day)
            ->whereBetween('start_time', [$start, $end])
            ->orwhereBetween('end_time', [$start, $end])
            ->first();*/

            //Teacher Check
            $teacher_check = ClassRoutine::where('teacher_id', $data['teacher'][$j])
            ->where('session_id', $session)
            ->where('start_time', $start)
            ->where('day', $day)
            ->first();
           // dd($teacher_check);

            //Room Check
            $room_check = ClassRoutine::where('room_id', $data['room'][$j])
            ->where('session_id', $session)
            ->where('start_time', $start)
            ->where('day', $day)
            ->first();

            //Period Check
            $period_check = ClassRoutine::where('session_id', $session)->where('program_id', $program)->where('semester_id', $semester)->where('section_id', $section)
            ->where('start_time', $start)
            ->where('day', $day)
            ->first();

            //Subject Check
            /*$subject_check = ClassRoutine::where('subject_id', $data['subject'][$j])->where('session_id', $session)->where('program_id', $program)->where('semester_id', $semester)->where('section_id', $section)
            ->where('day', $day)
            ->first();*/

            
            if(!empty($data['routine_id'][$j]))
            {
                // Update Routine
                $classRoutine = ClassRoutine::find($data['routine_id'][$j]);
                $classRoutine->subject_id = $data['subject'][$j];
                $classRoutine->teacher_id = $data['teacher'][$j];
                $classRoutine->room_id= $data['room'][$j];
                $classRoutine->session_id = $session;
                $classRoutine->program_id = $program;
                $classRoutine->semester_id = $semester;
                $classRoutine->section_id = $section;
                $classRoutine->start_time= $data['start_time'][$j];
                $classRoutine->end_time= $data['end_time'][$j];
                $classRoutine->day= $day;
               // dd($classRoutine);
                $classRoutine->save();
                session()->flash('add', ('msg added successfully'));
               
            }
            else{
                // Create Routine
                if(!empty($teacher_check) || !empty($room_check) || !empty($period_check))
                {
                    session()->flash('error', ('already exist'));
                }
                else{
                    try{
                    $classRoutine = new ClassRoutine;
                   
                    $classRoutine->subject_id = $data['subject'][$j];
                   
                    $classRoutine->teacher_id = $data['teacher'][$j];
                    $classRoutine->room_id= $data['room'][$j];
                    $classRoutine->session_id = $session;
                    $classRoutine->program_id = $program;
                    $classRoutine->semester_id = $semester;
                    $classRoutine->section_id = $section;
                    $classRoutine->start_time= $data['start_time'][$j];
                    $classRoutine->end_time= $data['end_time'][$j];
                    $classRoutine->day= $day;
                   // dd( $classRoutine->teacher_id);
                    $classRoutine->save();
                    
                    //dd($classRoutine->subject_id);
                    session()->flash('update', ('updated successfully'));
                }
                catch(Exception $e)
            {
                dd($e->getMessage());
            }

            }
               
            }
        }

        // Delete Routine
        if(!empty($request->delete_routine) && isset($request->delete_routine)){
        $delete_routine_count = count($data['delete_routine']);
        for($i = 0; $i < $delete_routine_count; $i++)
        {
            $classRoutine = ClassRoutine::find($data['delete_routine'][$i]);
            $classRoutine->delete();

            session()->flash('delete', ('msg deleted successfully'));
        }}
    }

            DB::commit();
            return redirect()->back();
    }

    public function deleteClassRoutine($id) {
        if ($id) {
            $classroutine = ClassRoutine::find($id);
            if ($classroutine) {
                $classroutine->is_deleted = '1';
                
                $classroutine->save();
            }
            return redirect()->route('classroutine-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('classroutine-list')->with('failed', 'Record not found.');
        }
    }
    public function teacher(Request $request)
    {
       

        // Teacher Filter
        $teachers = Teacher::where('status', '1');
        // $teachers->with('roles')->whereHas('roles', function ($query){
        //     $query->where('slug', 'teacher');
        // });
        $data['teachers'] = $teachers->orderBy('id', 'asc')->get();


        if(!empty($request->teacher) && $request->teacher != Null){

            $data['selected_staff'] = $request->teacher;

            $session = Session::where('status', '1')->where('current', '1')->first();

            if(isset($session)){
            $data['rows'] = ClassRoutine::where('status', '1')
                        ->where('session_id', $session->id)
                        ->where('teacher_id', $request->teacher)
                        ->orderBy('start_time', 'asc')
                        ->get();
            }
        }
        else {
            $data['selected_staff'] = Null;
        }

        return view('admin.class_routine.teacher')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $data['path'] = 'print-setting';
        // View
        $data['print'] = PrintSetting::where('slug', 'class-routine')->firstOrFail();
        
        // Filter Routine
        if(!empty($request->program) && !empty($request->session) && !empty($request->semester) && !empty($request->section)){

            $routines = ClassRoutine::where('status', '1');

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
            $data['rows'] = $routines->orderBy('start_time', 'asc')->get();   
        }

        return view('admin.class_routine.print')->with($data);
        
    }
}
