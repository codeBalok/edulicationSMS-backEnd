<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\State;
use App\Models\Schedule;
use App\Models\NATFile;
use App\Models\Enquiry ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use ZipArchive;
use File;
use Auth;
class ExportController extends Controller
{
    public function dataExporter()
    {
        try {

            return view('admin.export.data');
        } catch (\Exception $e) {
            // Optionally, display an error message or take other actions
            echo "An error occurred while creating the record: " . $e->getMessage();
        }
    }

    public function exportToXml(Request $request)
    {
        try {
            $table = $request->query('table');
            if ($table == 'student'){
                $students = Student::get();
                $xml = new \SimpleXMLElement('<?xml version="1.0"?><Weworkbook></Weworkbook>');
                foreach ($students as $student) {
                    $blogXml = $xml->addChild('student');
                    $blogXml->addChild('studentId', '');
                    $blogXml->addChild('RTOStudentId', $student->RTOStudentId);
                    $blogXml->addChild('firstName', $student->firstName);
                    $blogXml->addChild('lastName', $student->lastName);
                    $blogXml->addChild('preferredName', $student->preferredName);
                    $blogXml->addChild('contactNumber', $student->contactNumber);
                    $blogXml->addChild('businessNumber', $student->businessNumber);
                    $blogXml->addChild('homeNumber', $student->homeNumber);
                    $blogXml->addChild('facsimileNumber', $student->facsimileNumber);
                    $blogXml->addChild('studentEmail', $student->studentEmail);
                    $blogXml->addChild('studentEmail2', $student->studentEmail2);
                    $blogXml->addChild('studentEmail3', $student->studentEmail3);
                    $blogXml->addChild('preferredEmail', '');
                    $blogXml->addChild('preferredNumber', $student->preferred_contact);
                    $blogXml->addChild('companyId', $student->companyName);
                    $blogXml->addChild('addressLine1', $student->addressLine1);
                    $blogXml->addChild('addressLine2', $student->addressLine2);
                    $blogXml->addChild('suburb', $student->suburb);
                    $blogXml->addChild('state', $student->state);
                    $blogXml->addChild('postCode', $student->postCode);
                    $blogXml->addChild('country', $student->country);
                    $blogXml->addChild('clientCompany', '');
                    $blogXml->addChild('isLearner', $student->isLearner);
                    $blogXml->addChild('isContact', $student->isContact);
                    $blogXml->addChild('role', $student->role);
                    $blogXml->addChild('middleName', $student->middleName);
                    $blogXml->addChild('isMedical', '');
                    $blogXml->addChild('medicalNote', '');
                    $blogXml->addChild('entryDate', $student->entryDate);
                    $blogXml->addChild('NationalIdSetting', $student->nationalID);
                    $blogXml->addChild('number', '');
                    $blogXml->addChild('salutation', '');
                    $blogXml->addChild('prefix', '');
                    $blogXml->addChild('department', '');
                    $blogXml->addChild('vsn', $student->vsn);
                    $blogXml->addChild('dob', $student->dob);
                    $blogXml->addChild('gender', $student->gender);
                    $blogXml->addChild('buildingName', $student->buildingName);
                    $blogXml->addChild('unitDetails', $student->unitDetails);
                    $blogXml->addChild('streetNumber', $student->streetNumber);
                    $blogXml->addChild('streetName', '');
                    $blogXml->addChild('buildingNamepostal', $student->buildingName_postal);
                    $blogXml->addChild('unitDetailspostal', $student->unitDetails_postal);
                    $blogXml->addChild('streetNumberpostal', '');
                    $blogXml->addChild('deliveryBoxpostal', '');
                    $blogXml->addChild('suburbpostal', $student->suburb_postal);
                    $blogXml->addChild('statepostal', $student->state_postal);
                    $blogXml->addChild('postalCodepostal', $student->postalCode_postal);
                    $blogXml->addChild('countrypostal', $student->country_postal);
                    $blogXml->addChild('uniqueStudentIdentifier', $student->uniqueStudentIdentifier);
                    $blogXml->addChild('isUSIValid', '');
                    $blogXml->addChild('streetNamepostal', $student->streetName_postal);
                    $blogXml->addChild('certificateName', $student->certificateName);
                    $blogXml->addChild('surveyStat', $student->surveyStat);
                    $blogXml->addChild('pictureId', '');
                    $blogXml->addChild('EmployerInfoConsent', $student->Employer_Info_Consent);
                    $blogXml->addChild('wisenetid', '');
                    $blogXml->addChild('employeeNumber', $student->employeeNumber);
                    $blogXml->addChild('usiType', $student->nameType);
                    $blogXml->addChild('Highest-school-level-completed', $student->highestLevelCompleted);
                    $blogXml->addChild('Still-at-school', $student->stillAtSchool);
                    $blogXml->addChild('Year-school-level-was-completed', $student->yearSchoolCompleted);
                    $blogXml->addChild('Has-a-disability-impairment-or-long-term-condition', '');
                    $blogXml->addChild('Medical-Note', '');
                    $blogXml->addChild('Disabilities', $student->isDisabled);
                    $blogXml->addChild('Employment', '');
                    $blogXml->addChild('Country-of-Birth', $student->birthCountry);
                    $blogXml->addChild('Do-you-mainly-speak-English-at-home', '');
                    $blogXml->addChild('Do-you-speak-a-language-other-than-English-at-home', '');
                    $blogXml->addChild('English-Proficiency', $student->isMainEnglish);
                    $blogXml->addChild('Indigenous-Status', $student->indigenousStatus);
                    $blogXml->addChild('Prior-Qualification', '');
                    $blogXml->addChild('Completed-any-of-the-following-qualifications', '');
                }
                $xmlString = $xml->asXML();
                return Response::make($xmlString, 200, [
                    'Content-Type' => 'application/xml',
                    'Content-Disposition' => 'attachment; filename="students.xml"',
                ]);
            }

            if($table = 'schedule'){
                $from = $request->query('from');
                $to = $request->query('to');
                if($from != null && $to != null){
                    $schedules = Schedule::whereBetween('start_date', [$from, $to])
                    ->orWhereBetween('end_date', [$from, $to])
                    ->orWhere(function ($query) use ($from, $to) {
                        $query->where('start_date', '<=', $from)
                        ->where('end_date', '>=', $to);
                    })->get();
                    
                    $xml = new \SimpleXMLElement('<?xml version="1.0"?><Weworkbook></Weworkbook>');
                    foreach ($schedules as $schedule) {
                        $blogXml = $xml->addChild('student');
                        $blogXml->addChild('create_time', $schedule->create_time);
                        $blogXml->addChild('start_date', $schedule->start_date);
                        $blogXml->addChild('end_date', $schedule->end_date);
                        $blogXml->addChild('month', $schedule->month);
                        $blogXml->addChild('city_name', $schedule->city_name);
                        $blogXml->addChild('corse_id', $schedule->corse_id);
                        $blogXml->addChild('qouta', $schedule->qouta);
                        $blogXml->addChild('status', $schedule->status);
                        $blogXml->addChild('is_completed', $schedule->is_completed);
                    }
                $xmlString = $xml->asXML();
                return Response::make($xmlString, 200, [
                    'Content-Type' => 'application/xml',
                    'Content-Disposition' => 'attachment; filename="schedule.xml"',
                ]);
            }
        }

        if($table = 'courses'){
            $from = $request->query('from');
            $to = $request->query('to');
                if($from != null && $to != null){
                    $courses = Course::whereBetween('created_at', [$from, $to])->get();
                    $xml = new \SimpleXMLElement('<?xml version="1.0"?><Weworkbook></Weworkbook>');
                    foreach ($courses as $course) {
                        $blogXml = $xml->addChild('student');
                        $blogXml->addChild('create_time', $course->create_time);
                        $blogXml->addChild('start_date', $course->start_date);
                        $blogXml->addChild('end_date', $course->end_date);
                        $blogXml->addChild('month', $course->month);
                        $blogXml->addChild('city_name', $course->city_name);
                        $blogXml->addChild('corse_id', $course->corse_id);
                        $blogXml->addChild('qouta', $course->qouta);
                        $blogXml->addChild('status', $course->status);
                        $blogXml->addChild('is_completed', $course->is_completed);
                    }
                $xmlString = $xml->asXML();
                return Response::make($xmlString, 200, [
                    'Content-Type' => 'application/xml',
                    'Content-Disposition' => 'attachment; filename="courses.xml"',
                ]);
            }
        }

        if($table == 'enquirie'){
            $from = $request->query('from');
            $to = $request->query('to');
            if($from != null && $to != null){
                    $enquiries = Enquiry::whereBetween('created_at', [$from, $to])->get();
                    $xml = new \SimpleXMLElement('<?xml version="1.0"?><Weworkbook></Weworkbook>');
                    foreach ($enquiries as $enquiry) {
                        $blogXml = $xml->addChild('student');
                        $blogXml->addChild('reference_id', $enquiry->reference_id);
                        $blogXml->addChild('source_id', $enquiry->source_id);
                        $blogXml->addChild('program_id', $enquiry->program_id);
                        $blogXml->addChild('name', $enquiry->name);
                        $blogXml->addChild('father_name', $enquiry->father_name);
                        $blogXml->addChild('phone', $enquiry->phone);
                        $blogXml->addChild('email', $enquiry->email);
                        $blogXml->addChild('address', $enquiry->address);
                        $blogXml->addChild('purpose', $enquiry->purpose);
                        $blogXml->addChild('note', $enquiry->note);
                        $blogXml->addChild('date', $enquiry->date);
                        $blogXml->addChild('follow_up_date', $enquiry->follow_up_date);
                        $blogXml->addChild('assigned', $enquiry->assigned);
                        $blogXml->addChild('number_of_students', $enquiry->number_of_students);
                        $blogXml->addChild('status', $enquiry->status);
                    }
                $xmlString = $xml->asXML();
                return Response::make($xmlString, 200, [
                    'Content-Type' => 'application/xml',
                    'Content-Disposition' => 'attachment; filename="schedule.xml"',
                ]);
            }
           
        }
            return view('admin.export.data');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while generating the XML.'], 500);
        }
    }

