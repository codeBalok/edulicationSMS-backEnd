<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Faculty;
use App\Models\FeesCategory;
use App\Models\Program;
use App\Models\FeesMaster;
use App\Models\Session;
use App\Models\Semester;
use App\Models\Section;
use App\Models\StudentEnroll;
use App\Models\Fee;
use App\Models\FeesReceipt;
use App\Models\Transaction;
use App\Models\FeesDiscount;

use DB;
use Mail;

class FeesStudentController extends Controller {
    
        public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_fees_due', 1);
        $this->route = 'admin.fees-student';
        $this->view = 'admin.fees_student';
        $this->path = 'student';
        $this->access = 'fees-student';



    }

    public function index(Request $request) {
        $data = [];
        $data['title'] = 'Fees Student';
        $data['menu_active_tab'] = 'fees-student';
        
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        
        if(!empty($request->faculty) || $request->faculty != null){
            $data['selected_faculty'] = $faculty = $request->faculty;
        }
        else{
            $data['selected_faculty'] = $faculty = '0';
        }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = $program = '0';
        }

        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = $session = '0';
        }

        if(!empty($request->semester) || $request->semester != null){
            $data['selected_semester'] = $semester = $request->semester;
        }
        else{
            $data['selected_semester'] = $semester = '0';
        }

        if(!empty($request->section) || $request->section != null){
            $data['selected_section'] = $section = $request->section;
        }
        else{
            $data['selected_section'] = $section = '0';
        }

        if(!empty($request->category) || $request->category != null){
            $data['selected_category'] = $category = $request->category;
        }
        else{
            $data['selected_category'] = $category = '0';
        }

        if(!empty($request->student_id) || $request->student_id != null){
            $data['selected_student_id'] = $student_id = $request->student_id;
        }
        else{
            $data['selected_student_id'] = $student_id = null;
        }


        
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
        $data['print'] = FeesReceipt::where('slug', 'fees-receipt')->first();


        // Filter Search
        if(!empty($request->faculty) && $request->faculty != '0'){
        $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();}

        if(!empty($request->program) && $request->program != '0'){
        $sessions = Session::where('status', 1);
        $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['sessions'] = $sessions->orderBy('id', 'desc')->get();}

        if(!empty($request->program) && $request->program != '0'){
        $semesters = Semester::where('status', 1);
        $semesters->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['semesters'] = $semesters->orderBy('id', 'asc')->get();}

        if(!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0'){
        $sections = Section::where('status', 1);
        $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester){
            $query->where('program_id', $program);
            $query->where('semester_id', $semester);
        });
        $data['sections'] = $sections->orderBy('title', 'asc')->get();}
        


        // Filter Fees
        $fees = Fee::where('status', '0');

        if(!empty($request->faculty) || !empty($request->program) || !empty($request->session) || !empty($request->semester) || !empty($request->section)){
            $fees->whereHas('studentEnroll.program', function ($query) use ($faculty){
                if($faculty != 0){
                $query->where('faculty_id', $faculty);
                }
            });

            $fees->whereHas('studentEnroll', function ($query) use ($program, $session, $semester, $section){
                if($program != 0){
                $query->where('program_id', $program);
                }
                if($session != 0){
                $query->where('session_id', $session);
                }
                if($semester != 0){
                $query->where('semester_id', $semester);
                }
                if($section != 0){
                $query->where('section_id', $section);
                }
            });
        }
        if($category != 0){
            $fees->where('category_id', $category);
        }
        if(!empty($request->student_id)){
            $fees->whereHas('studentEnroll.student', function ($query) use ($student_id){
                if($student_id != 0){
                $query->where('student_id', 'LIKE', '%'.$student_id.'%');
                }
            });
        }

        $fees->whereHas('studentEnroll.student', function ($query){
            $query->orderBy('student_id', 'asc');
        });
        
        $data['rows'] = $fees->orderBy('id', 'desc')->get();

        return view('admin.fees_student.index')->with($data);
    }
    
     public function pay(Request $request)
    {
        // Field Validation
        $request->validate([
            'pay_date' => 'required|date|before_or_equal:today',
            'payment_method' => 'required',
            'fee_amount' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'fine_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
        ]);


        $fee = Fee::find($request->fee_id);

        // Discount Calculation
        $discount_amount = 0;
        $today = date('Y-m-d');

        if(isset($fee->category)){
        foreach($fee->category->discounts->where('status', '1') as $discount){

        $availability = FeesDiscount::availability($discount->id, $fee->studentEnroll->student_id);

            if(isset($availability)){
            if($discount->start_date <= $today && $discount->end_date >= $today){
                if($discount->type == '1'){
                    $discount_amount = $discount_amount + $discount->amount;
                }
                else{
                    $discount_amount = $discount_amount + ( ($fee->fee_amount / 100) * $discount->amount);
                }
            }}
        }}


        // Fine Calculation
        $fine_amount = 0;
        if(empty($fee->pay_date) || $fee->due_date < $fee->pay_date){
            
            $due_date = strtotime($fee->due_date);
            $today = strtotime(date('Y-m-d')); 
            $days = (int)(($today - $due_date)/86400);

            if($fee->due_date < date("Y-m-d")){
                if(isset($fee->category)){
                foreach($fee->category->fines->where('status', '1') as $fine){
                if($fine->start_day <= $days && $fine->end_day >= $days){
                    if($fine->type == '1'){
                        $fine_amount = $fine_amount + $fine->amount;
                    }
                    else{
                        $fine_amount = $fine_amount + ( ($fee->fee_amount / 100) * $fine->amount);
                    }
                }
                }}
            }
        }


        // Net Amount Calculation
        $net_amount = ($fee->fee_amount - $discount_amount) + $fine_amount;

        
        DB::beginTransaction();
        // Update Data              
        // $fee->fee_amount = $request->fee_amount;
        $fee->discount_amount = $discount_amount;
        $fee->fine_amount = $fine_amount;
        $fee->paid_amount = $net_amount;
        $fee->pay_date = $request->pay_date;
        $fee->payment_method = $request->payment_method;
        $fee->note = $request->note;
        $fee->status = '1';
        $fee->updated_by = Auth::guard('web')->user()->id;
        $fee->save();


        // Transaction
        $transaction = new Transaction;
        $transaction->transaction_id = Str::random(16);
        $transaction->amount = $net_amount;
        $transaction->type = '1';
        $transaction->created_by = Auth::guard('web')->user()->id;
        $fee->studentEnroll->student->transactions()->save($transaction);
        DB::commit();


        

        return redirect()->back()->with('success', 'Updated Successfully !!');
    }

    public function quickAssign()
    {
        $data = [];
        $data['title'] = 'Fees Student Quick Assign';
        $data['menu_active_tab'] = 'fees-student-quick-assign';


        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();

        // Filter Student
        $students = StudentEnroll::where('status', '1');
        $students->with('student')->whereHas('student', function ($query){
            $query->where('status', '1');
            $query->orderBy('student_id', 'asc');
        });

        $data['students'] = $students->orderBy('student_id', 'asc')->get();


        return view('admin.fees_student.quickassign')->with($data);
    }
    
    public function quickAssignStore(Request $request)
    {
        // Field Validation
        $request->validate([
            'student' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|numeric',
            'assign_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after_or_equal:assign_date',
        ]);


        $total_credits = 0;

        if($request->type == 1){
            $fee_amount = $request->amount;
        }
        else {
            $enroll = StudentEnroll::find($request->student);
            foreach($enroll->subjects as $subject){
                $total_credits = $total_credits + $subject->credit_hour;
            }

            $fee_amount = $total_credits * $request->amount;
        }

        // Assign Fees
        $fees = new Fee;
        $fees->student_enroll_id = $request->student;
        $fees->category_id = $request->category;
        $fees->fee_amount = $fee_amount;
        $fees->assign_date = $request->assign_date;
        $fees->due_date = $request->due_date;
        $fees->created_by = Auth::guard('web')->user()->id;
        $fees->save();


        return redirect()->route('admin.fees_student.quickassign')->with('success', 'Record Added.');
    }

    public function quickReceived()
    {
        //
        $data = [];
        $data['title'] = 'Fees Student Quick Received';
        $data['menu_active_tab'] = 'fees-student-quick-received';


        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();

        // Filter Student
        $students = StudentEnroll::where('status', '1');
        $students->with('student')->whereHas('student', function ($query){
            $query->where('status', '1');
            $query->orderBy('student_id', 'asc');
        });

        $data['students'] = $students->orderBy('student_id', 'asc')->get();


        return view('admin.fees_student.quickreceived')->with($data);
    }
    
    
    public function quickReceivedStore(Request $request)
    {
  
        // Field Validation
        $request->validate([
            'student' => 'required',
            'category' => 'required',
            'fee_amount' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'fine_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'payment_method' => 'required',
            'due_date' => 'required|date',
            'pay_date' => 'required|date|before_or_equal:today',
        ]);


        try{
                  
            DB::beginTransaction();
            // Insert Data
            $fee = new Fee;
            $fee->student_enroll_id = $request->student;
            $fee->category_id = $request->category;
            $fee->fee_amount = $request->fee_amount;
            $fee->discount_amount = $request->discount_amount;
            $fee->fine_amount = $request->fine_amount;
            $fee->paid_amount = $request->paid_amount;
            $fee->assign_date = today();
            $fee->due_date = $request->due_date;
            $fee->pay_date = $request->pay_date;
            $fee->payment_method = $request->payment_method;
            $fee->note = $request->note;
            $fee->status = '1';
            $fee->updated_by = Auth::guard('web')->user()->id;
            $fee->save();
// dd($fee);

            // Transaction
            $transaction = new Transaction;
            $transaction->transaction_id = Str::random(16);
            $transaction->amount = $request->paid_amount;
            $transaction->type = '1';
            $transaction->created_by = Auth::guard('web')->user()->id;
            $fee->studentEnroll->student->transactions()->save($transaction);
            DB::commit();


            return redirect()->route('fees-student-quick-received')->with('success', 'Record Added.');

        }
        catch(\Exception $e){
                //   dd('hii');
            return redirect()->route('fees-student-quick-received')->with('error', 'Record Not Added.');
        }
    }
    
    
    public function report(Request $request)
    {
        //
        $data = [];
        $data['title'] = 'Fees Student Report';
        $data['menu_active_tab'] = 'fees-student-report';
        
                $data['title'] = trans_choice('module_fees_report', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;



        if(!empty($request->faculty) || $request->faculty != null){
            $data['selected_faculty'] = $faculty = $request->faculty;
        }
        else{
            $data['selected_faculty'] = $faculty = '0';
        }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = $program = '0';
        }

        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = $session = '0';
        }

        if(!empty($request->semester) || $request->semester != null){
            $data['selected_semester'] = $semester = $request->semester;
        }
        else{
            $data['selected_semester'] = $semester = '0';
        }

        if(!empty($request->section) || $request->section != null){
            $data['selected_section'] = $section = $request->section;
        }
        else{
            $data['selected_section'] = $section = '0';
        }

        if(!empty($request->category) || $request->category != null){
            $data['selected_category'] = $category = $request->category;
        }
        else{
            $data['selected_category'] = $category = '0';
        }

        if(!empty($request->student_id) || $request->student_id != null){
            $data['selected_student_id'] = $student_id = $request->student_id;
        }
        else{
            $data['selected_student_id'] = $student_id = null;
        }


        
        $data['faculties'] = Faculty::where('status', '1')->orderBy('title', 'asc')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
        $data['print'] = FeesReceipt::where('slug', 'fees-receipt')->first();


        // Filter Search
        if(!empty($request->faculty) && $request->faculty != '0'){
        $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();}

        if(!empty($request->program) && $request->program != '0'){
        $sessions = Session::where('status', 1);
        $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['sessions'] = $sessions->orderBy('id', 'desc')->get();}

        if(!empty($request->program) && $request->program != '0'){
        $semesters = Semester::where('status', 1);
        $semesters->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['semesters'] = $semesters->orderBy('id', 'asc')->get();}

        if(!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0'){
        $sections = Section::where('status', 1);
        $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester){
            $query->where('program_id', $program);
            $query->where('semester_id', $semester);
        });
        $data['sections'] = $sections->orderBy('title', 'asc')->get();}
        

        // Filter Fees
        $fees = Fee::where('status', '!=', '0');

        if(!empty($request->faculty) || !empty($request->program) || !empty($request->session) || !empty($request->semester) || !empty($request->section)){
            $fees->whereHas('studentEnroll.program', function ($query) use ($faculty){
                if($faculty != 0){
                $query->where('faculty_id', $faculty);
                }
            });

            $fees->whereHas('studentEnroll', function ($query) use ($program, $session, $semester, $section){
                if($program != 0){
                $query->where('program_id', $program);
                }
                if($session != 0){
                $query->where('session_id', $session);
                }
                if($semester != 0){
                $query->where('semester_id', $semester);
                }
                if($section != 0){
                $query->where('section_id', $section);
                }
            });
        }
        if($category != 0){
            $fees->where('category_id', $category);
        }
        if(!empty($request->student_id)){
            $fees->whereHas('studentEnroll.student', function ($query) use ($student_id){
                if($student_id != 0){
                $query->where('student_id', 'LIKE', '%'.$student_id.'%');
                }
            });
        }
        
        $fees->whereHas('studentEnroll.student', function ($query){
            $query->orderBy('student_id', 'asc');
        });
        
        $data['rows'] = $fees->orderBy('updated_at', 'desc')->get();


        return view('admin.fees_student.report')->with($data);
    }
    
    public function print($id)
    {
        //
        $data['title'] = trans_choice('module_fees_report', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = 'print-setting';

        // View
        $data['print'] = FeesReceipt::where('slug', 'fees-receipt')->firstOrFail();
        $data['row'] = Fee::where('id', $id)->where('status', '1')->firstOrFail();

        return view('admin.fees_student.print')->with($data);
        
    }
    
    public function unpay(Request $request, $id)
    {
        try{

            DB::beginTransaction();
            // Update Data
            $fee = Fee::findOrFail($id);
            $fee->pay_date = null;
            $fee->payment_method = null;
            $fee->note = $request->note;
            $fee->status = '0';
            $fee->updated_by = Auth::guard('web')->user()->id;
            $fee->save();


            // Transaction
            $transaction = new Transaction;
            $transaction->transaction_id = Str::random(16);
            $transaction->amount = $fee->paid_amount;
            $transaction->type = '2';
            $transaction->created_by = Auth::guard('web')->user()->id;
            $fee->studentEnroll->student->transactions()->save($transaction);
            DB::commit();


            return redirect()->back()->with('success', 'Updated Successfully!!.');
        }
        catch(\Exception $e){

            Toastr::error(__('msg_updated_error'), __('msg_error'));

            return redirect()->back()->with('error', 'Error.');
        }
    }
    
    public function cancel(Request $request, $id)
    {
        // Update Data
        $fee = Fee::findOrFail($id);
        $fee->pay_date = null;
        $fee->payment_method = null;
        $fee->note = $request->note;
        $fee->status = '2';
        $fee->updated_by = Auth::guard('web')->user()->id;
        $fee->save();


        return redirect()->back()->with('success', 'Updated Successfully!!.');
    }
}