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
use App\Models\IdCardSetting;
use Mail;

class StudentIdCardSettingController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = 'ID Card Setting';
        $data['menu_active_tab'] = 'id-card-setting';
        $data['id_card'] = IdCardSetting::where('slug', 'student-card')->first();
        

        return view('admin.id_card.index')->with($data);
    }

    public function store(Request $request) {
        
        // dd($request);
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'validity' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            
            $id = $request->id;

        // -1 means no data row found
        if($id == -1){
            // Insert Data

            $setting = new IdCardSetting();
            $setting->slug = $request->slug;
            $setting->title = $request->title;
            $setting->subtitle = $request->subtitle;
            $setting->validity = $request->validity;
            $setting->address = $request->address;
            $setting->save();
            
            return redirect()->route('id-card-setting')->with('success', 'Record Added.');
        }
        else{
            
            // dd($request);
            // Update Data

            $setting = IdCardSetting::find($id);
            $setting->slug = $request->slug;
            $setting->title = $request->title;
            $setting->subtitle = $request->subtitle;
            $setting->validity = $request->validity;
            $setting->address = $request->address;
            $setting->save();
            
            return redirect()->route('id-card-setting')->with('success', 'Record Updated.');
        }
        
        }
    }




    

}
