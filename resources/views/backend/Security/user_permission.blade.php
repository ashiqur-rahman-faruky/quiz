@extends('backendlayout.index')
@section('title')
    <title>User Permission</title>
@endsection
@section('content') 
    <div class="layout-content-body">
        <div class="title-bar">
            <h1 class="title-bar-title">
                <span class="d-ib">User Permission</span>
            </h1>
        </div><hr style="position: relative;top: -15px;border: none;height: 2px;background: black; margin-bottom: 1px; ">
        <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
            <div class="demo-form-wrapper">
            <form class="form form-horizontal">
                <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-6">Select User</label>
                <div class="col-sm-9">
                    <select name="userID" id="userID" class="form-control" onchange="showMenu()">
                    <option value="">Select user name</option>
                    @foreach($user as $users)
                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-6">Select Menus</label>
                <div class="col-sm-9">
                    <select name="menuID" id="menuID" class="form-control" onchange="showSub()">
                    <option value="">Select menu</option>
                    @foreach($menu as $menuss)
                        <option value="{{ $menuss->id }}">{{ $menuss->title }}</option>
                    @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-6">Select Submenus</label>
                <div class="col-sm-9">
                    <select name="submenuID" id="submenuID" class="form-control">
                        <option value="">Select Sub menu</option>
                    </select>
                </div>
                </div>
                <div class="col-md-4"></div>
                <button class="col-md-3 btn btn-primary" id="addtolist" type="button"><spam><i class="fa fa-plus" aria-hidden="true"></i></spam> Add To List</button>
                <div class="col-md-1"></div>
                <button class="col-md-3 btn btn-danger" type="button"><spam><i class="fa fa-times" aria-hidden="true"></i></spam>&nbsp; Cancel</button>
            </form>
            </div>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                    <div class="card-header">
                        <div class="card-actions">
                        <button type="button" class="card-action card-toggler" title="Collapse"></button>
                        <button type="button" class="card-action card-reload" title="Reload"></button>
                        <button type="button" class="card-action card-remove" title="Remove"></button>
                        </div>
                        <strong>User Permission Table</strong>
                    </div>
                        <table id="tblDetails" class="data-table table table-bordered">
                            <thead>
                            <tr class="bg-success">
                                <th>Menu Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-5"></div>
                <div class="offset-md-5">
                    <button class=" col-md-1 btn btn-success" type="button" id="SaveData"  class="btn btn-info"><span><i class="fa fa-floppy-o" aria-hidden="true"></i></span>&nbsp; Save</button>
            </div>
        </div>
    </div>

  <script>
  	var menu,vwuserpermissions;
      $(function (){
        submenu = {!! $submenu !!};
      })

      $(function (){
        vwuserpermissions = {!! $vwuserpermission !!};
      })
  	function showSub(){  
        $('#submenuID').html(`<option value="">Select sub menu.</option>`);
        if (submenu != undefined) {
          submenu.forEach(menus =>{
            if (menus.parent_id == $('#menuID').val()) {
              $('#submenuID').append(`<option value="${menus.id}">${menus.title}</option>`);
            }
          })
        }
      }

      function showMenu(){
        var userid = $('#userID').val();
        // alert(userid);
        if(vwuserpermissions!=undefined){
         $(".data-table tbody").html('');
        //  alert(userid);
            vwuserpermissions.forEach(vwuserpermission=> {
                if(vwuserpermission.user_id == userid)
                {
                    if(vwuserpermission.parent_id == 2){
                        $("#tblDetails tbody").append("<tr class='menu' data-MenuName='" + vwuserpermission.title + "' data-MenuID='" + vwuserpermission.id + "'><td>"+  vwuserpermission.title +  "</td><td class='menuid'>"+ vwuserpermission.id +  "</td><td><button id=" + vwuserpermission.id + " class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
                    }
                    else{
                        $("#tblDetails tbody").append("<tr data-MenuName='" + vwuserpermission.title + "' data-MenuID='" + vwuserpermission.id + "'><td>"+ vwuserpermission.title +  "</td><td class='menuid'>"+ vwuserpermission.id +  "</td><td><button id=" + vwuserpermission.id + " class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
                    }
                }
            })
            $('.menuid').hide();
            $('.menu').hide();
        }
      }
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

			 function clearAll()
			 {
			 	$('#userID').val('');
			 	$('#menuID').val('');
			 	$('#submenuID').val('');
			 }


       function fnValidation()
			 {
			 	MenuID = $('#menuID').val();
				MenuName = $("#menuID :selected").text();
				//alert(MenuName)

				SubmenuID = $('#submenuID').val();
				//alert("submenu " + SubmenuID)
				SubmenuName = $("#submenuID :selected").text();
				// alert(SubmenuName)
			 	if($('#userID').val() == ""){
					alert('Select user name.');
					$('#userID').focus();
					return false;
				}
				else if(MenuID == ""){
					alert('Select menu.');
					$('#menuID').focus();
					return false;
				}
				else if(SubmenuID == ""){
					alert('Select submenu.');
					$('#submenuID').focus();
					return false;
				}
				return true; 
			 }

      $(document).ready(function(){
 	//add to list start...
 	$('#addtolist').click(function(){ 
 		if(fnValidation() ==  true){
 			var duplic=false,i=0,caught;
 			$('#tblDetails tbody tr').each(function (){
 				$(this).find("td:eq(1)").each(function(){
 					i++;
 					if (i == 1) {
 						caught = $(this).html();
 					}
 					if (MenuID == caught) {
 						duplic = true;
 					}
 				});
 				i = 0;
 			});

 			var count=0,cSubMenu = '',j=0;
 			$('#tblDetails tbody tr').each(function (){
 				$(this).find("td:eq(1)").each(function(){
 					j++;
 					if (j == 1) {
 						cSubMenu = $(this).html();
 						//alert(cSubMenu);
 					}
 					//alert("submenu id = " + SubmenuID)
 					if (SubmenuID == cSubMenu) {
 						count = count + 1;
 					}
 					//alert("total submenu " + count);
 				});
 				j = 0;
 			});
 			

 			if (duplic == false) {
 			  $(".data-table tbody").append("<tr class='menu' data-MenuName='" + MenuName +
 			   "' data-MenuID='" + MenuID + "'><td>"+ MenuName +  "</td><td>"+ MenuID +  
 			   "</td><td><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
 			}

 			if(count >=1)
 			{
 			 alert('Same Submenu can not be allowed.');
 	 		 $('#submenuID').val('');
 			 $('#submenuID').focus();
 			 return false;
 			}else{
 				 $(".data-table tbody").append("<tr data-SubmenuName='"+ 
 			     SubmenuName + "' data-SubmenuID='" + SubmenuID + "'><td>"+ 
 			     SubmenuName + "</td><td class='submenuid'>"+ SubmenuID +  
 			     "</td><td><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
 			}
 			$('.menu').hide();
 			$('.submenuid').hide();
 			$('#submenuID').val('');
 			$('#submenuID').focus();
 		}


 		 $("body").on("click", ".btn-delete", function () {
 		 	$(this).parents("tr").remove();
 		 })
 	});//add to list finished

 	//save Data start from here...
 	$('#SaveData').click(function(){
 		//var status;
 		var i = 0;
 		var MenuID = '';
 		var userID = $('#userID').val();

 		$('#tblDetails tbody tr').each(function(){
 			$(this).find('td:gt(0)').each(function(){
 				i = i + 1;
 				if(i == 1){
 					MenuID = $(this).html();
 					//alert(MenuID);
 				}
 			});
 			$.ajax({
 				url:'/user_permission/save_data',
 				type: 'post',
 				data:{
 					_token : CSRF_TOKEN,
 					userID : userID,
 					MenuID : MenuID
 				},
 				success: function(response)
 				{
 					if(response>0){
 				    	//$('#status').val(response);
 					}
 					else{
 						alert(response);
 					}
 				}
 			});
 			i = 0;
 		});


 		   var count=0,cSubMenu = '',j=0;
 			$('#tblDetails tbody tr').each(function (){
 				$(this).find("td:eq(1)").each(function(){
 					j++;
 					if (j == 1) {
 						cSubMenu = $(this).html();
 						count = count + 1;
 						//alert(cSubMenu);
 					}
 					
 				});
 				j = 0;
 			});


 			if(count<=0)
 			{
			 alert('At first add menu to the list.');
			 return false;
 			}else{
				alert('Permission given successfully.');
	            clearAll();
	            $("#tblDetails").find("tr:gt(0)").remove();
 			}

 	});
 	//savedata finished...
 })

      $("body").on("click", ".btn-delete", function (e) {
         e.preventDefault();
        var id = $(this).attr('id');
        var userid = $('#userID').val();
           if(confirm("Delete permanently,then click ok button")){
            $(this).parents("tr").remove();
            $.ajax({
                  url:'/user_permission/delete_data',
                  method: 'POST',
                  data:{
                      _token: CSRF_TOKEN,
                      id: id,
                      user_id: userid
                  },
                  success:function(response){

                      if(response>0){
                        alert('Deleted Successfully.');
                      }
                  }

              });
           }
      });


  </script>
@endsection