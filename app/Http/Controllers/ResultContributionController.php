<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use App\Models\ResultContribution;
use Illuminate\Http\Request;

class ResultContributionController extends Controller
{
    //

    public function __construct()
    {
        // Module Data
      
        $this->access = 'result-contribution';

    }

    public function list() {
        $data = [];
        $data['title'] = 'Result Contribution List';
        $data['menu_active_tab'] = 'resultcontribution-list';
        $data['access'] = $this->access;
        
        $data['row'] = ResultContribution::where('status', '1')->first();
        $data['exams'] = ExamType::orderBy('id', 'asc')->get();

        return view('admin.result_contribution.list')->with($data);
    
    }

    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'attendances' => 'required|numeric',
            'assignments' => 'required|numeric',
            'activities' => 'required|numeric',
            'contributions' => 'required',
        ]);


        // Check Contribution Total
        $exam_contributions = 0;
        foreach($request->contributions as $contribution){
            if(!is_numeric($contribution)){
                session()->flash('error', ('Your Contribution is not correct'));

                return redirect()->back();
            }
            else {
                $exam_contributions = $exam_contributions + $contribution;
            }
        }
        if( ($exam_contributions + $request->attendances + $request->assignments + $request->activities) != 100 ) {

            session()->flash('error', ('Your contribution is not correct.'));

            return redirect()->back();
        }



        $id = $request->id;

        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $contribution = new ResultContribution;
            $contribution->attendances = $request->attendances;
            $contribution->assignments = $request->assignments;
            $contribution->activities = $request->activities;
            $contribution->save();
        }
        else{
            // Update Data
            $contribution = ResultContribution::find($id);
            $contribution->attendances = $request->attendances;
            $contribution->assignments = $request->assignments;
            $contribution->activities = $request->activities;
            $contribution->save();
        }


        // Update Exam Contributions
        foreach($request->exams as $key => $exam){
            $exam = ExamType::find($exam);
            $exam->contribution = $request->contributions[$key];
            $exam->save();
        }


        session()->flash('success', ('data updated successfully'));

        return redirect()->back();
    }


}
