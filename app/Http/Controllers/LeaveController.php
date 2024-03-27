<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;


class LeaveController extends Controller
{
    

    public function __construct()
    {
        // Module Data
       
        $this->path = 'staff-leave';
        $this->access = 'staff-leave';
    }
    //
    public function List()
    {
        
        $data = [];
        $data['title'] = 'Staff Leave List';
        $data['menu_active_tab'] = 'staffleave-list';
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        $data['emp_id']=Employee::where('is_deleted','0')->pluck('id');
        $data['rows'] = Leave::whereIn('user_id', $data['emp_id'])
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.staff_leave.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Staff leave';
        $data['menu_active_tab'] = 'add-staffleave';
        $data['types'] = LeaveType::where('status', '1')->orderBy('title', 'asc')->get();
        return view('admin.staff_leave.add')->with($data);
    }
    public function uploadMedia(Request $request, $attach, $directory) {

        // File upload, fit and store inside public folder 
        if($request->hasFile($attach)){

            // Valid extension check
            $valid_extensions = array('jpg','jpeg','png','gif','ico','svg','webp','pdf','doc','docx','txt','zip','rar','csv','xls','xlsx','ppt','pptx','mp3','avi','mp4','mpeg','3gp');
            $file_ext = $request->file($attach)->getClientOriginalExtension();
            if(in_array($file_ext, $valid_extensions, true))
            {

            //Upload New File
            $filenameWithExt = $request->file($attach)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file($attach)->getClientOriginalExtension();
            $fileNameToStore = str_replace([' ','-','&','#','$','%','^',';',':'],'_',$filename).'_'.time().'.'.$extension;

            //Crete Folder Location
            $path = public_path('uploads/'.$directory.'/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move file inside public/uploads/ directory
            $request->file($attach)->move('uploads/'.$directory.'/', $fileNameToStore);

            }
            else {
                $fileNameToStore = Null;
            }
        }
        else{
            $fileNameToStore = Null;
        }


        return $fileNameToStore;
    }
    public function store(Request $request) {
        
        // Field Validation
        $request->validate([
            'apply_date' => 'required|date|before_or_equal:today',
            'type' => 'required',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
            'pay_type' => 'required',
            'attach' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip,rar,csv,xls,xlsx,ppt,pptx|max:20480',
        ]);

       
             try {
                   //Insert Data
                $emp_id = Employee::where('is_deleted', '0')->pluck('id')->first();
                $leave = new Leave;
                $leave->user_id = $emp_id;
                $leave->type_id = $request->type;
                $leave->apply_date = Carbon::today();
                $leave->from_date = $request->from_date;
                $leave->to_date = $request->to_date;
                $leave->reason = $request->reason;
                $leave->pay_type = $request->pay_type;
                $leave->attach = $this->uploadMedia($request, 'attach', $this->path);
                $leave->save();
        
                 return redirect()->route('staffleave-list')->with('success', 'Record added successfully.');
             } catch (Exception $e) {
                //dd($e);
                 return redirect()->route('staffleave-list')->with('failed', 'Record not added.');
             }
         
     }
     public function delete($id) {
        if ($id) {
            $leave = Leave::find($id);
            if ($leave) {
                $leave->is_deleted = '1';
                
                $leave->save();
            }
            return redirect()->route('staffleave-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('staffleave-list')->with('failed', 'Record not found.');
        }
    }
}
