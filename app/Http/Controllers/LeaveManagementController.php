<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveManagementController extends Controller
{
    //
    public function __construct()
    {
        // Module Data
       
        $this->path = 'staff-leave';
        $this->access = 'staff-leave-manage';
    }

    public function List(Request $request)
    {
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        if(!empty($request->user) || $request->user != null){
            $data['selected_user'] = $user = $request->user;
        }
        else{
            $data['selected_user'] = $user = '0';
        }

        if(!empty($request->pay_type) || $request->pay_type != null){
            $data['selected_pay_type'] = $pay_type = $request->pay_type;
        }
        else{
            $data['selected_pay_type'] = $pay_type = '0';
        }

        if(!empty($request->type) || $request->type != null){
            $data['selected_type'] = $type = $request->type;
        }
        else{
            $data['selected_type'] = $type = '0';
        }

        if(!empty($request->start_date) || $request->start_date != null){
            $data['selected_start_date'] = $start_date = $request->start_date;
        }
        else{
            $data['selected_start_date'] = $start_date = date('Y-m-d', strtotime(Carbon::now()->subYear()));
        }

        if(!empty($request->end_date) || $request->end_date != null){
            $data['selected_end_date'] = $end_date = $request->end_date;
        }
        else{
            $data['selected_end_date'] = $end_date = date('Y-m-d', strtotime(Carbon::today()));
        }


        // Search Filter
        $data['users'] = Employee::where('is_deleted', '0')
                            ->orderBy('id', 'asc')->get();
        $data['types'] = LeaveType::where('status', '1')
                            ->orderBy('title', 'asc')->get();

        $rows = Leave::whereDate('apply_date', '>=', $start_date)
                    ->whereDate('apply_date', '<=', $end_date);
                    if(!empty($request->user) || $request->user != null){
                        $rows->where('user_id', $user);
                    }
                    if(!empty($request->pay_type) || $request->pay_type != null){
                        $rows->where('pay_type', $pay_type);
                    }
                    if(!empty($request->type) || $request->type != null){
                        $rows->where('type_id', $type);
                    }
        $data['rows'] = $rows->orderBy('id', 'desc')->get();
        return view('admin.leave_manage.list')->with($data);

    }

    public function status(Request $request, $id)
    {
        // Field Validation
        $request->validate([
            'status' => 'required',
        ]);

        // Status Update
        $leave = Leave::findOrFail($id);
        $leave->review_by = \Auth::user()->id ? \Auth::user()->id : null;
        $leave->status = $request->status;
        $leave->save();


        if($request->status == 1)
        {
            session()->flash('approve_success', ('Approved successfully'));
        }
        else{
            session()->flash('reject_success', ('Rejected successfully'));
        }

        return redirect()->back();
    }
}
