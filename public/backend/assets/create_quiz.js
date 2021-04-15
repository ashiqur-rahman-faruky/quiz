var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function LoadData(rowId) {
    // alert(rowId);
    $("#btnSave").text('Update');
    $.ajax({
        url: '/quiz/GetData/' + rowId,
        type: 'GET',
        success: function(data) {
            //alert(data[0].ID);
            $('#QuizID').val(data.QuizID);
            $('#QuizName').val(data.QuizName);
            $('#Duration').val(data.Duration);
        }
    });
}

//Clear Data Method....
function ClearAll() {
    $('#QuizID').val('');
    $('#QuizName').val('');
    $('#Duration').val('');
    $("#btnSave").text('Save');
}


$(document).ready(function() {
    //load All Data
    GetData();
    //Validation
    function fnValidation() {
        if ($('#QuizName').val() == '') {
            alert('Please Enter Quiz Name');
            $('#QuizName').focus();
            return false;
        } else
        if ($('#Duration').val() == '') {
            alert('Please Enter Duration');
            $('#Duration').focus();
            return false;
        }

        return true;
    }

    // Save Data
    $('#btnSave').click(function() {
        if (fnValidation() == true) {
            if ($('#btnSave').text() == 'Save') {
                $.ajax({
                    url: '/quiz/SaveData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QuizName: $('#QuizName').val(),
                        Duration: $('#Duration').val()
                    },
                    success: function(response) {
                        if (response > 0) {
                            alert('Data save successfully');
                            // window.location.reload();
                            ClearAll();
                        } else {
                            alert(response);
                        }
                    }
                });
                // location.reload();

            } else if ($('#btnSave').text() == 'Update') {
                //alert("Update");
                $.ajax({
                    url: '/quiz/UpdateData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QuizID: $('#QuizID').val(),
                        QuizName: $('#QuizName').val(),
                        Duration: $('#Duration').val()
                    },
                    success: function(response) {
                        //alert(response);
                        if (response > 0) {
                            alert('Data update successfully');
                            ClearAll();

                        } else {
                            alert(response);
                        }
                    }
                });
            }
        }
        GetData();
    });
    
    function GetData(){
        $.ajax({
            url: '/quiz/GetData/0',
            type: 'get',
            success: function(response) {
                if (response) {
                    var k = 0;
                    $('#tblQuiz tbody').html('');
                    response.forEach(object=>{
                        k++;
                        if(object.Status == 0){
                            $('#tblQuiz tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.Duration + "</td><td align='center'><a class='btn btn-xs btn-warning' href='quiz/publish/1/"+ object.QuizID +"'>Pending</a></td><td align='center'><button type='button' class='btn btn-xs btn-info' onclick='LoadData("+ object.QuizID +")'>Edit</button></td></tr>");
                        }else if(object.Status == 1){
                            $('#tblQuiz tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.Duration + "</td><td align='center'><a class='btn btn-xs btn-success' href='quiz/publish/0/"+ object.QuizID +"'>Published</a></td><td align='center'><button type='button' class='btn btn-xs btn-danger' disabled>Edit</button></td></tr>");
                        }
                        
                    });                    
                } 
            }
        });
    } 

});

