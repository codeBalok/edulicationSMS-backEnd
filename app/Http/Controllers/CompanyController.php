<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avetmiss;
use App\Models\Template;
use App\Models\State;
use App\Models\EmailCourseStore;
use App\Models\CompanyDocument;
use App\Models\InfoPakSpecific;
use App\Models\BackgroundTemplate;
use App\Models\courseEmail;
use App\Models\AvitmessFunding;
use App\Models\FundingSource;
use App\Models\User;
use App\Models\CompanySetting;
use App\Models\StudentNoteCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ImageController;
use Exception;
use DB;
use Auth;
class CompanyController extends Controller
{
   public function avetmisssetting(){
    try {
        $users = User::get();
        $user_id = Auth::user()->id;
        $avetmiss = Avetmiss::where('user_id',$user_id)->first();
        $avitmess_funding = AvitmessFunding::where('avetmiss_id',$avetmiss->id)->get();
        $interntional = FundingSource::get();
        return view('admin.company.avetmisssetting',compact('users','avetmiss','avitmess_funding','interntional'));
    } catch (Exception $e) {
        // Handle the error and redirect back with an error message
        return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
    }
   }
   public function saveAvetmiss(Request $request){
      try {
        $user_id = Auth::user()->id;
        $avetmiss = Avetmiss::where('user_id',$user_id)->first();
        if($avetmiss == null){
            $avetmiss = new Avetmiss();
        }
         // Set the attributes for the new record
         $avetmiss->contact = $request->contact;
         $avetmiss->companyIdentifier = $request->companyIdentifier;
         $avetmiss->companyType = $request->companyType;
         $avetmiss->isManagingAgent = $request->isManagingAgent;
         $avetmiss->authorityIdentifier = $request->authorityIdentifier;
         $avetmiss->authorityName = $request->authorityName;
         $avetmiss->address1 = $request->address1;
         $avetmiss->address2 = $request->address2;
         $avetmiss->suburb = $request->suburb;
         $avetmiss->state = $request->state;
         $avetmiss->pcode = $request->pcode;
         $avetmiss->tcontactf = $request->tcontactf;
         $avetmiss->temail = $request->temail;
         $avetmiss->tphone = $request->tphone;
         $avetmiss->tfax = $request->tfax;
         $avetmiss->user_id = Auth::user()->id;
        // Attach FundingStates to Avetmiss with additional pivot data
        $avetmiss->save();
        if($request->funding != null){
            foreach($request->funding['state'] as $row => $funding){
                $state = new AvitmessFunding;
                $state->user_id = Auth::user()->id;
                $state->state = $request->funding['state'][$row];
                $state->international =  $request->funding['international'][$row];
                $state->avetmiss_id  = $avetmiss->id;
                $state->funding_state_id = $request->funding['state_funding'][$row];
                $state->description = $request->funding['description'][$row];
                $state->save();
               }
        }
           
         return redirect()->route('company.avetmissSetting');
    
     } catch (\Exception $e) {
        
         // Optionally, display an error message or take other actions
         echo "An error occurred while creating the record: " . $e->getMessage();
     }

   }
   public function certificate(Request $request){
      try {
            
        $certificateId = $request->query('makeDefault');
        if($certificateId != null){
            $certificate = Template::find($certificateId);
            if ($certificate) {
                // Set the certificate as default (example logic)
                $certificate->is_default = true;
                $certificate->save();

                // Optionally, unset other certificates as default
                Template::where('id', '!=', $certificateId)->update(['is_default' => false]);

                // Return a success response
                return view('admin.company.certificate',compact('templates'));
            } else {
                return view('admin.company.certificate',compact('templates'));

            }
        }else{
            $templates = Template::get();
            return view('admin.company.certificate',compact('templates'));
        }
     } catch (\Exception $e) {
         Log::error('Error rendering AVETMISS setting view: ' . $e->getMessage());
 
         // Optionally, you can redirect to a different page or show an error message
         return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page. Please try again later.');
     }
   }
   public function template(Request $request){  
        //  dd($request);
        try {
            // Create a new template instance
            $template = new Template;
            $template->newCertificateName = $request->newCertificateName;
            $template->save();

            // Redirect to the edit route with success message
            return redirect()->route('certificate.template.edit', $template->id)->with('success', 'Template created successfully.');
        } catch (Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while creating the template.');
        }

   }

   public function templateEdit($id){
    try {
        $template = Template::where('id', $id)->first();
        $backgroundTemplate = BackgroundTemplate::where('templates_id',$template->id)->get();
        $certificate = courseEmail::where('certificate_id',$template->id)->first();
        if (!$template) {
            throw new \Exception('Template not found');
        }
        return view('admin.company.certificateEdit', compact('template','backgroundTemplate','certificate'));
    } catch (\Exception $e) {
        // Handle the exception, log it or display an error message
        return redirect()->back()->with('error', $e->getMessage());
    }
   }

