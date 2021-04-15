var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function LoadData(rowId) {
    // alert(rowId);
    $("#btnSave").text('Update');
    $.ajax({
        url: '/Section/GetData/' + rowId,
        type: 'GET',
        success: function(data) {
            //alert(data[0].ID);
            $('#QsecID').val(data[0].QsecID);
            $('#QuizID').val(data[0].QuizID);
            $('#SectionName').val(data[0].SectionName);
        }
    });
}

//Clear Data Method....
function ClearAll() {
    $('#QuizID').val('');
    $('#SectionName').val('');
    $("#btnSave").text('Save');
}


$(document).ready(function() {
    //load All Data
    GetData();
    //Validation
    function fnValidation() {
        if ($('#QuizID').val() == '') {
            alert('Please Select Quiz');
            $('#QuizID').focus();
            return false;
        } else
        if ($('#SectionName').val() == '') {
            alert('Please Enter Section');
            $('#SectionName').focus();
            return false;
        }

        return true;
    }

    // Save Data
    $('#btnSave').click(function() {
        if (fnValidation() == true) {
            if ($('#btnSave').text() == 'Save') {
                $.ajax({
                    url: '/Section/SaveData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QuizID: $('#QuizID').val(),
                        SectionName: $('#SectionName').val()
                    },
                    success: function(response) {
                        if (response > 0) {
                            alert('Data save successfully');
                            ClearAll();
                        } else {
                            alert(response);
                        }
                    }
                });

            } else if ($('#btnSave').text() == 'Update') {
                //alert("Update");
                $.ajax({
                    url: '/Section/UpdateData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QsecID: $('#QsecID').val(),
                        QuizID: $('#QuizID').val(),
                        SectionName: $('#SectionName').val()
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
            url: '/Section/GetData/0',
            type: 'get',
            success: function(response) {
                if (response) {
                    var k = 0;
                    $('#tblQuiz tbody').html('');
                    response.forEach(object=>{
                        k++;
                        if(object.Status == 0){
                            $('#tblQuiz tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.SectionName + "</td><td align='center'><a class='btn btn-xs btn-warning' href='Section/publish/1/"+ object.QsecID +"'>Pending</a></td><td align='center'><button type='button' class='btn btn-xs btn-info' onclick='LoadData("+ object.QsecID +")'>Edit</button></td></tr>");
                        }else if(object.Status == 1){
                            $('#tblQuiz tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.SectionName + "</td><td align='center'><a class='btn btn-xs btn-success' href='Section/publish/0/"+ object.QsecID +"'>Published</a></td><td align='center'><button type='button' class='btn btn-xs btn-danger' disabled>Edit</button></td></tr>");
                        }
                        
                    });                    
                } 
            }
        });
    } 

});

