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
use App\Models\FeesFine;
use App\Models\FeesCategory;
use Mail;

class FeesFineController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Fees Fine List';
        $data['menu_active_tab'] = 'fees-fine-list';
        $data['fees_fine'] = FeesFine::orderBy('start_day', 'asc')->where('is_deleted', '0')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();

        return view('admin.fees_fine.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Fees Fine';
        $data['menu_active_tab'] = 'add-fees-fine';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
        
        
        return view('admin.fees_fine.add')->with($data);
    }

    public function store(Request $request) {
        
        // dd($request);
        $rules = [
            'from_day' => 'required',
            'to_day' => 'required',
            'amount' => 'required',
            'amount_type' => 'required',
            'categories' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->input();
            
            try {
                $feesfine = new FeesFine();
                $feesfine->start_day = $request->from_day;
                $feesfine->end_day = $request->to_day;
                $feesfine->amount = $request->amount;
                $feesfine->type = $request->amount_type;
                $feesfine->save();
                
                // Create Attach
                $feesfine->feesCategories()->attach($request->categories);
                
                
                return redirect()->route('fees-fine-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
                return redirect()->route('fees-fine-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Fees Fine';
        $data['menu_active_tab'] = 'fees-fine-list';
        
        if ($id) {
            $fees_fine = FeesFine::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($fees_fine) {
                
                $data['fees_fine'] = $fees_fine;
                $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();
                
                return view('admin.fees_fine.edit')->with($data);
            } else {
                return redirect()->route('fees-fine-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('fees-fine-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        // dd($request);
        if ($id) {
            $request->validate([
                'from_day' => 'required',
                'to_day' => 'required',
                'amount' => 'required',
                'amount_type' => 'required',
                'categories' => 'required',
                'status' => 'required',
            ]);
            $data = $request->input();
            $feesfine = FeesFine::find($id);
            
            if ($feesfine) {
                
                $feesfine->start_day = $request->from_day;
                $feesfine->end_day = $request->to_day;
                $feesfine->amount = $request->amount;
                $feesfine->type = $request->amount_type;
                $feesfine->status = $request->status;
                $feesfine->save();
                
                // Update Attach
                $feesfine->feesCategories()->sync($request->categories);

                return redirect()->route('fees-fine-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('fees-fine-list')->with('failed', 'Record not found.');
            }
        }
    }
    

    public function delete($id) {
        
        if ($id) {
            $feesfine = FeesFine::find($id);
            if ($feesfine) {
                
                $feesfine->is_deleted = '1';
                $feesfine->feesCategories()->detach();
                $feesfine->save();
            }
            return redirect()->route('fees-fine-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('fees-fine-list')->with('failed', 'Record not found.');
        }
    }

}