   public function template_update(Request $request,$id){ 
    try {
        // Find the template by ID
        $template = Template::find($id);

        // Validate if the template is found
        if (!$template) {
            return redirect()->back()->with('error', 'Template not found.');
        }

        // Update template fields
        $template->newCertificateName = $request->newCertificateName;
        $template->leading_text = $request->leading_text;
        $template->orientation = $request->orientation;
        $template->size = $request->size;
        $template->trailing_text = $request->trailing_text;

        // Handle image upload
        $myimage = "null";
        if (!is_null($request->image)) {
            $image = new ImageController;
            $myimage = $image->files($request->image);
            $template->image = $myimage;
        }

        // Prepare signing authority data
        $text1 = [];
        $text1['signing_authority_name'] = $request->signing_authority_name;
        $text1['signing_authority_title'] = $request->signing_authority_title;

        $text2 = [];
        $text2['secound_signing_name'] = $request->secound_signing_name;
        $text2['secound_signing_title'] = $request->secound_signing_title;

        $template->signing_authority = json_encode($text1);
        $template->secound_signing = json_encode($text2);

        // Save the updated template
        $template->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Template updated successfully.');
    } catch (Exception $e) {
        // Redirect back with error message
        return redirect()->back()->with('error', 'An error occurred while updating the template.');
    }
        }

        public function background(Request $request){
            try {
                // dd($request);
                $background = new BackgroundTemplate;
                $myimage = "null";
    
                if (!is_null($request->image)) {
                    $image = new ImageController;
                    $myimage = $image->files($request->image);
                    $background->image = $myimage;
                }
    
                $background->templates_id = $request->templates_id;
                $background->name = $request->template;
                $background->dpi = $request->dpi;
                $background->added_by = $request->added_by;
                $background->save();
                // dd($background);
    
                return redirect()->route('company.certificate')->with('error', 'Invalid certificate ID.');
            } catch (Exception $e) {
                return redirect()->route('company.certificate')->with('error', 'Invalid certificate ID.');
            }

        }

        public function clone($id){
            try {
                // Validate the parameter
                if (is_numeric($id)) {
                    // Find the certificate by ID
                    $certificate = Template::find($id);
                    if ($certificate) {
                        // Copy the certificate
                        $newCertificate = $certificate->replicate();
                        $newCertificate->save();
    
                        return redirect()->route('company.certificate')->with('success', 'Certificate copied successfully.');
                    } else {
                        return redirect()->route('company.certificate')->with('error', 'Certificate not found.');
                    }
                } else {
                    return redirect()->route('company.certificate')->with('error', 'Invalid certificate ID.');
                }
            } catch (Exception $e) {
                return redirect()->route('company.certificate')->with('error', 'An error occurred while copying the certificate.');
            }

        }

        public function templatedestroy($id){
                    // dd($id);
                    try {
                        // Validate the parameter
                        if (is_numeric($id)) {
                            // Find the template by ID
                            $template = Template::find($id);
                            if ($template) {
                                // Delete the template
                                $template->delete();
            
                                return redirect()->route('company.certificate')->with('success', 'Template deleted successfully.');
                            } else {
                                return redirect()->route('company.certificate')->with('error', 'Template not found.');
                            }
                        } else {
                            return redirect()->route('company.certificate')->with('error', 'Invalid template ID.');
                        }
                    } catch (Exception $e) {
                        return redirect()->route('company.certificate')->with('error', 'An error occurred while deleting the template.');
                    }
        }

        public function companyDoc(Request $request){
            try {
                $infos = CompanyDocument::where('type','info')->get();
                // dd($infos);
                $email = CompanyDocument::where('type','email')->get();
                return view('admin.company.document',compact('infos','email'));
            } catch (Exception $e) {
                // Handle the error and redirect back with an error message
                return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
            }
        }

