<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizSectionInfo;
use App\Models\QuizInfo;
use App\Models\QuizPassInfo;
use DB;

class CreateSectionController extends Controller
{
    public function index(){
        $quiz_section = QuizSectionInfo::all();
        $quiz = QuizInfo::all();
        return view('quiz.create_section')
            ->with('quiz',$quiz)
            ->with('quiz_section',$quiz_section);
    }

    public function store(Request $request){
        // dd($request->all());
        $data = array(
            'QuizID' => $request->QuizID, 
            'SectionName' => $request->SectionName,
            'Status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = QuizSectionInfo::insertGetId($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function GetData($id){
        if($id){
            $result = DB::select("SELECT qs.QuizID,qz.QuizName,qs.QsecID,qs.SectionName,qs.Status FROM quiz_section_infos qs JOIN quiz_infos qz ON qs.QuizID = qz.QuizID WHERE qs.QsecID = $id");
        }else{
            $result = DB::select("SELECT qs.QuizID,qz.QuizName,qs.QsecID,qs.SectionName,qs.Status FROM quiz_section_infos qs JOIN quiz_infos qz ON qs.QuizID = qz.QuizID ORDER BY qs.QsecID DESC");
        }
        return $result;
    }

    public function update(Request $request){
        // dd($request->all());
        $data = array(
            'QuizID' => $request->QuizID, 
            'SectionName' => $request->SectionName,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $result = QuizSectionInfo::where('QsecID', $request->QsecID)->update($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function publication($Status, $QsecID){
        // dd($Status, $QuizID);
        $data = array('Status' => $Status );
        $result = QuizSectionInfo::where('QsecID', $QsecID)->update($data);
        if($result){
            return back();
        }
    }

    //pass marks assign.. 
    public function passmarks(){
        $quiz_section = QuizSectionInfo::all();
        $quiz = QuizInfo::all();
        return view('quiz.assign_passmark   ')
            ->with('quiz',$quiz)
            ->with('quiz_section',$quiz_section);
    }

    //sectionwise total marks..
    public function sectionwise_totalMarks($QsecID){
        $result = DB::select("SELECT SUM(qi.Marks) AS TotalMarks FROM question_infos qi WHERE qi.QsecID = $QsecID AND qi.Status = 1");
        return $result;
    }

    //pass marks store.. 
    public function store_passmarks(Request $request){
        $data = array(
            'QsecID' => $request->QsecID,
            'TotalMarks' => $request->TotalMarks,
            'PassMarks' => $request->PassMarks,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = QuizPassInfo::insertGetId($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    //update Pass Marks.. 
    public function update_passmarks(Request $request){
        $data = array(
            'QsecID' => $request->QsecID,
            'TotalMarks' => $request->TotalMarks,
            'PassMarks' => $request->PassMarks,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $result = QuizPassInfo::where('PassID', $request->PassID)->update($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    //Get Pass Marks all Data.. 
    public function GetPassData($PassID){
        if($PassID){
            $result = DB::select("SELECT qs.QuizID,qi.QuizName,qp.QsecID,qs.SectionName,qp.PassID,qp.TotalMarks,qp.PassMarks FROM quiz_pass_infos qp JOIN quiz_section_infos qs ON qp.QsecID = qs.QsecID JOIN quiz_infos qi ON qs.QuizID = qi.QuizID WHERE qp.PassID = $PassID");
        }else{
            $result = DB::select("SELECT qs.QuizID,qi.QuizName,qp.QsecID,qs.SectionName,qp.PassID,qp.TotalMarks,qp.PassMarks FROM quiz_pass_infos qp JOIN quiz_section_infos qs ON qp.QsecID = qs.QsecID JOIN quiz_infos qi ON qs.QuizID = qi.QuizID");
        }
        // dd($result);
        return $result;
    }
}
