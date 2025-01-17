<?php

use Illuminate\Support\Facades\Route;
use App\User;





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
//Auth::routes();
Route::get('/logout', 'LoginController@logout');

/*
// Render perticular view file by foldername and filename and all passed in only one controller at a time
Route::get('{folder}/{file}', 'MetricaController@indexWithOneFolder');

// Render when Route Have 2 folder
Route::get('{folder1}/{folder2}/{file}', 'MetricaController@indexWithTwoFolder');

/*
// when render first time project redirect
Route::get('/home', function () {
    return redirect('/analytics/analytics-index');
});


// when render first time project redirect
Route::get('/', function () {
    return redirect('login');
});

*/



Route::get('/', function () {
  
   // User::all()->where('email',Auth::all()->email)->notify(new emailNotification);
  //  dd(User::where('email','bali4u2001@gmail.com') -> first());
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin routes
    //Password Reset 
    Route::post('admin-password/email','Users\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin-password/reset','Users\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin-password/reset','Users\Admin\ResetPasswordController@reset')->name('admin.password.update');
    Route::get('admin-password/reset/{token}','Users\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::prefix('admin')->group(function(){
    Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    Route::get('/phpinfo', 'Users\Admin\AdminController@phpinfo')->name('admin.phpinfo')->middleware('auth:admin');;


    Route::get('/allStudentsRecord', 'Users\Admin\AdminController@allStudentsRecord')->name('admin.allStudentsRecord')->middleware('auth:admin');;
    Route::get('/editStudentRecord/{id}', 'Users\Admin\AdminController@editStudentRecord')->name('admin.editStudentRecord')->middleware('auth:admin');;
    Route::post('/editStudentRecord', 'Users\Admin\AdminController@post_editStudentRecord')->name('editStudentRecord');
    Route::get('/deleteStudentRecord/{id}', 'Users\Admin\AdminController@deleteStudentRecord')->name('admin.deleteStudentRecord')->middleware('auth:admin');

    Route::get('/allTeachersRecord', 'Users\Admin\AdminController@allTeachersRecord')->name('admin.allTeachersRecord')->middleware('auth:admin');;
    Route::get('/editTeacherRecord/{id}', 'Users\Admin\AdminController@editTeacherRecord')->name('admin.editTeacherRecord')->middleware('auth:admin');;
    Route::post('/editTeacherRecord', 'Users\Admin\AdminController@post_editTeacherRecord')->name('editTeacherRecord');
    Route::get('/deleteTeacherRecord/{id}', 'Users\Admin\AdminController@deleteTeacherRecord')->name('admin.deleteTeacherRecord')->middleware('auth:admin');

    Route::get('/create_subCode', 'Users\Admin\AdminController@get_create_subCode')->name('admin.create_subCode')->middleware('auth:admin');;
    Route::post('/create_subCodes', 'Users\Admin\AdminController@post_create_subCode')->name('create_subCodes')->middleware('auth:admin');;
    Route::get('/allSubCodes', 'Users\Admin\AdminController@allSubCodes')->name('admin.allSubCodes')->middleware('auth:admin');;
    Route::get('/deleteSubCode/{id}', 'Users\Admin\AdminController@deleteSubCode')->name('admin.deleteSubCode')->middleware('auth:admin');

    Route::get('/createTerms', 'Users\Admin\AdminController@get_createTerms')->name('admin.createTerms')->middleware('auth:admin');;
    Route::post('/createTerms', 'Users\Admin\AdminController@post_createTerms')->name('createTerms')->middleware('auth:admin');;
    Route::get('/allTerms', 'Users\Admin\AdminController@allTerms')->name('admin.allTerms')->middleware('auth:admin');;
    Route::get('/deleteTerm/{id}', 'Users\Admin\AdminController@deleteTerm')->name('admin.deleteTerm')->middleware('auth:admin');
 
    Route::get('/liveClasses/editLiveClass/{id}', 'Users\Admin\AdminController@editLiveClass')->name('admin.liveClasses.editLiveClass');
    Route::post('/liveClasses/editLiveClass', 'Users\Admin\AdminController@post_editLiveClass')->name('editLiveClass');

    Route::get('/liveClasses/create_liveClass', 'Users\Admin\AdminController@get_create_liveClass')->name('admin.liveClasses.create_liveClass');
    Route::post('/liveClasses/create_liveClass', 'Users\Admin\AdminController@post_create_liveClass')->name('create_liveClass');
    Route::get('/liveClasses/allLiveClasses', 'Users\Admin\AdminController@allLiveClasses')->name('admin.liveClasses.allLiveClasses');

    Route::get('/allFlashNews', 'Users\Admin\AdminController@allFlashNews')->name('admin.allFlashNews');
    Route::get('/createFlashNews', 'Users\Admin\AdminController@createFlashNews')->name('admin.createFlashNews');
    Route::post('/postFlashNews', 'Users\Admin\AdminController@postFlashNews')->name('admin.postFlashNews');
    Route::get('/deleteFlashNews/{id}', 'Users\Admin\AdminController@deleteFlashNews')->name('admin.deleteFlashNews')->middleware('auth:admin');

    Route::get('/allClasswork', 'Users\Admin\AdminController@allClasswork')->name('admin.allClasswork')->middleware('auth:admin');;
    Route::get('/edit_classwork/{id}', 'Users\Admin\AdminController@edit_classwork')->name('admin.edit_classwork')->middleware('auth:admin');

    Route::post('/editPdfClasswork', 'Users\Admin\AdminController@editPdfClasswork')->name('admin.editPdfClasswork')->middleware('auth:admin');
    Route::post('/editImageClasswork', 'Users\Admin\AdminController@editImageClasswork')->name('admin.editImageClasswork')->middleware('auth:admin');
    Route::post('/editDocsClasswork', 'Users\Admin\AdminController@editDocsClasswork')->name('admin.editDocsClasswork')->middleware('auth:admin');
    Route::post('/editYoutubeLink', 'Users\Admin\AdminController@editYoutubeLink')->name('admin.editYoutubeLink')->middleware('auth:admin');

    Route::get('/classworkAttendence/{id}', 'Users\Admin\AdminController@classworkAttendence')->name('admin.classworkAttendence')->middleware('auth:admin');
    Route::get('/studentReturnWork/{id}', 'Users\Admin\AdminController@studentReturnWork')->name('admin.studentReturnWork')->middleware('auth:admin');
    Route::get('/classroom/{id}/delete', 'Users\Admin\AdminController@deletePost')->name('admin.deletePost')->middleware('auth:admin');

});


// Teacher routes
Route::prefix('teacher')->group(function(){
    Route::get('/', 'Users\Teacher\TeacherController@index')->name('teacher.dashboard');
    Route::get('/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
    Route::post('/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
    Route::get('/register', 'Auth\TeacherRegisterController@showRegisterForm')->name('teacher.register');
    Route::post('/register', 'Auth\TeacherRegisterController@register')->name('teacher.register.submit');

    Route::get('/edit_classwork/{id}', 'Users\Teacher\TeacherController@edit_classwork')->name('teacher.edit_classwork')->middleware('auth:teacher');
    
    Route::get('/createTitle/{id}', 'Users\Teacher\TeacherController@createTitle')->name('teacher.createTitle')->middleware('auth:teacher');
    Route::post('/createTitlePost', 'Users\Teacher\TeacherController@createTitlePost')->name('teacher.createTitlePost')->middleware('auth:teacher');


    Route::post('/pdfClasswork', 'Users\Teacher\TeacherController@pdfClasswork')->name('teacher.pdfClasswork')->middleware('auth:teacher');
    Route::post('/imageClasswork', 'Users\Teacher\TeacherController@imageClasswork')->name('teacher.imageClasswork')->middleware('auth:teacher');
    Route::post('/docsClasswork', 'Users\Teacher\TeacherController@docsClasswork')->name('teacher.docsClasswork')->middleware('auth:teacher');
    Route::post('/youtubeLink', 'Users\Teacher\TeacherController@youtubeLink')->name('teacher.youtubeLink')->middleware('auth:teacher');

    Route::post('/editPdfClasswork', 'Users\Teacher\TeacherController@editPdfClasswork')->name('teacher.editPdfClasswork')->middleware('auth:teacher');
    Route::post('/editImageClasswork', 'Users\Teacher\TeacherController@editImageClasswork')->name('teacher.editImageClasswork')->middleware('auth:teacher');
    Route::post('/editDocsClasswork', 'Users\Teacher\TeacherController@editDocsClasswork')->name('teacher.editDocsClasswork')->middleware('auth:teacher');
    Route::post('/editYoutubeLink', 'Users\Teacher\TeacherController@editYoutubeLink')->name('teacher.editYoutubeLink')->middleware('auth:teacher');

    Route::get('/liveClass', 'Users\Teacher\TeacherController@liveClass')->name('teacher.liveClass')->middleware('auth:teacher');
    Route::get('/liveClassAttendence/{id}', 'Users\Teacher\TeacherController@liveClassAttendence')->name('teacher.liveClassAttendence')->middleware('auth:teacher');;

    Route::get('/createExam', 'Users\Teacher\teacherExamController@createExam')->name('teacher.createExam')->middleware('auth:teacher');
    Route::get('/allExams', 'Users\Teacher\teacherExamController@allExams')->name('teacher.allExams')->middleware('auth:teacher');
    Route::get('/editExam/{id}', 'Users\Teacher\teacherExamController@editExam')->name('teacher.editExam')->middleware('auth:teacher');
    Route::post('/postEditExam', 'Users\Teacher\teacherExamController@postEditExam')->name('teacher.postEditExam')->middleware('auth:teacher');
    Route::get('/deleteExam/{id}', 'Users\Teacher\teacherExamController@deleteExam')->name('teacher.deleteExam')->middleware('auth:teacher');
    Route::get('/formExam/{id}', 'Users\Teacher\teacherExamController@formExam')->name('teacher.formExam')->middleware('auth:teacher');   

    Route::post('/pdfExam', 'Users\Teacher\teacherExamController@pdfExam')->name('teacher.pdfExam');
    Route::post('/imageExam', 'Users\Teacher\teacherExamController@imageExam')->name('teacher.imageExam');
    Route::post('/docsExam', 'Users\Teacher\teacherExamController@docsExam')->name('teacher.docsExam');
    Route::post('/formLink', 'Users\Teacher\teacherExamController@formLink')->name('teacher.formLink');


    Route::get('/classroom/{id}', 'Users\Teacher\TeacherController@classroom_id')->name('teacher.classroom')->middleware('auth:teacher');
  
    Route::get('/inner_classroom/{id}', 'Users\Teacher\TeacherController@inner_classroom_id')->name('teacher.inner_classroom')->middleware('auth:teacher');

    Route::get('/addMaterial/{id}', 'Users\Teacher\TeacherController@addMaterial')->name('teacher.addMaterial')->middleware('auth:teacher');

    Route::get('/classroom/{id}/delete', 'Users\Teacher\TeacherController@deletePost')->name('teacher.deletePost')->middleware('auth:teacher');
 
    Route::get('/classworkAttendence/{id}', 'Users\Teacher\TeacherController@classworkAttendence')->name('teacher.classworkAttendence')->middleware('auth:teacher');
    Route::get('/studentReturnWork/{id}', 'Users\Teacher\TeacherController@studentReturnWork')->name('teacher.studentReturnWork')->middleware('auth:teacher');
    
    Route::get('/resultList', 'Users\Teacher\TeacherResultController@resultList')->name('teacher.resultList')->middleware('auth:teacher');
    Route::get('/result/{id}', 'Users\Teacher\TeacherResultController@result')->name('teacher.result')->middleware('auth:teacher');
    Route::post('/postResult', 'Users\Teacher\TeacherResultController@postResult')->name('teacher.postResult');
    
    Route::get('/editStudentResult/{id}', 'Users\Teacher\TeacherResultController@editStudentResult')->name('teacher.editStudentResult')->middleware('auth:teacher');   
    Route::post('/topperSwitch', 'Users\Teacher\TeacherResultController@topperSwitch')->name('teacher.topperSwitch');

    Route::get('/liveClassAttendence', 'Users\Teacher\TeacherController@liveClassAttendence')->name('teacher.liveClassAttendence')->middleware('auth:teacher');;

    Route::get('/download/{id}', 'Users\Teacher\TeacherController@download')->name('teacher.download')->middleware('auth:teacher');;

}); 

Route::get('/hospital/events', 'Users\Teacher\TeacherController@events')->name('hospital.events')->middleware('auth:teacher');


// Teacher routes
Route::prefix('student')->group(function(){
    Route::get('/', 'Users\Student\StudentController@index')->name('student.dashboard')->middleware('auth');

    Route::get('/classroom/{id}', 'Users\Student\StudentController@classroom_id')->name('student.classroom')->middleware('auth');
   
    Route::get('/inner_classroom/{id}', 'Users\Student\StudentController@inner_classroom_id')->name('student.inner_classroom')->middleware('auth');
    Route::get('/homework/{id}', 'Users\Student\StudentController@homework')->name('student.homework')->middleware('auth');
    Route::post('/stuUploadFile', 'Users\Student\StudentController@stuUploadFile')->name('student.stuUploadFile')->middleware('auth');
    Route::get('homework/{id}/{titleId}/delete', 'Users\Student\StudentController@deleteStuUploadFile')->name('student.homework.deletePost')->middleware('auth');

    Route::get('/liveClass', 'Users\Student\StudentController@liveClass')->name('student.liveClass')->middleware('auth');
    Route::get('/liveAttendence/{id}', 'Users\Student\StudentController@liveAttendence')->name('student.liveAttendence')->middleware('auth');

    Route::get('/exams/allExams', 'Users\Student\ExamController@allExams')->name('student.exams.allExams')->middleware('auth');
    Route::get('/exams/upcomingExams', 'Users\Student\ExamController@upcomingExams')->name('student.exams.upcomingExams')->middleware('auth');
    Route::get('/exams/todayExams', 'Users\Student\ExamController@todayExams')->name('student.exams.todayExams')->middleware('auth');
     
    Route::get('/exams/attemptExam/{id}', 'Users\Student\ExamController@attemptExam')->name('student.exams.attemptExam')->middleware('auth');
    Route::post('/exams/fileExam', 'Users\Student\ExamController@fileExam')->name('student.exams.fileExam')->middleware('auth');   
    Route::post('/exams/formExam', 'Users\Student\ExamController@formExam')->name('student.exams.formExam')->middleware('auth');   
    Route::get('/exams/attemptExam/{id}/{examId}/delete', 'Users\Student\ExamController@deleteStuExamWroks')->name('student.exams.deletePost')->middleware('auth');
    Route::get('/exams/attemptExam/{id}/submittedDone', 'Users\Student\ExamController@submittedDone')->name('student.exams.submittedDone')->middleware('auth');


    Route::get('/notificationClasswork/{id}/{notificationId}', 'Users\Student\StudentController@notificationClasswork')->name('student.notificationClasswork')->middleware('auth');
    Route::get('/notificationExam/{id}/{notificationId}', 'Users\Student\StudentController@notificationExam')->name('student.notificationExam')->middleware('auth');

    Route::get('/results', 'Users\Student\StudentController@results')->name('admin.results');

}); 