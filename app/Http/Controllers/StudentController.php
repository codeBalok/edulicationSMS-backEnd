<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Disability_Types;
use App\Models\DisabilityDetails;
use App\Models\LanguageDiversity;
use App\Models\SpokenLanguage;
use App\Models\Student;
use App\Models\StudentDocument;
use App\Models\SurveyContactStatus;
use App\Services\NatFileGenerator;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use App\Models\StatusType;

class StudentController extends Controller {

    public function dashboard() {
        $data = [];
        $data['title'] = 'Dashboard';
        $data['menu_active_tab'] = 'dashboard';
        return view('admin.dashboard')->with($data);
    }

    public function registerStudent() {
        $data = [];
        $data['title'] = 'Register Student List';
        $data['menu_active_tab'] = 'user-list';
        $data['student'] = Student::orderBy('id', 'DESC')->get();
        $data['blood_group'] = DB::table('blood_group')->get();
        $data['marital_status'] = DB::table('marital_status')->get();
       $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

        $data['surveystatus'] = SurveyContactStatus::where('status', '1')->orderBy('status_type', 'asc')->get();
        return view('admin.student.list')->with($data);
    }

    public function studentList() {
        $data = [];
        $data['title'] = 'Register Student List';
        $data['menu_active_tab'] = 'user-list';
        $data['student'] = Student::orderBy('id', 'DESC')->get();
        $data['countries'] = Country::orderBy('id', 'asc')->get();
        $data['surveystatus'] = SurveyContactStatus::where('status', '1')->orderBy('status_type', 'asc')->get();
        $data['blood_group'] = DB::table('blood_group')->get();
        $data['marital_status'] = DB::table('marital_status')->get();
       $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

        return view('admin.student.list')->with($data);
    }
    public function Students() {
        $data = [];
        $data['title'] = 'Register Student List';
        $data['menu_active_tab'] = 'user-list';
        $data['student'] = Student::orderBy('id', 'DESC')->get();
        $data['countries'] = Country::orderBy('id', 'asc')->get();
        $data['surveystatus'] = SurveyContactStatus::where('status', '1')->orderBy('status_type', 'asc')->get();
        $data['blood_group'] = DB::table('blood_group')->get();
        $data['marital_status'] = DB::table('marital_status')->get();
       $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

        return view('admin.student.student')->with($data);
    }

    public function viewStudent(Request $request, $id) {
        $data = array();
        $data['title'] = 'Register Student View';
        $data['menu_active_tab'] = 'view-student';

        if ($id) {
            $student = Student::findOrFail($id);  // Retrieve student based on the ID

            if ($student) {
                $data['student'] = $student; 
                $data['surveystatus'] = SurveyContactStatus::join('students', 'students.survey_contact_status', '=', 'survey_contact_statuses.id')
                    ->where('students.id',$id)
                    ->orderBy('status_type', 'asc')
                    ->get();
                //document;
                $data['document'] = StudentDocument::join('students', 'students.id', '=', 'student_documents.student_id')
                    ->where('student_documents.student_id',$id)
                    ->orderBy('student_documents.student_id', 'asc')
                    ->get();

                //languagediversity
                $data['languagediversity'] = LanguageDiversity::join('students', 'students.id', '=', 'language_diversities.student_id')
                    ->where('language_diversities.student_id',$id)
                    ->orderBy('language_diversities.student_id', 'asc')
                    ->get();

                    $data['disability_types'] = Disability_Types::orderBy('id', 'asc')->get();
               
                    $data['disability_details'] = DisabilityDetails::join('students', 'students.id', '=', 'disability_details.student_id')
                        ->where('disability_details.student_id', $id)
                        ->orderBy('disability_details.student_id', 'asc')
                        ->get(['students.*','disability_details.student_id as student_id','disability_details.is_disability','disability_details.area_of_disability']);
           
                        $selectedDisabilities = [];
                        foreach ($data['disability_details'] as $disabilityDetail) {
                            // Push area_of_disability value to the array
                            $decodedDisability = json_decode($disabilityDetail->area_of_disability);
                        }
                        
                        // Assign selected disability
                        $data['selectedDisability'] =  array_merge($selectedDisabilities, $decodedDisability);
                        
                        //dd($data['selectedDisability']);
                

            
                $data['countries'] = Country::orderBy('id', 'asc')->get();
                $data['blood_group'] = DB::table('blood_group')->get();
                $data['marital_status'] = DB::table('marital_status')->get();
                $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

                return view('admin.student.view', $data); 
            } else {
                return redirect()->back()->with('error', 'Student not found');
            }
        } else {
            return redirect()->back()->with('error', 'No ID provided');
        }
    }

    public function addStudent(Request $request) {
        $data = [];
        $data['title'] = 'Add User';
        $data['menu_active_tab'] = 'add-user';
        $data['countries'] = Country::orderBy('id', 'asc')->get();
        $data['blood_group'] = DB::table('blood_group')->get();
        $data['marital_status'] = DB::table('marital_status')->get();
        $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.student.add')->with($data);
    }

