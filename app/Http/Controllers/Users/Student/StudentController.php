<?php

namespace App\Http\Controllers\Users\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\subCode;
use App\classwork;
use App\Exam;
use App\Term;
use App\stuHomeworkUpload;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Notifications\emailNotification;


 
class StudentController extends Controller
{

    public function classroom_id($id){
      $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
      $classCodes = subCode::all()->sortBy("class");
      $subcode = subCode::all()->where('id',$id);
      foreach($subcode as $classSub){
          $subject =  $classSub->subject;
          $class  =   $classSub->class;
      }

      $classDatas = classwork::all()->where('class',$class)->where('subject',$subject)->sortByDesc('created_at');
      //dd($classDatas);
      return view('student.classroom', compact('classCodes','subcode','classDatas','class','subject','subCodes'));
 
    }


    public function editClassroom_id($topicId){
     
      $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
      $DBtopics = classwork::all()->where('id',$topicId)->sortByDesc('created_at');
      foreach($DBtopics as $topic){
        $title = $topic->title;
        $teacherName = $topic->name;
        $subject= $topic->subject;
      }
      $DBtitles = classwork::all()->where('title',$title)->sortByDesc('created_at');
 
      return view('student.inner_classroom', compact('DBtitles','title','teacherName','subject','subCodes'));
 
    }


    public function inner_classroom_id($topicId){
     
      $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
      $DBtopics = classwork::all()->where('id',$topicId)->sortByDesc('created_at');
      foreach($DBtopics as $topic){
        $title = $topic->title;
        $teacherName = $topic->name;
        $subject= $topic->subject;
      }
      $DBtitles = classwork::all()->where('title',$title)->sortByDesc('created_at');
 
      return view('student.inner_classroom', compact('DBtitles','title','teacherName','subject','subCodes'));
 
    }

    public function homework($topicId){
     foreach(Auth::user()->unreadNotifications as $notification){
       if($notification->data['classworkId']==$topicId && $notification->data['workType']=='Classwork'){
         $notification->markAsRead();
       }
     }


      $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
      $DBtopics = classwork::all()->where('id',$topicId);
      foreach($DBtopics as $topic){
        $id = $topic->id;
        $title = $topic->title;
        $teacherName = $topic->name;
        $subject= $topic->subject;
        $fileUrl = $topic->fileUrl;
        $filename=basename($topic->fileUrl);
        $fileSizes=intval(($topic->fileSize)/1000);
        $studentReturn	=  $topic->studentReturn;	
      }
      $DBtitles = classwork::all()->where('title',$title)->sortByDesc('created_at');
      $stuHomeworkUploads = stuHomeworkUpload::all()->where('titleId',$id)->where('email',Auth::user()->email);
      
      return view('student.homework', compact('id','DBtitles','title','teacherName','subject','subCodes','fileUrl','stuHomeworkUploads','filename','fileSizes','studentReturn'));
 
    }

    public function stuUploadFile(Request $request){
      $data = $request->input();
      $id = $data['id'];
    try{
        $getClassSubs = DB::select('SELECT * FROM classworks WHERE id = ?' , [$data['id']]);

        foreach ($getClassSubs as $getClassSub) {
       //   dd($getClassSub);
            $class = $getClassSub->class;
            $subject = $getClassSub->subject;
            $title = $getClassSub->title;

          }

        $stuWork = new stuHomeworkUpload;
        $stuWork->titleId = $data['id'];
        $stuWork->class = $class;
        $stuWork->name = Auth::user()->name;
        $stuWork->email = Auth::user()->email;
        $stuWork->subject = $subject;        
        $stuWork->title = $title;
        $userName = Auth::user()->name;
        $fileUrl = 'https://upto12th.s3.ap-south-1.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $userName . '/' . $request->file->getClientOriginalName();
        $stuWork->fileUrl = $fileUrl;
        $stuWork->fileSize = $request->file('file')->getSize();
                 $stuWork->save();

        $file = $request->file('file');
        $imageName = $class . '/' . $subject . '/' . $title . '/' . $userName . '/' .  $file->getClientOriginalName();

        Storage::disk('s3')->put($imageName, file_get_contents($file));
        Storage::disk('s3')->setVisibility($imageName, 'public');
  
        request()->user()->notify(new emailNotification($class,$subject,$title));

        return redirect('student/homework/'.$id)->with('status','File uploaded successfully');
    }
    catch(Exception $e){
        return redirect('student/homework/'.$id)->with('failed',"operation failed");
    }
}

public function deleteStuUploadFile($id,$topicId){
  try{

          $record = stuHomeworkUpload::find($id);

          $record->delete($record->id);

          return redirect('student/homework/'.$topicId)->with('delete','File deleted successfully');
      }
    
      catch(Exception $e){
          return redirect('student/homework/'.$topicId)->with('failed',"operation failed");
      }
}
  


    public function liveClass(){
        $subCodes  = subCode::all()->where('class',Auth::user()->grade);   
        return view('student.liveClass', compact('subCodes'));
    }


    public function notificationClasswork($id,$notificationId){
        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {
          Auth::user()->notifications->find($notificationId)->markAsRead();
        }
        return redirect('student/homework/'.$id);
          }

    public function notificationExam($id,$notificationId){
        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {
          Auth::user()->notifications->find($notificationId)->markAsRead();
        }
        return redirect('/student/exams/upcomingExams');
    }    
}
