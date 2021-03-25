<?php

namespace App\Http\Controllers\Users\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\subCode;
use App\classwork;
use App\Exam;
use App\Term;
use App\studentExams;
use App\studentExamWorks;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Storage;
class ExamController extends Controller
{
    public function allExams(){
        $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
  
        $exams = Exam::all()->where('class',Auth::user()->grade)->sortByDesc('startExam'); 
        return view('student.exams.allExams', compact('exams','subCodes'));
      }
  
      public function upcomingExams(){
        $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
  
        $exams = Exam::all()->where('class',Auth::user()->grade)->sortByDesc('startExam'); 
        return view('student.exams.upcomingExams', compact('exams','subCodes'));
      }

      public function todayExams(){
        $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
  
        $exams = Exam::all()->where('class',Auth::user()->grade)->sortByDesc('startExam'); 
        return view('student.exams.todayExams', compact('exams','subCodes'));
      }

      public function attemptExam($id){
       
        foreach(Auth::user()->unreadNotifications as $notification){
          if($notification->data['classworkId']==$id && $notification->data['workType']=='Exam'){
            $notification->markAsRead();
          }
        }
        $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
  
        $exams = Exam::all()->where('id',$id);

        $studentExams = studentExams::all()->where('titleId',$id)->where('email',Auth::user()->email);
        $finalSubmit = false;
        foreach($studentExams as $studentExam){
          if($studentExam->email!=""){
            $finalSubmit = true;
          }
        }
         
        foreach($exams as $exam){
          $examId =$exam->id;
          $uploadFiles = studentExamWorks::all()->where('email',Auth::user()->email)->where('titleId',$examId);

           
          $users = User::all()->where('email',Auth::user()->email);
          foreach($users as $user){
            if($user->exam_permission == 0){
              return view('student.exams.examBlock', compact('exams','subCodes','id','finalSubmit'));
            }
          }

        if($exam->type =='FORM'){
            return view('student.exams.formExam', compact('exams','subCodes','id','finalSubmit'));
      }else{
        return view('student.exams.fileExam', compact('exams','uploadFiles','subCodes','id','finalSubmit'));
    }
    }
    }

 public function FileExam(Request $request){
        $data = $request->input();
        $id = $data['id'];
       

      try{
          $getClassSubs = DB::select('SELECT * FROM exams WHERE id = ?' , [$data['id']]);

          foreach ($getClassSubs as $getClassSub) {
         //   dd($getClassSub);
              $teacherEmail = $getClassSub->email;
              $class = $getClassSub->class;
              $subject = $getClassSub->subject;
              $title = $getClassSub->title;

            }

          $stuWork = new studentExamWorks;
          $stuWork->titleId = $data['id'];
          $stuWork->class = $class;
          $stuWork->name = Auth::user()->name;
          $stuWork->email = Auth::user()->email;
          $stuExam->teacherEmail = $teacherEmail;
          $stuWork->subject = $subject;        
          $stuWork->title = $title;
          $userName = Auth::user()->name;
          $fileUrl = 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . 'exams' . '/' . $title . '/' . $userName . '/' . $request->file->getClientOriginalName();
          $stuWork->fileUrl = $fileUrl;
          $stuWork->fileSize = $request->file('file')->getSize();
                   $stuWork->save();

          $file = $request->file('file');
          $imageName = $class . '/' . $subject . '/' . 'exams' . '/' . $title . '/' . $userName . '/' .  $file->getClientOriginalName();

          Storage::disk('s3')->put($imageName, file_get_contents($file));
          Storage::disk('s3')->setVisibility($imageName, 'public');
    

          return redirect('student/exams/attemptExam/'.$id)->with('status','File uploaded successfully');
      }
      catch(Exception $e){
          return redirect('student/exams/attemptExam/'.$id)->with('failed',"operation failed");
      }
  }
    
  public function getFileExam($id){
    $subCodes  = subCode::all()->where('class',Auth::user()->grade);   

    $exams = Exam::all()->where('id',$id);
 
    return view('student.exams.fileExam', compact('exams','subCodes','id'));
}


public function deleteStuExamWroks($id,$examId){
  try{

          $record = studentExamWorks::find($id);

          $record->delete($record->id);

          return redirect('student/exams/attemptExam/'.$examId)->with('delete','File deleted successfully');
      }
    
      catch(Exception $e){
          return redirect('student/exams/attemptExam/'.$examId)->with('failed',"operation failed");
      }
}

      public function submittedDone($id){
        try{
          $getClassSubs = DB::select('SELECT * FROM exams WHERE id = ?' , [$id]);
          //  dd($getClassSub->class);
            foreach ($getClassSubs as $getClassSub) {
                $teacherEmail = $getClassSub->email;
                $examId = $getClassSub->id;
                $class = $getClassSub->class;
                $subject = $getClassSub->subject;
                $title = $getClassSub->title;
                $maxMarks = $getClassSub->maxMarks;
            }
       
            $stuExam = new studentExams;
            $stuExam->titleId = $examId;
            $stuExam->class = $class;
            $stuExam->name = Auth::user()->name;
            $stuExam->email = Auth::user()->email;
            $stuExam->teacherEmail = $teacherEmail;
            $stuExam->subject = $subject;        
            $stuExam->title = $title;
            $stuExam->submittedDone = 1;
            $stuExam->maxMarks = $maxMarks;
                     $stuExam->save();

                return redirect('student/exams/attemptExam/'.$examId)->with('status','Final Submitted Done');
            }
          
            catch(Exception $e){
                return redirect('student/exams/attemptExam/'.$examId)->with('failed',"operation failed");
            }
      }

   
}
