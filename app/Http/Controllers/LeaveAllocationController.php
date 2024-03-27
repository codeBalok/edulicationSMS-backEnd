<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveAllocation;
use App\Models\LeaveAllocationDetail;
use App\Models\LeaveType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class LeaveAllocationController extends Controller
{
    //
    public function leaveallocationList() {
        $data = [];
        $data['title'] = 'Leave allocation List';
        $data['menu_active_tab'] = 'leaveallocation-list';
        $data['leaveallocation'] = LeaveAllocation::join('employee','employee.id','=','leave_allocation.employee_id')->join('designation','designation.id','=','employee.designation_id')->get(['leave_allocation.*','employee.first_name','employee.last_name','employee.employee_code','designation.designation_name']);
      // dd($data['leaveallocation']);
        
        return view('admin.leave_allocation.list')->with($data);
    }

    public function addLeaveAllocation(Request $request) {
        $data = [];
        $data['title'] = 'Add leave allocation';
        $data['menu_active_tab'] = 'add-leaveallocation';
        $data['leavetype'] = LeaveType::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
        //dd($data['leavetype']);
        $data['employee'] = Employee::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
       
        return view('admin.leave_allocation.add')->with($data);
    }
    public function storeLeaveAllocation(Request $request) {
        //dd($request->all());
        $rules = [
            'employee_id' => 'required',
            'start_date' => 'required|date', 
            'end_date' => 'required|date',
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
                
                $data = new LeaveAllocation();
                //dd($data);
                       
                        $data->employee_id = $request->input('employee_id');
                        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
                        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
                            $data->start_date=$startDate;
                            $data->end_date=$endDate;
                       
                        //alloted leaves counting
                        $numberOfDays = $endDate->diffInDays($startDate);
//dd($numberOfDays);
                        $data->leave_allotted = $numberOfDays;
                        $data->description = $request->input('description');
                       
                        // $data->requester_user_id = \Auth::user()->id ? \Auth::user()->id : null;
                        //dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('leaveallocation-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               //dd($e);
                return redirect()->route('leaveallocation-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editLeaveAllocation(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Leave Allocation';
        $data['menu_active_tab'] = 'leaveallocation-list';
        if ($id) {
            $leaveallocation = LeaveAllocation::find($id);
            $data['leaveallocation'] = LeaveAllocation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            $data['employee'] = Employee::where('id',$leaveallocation->employee_id)->where('is_deleted', '0')->orderBy('id', 'ASC')->first();
            $data['leavetype'] = LeaveType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            
            if ($leaveallocation) {
                $data['leaveallocation'] = $leaveallocation;
                //dd($data['employee']);
                
                return view('admin.leave_allocation.edit')->with($data);
            } else {
                return redirect()->route('leaveallocation-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('leaveallocation-list')->with('failed', 'Record not found.');
        }
    }
    public function updateLeaveAllocation(Request $request, $id) {
        
        if ($id) {
            $request->validate([
                'leave_type_id'=>'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'leave_allotted' => 'required|numeric',
            ]);
           //dd($request->all());
         $data = $request->input();
           //dd($data);
            $leaveallocation = LeaveAllocation::find($id);
            if ($leaveallocation) {
               

                 $leaveallocation->leave_type_id = isset($data['leave_type_id']) ? $data['leave_type_id'] : null;
                $leaveallocation->start_date = isset($data['start_date']) ? $data['start_date'] : null;
                $leaveallocation->end_date = isset($data['end_date']) ? $data['end_date'] : null;
                $leaveallocation->leave_allotted = isset($data['leave_allotted']) ? $data['leave_allotted'] : null;
                $leaveallocation->description = isset($data['description']) ? $data['description'] : null;

                $leaveallocation->save();
                
            }
            //dd('success');
            return redirect()->route('leaveallocation-list')->with('success', 'Record Updated.');
        } else {
          // dd('fail');
            return redirect()->route('leaveallocation-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteLeaveAllocation($id) {
        if ($id) {
            $leaveallocation = LeaveAllocation::find($id);
            if ($leaveallocation) {
                $leaveallocation->is_deleted = '1';
                
                $leaveallocation->save();
            }
            return redirect()->route('leaveallocation-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('leaveallocation-list')->with('failed', 'Record not found.');
        }
    }
   
}
