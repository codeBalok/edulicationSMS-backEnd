<?php

namespace App\Http\Controllers;

use App\Models\Disability_Types;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Validator;

class DisabilityTypesController extends Controller
{
    //

    public function list() {
        $data = [];
        $data['title'] = 'DisabilityTypes List';
        $data['menu_active_tab'] = 'disability-list';
        $data['disabilitytype'] = Disability_Types::orderBy('id', 'asc')->get();

        return view('admin.disability_type.list')->with($data);
    }
    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add DisabilityTypes';
        $data['menu_active_tab'] = 'add-disabilitytype';
        return view('admin.disability_type.add')->with($data);
    }
    public function store(Request $request) {
        //dd($request);
        $rules = [
            'type' => 'required|string|min:1|max:255',
//            
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            // $data = $request->input();
         
            try {
                $data = new Disability_Types();
                        $data->type = $request->input('type');
                        $data->description = $request->input('description');
                        $data->status = $request->input('status');
                        //dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('disabilitytype-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('disabilitytype-list')->with('failed', 'Record not added.');
            }
        }
    }
  
}
