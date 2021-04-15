var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function LoadData(rowId) {
    // alert(rowId);
    $.ajax({
        url: '/Question/GetData/' + rowId,
        type: 'GET',
        success: function(data) {
            //alert(data[0].ID);
            $('#tblQuestionDetails tbody').html('');
            $('#QsecID').val(data[0].QsecID);
            $('#QuizID').val(data[0].QuizID);
            $('#Question').val(data[0].Question);
            $('#Marks').val(data[0].Marks);
            $('#Duration').val(data[0].Duration);
            $('#QuestionID').val(data[0].QuestionID);
            data.forEach(object=>{
                $('#tblQuestionDetails tbody').append("<tr><td align='center' hidden>#</td><td align='center' hidden>"+ object.OptionID +"</td><td align='center' contenteditable='true'>" + object.OptionName + "</td><td align='center' class='Status' hidden>" + object.opStatus + "</td><td align='center' contenteditable='true'>" + (object.opStatus==1? 'Right': 'Wrong') + "</td></tr>");
                
            });            
        $("#btnSave").text('Update');
        }
    });
}

//Clear Data Method....
function ClearAll() {
    $('#QuestionID').val('');
    $('#QsecID').val('');
    $('#QuizID').val('');
    $('#Question').val('');
    $('#Marks').val('');
    $('#Duration').val('');
    $('#Option').val('');
    $("#btnSave").text('Save');
}

//List cancel...
$('#btnCancelListData').click(function(){
    $('#QuestionID').val('');
    $('#QsecID').val('');
    $('#QuizID').val('');
    $('#Question').val('');
    $('#Marks').val('');
    $('#Duration').val('');
    $('#Option').val('');
    $('#tblQuestionDetails tbody').html('');
    $("#btnSave").text('Save');
})
    
//Validation
function fnValidation() {
    if ($('#QsecID').val() == '') {
        alert('Please Select Section');
        $('#QsecID').focus();
        return false;
    } else if ($('#Question').val() == '') {
        alert('Please Enter Question');
        $('#Question').focus();
        return false;
    }else if ($('#Marks').val() == '') {
        alert('Please Enter Marks');
        $('#Marks').focus();
        return false;
    }else if ($('#Duration').val() == '') {
        alert('Please Enter Duration');
        $('#Duration').focus();
        return false;
    }else if ($('#Option').val() == '') {
        alert('Please Enter Option');
        $('#Option').focus();
        return false;
    }

    return true;
}

function fnValidation2() {
    if ($('#QsecID').val() == '') {
        alert('Please Select Section');
        $('#QsecID').focus();
        return false;
    } else if ($('#Question').val() == '') {
        alert('Please Enter Question');
        $('#Question').focus();
        return false;
    }else if ($('#Marks').val() == '') {
        alert('Please Enter Marks');
        $('#Marks').focus();
        return false;
    }else if ($('#Duration').val() == '') {
        alert('Please Enter Duration');
        $('#Duration').focus();
        return false;
    }

    return true;
}

//Add question option to the list...
$('#btnAdd').click(function() {
if(fnValidation() == true){
    var Option = $('#Option').val();
    var Status = $('[name="Status"]:checked').val();

    $('#tblQuestionDetails tbody').append("<tr><td align='center' hidden>#</td><td align='center'  contenteditable='true'>" + Option + "</td><td align='center' hidden>" + Status + "</td><td align='center'   contenteditable='true'>" + (Status==1? 'Right': 'Wrong') + "</td></tr>");
    $('#Option').val('');
    $('#Status').attr('Checked', false);
}
});

