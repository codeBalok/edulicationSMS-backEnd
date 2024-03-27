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
use FeesCategory;
use Mail;

class FeesCategoryController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Fees Categories List';
        $data['menu_active_tab'] = 'fees-categoris-list';
        $data['fees_category'] = \App\Models\FeesCategory::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.fees_category.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Fees Category';
        $data['menu_active_tab'] = 'add-fees-category';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.fees_category.add')->with($data);
    }

    public function store(Request $request) {
        $rules = [
            'title' => 'required|string|min:3|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $feestype = new \App\Models\FeesCategory();
                $feestype->title = $data['title'];
                $feestype->slug = Str::slug($request->title, '-');
                $feestype->save();
                return redirect()->route('fees-categoris-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
                return redirect()->route('fees-categoris-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Fees Type';
        $data['menu_active_tab'] = 'fees-categoris-list';
        if ($id) {
            $fees_category = \App\Models\FeesCategory::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($fees_category) {
                $data['fees_category'] = $fees_category;
                return view('admin.fees_category.edit')->with($data);
            } else {
                return redirect()->route('fees-categoris-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('fees-categoris-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        
        if ($id) {
            $request->validate([
                'title' => 'required',
            ]);
            $data = $request->input();
            $fees_category = \App\Models\FeesCategory::find($id);
            // dd($fees_category);
            if ($fees_category) {
                
                $fees_category->title = $data['title'];
                $fees_category->slug = Str::slug($request->title, '-');
                $fees_category->status = $request->status;
                $fees_category->save();

                return redirect()->route('fees-categoris-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('fees-categoris-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $fees_category = \App\Models\FeesCategory::find($id);
            if ($fees_category) {
                
                $fees_category->is_deleted = '1';
                $fees_category->save();
            }
            return redirect()->route('fees-categoris-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('fees-categoris-list')->with('failed', 'Record not found.');
        }
    }

}
