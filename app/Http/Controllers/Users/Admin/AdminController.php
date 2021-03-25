<?php

namespace App\Http\Controllers\Users\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\subCode;
use App\User;
use App\Term;
use App\Teacher;
use App\flashNews;
use App\classwork;
use DB;
use App\stuHomeworkUpload;
use Illuminate\Support\Facades\Storage;
use Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin');
    }

    public function allStudentsRecord()
    {
        $users  = User::all()->sortBy('class');  
        $flashNews = flashNews::all()->sortByDesc('created_at');
        return view('admin.allStudentsRecord', compact('users','flashNews'));
    }


    public function editStudentRecord(Request $request, $id)
    {
        $users  = User::all()->WHERE('id',$id);

        $classes = subCode::all()->unique()->sortBy("class");
        if(!(isset($classes))){
            return redirect('admin/create_subCode')->with('failed',"Please create class and Subject first.");
        }
        $grade = NULL;
        foreach($classes as $class){
            if($grade!=$class->class){
                $grades[] = $class->class;
            }
            $grade=$class->class;
        }
          
        return view('admin.editStudentRecord', compact('users', 'id','grades'));
    }

    public function post_editStudentRecord(Request $request){
      $data = $request->input();
      $id = $data['id'];
			try{
                
      DB::table('users')
      ->where('id', $id)
      ->update(['name' => $data['editName'],
      'email' => $data['editEmail'],
      'grade' => $data['editClass'],
      'app_permission' => $data['editAppPermission'],
      'exam_permission' => $data['editExamPermission'],
      ]);
        return redirect('admin/allStudentsRecord')->with('status','Record updated successfully');
                }
            
      catch(Exception $e){
        return redirect('admin/allStudentsRecord')->with('failed',"operation failed");
        
    }
  }

  public function deleteStudentRecord($id){
    try{
        $record = User::find($id);

        $record->delete($record->id);

        return redirect('admin/allStudentsRecord')->with('delete','Student deleted successfully');
    }
    catch(Exception $e){
        return redirect('teacher/allStudentsRecord/'.$id)->with('failed',"operation failed");
    
    }
  }

    public function allTeachersRecord()
    {
        $teachers  = Teacher::all();   
        $subCodes = subCode::all()->sortBy('class'); 
        return view('admin.allTeachersRecord', compact('teachers','subCodes'));
    }

    public function editTeacherRecord(Request $request, $id)
    {
        $teachers  = Teacher::all()->WHERE('id',$id);

        $classes = subCode::all()->unique()->sortBy("class");
        if(!(isset($classes))){
            return redirect('admin/create_subCode')->with('failed',"Please create class and Subject first.");
        }
    
        return view('admin.editTeacherRecord', compact('teachers', 'id','classes'));
    }
 
    public function post_editTeacherRecord(Request $request){
      $data = $request->input();
      $id = $data['id'];
			try{
        $teacherName = $data['editName'];
        $fileUrl = 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $teacherName;
                
      DB::table('teachers')
      ->where('id', $id)
      ->update(['name' => $data['editName'],
      'email' => $data['editEmail'],
      'class_code0' => $data['editCode0'],
      'class_code1' => $data['editCode1'],
      'class_code2' => $data['editCode2'],
      'class_code3' => $data['editCode3'],
      'class_code4' => $data['editCode4'],
      'class_code5' => $data['editCode5'],
      'class_code6' => $data['editCode6'],
      'class_code7' => $data['editCode7'],
      'class_code8' => $data['editCode8'],
      'class_code9' => $data['editCode9'],
      'class_code10' => $data['editCode10'],
      'class_code11' => $data['editCode11'],
      'teacherImg' => $fileUrl,
       ]);
       $file = $request->file('file');
        $imageName = 'teacherImg/' . $teacherName;
        if ($request->hasFile('file')) {
          request()->file->move(public_path('assets/images/teacherImg'), $imageName);  
      //  Storage::disk('s3')->put($imageName, file_get_contents($file));
      //  Storage::disk('s3')->setVisibility($imageName, 'public');
        }
        return redirect('admin/allTeachersRecord')->with('status','Record updated successfully');
                }
            
      catch(Exception $e){
        return redirect('admin/allTeachersRecord')->with('failed',"operation failed");
        
    }
  }


  public function deleteTeacherRecord($id){
    try{
        $record = Teacher::find($id);

        $record->delete($record->id);

        return redirect('admin/allTeachersRecord')->with('delete','Teacher deleted successfully');
    }
    catch(Exception $e){
        return redirect('teacher/allTeachersRecord/'.$id)->with('failed',"operation failed");
    
    }
  }

    public function get_create_subCode()
    {
        return view('admin.create_subCode');
    }


    public function insert(){
        $urlData = getURLList();
        return view('admin.create_subCode');
    }

    public function post_create_subCode(Request $request)
    {
       
        $rules = [
			      'grade' => 'required', 'string', 'max:255',
            'subject' =>  'required', 'string', 'max:255',
            
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('admin/create_subCode')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
        $class = strtoupper($data['grade']);
        $subject = strtoupper($data['subject']);
              $classSubjects = subCode::all();
              foreach($classSubjects as $classSubject){
                if($classSubject->class == $class && $classSubject->subject == $subject){
                  return redirect('admin/create_subCode')->with('failed',"Duplicate Entry");                
                }
              }

				        $subCode = new subCode;
                $subCode->class = $class;
                $subCode->subject = $subject;
				$subCode->save();
				return redirect('admin/create_subCode')->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('admin/create_subCode')->with('failed',"operation failed");
			}
		}
    }
    
    public function get_create_liveClass()
    {
        $subCodes  = subCode::all()->sortBy('class');   
        return view('admin.liveClasses.create_liveClass', compact('subCodes'));
    }

    public function allLiveClasses()
    {
        $subCodes  = subCode::all()->sortBy('class');   
        return view('admin.liveClasses.allLiveClasses', compact('subCodes'));
    }

    public function post_create_liveClass(Request $request)
    {
       
        
            $data = $request->input();
           
			try{
                if(isset($data['Monday'])){
                    $Monday = $data['Monday'];
                }else{
                  $Monday = NULL;
                }
                if(isset($data['Tuesday'])){
                  $Tuesday = $data['Tuesday'];
                }else{
                $Tuesday = NULL;
                }
                if(isset($data['Wednesday'])){
                  $Wednesday = $data['Wednesday'];
                }else{
                $Wednesday = NULL;
                }
                if(isset($data['Thursday'])){
                  $Thursday = $data['Thursday'];
                }else{
                $Thursday = NULL;
                }
                if(isset($data['Friday'])){
                  $Friday = $data['Friday'];
                }else{
                $Friday = NULL;
                }
                if(isset($data['Saturday'])){
                  $Saturday = $data['Saturday'];
                }else{
                $Saturday = NULL;
                }
                if(isset($data['Sunday'])){
                  $Sunday = $data['Sunday'];
                }else{
                $Sunday = NULL;
                }

                $subId = $data['selectClass'];
                
                //dd($subId);
                DB::table('sub_codes')
            ->where('id', $subId)
            ->update(['link_url' => $data['link'],
            'start_time' => $data['startTime'],
            'end_time' => $data['endTime'],
            'Monday' => $Monday,
            'Tuesday' => $Tuesday,
            'Wednesday' => $Wednesday,
            'Thursday' => $Thursday,
            'Friday' => $Friday,
            'Saturday' => $Saturday,
            'Sunday' => $Sunday, ]);
				return redirect('admin/liveClasses/create_liveClass')->with('status','Link created successfully');
                }
            
			catch(Exception $e){
				return redirect('admin/liveClasses/create_liveClass')->with('failed',"operation failed");
			}
		
    }
    
    public function post_editLiveClass(Request $request)
    {
       
        
            $data = $request->input();
           
			try{
                if(isset($data['Monday'])){
                    $Monday = $data['Monday'];
                }else{
                  $Monday = NULL;
                }
                if(isset($data['Tuesday'])){
                  $Tuesday = $data['Tuesday'];
                }else{
                $Tuesday = NULL;
                }
                if(isset($data['Wednesday'])){
                  $Wednesday = $data['Wednesday'];
                }else{
                $Wednesday = NULL;
                }
                if(isset($data['Thursday'])){
                  $Thursday = $data['Thursday'];
                }else{
                $Thursday = NULL;
                }
                if(isset($data['Friday'])){
                  $Friday = $data['Friday'];
                }else{
                $Friday = NULL;
                }
                if(isset($data['Saturday'])){
                  $Saturday = $data['Saturday'];
                }else{
                $Saturday = NULL;
                }
                if(isset($data['Sunday'])){
                  $Sunday = $data['Sunday'];
                }else{
                $Sunday = NULL;
                }

                $subId = $data['selectClass'];
                
                //dd($subId);
                DB::table('sub_codes')
            ->where('id', $subId)
            ->update(['link_url' => $data['link'],
            'start_time' => $data['startTime'],
            'end_time' => $data['endTime'],
            'Monday' => $Monday,
            'Tuesday' => $Tuesday,
            'Wednesday' => $Wednesday,
            'Thursday' => $Thursday,
            'Friday' => $Friday,
            'Saturday' => $Saturday,
            'Sunday' => $Sunday, ]);
				return redirect('admin/liveClasses/create_liveClass')->with('status','Link updated successfully');
                }
            
			catch(Exception $e){
				return redirect('admin/liveClasses/create_liveClass')->with('failed',"operation failed");
			}
		
    }
    public function editLiveClass(Request $request, $id)
    {
        $subCodes  = subCode::all()->WHERE('id',$id);
        foreach($subCodes as $subCode){
          $id =$subCode->id;
          $class =$subCode->class;
          $subject =$subCode->subject;
          $Monday =$subCode->Monday;
          $Tuesday =$subCode->Tuesday;
          $Wednesday =$subCode->Wednesday;
          $Thursday =$subCode->Thursday;
          $Friday =$subCode->Friday;
          $Saturday =$subCode->Saturday;
          $Sunday =$subCode->Sunday;
          $start_time =$subCode->start_time;
          $end_time =$subCode->end_time;
          $link_url =$subCode->link_url;
        }
          
        return view('admin.liveClasses.editLiveClass', compact('subCodes', 'id'));
    }

    public function createFlashNews(){
      return view('admin.createFlashNews');
    }


    public function postFlashNews(Request $request){
      $data = $request->input();
      try{
				$flashNews = new flashNews;
        $flashNews->news = $data['inputNews'];
				$flashNews->save();
				return redirect('admin/createFlashNews')->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('admin/createFlashNews')->with('failed',"operation failed");
			}
    }

    public function allFlashNews(){
      $flashNews = flashNews::all()->sortByDesc('created_at');
      return view('admin.allFlashNews',compact('flashNews'));
    }
   
    public function deleteFlashNews($id){
      try{
          $record = flashNews::find($id);

          $record->delete($record->id);

          return redirect('admin/allFlashNews')->with('delete','News deleted successfully');
      }
      catch(Exception $e){
          return redirect('teacher/allFlashNews/'.$id)->with('failed',"operation failed");
      
      }
    }

    public function allSubCodes()
    {
        $subCodes  = subCode::all()->sortBy('class');   
        return view('admin.allSubCodes', compact('subCodes'));
    }
    
    public function deleteSubCode($id){
      try{
          $record = subCode::find($id);

          $record->delete($record->id);

          return redirect('admin/allSubCodes')->with('delete','Subject deleted successfully');
      }
      catch(Exception $e){
          return redirect('teacher/allFlashNews/'.$id)->with('failed',"operation failed");
      
      }
    }

    public function get_createTerms(){
      return view('admin.createTerms');
    }

    public function post_createTerms(Request $request){
      $data = $request->input();
      try{
				$term = new Term;
        $term->term = $data['term'];
				$term->save();
				return redirect('admin/createTerms')->with('status','Insert successfully');
			}
			catch(Exception $e){
				return redirect('admin/createTerms')->with('failed',"operation failed");
			}
    }

    public function allTerms(){
      $terms = Term::all()->sortByDesc('created_at');
      return view('admin.allTerms',compact('terms'));
    }

    public function deleteTerm($id){
      try{
          $record = Term::find($id);

          $record->delete($record->id);

          return redirect('admin/allTerms')->with('delete','Term deleted successfully');
      }
      catch(Exception $e){
          return redirect('admin/allTerms/'.$id)->with('failed',"operation failed");
      
      }
    }

    public function allClasswork(){
      try{
        $classDatas = classwork::all()->sortByDesc('created_at');

        return view('admin.allClasswork', compact('classDatas'));
    }
    catch(Exception $e){
        return redirect('admin/allClasswork')->with('failed',"operation failed");
    
    }
    }

    public function edit_classwork(Request $request, $id ){
      try{
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

          return view('admin.edit_classwork', compact( 'classDatas','class','subject','title','id','terms','type','youtubeLink','studentReturn'));
        }
      
        catch(Exception $e){
      return redirect('admin/allClasswork/'.$id)->with('failed',"operation failed");
          }
        }

        public function editPdfClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('admin/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
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
                        'title' =>  $title,
          
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'PDF',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('admin/allClasswork')->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('admin/allClasswork')->with('failed',"operation failed");
			}
		
    }

    public function editImageClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('admin/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
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
                      
                        'title' =>  $title,
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'IMG',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('admin/allClasswork')->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('admin/allClasswork')->with('failed',"operation failed");
			}
		
    }

    public function editDocsClasswork(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('admin/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
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
                        'title' =>  $title,
                        'fileUrl' => 'https://brefnew-dev-storage-1xk3pgbkrilzi.s3.amazonaws.com/' . $class . '/' . $subject . '/' . $title . '/' . $data['fileName'],
                        'fileSize' => $request->file('file')->getSize(),
                        'studentReturn' => $studentReturn, 
                        'type' => 'DOCS',]);

                
               
                $file = $request->file('file');
                $imageName = $class . '/' . $subject . '/' . $title . '/' .  $data['fileName'];

                Storage::disk('s3')->put($imageName, file_get_contents($file));
                Storage::disk('s3')->setVisibility($imageName, 'public');

				return redirect('admin/allClasswork')->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('admin/allClasswork')->with('failed',"operation failed");
			}
		
    }
   

    public function  editYoutubeLink(Request $request)
    {
            $data = $request->input();
            $id = $data['id'];
            $term = $data['selectTerm'];
            if(!(isset($data['selectTitle']))){
                return redirect('admin/edit_classwork/'.$id)->with('failed',"Try again, Please select title");
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
                        'title' =>  $title,
                        'youtubeLink' => $data['youtubeLink'],
                        'studentReturn' => $studentReturn, 
                        'type' => 'YOUTUBE',]);

				return redirect('admin/allClasswork')->with('status','Record edited successfully');
			}
			catch(Exception $e){
				return redirect('admin/allClasswork')->with('failed',"operation failed");
			}
		
    }

    public function classworkAttendence($id){
     

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
          return view('admin/classworkAttendence', compact('readNotications','unreadNotications','id','users'));
  //        return view('teacher.createTitle', compact('subCodes','classCodes','classworks','subcode','classDatas','class','subject','id'));

      }

      public function studentReturnWork($id){
        
        $stuHomeworkUploads = stuHomeworkUpload::all()->where('titleId',$id)->sortBy('email');
       // dd($stuHomeworkUpload);
        foreach($stuHomeworkUploads as $stuHomeworkUpload){
            $class = $stuHomeworkUpload->class;
        }
        if(!(isset($class))){
            return back()->with('failed',"No record found");

        }
        $users = User::all()->where('grade',$class);
        
            return view('admin/studentReturnWork', compact('id','users','stuHomeworkUploads'));    
    
        }

        public function deletePost($id){
          try{
            
          
                  $record = classwork::find($id);
  
                  $record->delete($record->id);
  
                  return redirect('admin/allClasswork')->with('delete','Record deleted successfully');
              }
              catch(Exception $e){
                  return redirect('admin/allClasswork')->with('failed',"operation failed");
              }
          }

          public function phpinfo(){
            return view('admin.phpinfo');

          }
}

