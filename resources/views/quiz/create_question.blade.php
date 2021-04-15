@extends('backendlayout.index')
@section('title')
<title>Quiz Question</title>
@endsection
@section('content') 
<div class="layout-content-body">
   <div class="title-bar">
      <h1 class="title-bar-title">
         <span class="d-ib">Section Question Creation</span>
      </h1>
   </div>
   <hr style="position: relative;top: -15px;border: none;height: 2px;background: black; margin-bottom: 1px; ">
   <div class="demo-form-wrapper">
        <form class="form form-horizontal">
            @csrf
            <div class="row" >
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-5">
                    <div class="form-group" hidden>
                        <input name="QuestionID" id="QuestionID" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-23">Quiz</label>
                        <div class="col-sm-9">
                          <select class="custom-select custom-select-sm" id="QuizID" onchange="showSec(this.value)">
                            <option value="" selected="">Select Quiz</option> 
                            @foreach ($quiz as $quizes)
                                <option value="{{ $quizes->QuizID }}">{{ $quizes->QuizName }}</option> 
                            @endforeach                           
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-23">Section<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <select class="custom-select custom-select-sm" id="QsecID">
                            <option value="" selected="">Select Quiz first</option> 
                            @foreach ($quiz_section as $sec)
                            <option value="{{ $sec->QsecID }}">{{ $sec->SectionName }}</option> 
                            @endforeach                         
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1"> Question <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input name="Question" id="Question" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1"> Marks <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input name="Marks" id="Marks" class="form-control" type="number" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1"> Duration <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input name="Duration" id="Duration" class="form-control" type="number" min="0">
                            <p style="color:red">* in seconds</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1"> Option <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                            <input name="Option" id="Option" class="form-control" type="text">
                        </div>
                        <div class="col-md-2 form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="Status" id="Status" value="1">Correct 
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align:center">
                        <button type="button" id="btnAdd" class="btn btn-success btn-xs">Add to List</button>
                        <button type="button" id="btnCancel" onclick="ClearAll()" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <div class="col-md-7">
                    <table id="tblQuestionDetails" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th hidden>#</th>
                                <th>Option</th>
                                <th hidden>status</th>
                                <th>Right / Wrong</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div style="text-align:center">
                        <button type="button" id="btnSave" class="btn btn-success btn-xs">Save</button>
                        <button type="button" id="btnCancelListData" onclick="ClearListData()" class="btn btn-danger btn-xs">Cancel All</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="tblQuestionInfo" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Quiz Name</th>
                                <th>Section Name</th>
                                <th>Question</th>
                                <th>Marks</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>                
            </div>
        </form>
   </div>
</div>
<script src="backend/assets/create_question.js"></script>
<script>
    $(function() {
       quizSec = {!! $quiz_section !!};
     })
    function showSec(QuizID){
       $('#QsecID').html('<option value="">Select Section</option>')
       if(quizSec != undefined){
        quizSec.forEach(quizSecs => {
            if(quizSecs.QuizID == QuizID)
                $('#QsecID').append(`<option value="${quizSecs.QsecID}">${quizSecs.SectionName}</option>`);
            });
        }
    }
</script>
@endsection