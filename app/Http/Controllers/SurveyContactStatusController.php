<?php

namespace App\Http\Controllers;

use App\Models\SurveyContactStatus;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyContactStatusController extends Controller
{
    public function surveycontactstatusList() {
        $data = [];
        $data['title'] = 'Survey Contact Status';
        $data['menu_active_tab'] = 'surveycontact';
       
       
        $data['rows'] = SurveyContactStatus::where('is_deleted','0')->orderBy('status_type', 'asc')->get();
        //dd($data['rows']);
        return view('admin.survey_contact.list')->with($data);
    }
    public function addSurveyContactStatus(Request $request) {
        $data = [];
        $data['title'] = 'Add Contact Status';
        $data['menu_active_tab'] = 'add';
      
        return view('admin.survey_contact.add')->with($data);
    }
    public function storeSurveyContactStatus(Request $request) {
        //dd($request);
        $rules = [
             'status_type' => 'required|string|max:255',
               
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
             $data = $request->input();
         //dd($data);
            try {
                $data = new SurveyContactStatus();
        
               
                        $data->status_type = $request->input('status_type');
                     
                       // dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('surveycontactstatus-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('surveycontactstatus-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editSurveyContactStatus(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Survey Contact Status';
        $data['menu_active_tab'] = 'survey_contact-list';
        if ($id) {
            $surveycontact = SurveyContactStatus::find($id);
           
            if ($surveycontact) {
                $data['surveycontact'] = $surveycontact;
                return view('admin.survey_contact.edit')->with($data);
            } else {
                return redirect()->route('surveycontactstatus-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('surveycontactstatus-list')->with('failed', 'Record not found.');
        }
    }

    public function updateSurveyContactStatus(Request $request, $id) {
        if ($id) {
            $request->validate([
                'status_type' => 'required',
                
            ]);
            $surveycontact = SurveyContactStatus::find($id);
            if ($surveycontact) {
                $surveycontact->status_type = $request->input('status_type');
                $surveycontact->status = $request->status;
               
                $surveycontact->save();
            }
            return redirect()->route('surveycontactstatus-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('surveycontactstatus-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteSurveyContactStaus($id) {
        if ($id) {
            $surveycontact = SurveyContactStatus::find($id);
            if ($surveycontact) {
                $surveycontact->is_deleted = '1';
               
                $surveycontact->save();
            }

            return redirect()->route('surveycontact-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('surveycontact-list')->with('failed', 'Record not found.');
        }
    
    }


}


