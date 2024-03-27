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
use App\Models\FeesDiscount;
use App\Models\FeesCategory;
use App\Models\StatusType;
use Mail;

class FeesDiscountController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Fees Discount List';
        $data['menu_active_tab'] = 'fees-discount-list';
        $data['fees_discount'] = FeesDiscount::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
        $data['status_type'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

        return view('admin.fees_discount.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Fees Discount';
        $data['menu_active_tab'] = 'add-fees-discount';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
        $data['status_types'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

        return view('admin.fees_discount.add')->with($data);
    }

    public function store(Request $request) {
        
        // dd(date("d-m-Y", strtotime($request->start_date)));
        $rules = [
            'title' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'amount' => 'required|numeric',
            'amount_type' => 'required|integer',
            'categories' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->input();
            
            try {
                $feesdiscount = new FeesDiscount();
                $feesdiscount->title = $request->title;
                $feesdiscount->start_date = $request->start_date;
                $feesdiscount->end_date = $request->end_date;
                $feesdiscount->amount = $request->amount;
                $feesdiscount->type = $request->amount_type;
                $feesdiscount->save();
                
                // Create Attach
                $feesdiscount->feesCategories()->attach($request->categories);
                $feesdiscount->statusTypes()->attach($request->status);
                
                return redirect()->route('fees-discount-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
                return redirect()->route('fees-discount-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Fees Discount';
        $data['menu_active_tab'] = 'fees-discount-list';
        
        if ($id) {
            $fees_discount = FeesDiscount::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($fees_discount) {
                
                $data['fees_discount'] = $fees_discount;
                $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
                $data['status_type'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
                
                return view('admin.fees_discount.edit')->with($data);
            } else {
                return redirect()->route('fees-discount-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('fees-discount-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        
        if ($id) {
            $request->validate([
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'amount' => 'required',
                'amount_type' => 'required|integer',
                'categories' => 'required',
                'status' => 'required',
            ]);
            $data = $request->input();
            $feesdiscount = FeesDiscount::find($id);
            
            if ($feesdiscount) {
                
                $feesdiscount->title = $request->title;
                $feesdiscount->start_date = $request->start_date;
                $feesdiscount->end_date = $request->end_date;
                $feesdiscount->amount = $request->amount;
                $feesdiscount->type = $request->amount_type;
                $feesdiscount->save();
                
                // Update Attach
                $feesdiscount->feesCategories()->sync($request->categories);
                $feesdiscount->statusTypes()->sync($request->status);

                return redirect()->route('fees-discount-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('fees-discount-list')->with('failed', 'Record not found.');
            }
        }
    }
    

    public function delete($id) {
        if ($id) {
            $feesdiscount = FeesDiscount::find($id);
            if ($feesdiscount) {
                
                $feesdiscount->is_deleted = '1';
                $feesdiscount->feesCategories()->detach();
                $feesdiscount->statusTypes()->detach();
                $feesdiscount->save();
            }
            return redirect()->route('fees-discount-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('fees-discount-list')->with('failed', 'Record not found.');
        }
    }

}
