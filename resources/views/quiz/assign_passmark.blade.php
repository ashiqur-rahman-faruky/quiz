@extends('backendlayout.index')
@section('title')
<title>Assign Pass Marks</title>
@endsection
@section('content') 
<div class="layout-content-body">
   <div class="title-bar">
      <h1 class="title-bar-title">
         <span class="d-ib">Assign Pass Marks</span>
      </h1>
   </div>
   <hr style="position: relative;top: -15px;border: none;height: 2px;background: black; margin-bottom: 1px; ">
   <div class="demo-form-wrapper">
        <form class="form form-horizontal">
            @csrf
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group" hidden>
                        <input name="PassID" id="PassID" class="form-control" type="text">
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
                        <label class="col-sm-3 control-label" for="form-control-1"> Total Marks <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input style="cursor: " name="Marks" id="TotalMarks" class="form-control" type="number" min="0" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1"> Pass Marks <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input name="Duration" id="PassMarks" class="form-control" type="number" min="0">
                        </div>
                    </div>
                    <div class="form-group" style="text-align:center">
                        <button type="button" id="btnSave" class="btn btn-success btn-xs">Save</button>
                        <button type="button" id="btnCancel" onclick="ClearAll()" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="tblInfo" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Quiz Name</th>
                                <th>Section Name</th>
                                <th>Total Marks</th>
                                <th>Pass Marks</th>
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
<script src="backend/assets/pass_marks.js"></script>
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