<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\LeaveAllocation;
use App\Models\LeaveRequest;
use App\Models\LeaveRequestDetail;
use App\Models\LeaveType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Validator;

class LeaveRequestController extends Controller
{
    //
    public function leaverequestList() {
        $data = [];
        $data['title'] = 'Leave request List';
        $data['menu_active_tab'] = 'leaverequest-list';
      
        $data['leaverequest'] = LeaveRequest::join('employee', 'employee.id', '=', 'leave_request.employee_id')
    ->join('designation', 'designation.id', '=', 'employee.designation_id')
    ->join('leave_type', 'leave_type.id', '=', 'leave_request.leave_type_id')
    ->join('users', 'users.id', '=', 'leave_request.requester_user_id')
    ->where('leave_request.is_deleted', '0')->where('leave_request.status', '!=', '2')
    ->get(['leave_request.*','employee.id as empid','employee.first_name','employee.last_name','leave_type.name','designation.designation_name','users.username']);
  // dd($data);
            return view('admin.leave_request.list')->with($data);
    }

    public function addLeaveRequest(Request $request) {
        $data = [];
        $data['title'] = 'Add leave request';
        $data['menu_active_tab'] = 'add-leaverequest';
        $data['leavetype'] = LeaveType::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
        //dd($data['leavetype']);
        $data['employee'] = Employee::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
       
        return view('admin.leave_request.add')->with($data);
    }
    public function storeLeaveRequest(Request $request) {
        //dd($request->all());
        $rules = [
            'leave_type_id' => 'required',
            'leave_document' => 'required|mimes:pdf,doc,docx|max:2048', // Define appropriate file types and size
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',

              

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
       // dd($validator);
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            // $data = $request->input();
         
            try {
                $documentPath = $request->file('leave_document')->store('documents');
                //dd($documentPath);
                $data = new LeaveRequest();
              
                            $data->employee_id = $request->input('employee_id');
                      
                        
                        $data->leave_type_id = $request->input('leave_type_id');
                        $data->start_date = $request->input('start_date');
                        $data->end_date = $request->input('end_date');
                        $data->reason = $request->input('reason');
                        $data->status = $request->input('status');
                        $data->leave_document = $documentPath;
                        $data->requester_user_id = \Auth::user()->id ? \Auth::user()->id : null;

                       
                        //dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('leaverequest-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('leaverequest-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function editLeaveRequest(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Leave Request';
        $data['menu_active_tab'] = 'leaverequest-list';
        if ($id) {
            $leaverequest = LeaveRequest::find($id);
            $data['leaverequest'] = LeaveRequest::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            $data['employee'] = Employee::where('id',$leaverequest->employee_id)->where('is_deleted', '0')->orderBy('id', 'ASC')->first();
            $data['leavetype'] = LeaveType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            if ($leaverequest) {
                $data['leaverequest'] = $leaverequest;
                //dd($data['employee']);
                
                return view('admin.leave_request.edit')->with($data);
            } else {
                return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
        }
    }
    public function updateLeaveRequest(Request $request, $id) {
        
        if ($id) {
           
            $request->validate([
                'leave_type_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',

            ]);
           
         $data = $request->input();
            
            $leaverequest = LeaveRequest::find($id);

         
            if ($leaverequest) {
                
                $leaverequest->leave_type_id = isset($data['leave_type_id']) ? $data['leave_type_id'] : null;
                $leaverequest->start_date = isset($data['start_date']) ? $data['start_date'] : null;
                $leaverequest->end_date = isset($data['end_date']) ? $data['end_date'] : null;
                $leaverequest->reason = isset($data['reason']) ? $data['reason'] : 1;

                $leaverequest->save();
                
            }
            //dd('success');
            return redirect()->route('leaverequest-list')->with('success', 'Record Updated.');
        } else {
           // dd('fail');
            return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteLeaveRequest($id) {
        if ($id) {
            $leaverequest = LeaveRequest::find($id);
            if ($leaverequest) {
                $leaverequest->is_deleted = '1';
                
                $leaverequest->save();
            }
            return redirect()->route('leaverequest-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
        }
    }
    public function leaverequestDetail(Request $request, $id) {
        $data = [];
        $data['title'] = 'Leave Request Detail';
        $data['menu_active_tab'] = 'leaverequest-detail';
        if ($id) {
            $leaverequest = LeaveRequest::find($id);
           // dd($leaverequest->employee_id);
                $data['leaverequestdetail']= LeaveRequestDetail::where('employee_leave_request_id',$leaverequest->id)->first();
                $data['leaverequest'] = LeaveRequest::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
                $empid=$leaverequest->employee_id;
                
                $data['employee'] = Employee::where('id',$empid)->where('is_deleted', '0')->first();
                $data['leavetype'] = LeaveType::where('id',$leaverequest->leave_type_id)->where('is_deleted', '0')->orderBy('id', 'ASC')->first('leave_type.name');
                $data['designation'] = Designation::join('employee','employee.designation_id','=','designation.id')->where('employee.id',$empid)->first(['designation.id','designation.designation_name']);
                $data['leave_allocation'] = LeaveAllocation::where('leave_allocation.employee_id',$empid)->first();
                $data['user'] = User::where('id','=',$leaverequest->requester_user_id)->first();

                //fetch all leave request detail list
              $data['leavedetaillist'] = LeaveRequestDetail::join('users','users.id','=','leave_request_detail.approver_user_id')->get(['leave_request_detail.*','users.username as approver_username']);
              // dd( $data['leave_allocation']);

            if ($leaverequest) {
                $data['leaverequest'] = $leaverequest;
                return view('admin.leave_request.detail')->with($data);
            } else {
                return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('leaverequest-list')->with('failed', 'Record not found.');
        }
    }
    public function AddleaverequestDetail(Request $request) {
        $rules = [
            'status' => 'required',
            'comment' =>'required|min:20|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
       // dd($validator);
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            // $data = $request->input();
         
            try {
                
                $data = new LeaveRequestDetail();
                $detail = LeaveRequestDetail::pluck('id');
            
                        $data->employee_leave_request_id = $request->input('employee_leave_request_id');
                        $data->employee_id = $request->input('employee_id');
                        $data->designation_id = $request->input('designation_id');
                        $data->status = $request->input('status');
                        $data->comment = $request->input('comment');
                        $data->approver_user_id = \Auth::user()->id ? \Auth::user()->id : null;
                        $data->save();
                        
                return redirect()->route('leaverequest-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('leaverequest-list')->with('failed', 'Record not added.');
            }
        }
    }
}
