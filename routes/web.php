<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ClassRoutineController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DisabilityTypesController;
use App\Http\Controllers\EnrollSubjectController;
use App\Http\Controllers\ExamAttendanceController;
use App\Http\Controllers\ExamRoutineController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LanguageDiversityController;
use App\Http\Controllers\LeaveAllocationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ResultContributionController;
use App\Http\Controllers\RoutineSettingController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SurveyContactStatusController;
use App\Models\Grade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\AcademicClassController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeCategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FeesCategoryController;
use App\Http\Controllers\FeesDiscountController;
use App\Http\Controllers\FeesFineController;
use App\Http\Controllers\FeesReceiptController;
use App\Http\Controllers\FeesMasterController;
use App\Http\Controllers\FeesStudentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusTypeController;
use App\Http\Controllers\StudentIdCardSettingController;
use App\Http\Controllers\ContentTypeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AssignmentController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [UserController::class, 'login'])->name('');

//Route::get('/login', [UserController::class, 'login'])->name('login');
//Route::post('/login-post', [UserController::class, 'loginPost'])->name('login-post');
Route::get('/', [UserController::class, 'login'])->name('');

Route::group(['prefix' => 'admin'], function () {

    // login
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login-post', [UserController::class, 'loginPost'])->name('login-post');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/edit-user-profile', [UserController::class, 'editUserProfile'])->name('edit-user-profile');
        Route::post('/edit-user-profile', [UserController::class, 'updateUserProfile'])->name('update-user-profile');

        // START - user
        Route::get('/add-super-admin', [UserController::class, 'addSuperAdmin'])->name('add-super-admin');
        Route::post('/store-super-admin', [UserController::class, 'storeSuperAdmin'])->name('store-super-admin');
        Route::get('/super-admin-list', [UserController::class, 'superAdminList'])->name('super-admin-list');
        Route::get('/edit-super-admin/{id}', [UserController::class, 'editSuperAdmin'])->name('edit-super-admin');
        Route::post('/update-super-admin/{id}', [UserController::class, 'updateSuperAdmin'])->name('update-super-admin');
        Route::get('/delete-super-admin/{id}', [UserController::class, 'deleteSuperAdmin'])->name('delete-super-admin');
        // START - school
        Route::get('/add-school', [SchoolController::class, 'addSchool'])->name('add-school');
        Route::post('/store-school', [SchoolController::class, 'storeSchool'])->name('store-school');
        Route::get('/school-list', [SchoolController::class, 'schoolList'])->name('school-list');
        Route::get('/edit-school/{id}', [SchoolController::class, 'editSchool'])->name('edit-school');
        Route::post('/update-school/{id}', [SchoolController::class, 'updateSchool'])->name('update-school');
        Route::get('/delete-school/{id}', [SchoolController::class, 'deleteSchool'])->name('delete-school');
        // START - user
        Route::get('/add-user', [UserController::class, 'addUser'])->name('add-user');
        Route::post('/store-user', [UserController::class, 'storeUser'])->name('store-user');
        Route::get('/user-list', [UserController::class, 'userList'])->name('user-list');
        Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('edit-user');
        Route::post('/update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
        Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/register-student', [StudentController::class, 'registerStudent'])->name('register-student');
        Route::get('/students', [StudentController::class, 'Students'])->name('students');
        Route::get('/add-student', [StudentController::class, 'addStudent'])->name('add-student');
        Route::post('/store-student', [StudentController::class, 'storeStudent'])->name('store-student');
        Route::get('/student-list', [StudentController::class, 'studentList'])->name('student-list');
        Route::get('/edit-student/{id}', [StudentController::class, 'editStudent'])->name('edit-student');
        Route::get('/view-student/{id}', [StudentController::class, 'viewStudent'])->name('view-student');
        Route::post('/update-student/{id}', [StudentController::class, 'updateStudent'])->name('update-student');
        Route::get('/generate-nat-file', [StudentController::class, 'generateNatFile'])->name('generate-nat-file');
        Route::get('/upload-document/{id}', [StudentController::class, 'uploadDocument'])->name('upload-document');
        Route::post('/store-document/{id}', [StudentController::class, 'storeDocument'])->name('store-document');
        Route::get('/download-document/{id}', [StudentController::class, 'downloadDocument'])->name('download-document');
        Route::get('/edit-document/{id}', [StudentController::class, 'editDocument'])->name('edit-document');
        Route::post('/update-document/{id}', [StudentController::class, 'updateDocument'])->name('update-document');
        Route::get('/delete-document/{id}', [StudentController::class, 'deleteDcoument'])->name('delete-document');
        Route::get('/edit-disabilitydetail/{id}', [StudentController::class, 'editDisability'])->name('edit-disabilitydetail');
        Route::post('/update-disabilitydetail/{id}', [StudentController::class, 'updateDisability'])->name('update-disabilitydetail');
       

      // START - Language Diversity
      Route::get('/add-languagediversity', [LanguageDiversityController::class, 'add'])->name('add-languagediversity');
      Route::post('/store-languagediversity', [LanguageDiversityController::class, 'store'])->name('store-languagediversity');
      Route::get('/languagediversity-list', [LanguageDiversityController::class, 'list'])->name('languagediversity-list');
      Route::get('/edit-languagediversity/{id}', [LanguageDiversityController::class, 'edit'])->name('edit-languagediversity');
      Route::post('/update-languagediversity/{student_id}', [LanguageDiversityController::class, 'update'])->name('update-languagediversity');
      
      // END - Language Diversity

      // START - Disability Type
     
      Route::get('/disabilitytype-list', [DisabilityTypesController::class, 'list'])->name('disabilitytype-list');
      Route::get('/add-disabilitytype', [DisabilityTypesController::class, 'add'])->name('add-disabilitytype');
      Route::post('/store-disabilitytype', [DisabilityTypesController::class, 'store'])->name('store-disabilitytype');
      
      // END - Disability Type

        // START - Academic Session
        Route::get('/add-academic-session', [AcademicSessionController::class, 'add'])->name('add-academic-session');
        Route::post('/store-academic-session', [AcademicSessionController::class, 'store'])->name('store-academic-session');
        Route::get('/academic-session-list', [AcademicSessionController::class, 'list'])->name('academic-session-list');
        Route::get('/edit-academic-session/{id}', [AcademicSessionController::class, 'edit'])->name('edit-academic-session');
        Route::post('/update-academic-session/{id}', [AcademicSessionController::class, 'update'])->name('update-academic-session');
        Route::get('/delete-academic-session/{id}', [AcademicSessionController::class, 'delete'])->name('delete-academic-session');
        // END - Academic Session


        // START - Academic class
        Route::get('/add-academic-class', [AcademicClassController::class, 'add'])->name('add-academic-class');
        Route::post('/store-academic-class', [AcademicClassController::class, 'store'])->name('store-academic-class');
        Route::get('/academic-class-list', [AcademicClassController::class, 'list'])->name('academic-class-list');
        Route::get('/edit-academic-class/{id}', [AcademicClassController::class, 'edit'])->name('edit-academic-class');
        Route::post('/update-academic-class/{id}', [AcademicClassController::class, 'update'])->name('update-academic-class');
        Route::get('/delete-academic-class/{id}', [AcademicClassController::class, 'delete'])->name('delete-academic-class');
        // END - Academic class
        // START - Teacher
        Route::get('/add-teacher', [TeacherController::class, 'add'])->name('add-teacher');
        Route::post('/store-teacher', [TeacherController::class, 'store'])->name('store-teacher');
        Route::get('/teacher-list', [TeacherController::class, 'list'])->name('teacher-list');
        Route::get('/edit-teacher/{id}', [TeacherController::class, 'edit'])->name('edit-teacher');
        Route::post('/update-teacher/{id}', [TeacherController::class, 'update'])->name('update-teacher');
        Route::get('/delete-teacher/{id}', [TeacherController::class, 'delete'])->name('delete-teacher');
        // END - Teacher

        // START - subject
        Route::get('/add-subject', [SubjectController::class, 'add'])->name('add-subject');
        Route::post('/store-subject', [SubjectController::class, 'store'])->name('store-subject');
        Route::get('/subject-list', [SubjectController::class, 'list'])->name('subject-list');
        Route::get('/edit-subject/{id}', [SubjectController::class, 'edit'])->name('edit-subject');
        Route::post('/update-subject/{id}', [SubjectController::class, 'update'])->name('update-subject');
        Route::get('/delete-subject/{id}', [SubjectController::class, 'delete'])->name('delete-subject');
        // END - subject

        // START - role
        Route::get('/add-role', [RoleController::class, 'add'])->name('add-role');
        Route::post('/store-role', [RoleController::class, 'store'])->name('store-role');
        Route::get('/role-list', [RoleController::class, 'list'])->name('role-list');
        Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit-role');
        Route::post('/update-role/{id}', [RoleController::class, 'update'])->name('update-role');
        Route::get('/delete-role/{id}', [RoleController::class, 'delete'])->name('delete-role');
        // END - role
        // START - Employee
        Route::get('/add-employee', [EmployeeController::class, 'addEmployee'])->name('add-employee');
        Route::post('/store-employee', [EmployeeController::class, 'storeEmployee'])->name('store-employee');
        Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
        Route::get('/edit-employee/{id}', [EmployeeController::class, 'editEmployee'])->name('edit-employee');
        Route::post('/update-employee/{id}', [EmployeeController::class, 'updateEmployee'])->name('update-employee');
        Route::get('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete-employee');
        //END - Employee 
        // START - Department
        Route::get('/add-department', [DepartmentController::class, 'addDepartment'])->name('add-department');
        Route::post('/store-department', [DepartmentController::class, 'storeDepartment'])->name('store-department');
        Route::get('/department-list', [DepartmentController::class, 'departmentList'])->name('department-list');
        Route::get('/edit-department/{id}', [DepartmentController::class, 'editDepartment'])->name('edit-department');
        Route::post('/update-department/{id}', [DepartmentController::class, 'updateDepartment'])->name('update-department');
        Route::get('/delete-department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('delete-department');
        //END - Department
        
        // START - Designation
        Route::get('/add-designation', [DesignationController::class, 'addDesignation'])->name('add-designation');
        Route::post('/store-designation', [DesignationController::class, 'storeDesignation'])->name('store-designation');
        Route::get('/designation-list', [DesignationController::class, 'designationList'])->name('designation-list');
        Route::get('/edit-designation/{id}', [DesignationController::class, 'editDesignation'])->name('edit-designation');
        Route::post('/update-designation/{id}', [DesignationController::class, 'updateDesignation'])->name('update-designation');
        Route::get('/delete-designation/{id}', [DesignationController::class, 'deleteDesignation'])->name('delete-designation');
        //END - Designation

        // START - Attendance
        Route::get('/add-attendance', [AttendanceController::class, 'addAttendance'])->name('add-attendance');
        Route::post('/store-attendance', [AttendanceController::class, 'storeAttendance'])->name('store-attendance');
        Route::get('/attendance-list', [AttendanceController::class, 'attendanceList'])->name('attendance-list');
        Route::post('/attendance-get', [AttendanceController::class, 'filterAttendance'])->name('attendance-get');
        Route::get('/edit-attendance/{id}', [AttendanceController::class, 'editAttendance'])->name('edit-attendance');
        Route::post('/update-attendance/{id}', [AttendanceController::class, 'updateAttendance'])->name('update-attendance');
        Route::get('/delete-attendance/{id}', [AttendanceController::class, 'deleteAttendance'])->name('delete-attendance');
        
        //END - Attendance 

        // START - AttendanceType
        Route::get('/add-attendancetype', [AttendanceTypeController::class, 'addAttendanceType'])->name('add-attendancetype');
        Route::post('/store-attendancetype', [AttendanceTypeController::class, 'storeAttendanceType'])->name('store-attendancetype');
        Route::get('/attendancetype-list', [AttendanceTypeController::class, 'AttendanceTypeList'])->name('attendancetype-list');
        Route::get('/edit-attendancetype/{id}', [AttendanceTypeController::class, 'editAttendanceType'])->name('edit-attendancetype');
        Route::post('/update-attendancetype/{id}', [AttendanceTypeController::class, 'updateAttendanceType'])->name('update-attendancetype');
        Route::get('/delete-attendancetype/{id}', [AttendanceTypeController::class, 'deleteAttendanceType'])->name('delete-attendancetype');
        //END - AttendanceType 
        // START - EmployeeCategory
        Route::get('/add-employeecategory', [EmployeeCategoryController::class, 'addEmployeeCategory'])->name('add-employeecategory');
        Route::post('/store-employeecategory', [EmployeeCategoryController::class, 'storeEmployeeCategory'])->name('store-employeecategory');
        Route::get('/employeecategory-list', [EmployeeCategoryController::class, 'employeecategoryList'])->name('employeecategory-list');
        Route::get('/edit-employeecategory/{id}', [EmployeeCategoryController::class, 'editEmployeeCategory'])->name('edit-employeecategory');
        Route::post('/update-employeecategory/{id}', [EmployeeCategoryController::class, 'updateEmployeeCategory'])->name('update-employeecategory');
        Route::get('/delete-employeecategory/{id}', [EmployeeCategoryController::class, 'deleteEmployeeCategory'])->name('delete-employeecategory');
        //END - EmployeeCategory 

         // START - LeaveType
         Route::get('/add-leavetype', [LeaveTypeController::class, 'addLeaveType'])->name('add-leavetype');
         Route::post('/store-leavetype', [LeaveTypeController::class, 'storeLeaveType'])->name('store-leavetype');
          Route::get('/leavetype-list', [LeaveTypeController::class, 'leavetypeList'])->name('leavetype-list');
          Route::get('/edit-leavetype/{id}', [LeaveTypeController::class, 'editLeaveType'])->name('edit-leavetype');
          Route::post('/update-leavetype/{id}', [LeaveTypeController::class, 'updateLeaveType'])->name('update-leavetype');
          Route::get('/delete-leavetype/{id}', [LeaveTypeController::class, 'deleteLeaveType'])->name('delete-leavetype');
         //END - LeaveType 


           // START - StaffLeave
           Route::get('/add-staffleave', [LeaveController::class, 'add'])->name('add-staffleave');
           Route::post('/store-staffleave', [LeaveController::class, 'store'])->name('store-staffleave');
            Route::get('/staffleave-list', [LeaveController::class, 'List'])->name('staffleave-list');
            Route::get('/edit-staffleave/{id}', [LeaveController::class, 'edit'])->name('edit-staffleave');
            Route::post('/update-staffleave/{id}', [LeaveController::class, 'update'])->name('update-staffleave');
            Route::get('/delete-staffleave/{id}', [LeaveController::class, 'delete'])->name('delete-staffleave');
           //END - StaffLeave 

                // START - LeaveManage
                Route::get('/add-leavemanage', [LeaveManagementController::class, 'add'])->name('add-leavemanage');
                Route::post('/store-leavemanage', [LeaveManagementController::class, 'store'])->name('store-leavemanage');
                 Route::get('/leavemanage-list', [LeaveManagementController::class, 'List'])->name('leavemanage-list');
                 Route::get('/edit-leavemanage/{id}', [LeaveManagementController::class, 'edit'])->name('edit-leavemanage');
                 Route::post('/update-leavemanage/{id}', [LeaveManagementController::class, 'update'])->name('update-leavemanage');
                 Route::get('/delete-leavemanage/{id}', [LeaveManagementController::class, 'delete'])->name('delete-leavemanage');
                 Route::post('/leavemanage-status/{id}', [LeaveManagementController::class, 'status'])->name('leavemanage-status');
                //END - LeaveManage 
 
          // START - LeaveRequest
          Route::get('/add-leaverequest', [LeaveRequestController::class, 'addLeaveRequest'])->name('add-leaverequest');
          Route::post('/store-leaverequest', [LeaveRequestController::class, 'storeLeaveRequest'])->name('store-leaverequest');
           Route::get('/leaverequest-list', [LeaveRequestController::class, 'leaverequestList'])->name('leaverequest-list');
           Route::get('/edit-leaverequest/{id}', [LeaveRequestController::class, 'editLeaveRequest'])->name('edit-leaverequest');
           Route::post('/update-leaverequest/{id}', [LeaveRequestController::class, 'updateLeaveRequest'])->name('update-leaverequest');
           Route::get('/delete-leaverequest/{id}', [LeaveRequestController::class, 'deleteLeaveRequest'])->name('delete-leaverequest');
           Route::get('/leaverequest-detail/{id}', [LeaveRequestController::class, 'leaverequestDetail'])->name('leaverequest-detail');
           Route::post('/add-leaverequest-detail', [LeaveRequestController::class, 'AddleaverequestDetail'])->name('add-leaverequest-detail');
          //END - LeaveRequest 

          // START - LeaveAllocation
          Route::get('/add-leaveallocation', [LeaveAllocationController::class, 'addLeaveAllocation'])->name('add-leaveallocation');
          Route::post('/store-leaveallocation', [LeaveAllocationController::class, 'storeLeaveAllocation'])->name('store-leaveallocation');
           Route::get('/leaveallocation-list', [LeaveAllocationController::class, 'leaveallocationList'])->name('leaveallocation-list');
           Route::get('/edit-leaveallocation/{id}', [LeaveAllocationController::class, 'editLeaveAllocation'])->name('edit-leaveallocation');
           Route::post('/update-leaveallocation/{id}', [LeaveAllocationController::class, 'updateLeaveAllocation'])->name('update-leaveallocation');
           Route::get('/delete-leaveallocation/{id}', [LeaveAllocationController::class, 'deleteLeaveAllocation'])->name('delete-leaveallocation');
        //    Route::get('/leaveallocation-detail/{id}', [LeaveAllocationController::class, 'leaveallocationDetail'])->name('leaveallocation-detail');
          //END - LeaveAllocation 


           // START - Exams
           Route::get('/add-examtypes', [ExamTypeController::class, 'addExamType'])->name('add-examtypes');
           Route::post('/store-examtypes', [ExamTypeController::class, 'storeExamType'])->name('store-examtypes');
            Route::get('/examtype-list', [ExamTypeController::class, 'examtypeList'])->name('examtype-list');
            Route::get('/edit-examtype/{id}', [ExamTypeController::class, 'editExamType'])->name('edit-examtype');
            Route::post('/update-examtype/{id}', [ExamTypeController::class, 'updateExamType'])->name('update-examtype');
            Route::get('/delete-examtype/{id}', [ExamTypeController::class, 'deleteExamType'])->name('delete-examtype');
           //END - Exams 

           // START - Grade
           Route::get('/add-grade', [GradeController::class, 'addGrade'])->name('add-grade');
           Route::post('/store-grade', [GradeController::class, 'storeGrade'])->name('store-grade');
            Route::get('/grade-list', [GradeController::class, 'gradeList'])->name('grade-list');
            Route::get('/edit-grade/{id}', [GradeController::class, 'editGrade'])->name('edit-grade');
            Route::post('/update-grade/{id}', [GradeController::class, 'updateGrade'])->name('update-grade');
            Route::get('/delete-grade/{id}', [GradeController::class, 'deleteGrade'])->name('delete-grade');
           //END - Grade 

           // START - Faculty
           Route::get('/add-faculty', [FacultyController::class, 'addFaculty'])->name('add-faculty');
           Route::post('/store-faculty', [FacultyController::class, 'storeFaculty'])->name('store-faculty');
            Route::get('/faculty-list', [FacultyController::class, 'facultyList'])->name('faculty-list');
            Route::get('/edit-faculty/{id}', [FacultyController::class, 'editFaculty'])->name('edit-faculty');
            Route::post('/update-faculty/{id}', [FacultyController::class, 'updateFaculty'])->name('update-faculty');
            Route::get('/delete-faculty/{id}', [FacultyController::class, 'deleteFaculty'])->name('delete-faculty');
           //END - Faculty

           // START - Program
           Route::get('/add-program', [ProgramController::class, 'addProgram'])->name('add-program');
           Route::post('/store-program', [ProgramController::class, 'storePRogram'])->name('store-program');
            Route::get('/program-list', [ProgramController::class, 'programList'])->name('program-list');
            Route::get('/edit-program/{id}', [ProgramController::class, 'editProgram'])->name('edit-program');
            Route::post('/update-program/{id}', [ProgramController::class, 'updateProgram'])->name('update-program');
            Route::get('/delete-program/{id}', [ProgramController::class, 'deleteProgram'])->name('delete-program');
           //END - Program


           // START - Batch
           Route::get('/add-batch', [BatchController::class, 'addBatch'])->name('add-batch');
           Route::post('/store-batch', [BatchController::class, 'storeBatch'])->name('store-batch');
            Route::get('/batch-list', [BatchController::class, 'batchList'])->name('batch-list');
            Route::get('/edit-batch/{id}', [BatchController::class, 'editBatch'])->name('edit-batch');
            Route::post('/update-batch/{id}', [BatchController::class, 'updateBatch'])->name('update-batch');
            Route::get('/delete-batch/{id}', [BatchController::class, 'deleteBatch'])->name('delete-batch');
           //END - Batch

           // START - Session
           Route::get('/add-session', [SessionController::class, 'addSession'])->name('add-session');
           Route::get('/session-list-current/{id}', 'SessionController@current')->name('session-list.current');
           Route::post('/store-session', [SessionController::class, 'storeSession'])->name('store-session');
            Route::get('/session-list', [SessionController::class, 'SessionList'])->name('session-list');
            Route::get('/edit-session/{id}', [SessionController::class, 'editSession'])->name('edit-session');
            Route::post('/update-session/{id}', [SessionController::class, 'updateSession'])->name('update-session');
            Route::get('/delete-session/{id}', [SessionController::class, 'deleteSession'])->name('delete-session');
           //END - Session

            // START - Semester
            Route::get('/add-semester', [SemesterController::class, 'addSemester'])->name('add-semester');
           // Route::get('/semester-list-current/{id}', 'SessionController@current')->name('session-list.current');
            Route::post('/store-semester', [SemesterController::class, 'storeSemester'])->name('store-semester');
             Route::get('/semester-list', [SemesterController::class, 'semesterList'])->name('semester-list');
             Route::get('/edit-semester/{id}', [SemesterController::class, 'editSemester'])->name('edit-semester');
             Route::post('/update-semester/{id}', [SemesterController::class, 'updateSemester'])->name('update-semester');
             Route::get('/delete-semester/{id}', [SemesterController::class, 'deleteSemester'])->name('delete-semester');
            //END - Semester

               // START - Semester
               Route::get('/add-semester', [SemesterController::class, 'addSemester'])->name('add-semester');
               // Route::get('/semester-list-current/{id}', 'SessionController@current')->name('session-list.current');
                Route::post('/store-semester', [SemesterController::class, 'storeSemester'])->name('store-semester');
                 Route::get('/semester-list', [SemesterController::class, 'semesterList'])->name('semester-list');
                 Route::get('/edit-semester/{id}', [SemesterController::class, 'editSemester'])->name('edit-semester');
                 Route::post('/update-semester/{id}', [SemesterController::class, 'updateSemester'])->name('update-semester');
                 Route::get('/delete-semester/{id}', [SemesterController::class, 'deleteSemester'])->name('delete-semester');
                //END - Semester


                 // START - Section
                 Route::get('/add-section', [SectionController::class, 'addSection'])->name('add-section');
                 Route::post('/store-section', [SectionController::class, 'storeSection'])->name('store-section');
                 Route::get('/section-list', [SectionController::class, 'sectionList'])->name('section-list');
                 Route::get('/edit-section/{id}', [SectionController::class, 'editSection'])->name('edit-section');
                 Route::post('/update-section/{id}', [SectionController::class, 'updateSection'])->name('update-section');
                 Route::get('/delete-section/{id}', [SectionController::class, 'deleteSection'])->name('delete-section');
                //END - Section

                // START - Classroom
                Route::get('/add-classroom', [ClassRoomController::class, 'addClassroom'])->name('add-classroom');
                Route::post('/store-classroom', [ClassRoomController::class, 'storeClassroom'])->name('store-classroom');
                Route::get('/classroom-list', [ClassRoomController::class, 'classroomList'])->name('classroom-list');
                Route::get('/edit-classroom/{id}', [ClassRoomController::class, 'editClassroom'])->name('edit-classroom');
                Route::post('/update-classroom/{id}', [ClassRoomController::class, 'updateClassroom'])->name('update-classroom');
                Route::get('/delete-classroom/{id}', [ClassRoomController::class, 'deleteClassroom'])->name('delete-classroom');
               //END - Classroom

               // START - Courses
              //  Route::get('/add-course', [CourseController::class, 'addCourse'])->name('add-course');
              //  Route::post('/store-course', [CourseController::class, 'storeCourse'])->name('store-course');
              //  Route::get('/course-list', [CourseController::class, 'courseList'])->name('course-list');
              //  Route::get('/edit-course/{id}', [CourseController::class, 'editCourse'])->name('edit-course');
              //  Route::post('/update-course/{id}', [CourseController::class, 'updateCourse'])->name('update-course');
              //  Route::get('/delete-course/{id}', [CourseController::class, 'deleteCourse'])->name('delete-course');
              //END - Courses


            // START - enrollsubject
        Route::get('/add-enrollsubject', [EnrollSubjectController::class, 'addEnrollsubject'])->name('add-enrollsubject');
        Route::post('/store-enrollsubject', [EnrollSubjectController::class, 'storeEnrollsubject'])->name('store-enrollsubject');
        Route::get('/enrollsubject-list', [EnrollSubjectController::class, 'enrollsubjectList'])->name('enrollsubject-list');
        Route::get('/edit-enrollsubject/{id}', [EnrollSubjectController::class, 'editEnrollsubject'])->name('edit-enrollsubject');
        Route::post('/update-enrollsubject/{id}', [EnrollSubjectController::class, 'updateEnrollsubject'])->name('update-enrollsubject');
        Route::get('/delete-enrollsubject/{id}', [EnrollSubjectController::class, 'deleteEnrollsubject'])->name('delete-enrollsubject');
        // END - enrollsubject

         // START - classroutine
         Route::get('/add-classroutine', [ClassRoutineController::class, 'addClassRoutine'])->name('add-classroutine');
         Route::post('/store-classroutine', [ClassRoutineController::class, 'storeClassRoutine'])->name('store-classroutine');
         Route::get('/classroutine-list', [ClassRoutineController::class, 'classroutineList'])->name('classroutine-list');
         Route::get('/edit-classroutine/{id}', [ClassRoutineController::class, 'editClassRoutine'])->name('edit-classroutine');
         Route::post('/update-classroutine/{id}', [ClassRoutineController::class, 'updateClassRoutine'])->name('update-classroutine');
         Route::get('/delete-classroutine/{id}', [ClassRoutineController::class, 'deleteClassRoutine'])->name('delete-classroutine');
         Route::get('/class-routine-teacher', [ClassRoutineController::class, 'teacher'])->name('class-routine.teacher');
         Route::post('/class_routine/print', [ClassRoutineController::class, 'print'])->name('class-routine.print');
         Route::get('/routine-setting/class', [RoutineSettingController::class, 'class'])->name('routine-setting.class');
         Route::get('/routine-setting/exam', [RoutineSettingController::class, 'exam'])->name('routine-setting.exam');
         Route::post('/routine-setting/store', [RoutineSettingController::class, 'store'])->name('routine-setting.store');
     
         // END - classroutine


         // START - examroutine
         Route::get('/add-examroutine', [ExamRoutineController::class, 'addExamRoutine'])->name('add-examroutine');
         Route::post('/store-examroutine', [ExamRoutineController::class, 'storeExamRoutine'])->name('store-examroutine');
         Route::get('/examroutine-list', [ExamRoutineController::class, 'examroutineList'])->name('examroutine-list');
         Route::get('/edit-examroutine/{id}', [ExamRoutineController::class, 'editExamRoutine'])->name('edit-examroutine');
         Route::post('/update-examroutine/{id}', [ExamRoutineController::class, 'updateExamRoutine'])->name('update-examroutine');
         Route::get('/delete-examroutine/{id}', [ExamRoutineController::class, 'deleteExamRoutine'])->name('delete-examroutine');
         Route::post('/exam_routine/print', [ExamRoutineController::class, 'print'])->name('exam-routine.print');   
         // END - examroutine

          // START - coursecategory
          Route::get('/add-coursecategory', [CourseCategoryController::class, 'addCourseCategory'])->name('add-coursecategory');
          Route::post('/store-coursecategory', [CourseCategoryController::class, 'storeCourseCategory'])->name('store-coursecategory');
          Route::get('/coursecategory-list', [CourseCategoryController::class, 'coursecategoryList'])->name('coursecategory-list');
          Route::get('/edit-coursecategory/{id}', [CourseCategoryController::class, 'editCourseCategory'])->name('edit-coursecategory');
          Route::post('/update-coursecategory/{id}', [CourseCategoryController::class, 'updateCourseCategory'])->name('update-coursecategory');
          Route::get('/delete-coursecategory/{id}', [CourseCategoryController::class, 'deleteCourseCategory'])->name('delete-coursecategory');
          // END - coursecategory
 


        //start-FilterController
        Route::post('filter-batch', [FilterController::class, 'filterBatch'])->name('filter-batch');
        Route::post('filter-program', [FilterController::class, 'filterProgram'])->name('filter-program');
        Route::post('filter-session', [FilterController::class, 'filterSession'])->name('filter-session');
        Route::post('filter-semester', [FilterController::class, 'filterSemester'])->name('filter-semester');
        Route::post('filter-section', [FilterController::class, 'filterSection'])->name('filter-section');
        Route::post('filter-subject', [FilterController::class, 'filterSubject'])->name('filter-subject');
        Route::post('filter-enroll-subject', [FilterController::class, 'filterEnrollSubject'])->name('filter-enroll-subject');
        //End-FilterController

               // START - Fees Type
               Route::get('/add-fees-category', [FeesCategoryController::class, 'add'])->name('add-fees-category');
               Route::post('/store-fees-type', [FeesCategoryController::class, 'store'])->name('store-fees-type');
               Route::get('/fees-categoris-list', [FeesCategoryController::class, 'list'])->name('fees-categoris-list');
               Route::get('/edit-fees-type/{id}', [FeesCategoryController::class, 'edit'])->name('edit-fees-type');
               Route::post('/update-fees-type/{id}', [FeesCategoryController::class, 'update'])->name('update-fees-type');
               Route::get('/delete-fees-type/{id}', [FeesCategoryController::class, 'delete'])->name('delete-fees-type');
               // END - Fees Type
                  
               // START - Fees Discount
               Route::get('/add-fees-discount', [FeesDiscountController::class, 'add'])->name('add-fees-discount');
               Route::post('/store-fees-discount', [FeesDiscountController::class, 'store'])->name('store-fees-discount');
               Route::get('/fees-discount-list', [FeesDiscountController::class, 'list'])->name('fees-discount-list');
               Route::get('/edit-fees-discount/{id}', [FeesDiscountController::class, 'edit'])->name('edit-fees-discount');
               Route::post('/update-fees-discount/{id}', [FeesDiscountController::class, 'update'])->name('update-fees-discount');
               Route::get('/delete-fees-discount/{id}', [FeesDiscountController::class, 'delete'])->name('delete-fees-discount');
               // END - Fees Discount
               
               
              // START - Fees Fines
               Route::get('/add-fees-fine', [FeesFineController::class, 'add'])->name('add-fees-fine');
               Route::post('/store-fees-fine', [FeesFineController::class, 'store'])->name('store-fees-fine');
               Route::get('/fees-fine-list', [FeesFineController::class, 'list'])->name('fees-fine-list');
               Route::get('/edit-fees-fine/{id}', [FeesFineController::class, 'edit'])->name('edit-fees-fine');
               Route::post('/update-fees-fine/{id}', [FeesFineController::class, 'update'])->name('update-fees-fine');
               Route::get('/delete-fees-fine/{id}', [FeesFineController::class, 'delete'])->name('delete-fees-fine');
               // END - Fees Fines
               
              // START - fees-receipt
               Route::get('/add-fees-receipt', [FeesReceiptController::class, 'index'])->name('add-fees-receipt');
               Route::post('/store-fees-receipt', [FeesReceiptController::class, 'store'])->name('store-fees-receipt');
               // END - fees-receipt

              // START - fees-master
              Route::get('/list-fees-master', [FeesMasterController::class, 'index'])->name('list-fees-master');
              Route::get('/add-fees-master', [FeesMasterController::class, 'add'])->name('add-fees-master');
              Route::post('/store-fees-master', [FeesMasterController::class, 'store'])->name('store-fees-master');
              // END - fees-master
          
              // fees - student
                Route::get('/fees-student', [FeesStudentController::class, 'index'])->name('fees-student');
                Route::get('/fees-student-quick-assign', [FeesStudentController::class, 'quickAssign'])->name('fees-student-quick-assign');
                Route::post('/fees-student-quick-assign', [FeesStudentController::class, 'quickAssignStore'])->name('fees-student-quick-assign-store');
                Route::get('/fees-student-quick-received', [FeesStudentController::class, 'quickReceived'])->name('fees-student-quick-received');
                Route::post('/fees-student-quick-received', [FeesStudentController::class, 'quickReceivedStore'])->name('fees-student-quick-received-store');
                Route::get('/fees-student-report', [FeesStudentController::class, 'report'])->name('fees-student-report');
                Route::get('fees-student-print/{id}', [FeesStudentController::class, 'print'])->name('fees-student-print');
                Route::post('fees-student-unpay/{id}', [FeesStudentController::class, 'unpay'])->name('fees-student-unpay');
                Route::post('fees-student-pay', [FeesStudentController::class, 'pay'])->name('fees-student-pay');
                Route::post('fees-student-cancel/{id}', [FeesStudentController::class, 'cancel'])->name('fees-student-cancel');
                
                // setting 
                Route::get('/setting', [SettingController::class, 'index'])->name('setting');
                Route::post('/store-setting', [SettingController::class, 'store'])->name('store-setting');

              // START - status Type
               Route::get('/add-status-type', [StatusTypeController::class, 'add'])->name('add-status-type');
               Route::post('/store-status-type', [StatusTypeController::class, 'store'])->name('store-status-type');
               Route::get('/status-type-list', [StatusTypeController::class, 'list'])->name('status-type-list');
               Route::get('/edit-status-type/{id}', [StatusTypeController::class, 'edit'])->name('edit-status-type');
               Route::post('/update-status-type/{id}', [StatusTypeController::class, 'update'])->name('update-status-type');
               Route::get('/delete-status-type/{id}', [StatusTypeController::class, 'delete'])->name('delete-status-type');
               // END - status Type
                 
                // START - student-id-card
               Route::get('/id-card-setting', [StudentIdCardSettingController::class, 'index'])->name('id-card-setting');
               Route::post('/store-id-card-setting', [StudentIdCardSettingController::class, 'store'])->name('store-id-card-setting');
               // END - student-id-card

        // START - Content Type
        Route::get('/content-type-list', [ContentTypeController::class, 'list'])->name('content-type-list');
        Route::get('/add-content-type', [ContentTypeController::class, 'add'])->name('add-content-type');
        Route::post('/store-content-type', [ContentTypeController::class, 'store'])->name('store-content-type');
        Route::get('/edit-content-type/{id}', [ContentTypeController::class, 'edit'])->name('edit-content-type');
        Route::post('/update-content-type/{id}', [ContentTypeController::class, 'update'])->name('update-content-type');
        Route::get('/delete-content-type/{id}', [ContentTypeController::class, 'delete'])->name('delete-content-type');
        // END - Content Type

        // START - Content
        Route::get('/content-list', [ContentController::class, 'list'])->name('content-list');
        Route::get('/add-content', [ContentController::class, 'add'])->name('add-content');
        Route::post('/store-content', [ContentController::class, 'store'])->name('store-content');
        Route::get('/edit-content/{id}', [ContentController::class, 'edit'])->name('edit-content');
        Route::post('/update-content/{id}', [ContentController::class, 'update'])->name('update-content');
        Route::get('/delete-content/{id}', [ContentController::class, 'delete'])->name('delete-content');
        // END - Content

        // START - assignment
        Route::get('/assignment-list', [AssignmentController::class, 'list'])->name('assignment-list');
        Route::get('/add-assignment', [AssignmentController::class, 'add'])->name('add-assignment');
        Route::post('/store-assignment', [AssignmentController::class, 'store'])->name('store-assignment');
        Route::get('/edit-assignment/{id}', [AssignmentController::class, 'edit'])->name('edit-assignment');
        Route::post('/update-assignment/{id}', [AssignmentController::class, 'update'])->name('update-assignment');
        Route::get('/delete-assignment/{id}', [AssignmentController::class, 'delete'])->name('delete-assignment');
        // END - assignment

        //START-ResultContribution
         
         Route::get('/resultcontribution-list', [ResultContributionController::class, 'list'])->name('resultcontribution-list');
         Route::get('/add-resultcontribution', [ResultContributionController::class, 'add'])->name('add-resultcontribution');
         Route::post('/store-resultcontribution', [ResultContributionController::class, 'store'])->name('store-resultcontribution');
         Route::get('/edit-resultcontribution/{id}', [ResultContributionController::class, 'edit'])->name('edit-resultcontribution');
         Route::post('/update-resultcontribution/{id}', [ResultContributionController::class, 'update'])->name('update-resultcontribution');
         Route::get('/delete-resultcontribution/{id}', [ResultContributionController::class, 'delete'])->name('delete-resultcontribution');
         
        //END-ResultContribution

         //START-ExamAttendance
         Route::get('/examattendance-list', [ExamAttendanceController::class, 'list'])->name('examattendance-list');
         Route::get('/add-examattendance', [ExamAttendanceController::class, 'add'])->name('add-examattendance');
         Route::post('/store-examattendance', [ExamAttendanceController::class, 'store'])->name('store-examattendance');
         Route::get('/edit-examattendance/{id}', [ExamAttendanceController::class, 'edit'])->name('edit-examattendance');
         Route::post('/update-examattendance/{id}', [ExamAttendanceController::class, 'update'])->name('update-examattendance');
         Route::get('/delete-examattendance/{id}', [ExamAttendanceController::class, 'delete'])->name('delete-examattendance');
         
        //END-ExamAttendance
    });

    // START - SurveyContactStatus
    Route::get('/add-surveycontactstatus', [SurveyContactStatusController::class, 'addSurveyContactStatus'])->name('add-surveycontactstatus');
    Route::post('/store-surveycontactstatus', [SurveyContactStatusController::class, 'storeSurveyContactStatus'])->name('store-surveycontactstatus');
    Route::get('/surveycontactstatus-list', [SurveyContactStatusController::class, 'surveycontactstatusList'])->name('surveycontactstatus-list');
    Route::get('/edit-surveycontactstatus/{id}', [SurveyContactStatusController::class, 'editSurveyContactStatus'])->name('edit-surveycontactstatus');
    Route::post('/update-surveycontactstatus/{id}', [SurveyContactStatusController::class, 'updateSurveyContactStatus'])->name('update-surveycontactstatus');
    Route::get('/delete-surveycontactstatus/{id}', [SurveyContactStatusController::class, 'deleteSurveyContactStatus'])->name('delete-surveycontactstatus');
    //END - SurveyContactStatus 

});
