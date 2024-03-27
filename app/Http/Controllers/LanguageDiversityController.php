<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\LanguageDiversity;
use App\Models\Role;
use App\Models\SpokenLanguage;
use App\Models\StatusType;
use App\Models\Student;
use App\Models\StudentDocument;
use App\Models\SurveyContactStatus;
use Exception;
use Illuminate\Http\Request;
use DB;

class LanguageDiversityController extends Controller
{
    //

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Language Diversity';
        $data['menu_active_tab'] = 'add-languagediversity';
            $data['students'] = Student::where('is_deleted', '0')->orderBy('id', 'asc')->get();
            $data['blood_group'] = DB::table('blood_group')->get();
            $data['marital_status'] = DB::table('marital_status')->get();
            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['spoken_language'] = SpokenLanguage::orderBy('id', 'asc')->get();

            return view('admin.language_diversity.add')->with($data);
            
        } 
    

    public function store(Request $request) {
        $data = $request->input();
       
        try {
           
            $languagediversity = new LanguageDiversity();
            
                $languagediversity->birth_country = $data['birth_country'];
                $languagediversity->student_id = $data['student_id'];
                $languagediversity->main_english = $data['main_english'];
                $languagediversity->other_language = $data['other_language'];
                $languagediversity->other_language_name = $data['other_language_name'];
                if( $data['other_language']==1)
                {
                    $languagediversity->eng_proficiency = '0'; 
                }
                else
                {
                    $languagediversity->eng_proficiency = $data['eng_proficiency'];
                }
               
                $languagediversity->indigenous_status = $data['indigenous_status'];
                //dd( $languagediversity->eng_proficiency);
                $languagediversity->save();
               
                return redirect()->route('students')->with('success', 'Record added successfully.');
            } 
            catch (Exception $e) {
                dd($e);
                return redirect()->route('students')->with('success', 'Record added successfully.');
            }
        }
    


    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit LanguageDiversity';
        $data['menu_active_tab'] = 'languagediversity-list';
        if ($id) {
            $languagediversity = LanguageDiversity::find($id);
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['spoken_language'] = SpokenLanguage::orderBy('id', 'asc')->get();
            $data['languagediversity'] = LanguageDiversity::join('students', 'students.id', '=', 'language_diversities.student_id')
            ->where('language_diversities.student_id',$id)
            ->orderBy('language_diversities.student_id', 'asc')
            ->get();

            $selectedCountry=$languagediversity->birth_country;
            $selectedLanguage=$languagediversity->other_language_name;
            
            $data['selectedCountry'] = $selectedCountry;
            $data['selectedLanguage'] = $selectedLanguage;
            if ($languagediversity) {
                $data['languagediversity'] = $languagediversity;
               
                return view('admin.language_diversity.edit')->with($data);
            } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
       //dd($student_id);
        if ($id) {

            $data = $request->input();
            $languagediversity = LanguageDiversity::find($id);
            //dd($languagediversity['student_id']);
            $data['languagediversity'] = LanguageDiversity::join('students', 'students.id', '=', 'language_diversities.student_id')
                ->where('language_diversities.student_id', $languagediversity['student_id'])
                ->orderBy('language_diversities.student_id', 'asc')
                ->get();
           // dd($data['languagediversity']);
            if ($languagediversity) {
                $data['languagediversity'] = $languagediversity;
                //dd($data['languagediversity']);
                $languagediversity->birth_country = $data['birth_country'];
                $languagediversity->student_id = $data['student_id'];
                $languagediversity->main_english = $data['main_english'];
                $languagediversity->other_language = $data['other_language'];
                $languagediversity->other_language_name = $data['other_language_name'];
                $languagediversity->eng_proficiency = $data['eng_proficiency'];
                $languagediversity->indigenous_status = $data['indigenous_status'];
                //dd($languagediversity);
                $languagediversity->save();
               
                return redirect()->route('view-student',['id' => $id])->with('success', 'Record Updated.');
            } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
            }
        }
    }

}
