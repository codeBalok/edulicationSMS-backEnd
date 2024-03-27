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
use App\Models\FeesReceipt;
use App\Models\Setting;
use Mail;

class SettingController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = 'Setting';
        $data['menu_active_tab'] = 'setting';
         $data['row'] = Setting::where('status', '1')->first();
        

        return view('admin.setting.index')->with($data);
    }

    public function store(Request $request) {
        
        // dd($request);
        $rules = [
            'title' => 'required',
            'meta_title' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'decimal_place' => 'required',
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
            
            if ($request->hasfile('logo')) {
                $file = $request->file('logo');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('setting/', $fileName);
                $logo = $fileName;
            } else {
                $logo = '';
            }
            
            if ($request->hasfile('favicon')) {
                $file = $request->file('favicon');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('setting/', $fileName);
                $favicon = $fileName;
            } else {
                $favicon = '';
            }
            

            $data = new Setting;
            $data->title = $request->title;
            $data->academy_code = $request->academy_code;
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keywords = $request->meta_keywords;
            $data->logo_path = $logo;
            $data->favicon_path = $favicon;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->fax = $request->fax;
            $data->address = $request->address;
            $data->language = $request->language;
            $data->date_format = $request->date_format;
            $data->time_format = $request->time_format;
            $data->time_zone = $request->time_zone;
            $data->currency = $request->currency;
            $data->currency_symbol = $request->currency_symbol;
            $data->decimal_place = $request->decimal_place;
            $data->copyright_text = $request->copyright_text;
            $data->save();
            
            return redirect()->route('setting')->with('success', 'Record Added.');
        }
        else{
            
            // dd($request);
            // Update Data
            $data = Setting::find($id);
            
            if ($request->hasfile('logo')) {
                $file = $request->file('logo');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('setting', $fileName);
                $logo = $fileName;
            } else {
                $logo = $data->logo_path;
            }
            
            if ($request->hasfile('favicon')) {
                $file = $request->file('favicon');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('setting', $fileName);
                $favicon = $fileName;
            } else {
                $favicon = $data->favicon_path;
            }
            


            $data->title = $request->title;
            $data->academy_code = $request->academy_code;
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keywords = $request->meta_keywords;
            $data->logo_path = $logo;
            $data->favicon_path = $favicon;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->fax = $request->fax;
            $data->address = $request->address;
            $data->language = $request->language;
            $data->date_format = $request->date_format;
            $data->time_format = $request->time_format;
            $data->time_zone = $request->time_zone;
            $data->currency = $request->currency;
            $data->currency_symbol = $request->currency_symbol;
            $data->decimal_place = $request->decimal_place;
            $data->copyright_text = $request->copyright_text;
            $data->save();
            
            return redirect()->route('setting')->with('success', 'Record Updated.');
        }
        
        }
    }




    

}