    public function exportToXls(Request $request)
    {
        try {
            // dd($request);
            $table = $request->query('table');
            if ($table == 'student') {
                $students = Student::get();
                // Set headers for download
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="students.xls"');
                header('Cache-Control: max-age=0');

                // Output Excel header
                echo <<<EOF
                <!DOCTYPE html>
                <html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
                </head>
                <body>
                <table border="1">
                <tr>
                <td>studentId</td>
                <td>RTOStudentId</td>
                <td>firstName</td>
                <td>lastName</td>
                <td>preferredName</td>
                <td>contactNumber</td>
                <td>businessNumber</td>
                <td>homeNumber</td>
                <td>facsimileNumber</td>
                <td>studentEmail</td>
                <td>studentEmail2</td>
                <td>studentEmail3</td>
                <td>preferredEmail</td>
                <td>preferredNumber</td>
                <td>companyId</td>
                <td>addressLine1</td>
                <td>addressLine2</td>
                <td>suburb</td>
                <td>state</td>
                <td>postCode</td>
                <td>country</td>
                <td>clientCompany</td>
                <td>isLearner</td>
                <td>isContact</td>
                <td>role</td>
                <td>middleName</td>
                <td>isMedical</td>
                <td>medicalNote</td>
                <td>entryDate</td>
                <td>NationalIdSetting</td>
                <td>number</td>
                <td>salutation</td>
                <td>prefix</td>
                <td>department</td>
                <td>vsn</td>
                <td>dob</td>
                <td>gender</td>
                <td>buildingName</td>
                <td>unitDetails</td>
                <td>streetNumber</td>
                <td>streetName</td>
                <td>buildingNamepostal</td>
                <td>unitDetailspostal</td>
                <td>streetNumberpostal</td>
                <td>deliveryBoxpostal</td>
                <td>suburbpostal</td>
                <td>statepostal</td>
                <td>postalCodepostal</td>
                <td>countrypostal</td>
                <td>uniqueStudentIdentifier</td>
                <td>isUSIValid</td>
                <td>streetNamepostal</td>
                <td>certificateName</td>
                <td>surveyStat</td>
                <td>pictureId</td>
                <td>EmployerInfoConsent</td>
                <td>wisenetid</td>
                <td>employeeNumber</td>
                <td>usiType</td>
                <td>Highest-school-level-completed</td>
                <td>Still-at-school</td>
                <td>Year-school-level-was-completed</td>
                <td>Has-a-disability-impairment-or-long-term-condition</td>
                <td>Medical-Note</td>
                <td>Disabilities</td>
                <td>Employment</td>
                <td>Country-of-Birth</td>
                <td>Do-you-mainly-speak-English-at-home</td>
                <td>Do-you-speak-a-language-other-than-English-at-home</td>
                <td>English-Proficiency</td>
                <td>Indigenous-Status</td>
                <td>Prior-Qualification</td>
                <td>Completed-any-of-the-following-qualifications</td>
                </tr>
                EOF;

                // Output data rows
                foreach ($students as $student) {
                    echo "<tr><td>{$student->studentId}</td>
                    <td>{$student->RTOStudentId}</td>
                    <td>{$student->firstName}</td>
                    <td>{$student->lastName}</td>
                    <td>{$student->preferredName}</td>
                    <td>{$student->contactNumber}</td>
                    <td>{$student->businessNumber}</td>
                    <td>{$student->homeNumber}</td>
                    <td>{$student->facsimileNumber}</td>
                    <td>{$student->studentEmail}</td>
                    <td>{$student->studentEmail2}</td>
                    <td>{$student->studentEmail3}</td>
                    <td>{}</td>
                    <td>{$student->preferred_contact}</td>
                    <td>{$student->companyName}</td>
                    <td>{$student->addressLine1}</td>
                    <td>{$student->addressLine2}</td>
                    <td>{$student->suburb}</td>
                    <td>{$student->state}</td>
                    <td>{$student->postCode}</td>
                    <td>{$student->country}</td>
                    <td>{}</td>
                    <td>{$student->isLearner}</td>
                    <td>{$student->isContact}</td>
                    <td>{$student->role}</td>
                    <td>{$student->middleName}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{$student->entryDate}</td>
                    <td>{$student->nationalID}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{$student->vsn}</td>
                    <td>{$student->dob}</td>
                    <td>{$student->gender}</td>
                    <td>{$student->buildingName}</td>
                    <td>{$student->unitDetails}</td>
                    <td>{$student->streetNumber}</td>
                    <td>{}</td>
                    <td>{$student->buildingName_postal}</td>
                    <td>{$student->unitDetails_postal}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{$student->suburb_postal}</td>
                    <td>{$student->state_postal}</td>
                    <td>{$student->postalCode_postal}</td>
                    <td>{$student->country_postal}</td>
                    <td>{$student->uniqueStudentIdentifier}</td>
                    <td>{}</td>
                    <td>{$student->streetName_postal}</td>
                    <td>{$student->certificateName}</td>
                    <td>{$student->surveyStat}</td>
                    <td>{}</td>
                    <td>{$student->Employer_Info_Consent}</td>
                    <td>{}</td>
                    <td>{$student->employeeNumber}</td>
                    <td>{$student->nameType}</td>
                    <td>{$student->highestLevelCompleted}</td>
                    <td>{$student->stillAtSchool}</td>
                    <td>{$student->yearSchoolCompleted}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{$student->isDisabled}</td>
                    <td>{}</td>
                    <td>{$student->birthCountry}</td>
                    <td>{}</td>
                    <td>{}</td>
                    <td>{$student->isMainEnglish}</td>
                    <td>{$student->indigenousStatus}</td>
                    <td>{}</td>
                    <td>{}</td>
                    </tr>";
                }

                // Output Excel footer
                echo <<<EOF
                    </table>
                    </body>
                    </html>
                    EOF;
            }

        if($table = 'schedule'){
            $from = $request->query('from');
            $to = $request->query('to');
            if($from != null && $to != null){
                $schedules = Schedule::whereBetween('start_date', [$from, $to])->get();
                // Set headers for download
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="students.xls"');
                header('Cache-Control: max-age=0');

                // Output Excel header
                echo <<<EOF
                <!DOCTYPE html>
                <html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
                </head>
                <body>
                <table border="1">
                <tr>
                <td>id</td>
                <td>create_time</td>
                <td>start_date</td>
                <td>end_date</td>
                <td>month</td>
                <td>city_name</td>
                <td>corse_id</td>
                <td>qouta</td>
                <td>status</td>
                <td>is_completed</td>
                </tr>
                EOF;

                // Output data rows
                foreach ($schedules as $student) {
                    echo "<tr><td>{$student->id}</td>
                    <td>{$student->create_time}</td>
                    <td>{$student->start_date}</td>
                    <td>{$student->end_date}</td>
                    <td>{$student->month}</td>
                    <td>{$student->city_name}</td>
                    <td>{$student->corse_id}</td>
                    <td>{$student->qouta}</td>
                    <td>{$student->status}</td>
                    <td>{$student->is_completed}</td>
                    </tr>";
                }
                // Output Excel footer
                echo <<<EOF
            </table>
            </body>
            </html>
            EOF;
            }else{

            }
        }

        if($table = 'courses'){
            $from = $request->query('from');
            $to = $request->query('to');
            if($from != null && $to != null){
                $enquiries = Course::whereBetween('start_date', [$from, $to])->get();
                // Set headers for download
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="students.xls"');
                header('Cache-Control: max-age=0');

                // Output Excel header
                echo <<<EOF
                <!DOCTYPE html>
                <html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
                </head>
                <body>
                <table border="1">
                <tr>
                <td>id</td>
                <td>name</td>
                <td>code</td>
                <td>course_category_id</td>
                <td>default_course_cost</td>
                <td>follow_up_enquiry</td>
                <td>delivery_method</td>
                <td>required_no_of_unit</td>
                <td>core_unit</td>
                <td>color</td>
                <td>reporting_this_course</td>
                <td>tga_package</td>
                <td>language_id</td>
                <td>course_enquiry_id</td>
                <td>title</td>
                <td>slug</td>
                <td>faculty</td>
                <td>semesters</td>
                <td>credits</td>
                <td>duration</td>
                <td>session_option</td>
                <td>core_units</td>
                <td>total_units</td>
                <td>fee</td>
                <td>description</td>
                <td>comments</td>
                <td>attach</td>
                <td>status</td>
                </tr>
                EOF;

                // Output data rows
                foreach ($enquiries as $enquiry) {
                    echo "<tr><td>{$enquiry->id}</td>
                    <td>{$enquiry->name}</td>
                    <td>{$enquiry->code}</td>
                    <td>{$enquiry->course_category_id}</td>
                    <td>{$enquiry->tga_package}</td>
                    <td>{$enquiry->default_course_cost}</td>
                    <td>{$enquiry->reporting_this_course}</td>
                    <td>{$enquiry->follow_up_enquiry}</td>
                    <td>{$enquiry->delivery_method}</td>
                    <td>{$enquiry->required_no_of_unit}</td>
                    <td>{$enquiry->core_unit}</td>  
                    <td>{$enquiry->color}</td>  
                    <td>{$enquiry->language_id}</td>  
                    <td>{$enquiry->title}</td>  
                    <td>{$enquiry->slug}</td>  
                    <td>{$enquiry->course_enquiry_id}</td>  
                    <td>{$enquiry->faculty}</td>  
                    <td>{$enquiry->semesters}</td>
                    <td>{$enquiry->credits}</td>
                    <td>{$enquiry->duration}</td>
                    <td>{$enquiry->session_option}</td>
                    <td>{$enquiry->fee}</td>
                    <td>{$enquiry->description}</td>
                    <td>{$enquiry->core_units}</td>
                    <td>{$enquiry->comments}</td>
                    <td>{$enquiry->attach}</td>
                    <td>{$enquiry->status}</td>
                    </tr>";
                }
                // Output Excel footer
                echo <<<EOF
            </table>
            </body>
            </html>
            EOF;
            }else{

            }
        }


        if($table = 'enquirie'){
            $from = $request->query('from');
            $to = $request->query('to');
            if($from != null && $to != null){
                $schedules = Enquiry::whereBetween('start_date', [$from, $to])->get();
                // Set headers for download
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="students.xls"');
                header('Cache-Control: max-age=0');

                // Output Excel header
                echo <<<EOF
                <!DOCTYPE html>
                <html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
                </head>
                <body>
                <table border="1">
                <tr>
                <td>id</td>
                <td>reference_id</td>
                <td>source_id</td>
                <td>program_id</td>
                <td>name</td>
                <td>father_name</td>
                <td>phone</td>
                <td>email</td>
                <td>address</td>
                <td>purpose</td>
                <td>note</td>
                <td>date</td>
                <td>follow_up_date</td>
                <td>assigned</td>
                <td>number_of_students</td>
                <td>status</td>
                </tr>
                EOF;

                // Output data rows
                foreach ($schedules as $student) {
                    echo "<tr><td>{$student->id}</td>
                    <td>{$student->reference_id}</td>
                    <td>{$student->source_id}</td>
                    <td>{$student->program_id}</td>
                    <td>{$student->name}</td>
                    <td>{$student->father_name}</td>
                    <td>{$student->phone}</td>
                    <td>{$student->email}</td>
                    <td>{$student->address}</td>
                    <td>{$student->purpose}</td>
                    <td>{$student->note}</td>
                    <td>{$student->date}</td>
                    <td>{$student->follow_up_date}</td>
                    <td>{$student->assigned}</td>
                    <td>{$student->number_of_students}</td>
                    <td>{$student->status}</td>
                    </tr>";
                }
                // Output Excel footer
                echo <<<EOF
            </table>
            </body>
            </html>
            EOF;
            }else{
            }
        }
        } catch (\Exception $e) {
            // Handle the exception, log it, or display an error message
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
    public function exportASQA(){
        try {

            return view('admin.export.ASQA');
        } catch (\Exception $e) {
            // Optionally, display an error message or take other actions
            echo "An error occurred while creating the record: " . $e->getMessage();
        }
    }

    public function ExportStore(Request $request){
            // dd($request,"Nat");
            if($request->excelVersion == "excelVersion"){

            }else{

            }
    }

    public function ExportNAT(){
        try {
            $states = State::where('is_deleted','0')->get();
            $name = Auth::user()->first_name . " " . Auth::user()->last_name;
            $nat_file = NATFile::where('generated_by',$name)->get();
            return view('admin.export.NAT',compact('states','nat_file'));
        } catch (\Exception $e) {
            // Optionally, display an error message or take other actions
            echo "An error occurred while creating the record: " . $e->getMessage();
        }
    }
    public function exportNATGenerator(Request $request){
      
        if($request->excelVersion == "excelVersion"){
            $students = Student::where('is_deleted',"0")->get();
        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="NAT00120File.xls"');
        header('Cache-Control: max-age=0');
        // Output Excel header
        echo <<<EOF
        <!DOCTYPE html>
        <html xmlns:x="urn:schemas-microsoft-com:office:excel">
        <head>
        <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
        </head>
        <body>
        <table border="1">
        <tr>
        <td>TrngOrgIdentifier</td>
        <td>LocationId</td>
        <td>RTOStudentId</td>
        <td>Student FirstName</td>
        <td>Student LastName</td>
        <td>UnitofCompetencyId</td>
        <td>NatCourseCode</td>
        <td>ActStartDate</td>
        <td>ActEndDate</td>
        <td>DeliveryModeID</td>
        <td>OutcomeID</td>
        <td>FundSrc</td>
        <td>CommencingProgramID</td>
        <td>TrainingContractID</td>
        <td>ClientIDApprenticeships</td>
        <td>StudyReasonID</td>
        <td>VetInSchoolFlag</td>
        <td>SpecificFundingID</td>
        <td>SchoolTypeId</td>
        <td>OutcomeIDTra</td>
        <td>FundSrcState</td>
        <td>ClientTuitionFee</td>
        <td>FeeExemptionID</td>
        <td>PurchasingContractID</td>
        <td>PurchasingContractScheduleID</td>
        <td>HoursAttend</td>
        <td>AssociatedCourseID</td>
        <td>ScheduledHours</td>
        <td>PreDominantDeliveryMode</td>
        </tr>
        EOF;
        // Output data rows
        foreach ($students as $student) {
           
            echo "<tr><td>{$student->id}</td>
            <td>{$student->LocationId}</td>
            <td>{$student->RTOStudentId}</td>
            <td>{$student->firstName}</td>
            <td>{$student->lastname}</td>
            <td>{$student->unitDetails}</td>
            <td>{$student->nat_code}</td>
            <td>{$student->Act_Start_Date}</td>
            <td>{$student->Act_End_Date}</td>
            <td>{$student->delivery_mode}</td>
            <td>{$student->out_come_id}</td>
            <td>{$student->fund_src}</td>
            <td>{$student->CommencingProgramID}</td>
            <td>{$student->TrainingContractID}</td>
            <td>{$student->ClientIDApprenticeships}</td>
            <td>{$student->StudyReasonID}</td>
            <td>{$student->VetInSchoolFlag}</td>
            <td>{$student->SpecificFundingID}</td>
            <td>{$student->SchoolTypeId}</td>
            <td>{$student->OutcomeIDTra}</td>
            <td>{$student->FundSrcState}</td>
            <td>{$student->ClientTuitionFee}</td>
            <td>{$student->FeeExemptionID}</td>
            <td>{$student->PurchasingContractID}</td>
            <td>{$student->PurchasingContractScheduleID}</td>
            <td>{$student->HoursAttend}</td>
            <td>{$student->AssociatedCourseID}</td>
            <td>{$student->ScheduledHours}</td>
            <td>{$student->PreDominantDeliveryMode}</td>
            </tr>";
        }
        // Output Excel footer
        echo <<<EOF
            </table>
            </body>
            </html>
            EOF;
                }else{
                    // dd($request);
                    // Content of the text file
                    if($request->NAT00010){
                        $content = "45665     AUSTRALIAN INSTITUTE OF FINANCE TRAINING PTY LTD                                                    9116/55 Alice Street South                                                                            Wiley Park                                        219501Kiron,Kabir                                                 +61410611173                            info@aift.com.au                                                                ";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00010.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }

                    if($request->NAT00020){
                        $content = "";
                    // Path to the root directory (public directory)
                    $filePath = public_path('files/'.$request->NAT00020.'.txt');
                    // Create and save the text file
                    File::put($filePath, $content);
                    }
                    
                    if($request->NAT00030){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00030.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00060){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00060.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00080){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00080.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00085){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00085.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00090){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00090.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00100){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00100.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00120){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00120.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00130){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00130.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00010A){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00010A.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    if($request->NAT00030A){
                        $content = "";
                        // Path to the root directory (public directory)
                        $filePath = public_path('files/'.$request->NAT00030A.'.txt');
                        // Create and save the text file
                        File::put($filePath, $content);
                    }
                    $tempDir = public_path('files');
                    $allFilesAndDirectories = File::allFiles($tempDir);
                    foreach ($allFilesAndDirectories as $file) {
                        $paths[] = $file->getPathname();
                    }
                    $files = $paths;
                    $year = date("Y");
                    $month = date("m");
                    $day = date("d");
                    $zipFileName = 'zip/'.$year.$month.$day.date('His').'.zip';
                    $zip = new ZipArchive();

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            // Add files to the ZIP file
            foreach ($files as $file) {
                if (file_exists($file)) {
                    $zip->addFile($file, basename($file));
                } else {
                    return response()->json(['error' => "File <$file> does not exist."], 404);
                }
            }
            // Close the ZIP file
            $zip->close();
            // dd( Auth::user());
            $nat_file_store = new NATFile;
            $nat_file_store->date_from = $request->exportDateFrom ;
            $nat_file_store->date_to = $request->exportDateTo ;
            $nat_file_store->nat_file =  $zipFileName;
            $nat_file_store->no_out_come = "";
            $nat_file_store->generated_by = Auth::user()->first_name . " " . Auth::user()->last_name;
            // if($request->seriesname == "38"){
                $nat_file_store->exclusion = "" ;
            // }
            // if($request->seriesname == "0"){
                $nat_file_store->inclusions = $request->seriesname ;
            // }
            $nat_file_store->version = $request->exportDateFrom ;
            $nat_file_store->reporting_state = $request->reportingState ;
            $nat_file_store->start_enrolments = "";
            $nat_file_store->forstate = "" ;
            $nat_file_store->report_type = "zip";
            $nat_file_store->status = "A";
            $nat_file_store->save();
            return redirect()->back();
        } else {
            return response()->json(['error' => "Cannot create <$zipFileName>"], 500);
        }
                }
    }
    public function courseLoad(Request $request){
        $query = $request->input('q'); // Get the search term from the request
        $results = Course::where('name', 'LIKE', '%' . $query . '%')
            ->take(10)
            ->get(['id', 'name']);
    
        return response()->json(['items' => $results]);
    }
    public function company(){
        try {

            return view('admin.user.list');
        } catch (\Exception $e) {
            // Optionally, display an error message or take other actions
            echo "An error occurred while creating the record: " . $e->getMessage();
        }
    }
}