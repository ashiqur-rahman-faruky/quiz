@extends('backendlayout.index')
@section('title')
<title>Quiz Creation</title>
@endsection
@section('content') 
<div class="layout-content-body">
   <div class="title-bar">
      <h1 class="title-bar-title">
         <span class="d-ib">Quiz Creation</span>
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
                            <input name="QuizID" id="QuizID" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Quiz Name <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input name="QuizName" id="QuizName" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Duration <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" name="Duration" id="Duration" type="number" min="0">
                            <p style="color:red">* In Minutes</p>
                        </div>
                    </div>
                    <div class="form-group" style="text-align:center">
                        <button type="button" id="btnSave" class="btn btn-success btn-xs">Save</button>
                        <button type="button" id="btnCancel" onclick="ClearAll()" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-12">
                    <div class="col-md-1"></div>
                    <div class="col-md-9">
                        <table id="tblQuiz" class="table table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Quiz Name</th>
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
            </div>
        </form>
   </div>
</div>
<script src="backend/assets/create_quiz.js"></script>
@endsection