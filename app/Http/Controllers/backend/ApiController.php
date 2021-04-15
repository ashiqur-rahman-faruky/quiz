<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function GetData($id){
        // return $id;
        if($id){
            $result = DB::select("SELECT q.QuizID,q.QuizName,s.QsecID,s.SectionName,qu.QuestionID,qu.Question,o.OptionID,o.OptionName, IF(o.Status = 1, 'Right', 'Wrong') as Answer FROM quiz_infos q JOIN quiz_section_infos s ON q.QuizID= s.QuizID JOIN question_infos qu ON qu.QsecID = s.QsecID JOIN option_infos o ON qu.QuestionID = o.QuestionID where q.QuizID = $id");
        }else{
            $result = DB::select("SELECT q.QuizID,q.QuizName,s.QsecID,s.SectionName,qu.QuestionID,qu.Question,o.OptionID,o.OptionName, IF(o.Status = 1, 'Right', 'Wrong') as Answer FROM quiz_infos q JOIN quiz_section_infos s ON q.QuizID= s.QuizID JOIN question_infos qu ON qu.QsecID = s.QsecID JOIN option_infos o ON qu.QuestionID = o.QuestionID");
        }
        return $result;
    }
}