$(document).ready(function() {
    //load All Data
    GetData();    

    // Save Data
    $('#btnSave').click(function() {
        if (fnValidation2() == true) {
            if ($('#btnSave').text() == 'Save') {
                $.ajax({
                    url: '/Question/SaveData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QsecID: $('#QsecID').val(),
                        Question: $('#Question').val(),
                        Marks: $('#Marks').val(),
                        Duration: $('#Duration').val(),
                    },
                    success: function(response) {
                        if (response > 0) {                          
                            var Option,Status;
                            QuestionID = response;
                            $('#tblQuestionDetails tbody tr').each(function(){
                                i=0;
                                $(this).find('td:gt(0)').each(function(){
                                    i++;
                                    if(i == 1){
                                        Option = $(this).html();
                                    }else if(i == 3){
                                        Status = $(this).html();
                                    }
                                });
                                $.ajax({
                                    url:'/Option/SaveData',
                                    type: 'post',
                                    data:{
                                        _token : CSRF_TOKEN,
                                        QuestionID: QuestionID,
                                        OptionName : Option,
                                        Status : Status,
                                    },
                                    success: function(response)
                                    {
                                        if(response>0){
                                        }
                                        else{
                                            alert("Oops! Something went wrong.");
                                        }
                                    }
                                });
                            });

                        } else {
                            alert("Oops! Something went wrong.");
                        }
                    },
                    complete: function(response) {
                        if(response){
                            alert("Data Save Successfully.");
                        ClearAll();
                        $('#tblQuestionDetails tbody').html('');
                        }
                    }
                });

            } else if ($('#btnSave').text() == 'Update') {                
                //alert("Update");
                $.ajax({
                    url: '/Question/UpdateData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QuestionID: $('#QuestionID').val(),
                        QsecID: $('#QsecID').val(),
                        Question: $('#Question').val(),
                        Marks: $('#Marks').val(),
                        Duration: $('#Duration').val(),
                    },
                    success: function(response) {
                        if(response) {                            
                            $('#tblQuestionDetails tbody tr').each(function(){
                                i=0;
                                $(this).find('td:gt(0)').each(function(){
                                    i++;
                                    if(i == 1){
                                        OptionID = $(this).html();
                                    }else if(i == 2){
                                        OptionName = $(this).html();
                                    }else if(i == 4){
                                        Status = $(this).html();
                                    }
                                });
                                $.ajax({
                                    url:'/Option/UpdateData',
                                    type: 'post',
                                    data:{
                                        _token : CSRF_TOKEN,
                                        OptionID:OptionID,
                                        QuestionID: $('#QuestionID').val(),
                                        OptionName : OptionName,
                                        Status : Status,
                                    },
                                    success: function(response)
                                    {
                                        if(response>0){
                                        }
                                        else{
                                            alert("Oops! Something went wrong.");
                                        }
                                    }
                                });
                            });
                        } else {
                            alert(response);
                        }
                    },
                    complete: function(response) {
                        if(response){
                            alert("Data Update Successfully.");
                        ClearAll();
                        $('#tblQuestionDetails tbody').html('');
                        }
                    }
                });
            }
        }
        GetData();
    });   
    
    function GetData(){
        $.ajax({
            url: '/Question/GetData/0',
            type: 'get',
            success: function(response) {
                if (response) {
                    var k = 0;
                    $('#tblQuestionInfo tbody').html('');
                    response.forEach(object=>{
                        k++;
                        if(object.Status == 0){
                            $('#tblQuestionInfo tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.SectionName + "</td><td align='center'>" + object.Question + "</td><td align='center'>" + object.Marks + "</td><td align='center'>" + object.Duration + "</td><td align='center'><a class='btn btn-xs btn-warning' href='Question/publish/1/"+ object.QuestionID +"'>Pending</a></td><td align='center'><button type='button' class='btn btn-xs btn-info' onclick='LoadData("+ object.QuestionID +")'>Edit</button></td></tr>");
                        }else if(object.Status == 1){
                            $('#tblQuestionInfo tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.SectionName + "</td><td align='center'>" + object.Question + "</td><td align='center'>" + object.Marks + "</td><td align='center'>" + object.Duration + "</td><td align='center'><a class='btn btn-xs btn-success' href='Question/publish/0/"+ object.QuestionID +"'>Published</a></td><td align='center'><button type='button' class='btn btn-xs btn-danger' disabled>Edit</button></td></tr>");
                        }
                        
                    });                    
                } 
            }
        });
    } 
});

