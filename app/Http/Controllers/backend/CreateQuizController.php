<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizInfo;

class CreateQuizController extends Controller
{
    public function index(){
        $quiz = QuizInfo::all();
        return view('quiz.create_quiz')
            ->with('quiz',$quiz);
    }

    public function store(Request $request){
        $data = array(
            'QuizName' => $request->QuizName, 
            'Duration' => $request->Duration,
            'Status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = QuizInfo::insertGetId($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function GetData($id){
        if($id){
            $result = QuizInfo::where('QuizID', $id)->first();
        }else{
            $result = QuizInfo::all();
        }
        return $result;
    }

    public function update(Request $request){
        $data = array(
            'QuizName' => $request->QuizName, 
            'Duration' => $request->Duration,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $result = QuizInfo::where('QuizID', $request->QuizID)->update($data);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    public function publication($Status, $QuizID){
        // dd($Status, $QuizID);
        $data = array('Status' => $Status );
        $result = QuizInfo::where('QuizID', $QuizID)->update($data);
        if($result){
            return back();
        }
    }
}
