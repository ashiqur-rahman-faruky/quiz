var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function LoadData(rowId) {
    // alert(rowId);
    $("#btnSave").text('Update');
    $.ajax({
        url: '/passmarks/GetData/' + rowId,
        type: 'GET',
        success: function(data) {
            $('#PassID').val(data[0].PassID);
            $('#QuizID').val(data[0].QuizID);
            $('#QsecID').val(data[0].QsecID);
            $('#TotalMarks').val(data[0].TotalMarks);
            $('#PassMarks').val(data[0].PassMarks);
        }
    });
}

//Clear Data Method....
function ClearAll() {
    $('#QuizID').val('');
    $('#QsecID').val('');
    $('#TotalMarks').val('');
    $('#PassMarks').val('');
    $("#btnSave").text('Save');
}


$(document).ready(function() {
    //load All Data
    GetData();
    //Validation
    function fnValidation() {
        if ($('#QsecID').val() == '') {
            alert('Please select section');
            $('#QsecID').focus();
            return false;
        } else if ($('#PassMarks').val() == '') {
            alert('Please Enter pass Marks');
            $('#Duration').focus();
            return false;
        }else if($('#PassMarks').val() > $('#TotalMarks').val()){
            $('#PassMarks').val('');
            alert("Pass marks can't greater than Total Marks.");
            return false;
        }

        return true;
    }

    // Save Data
    $('#btnSave').click(function() {
        if (fnValidation() == true) {
            if ($('#btnSave').text() == 'Save') {
                $.ajax({
                    url: '/pass_marks/SaveData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        QsecID: $('#QsecID').val(),
                        TotalMarks: $('#TotalMarks').val(),
                        PassMarks: $('#PassMarks').val()
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
                    url: '/pass_marks/UpdateData',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        PassID: $('#PassID').val(),
                        QsecID: $('#QsecID').val(),
                        TotalMarks: $('#TotalMarks').val(),
                        PassMarks: $('#PassMarks').val()
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
            url: '/passmarks/GetData/0',
            type: 'get',
            success: function(response) {
                if (response) {
                    var k = 0;
                    $('#tblInfo tbody').html('');
                    response.forEach(object=>{
                        k++;
                        $('#tblInfo tbody').append("<tr><td align='center'>" + k + "</td><td align='center'>" + object.QuizName + "</td><td align='center'>" + object.SectionName + "</td><td align='center'>" + object.TotalMarks + "</td><td align='center'>" + object.PassMarks + "</td><td align='center'><button type='button' class='btn btn-xs btn-info' onclick='LoadData("+ object.PassID +")'>Edit</button></td></tr>");
                    });                    
                } 
            }
        });
    } 

    $('#QsecID').change(function(){
       QsecID = $(this).val();
       $.ajax({
            url: '/Get/TotalMarks/' + QsecID,
            type: 'get',
            success: function(response) {
                // alert(response[0].TotalMarks);
                $('#TotalMarks').val(response[0].TotalMarks);
            }
        });
    });

});