    public function storeStudent(Request $request) {
        $this->validate($request, [
            'first_name' => 'required|string|min:1|max:255',
            // Add validation rules for other fields
        ]);
        $data = $request->input();
        
        try {
            $student = new Student();
           
            $student->entry_date = $data['entry_date'];
            $student->first_name = $data['first_name'];
            $student->middle_name = $data['middle_name'];
            $student->last_name = $data['last_name'];
            $student->mobile_no = $data['mobile_no'];
            $student->business_phone = $data['business_phone'];
            $student->home_phone = $data['home_phone'];
            $student->email_id = $data['email_id'];
            $student->save();
            return redirect()->route('student-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
      
            return redirect()->route('student-list')->with('failed', 'Record not added.');
        }
    }
    public function editStudent(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Student';
        $data['menu_active_tab'] = 'student-list';
        if ($id) {
            $student = Student::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['blood_group'] = DB::table('blood_group')->get();
            $data['marital_status'] = DB::table('marital_status')->get();
            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
            $data['surveystatus'] = SurveyContactStatus::where('status', '1')->orderBy('status_type', 'asc')->get();
            
            if ($student) {
                $data['student'] = $student;
                //dd($data['student']);
                return view('admin.student.edit')->with($data);
            } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
        }
    }

    public function updateStudent(Request $request, $id) {
        //dd($request->all());
        if ($id) {
            
                $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                
                
            ]);
            $student = Student::find($id);
           //dd( $student->mobile_no);
            if ($student) {
                try{
                $student->entry_date = $request->input('entry_date');
                $student->first_name = $request->input('first_name');
                $student->middle_name = $request->input('middle_name');
                $student->last_name = $request->input('last_name');
                $student->title = $request->input('title');
               
                $student->preferred_name = $request->input('preferred_name');
               
                $student->certificate_name = $request['first_name'] . ' ' . $request['last_name'];
                
                $student->gender = $request->input('gender');
                
                $student->mobile_no = $request->input('mobile_no');
                $student->emergency_contact_no = $request->input('emergency_contact_no');
                $student->business_phone = $request['business_phone'];
                $student->home_phone = $request['home_phone'];
               $student->residence_building_name = $request['residence_building_name'];
               $student->residence_flat_details = $request['residence_flat_details'];
               $student->residence_street_number = $request['residence_street_number'];
               $student->residence_street_name = $request['residence_street_name'];
               $student->residence_postal_code = $request['residence_postal_code'];
               $student->residence_state = $request['residence_state'];
               $student->residence_country = $request['residence_country'];
               $student->residence_suburb = $request['residence_suburb'];
               $student->postal_building_name = $request['postal_building_name'];
               $student->postal_flat_details = $request['postal_flat_details'];
               $student->postal_street_number = $request['postal_street_number'];
               $student->postal_street_name = $request['postal_street_name'];
               $student->postal_post_code = $request['postal_post_code'];
               $student->postal_state = $request['postal_state'];
               $student->postal_country = $request['postal_country'];
               $student->postal_suburb = $request['postal_suburb'];
               $student->nationality = $request['nationality'];
               $student->email_id = $request['email_id'];
               $student->date_of_birth = $request['date_of_birth'];
               $student->employee_number = $request['employee_number'];
               $student->employer_group = $request['employer_group'];
               $student->is_learner = $request['is_learner'];
               $student->is_companycontact = $request['is_companycontact'];
               $student->USI_no = $request['USI_no'];
               $student->name_type = $request['name_type'];
               $student->overseas_client = $request['overseas_client'];
               $nationalId = mt_rand(1, 9999999);
               $student->national_id = $nationalId;
               $student->unique_id = $student->national_id;
               $student->marital_status = $request->marital_status;
               $student->survey_contact_status = $request->survey_contact_status;
               $student->blood_group = $request->blood_group;
               $student->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                
                $student->student_id = $request->student_id;
                $student->marital_status = $request->marital_status;
                $student->blood_group = $request->blood_group;

                $file_name = null;
                $file_path = null;

                if ($request->hasFile('person_photo')) {
                    $file_name = 'person_photo' . time() . '.' . $request->file('person_photo')->extension();
                    $file_path = $request->file('person_photo')->storeAs('person_photo', $file_name, 'public');
                    
                }
                //dd($file_name);
                if ($file_name != null) {
                    $student->person_photo = $file_name;
                }
                if ($file_path != null) {
                    $student->person_photo = $file_path;
                }
                //dd($student);
                $student->save();
                
            // Update Status
            $student->statuses()->sync($request->statuses);
                }
                catch(Exception $e)
                {
                    dd($e);
                }
            }
            return redirect()->route('view-student',['id' => $id])->with('success', 'Record Updated.');
        } else {
            return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
        }
    }

    public function deleteUser(Request $request) {
        $id = $request->input('delete_id');
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->is_deleted = '1';
                $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $user->save();
            }

            return redirect()->route('user-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('user-list')->with('failed', 'Record not found.');
        }
    }

    public function generateNatFile(NatFileGenerator $natFileGenerator)
    {
        // Fetch student data from the database or any other source
        $studentData = Student::all(); // Replace with your own logic to fetch student data

        // Generate the .nat file
        $filePath = $natFileGenerator->generateNatFile($studentData);

        // Provide the file as a downloadable response
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }

    public function uploadDocument(Request $request, $id)
    {
        $data = [];
        $data['title'] = 'Upload Document';
        //$data['menu_active_tab'] = 'student-list';
        if ($id) {
            $student = Student::find($id);
            if ($student) {
                $data['student'] = $student;
                //dd($data['student']);
                $data['surveystatus'] = SurveyContactStatus::join('students', 'students.survey_contact_status', '=', 'survey_contact_statuses.id')
                ->where('students.id',$id)
                ->orderBy('status_type', 'asc')
                ->get();

                //studentdocument
                $data['document'] = StudentDocument::join('students', 'students.id', '=', 'student_documents.student_id')
                ->where('student_documents.student_id',$id)
                ->orderBy('student_documents.student_id', 'asc')
                ->get();
                
                //language diversity
                $data['languagediversity'] = LanguageDiversity::orderBy('id', 'DESC')->get();
                
                $data['countries'] = Country::orderBy('id', 'asc')->get();
                $data['blood_group'] = DB::table('blood_group')->get();
                $data['marital_status'] = DB::table('marital_status')->get();
                $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
        
                return view('admin.student.view')->with($data);
            } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
        }
       
    }

    public function storeDocument(Request $request,$id)
    {
        //dd($id);
        $request->validate([
            'files.*' => 'required', // Adjust file types and size as needed
            'document_name' => 'required',
        ]);
        
        foreach ($request->file('files') as $file) {
            $path = $file->store('documents');
            //dd($id);
            // Store the document with student ID
            StudentDocument::create([
                
                'student_id' => $id,
                'document_name'=>$request->document_name,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path
            ]);
        }

        return redirect()->route('upload-document', ['id' => $id])->with('success', 'File Uploaded.');

    }

    public function downloadDocument($id)
{
    $document = StudentDocument::findOrFail($id);
    $filePath = storage_path('app/' . $document->file_path);

    return response()->download($filePath, $document->file_name);
}

   

    public function editDisability(Request $request,$id)
    {
        $data = [];
        $data['title'] = 'Edit Disability';
        $data['menu_active_tab'] = 'disability-list';
        if ($id) {
            $student = Student::find($id);
            //dd($student);
            if ($student) {
                $data['disability_types'] = Disability_Types::orderBy('id', 'asc')->get();
               
                 //studentdisability details
                 $data['disabilitydetails'] = DisabilityDetails::join('students', 'students.id', '=', 'disability_details.student_id')
                 ->where('disability_details.student_id',$id)
                 ->orderBy('disability_details.student_id', 'asc')
                 ->get(['students.id as student_id','disability_details.*']);

                 $selectedDisabilities = [];
                    foreach ($data['disabilitydetails'] as $disabilityDetail) {
                        // Decode JSON string to an array
                        $decodedDisability = json_decode($disabilityDetail->area_of_disability);

                        // Merge the arrays
                        $selectedDisabilities = array_merge($selectedDisabilities, $decodedDisability);
                    }

                    // Assign selected disabilities
                    $data['selectedDisability'] = $selectedDisabilities;

                 $data['surveystatus'] = SurveyContactStatus::join('students', 'students.survey_contact_status', '=', 'survey_contact_statuses.id')
                 ->where('students.id',$id)
                 ->orderBy('status_type', 'asc')
                 ->get();
 
                 //studentdocument
                 $data['document'] = StudentDocument::join('students', 'students.id', '=', 'student_documents.student_id')
                 ->where('student_documents.student_id',$id)
                 ->orderBy('student_documents.student_id', 'asc')
                 ->get();
                 
                 //language diversity
                 $data['languagediversity'] = LanguageDiversity::orderBy('id', 'DESC')->get();
                 
                 $data['countries'] = Country::orderBy('id', 'asc')->get();
                 $data['blood_group'] = DB::table('blood_group')->get();
                 $data['marital_status'] = DB::table('marital_status')->get();
                 $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
         

                return view('admin.disability_details.edit')->with($data);
            } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
        }
    }
    public function updateDisability(Request $request, $id) {
        //dd($student_id);
         if ($id) {
 
             $data = $request->input();
             $disabilitydetail= DisabilityDetails::find($id);
             if ($disabilitydetail) {
                $disabilitydetail->student_id = $data['student_id'];
                 $disabilitydetail->is_disability = $data['is_disability'];
                 $areaOfDisabilityJson = json_encode($request->input('area_of_disability'));
                 $disabilitydetail->area_of_disability = $areaOfDisabilityJson;
                 $disabilitydetail->medical_note = $data['medical_note'];
                 //dd($disabilitydetail);
                 $disabilitydetail->save();
 
                 return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
             } else {
                return redirect()->route('view-student',['id' => $id])->with('failed', 'Record not found.');
             }
        }
}
}