        public function uploadFile(Request $request)
        { 
            $request->validate([
                'file' => 'required|file|max:20480', // Max size: 20MB
            ]);
            // dd($request);
            $documents = new CompanyDocument;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file = $file->move(public_path('document'), $filename);
                $imageName = 'document/' . $filename;
                $documents->file_name = $imageName;
                }
        $documents->document_name = $request->document_name;
        $documents->type = $request->type;
        $documents->save();
        return back()->with('error', 'Failed to upload file');
        }
        
        public function documentdelete($id){
            try {
                    $template = CompanyDocument::find($id);
                    if ($template) {
                        $template->delete();
                        // dd($template);
                        return redirect()->route('company.document')->with('success', 'Template deleted successfully.');
                    } else {
                        return redirect()->route('company.document')->with('error', 'Template not found.');
                    }
                
            } catch (Exception $e) {
                return redirect()->route('company.document')->with('error', 'An error occurred while deleting the template.');
            }
            }
            public function documentEdit($id){
                try {
                        $template = CompanyDocument::find($id);
                        return view('admin.company.document.edit',compact('template','id'));
                } catch (Exception $e) {
                    return redirect()->route('company.document')->with('error', 'An error occurred while deleting the template.');
                }
                }
            public function competencyReport(){
                try {
                    $infos = CompanyDocument::where('type','info')->get();
                    $email = CompanyDocument::where('type','email')->get();
                    return view('admin.company.competencyReport',compact('infos','email'));
                } catch (Exception $e) {
                    // Handle the error and redirect back with an error message
                    return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
                }
            }

            public function competencyReportEdit(Request $request){
                                // dd($request);
               return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
            }


            public function companysettings(){
                try {
                    $user_id = Auth::user()->id;
                    // $infos = CompanyDocument::where('type','info')->get();
                    $note = StudentNoteCategory::get();
                    $corses_settings = CompanySetting::where('name','Course Setting')->first();
                    $students_setting = CompanySetting::where('name','Student Setting')->first();
                    $course_setting = json_decode($corses_settings->description,true);
                    $student_setting = json_decode($students_setting->description,true);
                    $course_delivery_method = DB::table('user_delivery_methods')->where('user_id', $user_id)->get();
                    
                    return view('admin.company.companySetting',compact('course_setting','note','student_setting','course_delivery_method'));
                } catch (Exception $e) {
                    // Handle the error and redirect back with an error message
                    return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
                }
            }

            public function CQR(){
                try {
                    $states = State::get();
                    $infos = CompanyDocument::where('type','info')->get();
                    return view('admin.cqr.report',compact('states'));
                } catch (Exception $e) {
                    // Handle the error and redirect back with an error message
                    return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
                }
            }

            public function CQRreporthistory(){
                try {
                    $infos = CompanyDocument::where('type','info')->get();
                    return view('admin.cqr.report-history');
                } catch (Exception $e) {
                    // Handle the error and redirect back with an error message
                    return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
                }
            }

            public function courseEmail(Request $request){
                // dd($request);
                $courses_op = EmailCourseStore::where('course_id',$request->courId)->first();
                if($courses_op != null){
                    $courses_op->subject = $request->subject;
                    $courses_op->note = $request->note;
                    $courses_op->com_chk = json_encode($request->com_chk);
                    $courses_op->save();
                }else{
                    $courseDocument = new EmailCourseStore;
                    $courseDocument->course_id = $request->courId;
                    $courseDocument->subject = $request->subject;
                    $courseDocument->note = $request->note;
                    $courseDocument->com_chk = json_encode($request->com_chk);
                    $courseDocument->save();
                }
                     
                return redirect()->back()->with('success', 'Document delete successfully!');
            }

            public function courseCertificateDocument(Request $request){
                $request->validate([
                    'myFile' => 'required|file|max:20480', // Max size: 20MB
                ]);
                $documents = new InfoPakSpecific;
                if ($request->hasFile('myFile')) {
                    $file = $request->file('myFile');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file = $file->move(public_path('infopakdocument'), $filename);
                    $imageName = 'infopakdocument/' . $filename;
                    $documents->path = $imageName;
                }
            $documents->documentname = $request->name;
            $documents->filename = $filename;
            $documents->save();
            return response()->json(['response' => "0"]); 
            }
            public function courseCertificate(Request $request){
                // dd($request);
                $courses_op = courseEmail::where('course_id',$request->course_id)->first();
                if($courses_op != null){
                    $courses_op->certificate_id = $request->certificate;
                    $courses_op->subject = $request->subject;
                    $courses_op->body = $request->note;
                    // $courses_op->com_chk = json_encode($request->com_chk);
                    $courses_op->save();
                }else{
                    $courseDocument = new courseEmail;
                    $courseDocument->course_id = $request->course_id;
                    $courseDocument->certificate_id = $request->certificate;
                    $courseDocument->subject = $request->subject;
                    $courseDocument->body = $request->note;
                    // $courseDocument->com_chk = json_encode($request->com_chk);
                    $courseDocument->save();
                    }
                         
                    return redirect()->back()->with('success', 'Document delete successfully!');
            }
            public function document_update(Request $request){
                $document_info = CompanyDocument::find($request->template_id);
                // dd($document_info,$request);
                    // $request->validate([
                    //     'file' => 'required|file|max:20480', // Max size: 20MB
                    // ]);
                   
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file = $file->move(public_path('document'), $filename);
                        $imageName = 'document/' . $filename;
                        $document_info->file_name = $imageName;
                        }
                $document_info->document_name = $request->document_name;
                $document_info->save();
                return redirect()->back()->with('success', 'Document Update successfully!');
            }
            
    }
    