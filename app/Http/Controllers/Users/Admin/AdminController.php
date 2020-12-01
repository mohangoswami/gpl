<?php

namespace App\Http\Controllers\Users\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\subCode;
use App\flashNews;
use DB;


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
			'title' => 'required', 'string', 'max:255',
            'discription' =>  'string', 'max:255',
            
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
				$subCode = new subCode;
                $subCode->class = $data['grade'];
                $subCode->subject = $data['subject'];
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
}