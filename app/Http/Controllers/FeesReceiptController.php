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
use Mail;

class FeesReceiptController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = 'Fees Receipt';
        $data['menu_active_tab'] = 'fees-receipt';
        $data['fees_receipt'] = FeesReceipt::where('slug', 'fees-receipt')->first();
        

        return view('admin.fees_receipt.index')->with($data);
    }

    public function store(Request $request) {
        
        // dd($request);
        $rules = [
            'logo_left' => 'nullable|image',
            'logo_right' => 'nullable|image',
            'background' => 'nullable|image',
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
            
            if ($request->hasfile('logo_left')) {
                $file = $request->file('logo_left');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt/', $fileName);
                $logo_left = $fileName;
            } else {
                $logo_left = '';
            }
            
            if ($request->hasfile('logo_right')) {
                $file = $request->file('logo_right');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt/', $fileName);
                $logo_right = $fileName;
            } else {
                $logo_right = '';
            }
            
            if ($request->hasfile('background')) {
                $file = $request->file('background');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt/', $fileName);
                $background = $fileName;
            } else {
                $background = '';
            }
            
            $feereceipt = new FeesReceipt;
            


            $feereceipt->slug = $request->slug;
            $feereceipt->title = $request->title;
            $feereceipt->header_left = $request->header_left;
            $feereceipt->header_center = $request->header_center;
            $feereceipt->header_right = $request->header_right;
            $feereceipt->body = $request->body;
            $feereceipt->footer_left = $request->footer_left;
            $feereceipt->footer_center = $request->footer_center;
            $feereceipt->footer_right = $request->footer_right;
            $feereceipt->logo_left = $logo_left;
            $feereceipt->logo_right = $logo_right;
            $feereceipt->background = $background;
            $feereceipt->width = $request->width;
            $feereceipt->save();
            
            return redirect()->route('add-fees-receipt')->with('success', 'Record Added.');
        }
        else{
            
            // dd($request);
            // Update Data
            $feereceipt = FeesReceipt::find($id);
            
            if ($request->hasfile('logo_left')) {
                $file = $request->file('logo_left');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt', $fileName);
                $logo_left = $fileName;
            } else {
                $logo_left = $feereceipt->logo_left;
            }
            
            if ($request->hasfile('logo_right')) {
                $file = $request->file('logo_right');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt', $fileName);
                $logo_right = $fileName;
            } else {
                $logo_right = $feereceipt->logo_right;
            }
            
            if ($request->hasfile('background')) {
                $file = $request->file('background');
                $extenstion = $file->getClientOriginalName();
                $fileName =  time() . '_' . $extenstion;
                $file->move('fee_receipt', $fileName);
                $background = $fileName;
            } else {
                $background = $feereceipt->background;
            }

            $feereceipt->slug = $request->slug;
            $feereceipt->title = $request->title;
            $feereceipt->header_left = $request->header_left;
            $feereceipt->header_center = $request->header_center;
            $feereceipt->header_right = $request->header_right;
            $feereceipt->body = $request->body;
            $feereceipt->footer_left = $request->footer_left;
            $feereceipt->footer_center = $request->footer_center;
            $feereceipt->footer_right = $request->footer_right;
            $feereceipt->logo_left = $logo_left;
            $feereceipt->logo_right = $logo_right;
            $feereceipt->background = $background;
            $feereceipt->width = $request->width;
            $feereceipt->save();
            
            return redirect()->route('add-fees-receipt')->with('success', 'Record Updated.');
        }
        
        }
    }




    

}
