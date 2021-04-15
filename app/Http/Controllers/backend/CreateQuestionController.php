<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuizSectionInfo;
use App\Models\QuizInfo;
use App\Models\QuestionInfo;
use App\Models\OptionInfo;
use DB;

class CreateQuestionController extends Controller
{
    public function index(){
        $quiz_section = QuizSectionInfo::all();
        $quiz = QuizInfo::all();
        return view('quiz.create_question')
        ->with('quiz',$quiz)
        ->with('quiz_section',$quiz_section);
    }

    public function store(Request $request){
        // dd($request->all());
        $data = array(
            'QsecID' => $request->QsecID, 
            'Question' => $request->Question,
            'Marks' => $request->Marks,
            'Duration' => $request->Duration,
            'Status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = QuestionInfo::insertGetId($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function update(Request $request){
        // dd($request->all());
        $data = array(
            'QsecID' => $request->QsecID, 
            'Question' => $request->Question,
            'Marks' => $request->Marks,
            'Duration' => $request->Duration,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $result = QuestionInfo::where('QuestionID', $request->QuestionID)->update($data);
        // dd($result);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    //Question wise option insert and answer select by status = 1;
    public function store_option(Request $request){

        if(Str::upper($request->Status) == "RIGHT"){
            $Status = 1;
        }else if(Str::upper($request->Status) == "WRONG"){
            $Status = 0;
        }
        $data = array(
            'QuestionID' => $request->QuestionID, 
            'OptionName' => $request->OptionName, 
            'Status' => $Status,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $result = OptionInfo::insertGetId($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function update_option(Request $request){
        // dd($request->all());
        if(Str::upper($request->Status) == "RIGHT"){
            $Status = 1;
        }else if(Str::upper($request->Status) == "WRONG"){
            $Status = 0;
        }
        $data = array(
            'QuestionID' => $request->QuestionID, 
            'OptionName' => $request->OptionName, 
            'Status' => $Status,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = OptionInfo::where('OptionID', $request->OptionID)->update($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function publication($Status, $QuestionID){
        // dd($Status, $QuizID);
        $data = array('Status' => $Status );
        $result = QuestionInfo::where('QuestionID', $QuestionID)->update($data);
        if($result){
            return back();
        }
    }    

    public function GetData($id){
        if($id){
            $result = DB::select("SELECT q.QuestionID,q.Question,q.Marks,q.Duration,q.Status,q.QsecID,qs.SectionName,qs.QuizID,qi.QuizName,op.OptionID,op.OptionName,op.Status as opStatus FROM option_infos op JOIN   question_infos q ON op.QuestionID = q.QuestionID JOIN quiz_section_infos qs ON q.QsecID = qs.QsecID JOIN quiz_infos qi ON qs.QuizID = qi.QuizID WHERE q.QuestionID = $id");
            // dd($result);
        }else{
            $result = DB::select("SELECT q.QuestionID,q.Question,q.Marks,q.Duration,q.Status,q.QsecID,qs.SectionName,qs.QuizID,qi.QuizName FROM question_infos q JOIN quiz_section_infos qs ON q.QsecID = qs.QsecID JOIN quiz_infos qi ON qs.QuizID = qi.QuizID ORDER BY q.QuestionID ASC");
        }
        return $result;
    }
}
