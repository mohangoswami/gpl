<?php

namespace App\Http\Controllers\Users\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\subCode;
use App\classwork;
use App\Exam;
use App\Term;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Notifications\emailNotification;
use App\User;
use App\Admin;
use App\flashNews;
use App\stuHomeworkUpload;
use App\liveClassAttendence;


class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index()
    {
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $flashNews = flashNews::all()->sortByDesc('created_at');

        $classworks  = classwork::all()->where('email',Auth::user()->email)->sortByDesc('created_at');   
        $exams = Exam::all()->where('email',Auth::user()->email)->sortByDesc('created_at'); 
        return view('/teacher/dashboard',compact('subCodes','classworks','exams','classCodes','flashNews'));
    }

    public function liveClass(){
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
       return view('teacher.liveClass', compact('subCodes','classCodes'));
      }

    public function addMaterial($id){
         
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $subcode = subCode::all()->where('id',$id);
        $terms = Term::all()->sortBy("term");
        foreach($subcode as $classSub){
            $subject =  $classSub->subject;
            $class  =   $classSub->class;
        }
       
        $classDatas = classwork::all()->where('class',$class)->where('subject',$subject)->sortByDesc('created_at');
        //dd($classDatas);
        $classworks  = classwork::all()->sortBy("class");
        return view('teacher.addMaterial', compact('subCodes','classCodes','classworks','subcode','classDatas','class','subject','id','terms'));
   
    }

    public function edit_classwork(Request $request, $id ){
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $terms = Term::all()->sortBy("term");
        
        $classworks  = classwork::all()->WHERE('id',$id);

        foreach($classworks as $classwork){
            $class = $classwork->class;
            $subject = $classwork->subject;
            $title = $classwork->title;
            $type = $classwork->type;
            $youtubeLink = $classwork->youtubeLink;
            $studentReturn = $classwork->studentReturn;
        }
        $classDatas = classwork::all()->where('class',$class)->where('subject',$subject)->sortByDesc('created_at');

        $subIds = subCode::all()->where('class',$class)->where('subject',$subject);
        $teacherCode=false;
       
        foreach($subIds as $forSubId){
            $checkId =   $forSubId->id;
            $subId = $forSubId->id;
            
        } 

        foreach($subCodes as $subcode){
          
            if($checkId == $subcode){
                    $teacherCode = true;
                }

            }
    
        if($teacherCode==true){
            return view('teacher.edit_classwork', compact('subCodes','classCodes', 'classDatas','class','subject','title','id','terms','type','youtubeLink','studentReturn','subId'));
        }
            else{
				return redirect('teacher/inner_classroom/'.$id)->with('failed',"operation failed");
            }
}
 
   
    public function pdfClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/addMaterial/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM sub_codes WHERE id = ?' , [$data['id']]);
              //  dd($getClassSub->class);
                foreach ($getClassSubs as $getClassSub) {
                    $class = $getClassSub->class;
                    $subject = $getClassSub->subject;
                }
                $classwork = new classwork;
                $classwork->term = $term;
                $classwork->name = Auth::guard('teacher')->user()->name;
                $classwork->email = Auth::guard('teacher')->user()->email;
                $classwork->title =$title;
                $classwork->subject = $subject;
                $classwork->class = $class;
                $classwork->fileUrl = 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'];
                $classwork->fileSize = $request->file('file')->getSize();
                if(isset($data['studentWorkIsrequire'])){
                $classwork->studentReturn = 1;
                }
                $classwork->type = 'PDF';
                $classwork->save();
                 
               $classworkId = $classwork->id;
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');
          
                $type = "PDF";
                $workType = "Classwork";
              
                User::all()->where('grade',$class)->each(function (User $user) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $user->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
              
                });
                Admin::all()->each(function (Admin $admin) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $admin->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
              
                });
				return redirect('teacher/addMaterial/'.$id)->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('teacher/addMaterial/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function imageClasswork(Request $request)
    {
            
            $data = $request->input();
            $term = $data['selectTerm'];
            $id = $data['id'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/addMaterial/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM sub_codes WHERE id = ?' , [$data['id']]);
              //  dd($getClassSub->class);
                foreach ($getClassSubs as $getClassSub) {
                    $class = $getClassSub->class;
                    $subject = $getClassSub->subject;
                }
                $classwork = new classwork;
                $classwork->term = $term;
                $classwork->name = Auth::guard('teacher')->user()->name;
                $classwork->email = Auth::guard('teacher')->user()->email;
                $classwork->title =$title;
                $classwork->subject = $subject;
                $classwork->class = $class;
                $classwork->fileUrl = 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'];
                $classwork->fileSize = $request->file('file')->getSize();
                if(isset($data['imgStudentWorkIsrequire'])){
                    $classwork->studentReturn = 1;
                    }
                    $classwork->type = 'IMG';
                    $classwork->save();
                
                
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

                $classworkId = $classwork->id;
                $type = "IMG";
                $workType = "Classwork";
             //   User::where('email','bali4u2001@gmail.com') -> first()->notify(new emailNotification);
                User::all()->where('grade',$class)->each(function (User $user) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $user->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
                });
                Admin::all()->each(function (Admin $admin) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $admin->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
              
                });
				return redirect('teacher/addMaterial/'.$id)->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('teacher/addMaterial/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function docsClasswork(Request $request)
    {
        $data = $request->input();
        $term = $data['selectTerm'];
        $id = $data['id'];
        if(!(isset($data['selectTitle']))){
            return redirect('teacher/addMaterial/'.$id)->with('failed',"Try again, Please select title");
        }
       $title = $data['selectTitle'];
        
        try{
                $getClassSubs = DB::select('SELECT * FROM sub_codes WHERE id = ?' , [$data['id']]);
            //  dd($getClassSub->class);
                foreach ($getClassSubs as $getClassSub) {
                    $class = $getClassSub->class;
                    $subject = $getClassSub->subject;
                }
                $classwork = new classwork;
                $classwork->term = $term;
                $classwork->name = Auth::guard('teacher')->user()->name;
                $classwork->email = Auth::guard('teacher')->user()->email;
                $classwork->title =$title;                          
                $classwork->subject = $subject;
                $classwork->class = $class;
                $classwork->fileUrl = 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'];
                $classwork->fileSize = $request->file('file')->getSize();
                if(isset($data['docStudentWorkIsrequire'])){
                    $classwork->studentReturn = 1;
                    }
                $classwork->type = 'DOCS';
                $classwork->save();
                
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');
            
                $classworkId = $classwork->id;
                $type = "DOCS";
                $workType = "Classwork";
             //   User::where('email','bali4u2001@gmail.com') -> first()->notify(new emailNotification);
                User::all()->where('grade',$class)->each(function (User $user) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $user->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
                });
                Admin::all()->each(function (Admin $admin) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $admin->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
              
                });
				return redirect('teacher/addMaterial/'.$id)->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('teacher/addMaterial/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function youtubeLink(Request $request)
    {
        $data = $request->input();
        $term = $data['selectTerm'];
        $id = $data['id'];
        if(!(isset($data['selectTitle']))){
            return redirect('teacher/addMaterial/'.$id)->with('failed',"Try again, Please select title");
        }
       $title = $data['selectTitle'];
        
        try{
            $getClassSubs = DB::select('SELECT * FROM sub_codes WHERE id = ?' , [$data['id']]);
          //  dd($getClassSub->class);
            foreach ($getClassSubs as $getClassSub) {
                $class = $getClassSub->class;
                $subject = $getClassSub->subject;
            }
                $classwork = new classwork;
                $classwork->term = $term;
                $classwork->name = Auth::guard('teacher')->user()->name;
                $classwork->email = Auth::guard('teacher')->user()->email;
                $classwork->title =$title;
                $classwork->subject = $subject;
                $classwork->class = $class;
                $classwork->youtubeLink = $data['youtubeLink'];
                if(isset($data['ytStudentWorkIsrequire'])){
                    $classwork->studentReturn = 1;
                    }
                $classwork->type = 'YOUTUBE';                
                $classwork->save();
                    
                $classworkId = $classwork->id;
                $type = "YOUTUBE";
                $workType = "Classwork";
             //   User::where('email','bali4u2001@gmail.com') -> first()->notify(new emailNotification);
                User::all()->where('grade',$class)->each(function (User $user) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $user->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
                });
                Admin::all()->each(function (Admin $admin) use ($workType,$classworkId,$class,$subject,$title,$type){
                    $admin->notify(new emailNotification($workType,$classworkId,$class,$subject,$title,$type));
                });
				return redirect('teacher/addMaterial/'.$id)->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('teacher/addMaterial/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function editPdfClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM classworks WHERE id = ?' , [$data['id']]);
                //  dd($getClassSub->class);
                  foreach ($getClassSubs as $getClassSub) {
                      $class = $getClassSub->class;
                      $subject = $getClassSub->subject;
                  }
                  if(isset($data['studentWorkIsrequire'])){
                    $studentReturn = 1;
                    }else{
                    $studentReturn = 0;
                    }

                DB::table('classworks')
            ->where('id', $id)
            ->update([  'term' => $term,
                        'name' => Auth::guard('teacher')->user()->name,
                        'email' => Auth::guard('teacher')->user()->email,
                        'title' =>  $title,
                        'subject' => $subject,
                        'class' => $class,
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'PDF',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('teacher/inner_classroom/'.$id)->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('teacher/inner_classroom/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function editImageClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM classworks WHERE id = ?' , [$data['id']]);
                //  dd($getClassSub->class);
                  foreach ($getClassSubs as $getClassSub) {
                      $class = $getClassSub->class;
                      $subject = $getClassSub->subject;
                  }
                  if(isset($data['imgStudentWorkIsrequire'])){
                    $studentReturn = 1;
                    }else{
                    $studentReturn = 0;
                    }

                DB::table('classworks')
            ->where('id', $id)
            ->update([  'term' => $term,
                        'name' => Auth::guard('teacher')->user()->name,
                        'email' => Auth::guard('teacher')->user()->email,
                        'title' =>  $title,
                        'subject' => $subject,
                        'class' => $class,
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'IMG',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('teacher/inner_classroom/'.$id)->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('teacher/inner_classroom/'.$id)->with('failed',"operation failed");
			}
		
    }

    public function editDocsClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM classworks WHERE id = ?' , [$data['id']]);
                //  dd($getClassSub->class);
                  foreach ($getClassSubs as $getClassSub) {
                      $class = $getClassSub->class;
                      $subject = $getClassSub->subject;
                  }
                  if(isset($data['docStudentWorkIsrequire'])){
                    $studentReturn = 1;
                    }else{
                    $studentReturn = 0;
                    }

                DB::table('classworks')
            ->where('id', $id)
            ->update([  'term' => $term,
                        'name' => Auth::guard('teacher')->user()->name,
                        'email' => Auth::guard('teacher')->user()->email,
                        'title' =>  $title,
                        'subject' => $subject,
                        'class' => $class,
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'DOCS',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('teacher/inner_classroom/'.$id)->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('teacher/inner_classroom/'.$id)->with('failed',"operation failed");
			}
		
    }
   

    public function  editYoutubeLink(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('teacher/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
            }
           $title = $data['selectTitle'];
            
            try{
                $getClassSubs = DB::select('SELECT * FROM classworks WHERE id = ?' , [$data['id']]);
                //  dd($getClassSub->class);
                  foreach ($getClassSubs as $getClassSub) {
                      $class = $getClassSub->class;
                      $subject = $getClassSub->subject;
                  }
                  if(isset($data['ytStudentWorkIsrequire'])){
                    $studentReturn = 1;
                    }else{
                    $studentReturn = 0;
                    }

                DB::table('classworks')
            ->where('id', $id)
            ->update([  'term' => $term,
                        'name' => Auth::guard('teacher')->user()->name,
                        'email' => Auth::guard('teacher')->user()->email,
                        'title' =>  $title,
                        'subject' => $subject,
                        'class' => $class,
                        'youtubeLink' => $data['youtubeLink'],
                        'studentReturn' => $studentReturn, 
                        'type' => 'YOUTUBE',]);

				return redirect('teacher/inner_classroom/'.$id)->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('teacher/inner_classroom/'.$id)->with('failed',"operation failed");
			}
		
    }

   



    public function classroom(){
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $subcode = subCode::all()->where('id',$id);

        $classworks  = classwork::all()->sortBy("class");
        return view('teacher.classroom', compact('subCodes','classCodes','classworks','subCode'));
    }

    public function classroom_id($id){
        
       
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $subcode = subCode::all()->where('id',$id);
        foreach($subcode as $classSub){
            $subject =  $classSub->subject;
            $class  =   $classSub->class;
        } 
       
        $classDatas = classwork::all()->where('class',$class)->where('subject',$subject)->sortByDesc('created_at');
        //dd($classDatas);
        $classworks  = classwork::all()->sortBy("class");
        return view('teacher.classroom', compact('subCodes','classCodes','classworks','subcode','classDatas','class','subject','id'));
   
    }


    public function inner_classroom_id($id){
     
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;

        $classCodes = subCode::all()->sortBy("class");
        
        $DBtopics = classwork::all()->where('id',$id)->sortByDesc('created_at');
        foreach($DBtopics as $topic){
          $title = $topic->title;
          $teacherName = $topic->name;
          $subject= $topic->subject;
          $class= $topic->class;
        }
        $DBtitles = classwork::all()->where('class',$class)->where('subject',$subject)->where('title',$title)->sortByDesc('created_at');
   
        return view('teacher.inner_classroom', compact('DBtitles','title','teacherName','subject','subCodes','classCodes'));
   
      }

    public function createTitle($id){
       
        $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
        $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
        
        $classCodes = subCode::all()->sortBy("class");
        $subcode = subCode::all()->where('id',$id);
        foreach($subcode as $classSub){
            $subject =  $classSub->subject;
            $class  =   $classSub->class;
        }
       
        $classDatas = classwork::all()->where('class',$class)->where('subject',$subject)->sortByDesc('created_at');
        //dd($classDatas);
        $classworks  = classwork::all()->sortBy("class");
        return view('teacher.createTitle', compact('subCodes','classCodes','classworks','subcode','classDatas','class','subject','id'));
   
    }

    public function createTitlePost(Request $request){
      
        $data = $request->input();
        $id = $data['id'];
        if($data['inputTitle']==""){
            return redirect('teacher/createTitle/'.$id)->with('failed',"Try again, Please select only one title");
        }

        try{
            $getClassSubs = DB::select('SELECT * FROM sub_codes WHERE id = ?' , [$data['id']]);
          //  dd($getClassSub->class);
            foreach ($getClassSubs as $getClassSub) {
                $class = $getClassSub->class;
                $subject = $getClassSub->subject;
            }
            $classwork = new classwork;
            $classwork->name = Auth::guard('teacher')->user()->name;
            $classwork->email = Auth::guard('teacher')->user()->email;
            $classwork->title = $data['inputTitle'];
            $classwork->discription = $data['discription'];
            $classwork->subject = $subject;
            $classwork->class = $class;
            $classwork->type = 'TOPIC';
          
            $classwork->save();

            return redirect('teacher/createTitle/'.$id)->with('status','Insert successfully');
        }
        catch(Exception $e){
            return redirect('teacher/createTitle/'.$id)->with('failed',"operation failed");
        }
    }

    public function deletePost($id){
        try{
          
            $classworks  = classwork::all()->WHERE('id',$id);

            foreach($classworks as $classwork){
                $class = $classwork->class;
                $subject = $classwork->subject;
            }
   
            $subIds = subCode::all()->where('class',$class)->where('subject',$subject);
            foreach($subIds as $forSubId){
                $subId = $forSubId->id;
                
            } 

                $record = classwork::find($id);

                $record->delete($record->id);

                return redirect('teacher/classroom/'.$subId)->with('delete','Record deleted successfully');
            }
            catch(Exception $e){
                return redirect('teacher/createTitle/'.$id)->with('failed',"operation failed");
            }
        }
          
         
        public function classworkAttendence($id){
            $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
            $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
            
            $classCodes = subCode::all()->sortBy("class");

            $classworks= classwork::all()->where('id',$id);
            foreach($classworks as $classwork){
                $class = $classwork->class;
            }
            $users = User::all()->where('grade',$class);
            
            foreach($users as $user){
            foreach($user->readnotifications as $notification){
                   $readNotications[] = $notification;
            }
            if(!(isset($readNotications))){
                $readNotications = NULL;
            }
            foreach($user->unreadnotifications as $notification){
                $unreadNotications[] = $notification;
         }
         if(!(isset($unreadNotications))){
            $unreadNotications = NULL;
        }
            }
                //dd($attendenceNotications);
                return view('teacher/classworkAttendence', compact('subCodes','classCodes','readNotications','unreadNotications','id','users'));
        //        return view('teacher.createTitle', compact('subCodes','classCodes','classworks','subcode','classDatas','class','subject','id'));

            }

            public function studentReturnWork($id){
                $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
                $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
                
                $classCodes = subCode::all()->sortBy("class");
    
                $stuHomeworkUploads = stuHomeworkUpload::all()->where('titleId',$id)->sortBy('email');
               // dd($stuHomeworkUpload);
                foreach($stuHomeworkUploads as $stuHomeworkUpload){
                    $class = $stuHomeworkUpload->class;
                }
                if(!(isset($class))){
                    return back()->with('failed',"No record found");
 
                }
                $users = User::all()->where('grade',$class);
                
                    return view('teacher/studentReturnWork', compact('subCodes','classCodes','id','users','stuHomeworkUploads'));    
            
                }

                public function liveClassAttendence($id){
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code0;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code1;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code2;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code3;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code4;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code5;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code6;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code7;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code8;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code9;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code10;
                    $subCodes[] =  Auth::guard('teacher')->user()->class_code11;
                    
                    $classCodes = subCode::all()->sortBy("class");
        
                    $liveSubCodes = subCode::all()->where('id',$id);
                   foreach($liveSubCodes as $liveSubCode){
                       $class = $liveSubCode->class;
                       $subject = $liveSubCode->subject;
                   }
                   
                    if(!(isset($class))){
                        return back()->with('failed',"No record found");
                    }
                    $users = liveClassAttendence::all()->where('class',$class)->where('subject',$subject)->sortBy('created_at');
                    
                        return view('teacher/liveClassAttendence', compact('subCodes','classCodes','users','class','subject'));    
                
                    }
    }

    
