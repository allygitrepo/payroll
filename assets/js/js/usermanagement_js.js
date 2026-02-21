$(document).ready(function() {
	


/*---------view address list start-----------------*/

	show_user();	//call function show all product
		
	
		//function show all product
		function show_user(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"usermanagement/view_usermanagement",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0"  ><thead><tr><th>Sr. No.</th><th>User Name</th><th>User Id</th><th>Password</th><th>Designation</th><!--<th>Dsc Expire date</th>--><th><center>Action</center></th></tr></thead><tbody>';
		            var i;
		            for(i=0; i<data.length; i++){
						
	//		var date11 = 	data[i].dscdate;
	//		var tdateAr = date11.split('-');
	//		var dscdate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();

			var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                        '<td id="user_name'+data[i].id+'">'+data[i].user_name+'</td>'+
	                        '<td id="user_id'+data[i].id+'">'+data[i].user_id+'</td>'+
	                        '<td id="password'+data[i].id+'">'+data[i].password+'</td>'+
	                        '<td id="designation'+data[i].id+'">'+data[i].designation+'</td>'+
//	                        '<td id="dscdate'+data[i].id+'">'+dscdate+'</td>'+
									'<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }

					
					html += '</tbody></table>';	
		            $('#show_user_list').html(html);
					
					
					
  
	   var msg = "User's List";
      
    $('#example1').dataTable({
		'bDestroy': true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
 //       'responsive': true, // https://datatables.net/extensions/responsive/examples/
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns:',
            sLengthMenu:  '_MENU_ records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        },
        // Datatable Buttons setup
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'excel', className: 'btn-sm', title: msg },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ]
    });
					
		        }

		    });
		}
/*---------view address list end-----------------*/

/*---------insert address  start-----------------*/
//        $('#btn_save').on('submit',function(e){
//	$("#btn_save").submit(function() {
//				e.preventDefault();
		
    $(document).on("submit","#usermanagement_form",function(e){
			e.preventDefault();
			var save_update1 = $('#save_update').val();
            var username = $('#username').val();
            var userid = $('#userid').val();
            var password = $('#password').val();
            var designation = $('#designation').val();  
  var j =0;
  var arr = [];
  
       $('.access:checked').each(function () {
           arr[j++] = $(this).val();
       });
			
//	   console.log(arr);
			var access = arr;
			
			var i=0;
			var dashboard = "";
			var master = "";
			var setup = "";
			var entry = "";
			var report = "";
			var utility = "";
			var todolist = "";
			var convert = "";
			

			
			for(i=0;i<access.length;i++){
				
				var dscdata = access[i]; 
				var right  = dscdata.split('_');

				if(right[0]=="d"){	dashboard += access[i]+',';	}
				if(right[0]=="m"){	master += access[i]+',';	}
				if(right[0]=="s"){	setup += access[i]+',';		}
				if(right[0]=="e"){	entry += access[i]+',';		}
				if(right[0]=="r"){	report += access[i]+',';	}
				if(right[0]=="u"){	utility += access[i]+',';	}
				if(right[0]=="t"){	todolist += access[i]+',';	}
				if(right[0]=="c"){	convert += access[i]+',';	}
				
			}
			
//			alert(dashboard)

			
//            var dscdate = $('#dscdate').val();  
			
//			var tdateAr = dscdate.split('/');
//			var dscdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
			$.ajax({
                type : "POST",
				url  : baseurl+"usermanagement/save_usermanagement",
//                dataType : "JSON",
           data : {convert:convert,todolist:todolist,utility:utility,report:report,entry:entry,setup:setup,master:master,dashboard:dashboard,id:save_update1 ,username:username , userid:userid, password:password,designation:designation},
                success: function(data){
					if(data == false){
				$().toastmessage('showErrorToast', "User Data Save Failed");
						}
				else{
					
				$().toastmessage('showSuccessToast', "User Data Save Successfully");
                    $('#username').val("");
                    $('#userid').val("");
                    $('#password').val("");
                    $('#designation').val("");
//                    $('#dscdate').val("");
                    $('#save_update').val("add");
					$(".access").prop('checked',true); 
						show_user();
							$("#hide_show").hide();
	$("#new").show();
				}
					
					
                }
            });
            return false;
	
        });
/*---------insert address  end-----------------*/


/*---------get  address  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		
		$(".access").prop('checked',false); 

		var id1 = $(this).attr('id');
		var user_name = $('#user_name'+id1).html();
		var user_id = $('#user_id'+id1).html();
		var password = $('#password'+id1).html();
		var designation = $('#designation'+id1).html();
//		var dscdate = $('#dscdate'+id1).html();

//		var tdateAr = dscdate.split('-');
//			var dscdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
//			console.log(dscdate);
            $('#username').val(user_name);
            $('#userid').val(user_id);
            $('#password').val(password);
            $('#designation').val(designation);
 //           $('#dscdate').val(dscdate);
 					$("#hide_show").show();
					$('#save_update').val(id1);
	$("#new").hide();

 
 
 			$.ajax({
                type : "POST",
				url  : baseurl+"usermanagement/edit_usermanagement",
//                dataType : "JSON",
           data : {user_id:id1},
                success: function(data){
				var i=0;
						data1 = JSON.parse(data);
					for(i=0;i<data1.length;i++)
					{
						var access = data1[i].access;	
						var rights = access.split(',');
						var count = (rights.length)-1;
						var j=0;
						for(j=0;j<count;j++){
							
							$("#"+rights[j]).prop('checked',true); 

							
						}			
								
					}
					
                }
            });
            return false;

 
 
 
 
 

        });
	
/*---------get  address  start-----------------*/
		$(document).on('click','#close',function(){
		$(".access").prop('checked',true); 
                    $('#username').val("");
                    $('#userid').val("");
                    $('#password').val("");
                    $('#designation').val("");
//                    $('#dscdate').val("");
                    $('#save_update').val("add");
					$(".access").prop('checked',true); 

		});


/*---------delete    calender row  start-----------------*/

  	$(document).on('click','.delete_row',function(){
		var id1 = $(this).attr('id');
//		 $('#myModal').show();



		      swal({
        title : "Are you sure?",
        text : "You will not be able to recover this  Data!",
        type : "warning",
        showCancelButton : true,
        confirmButtonColor : "#DD6B55",
        confirmButtonText : "Yes, delete it!",
        closeOnConfirm : true
      },
        function () {



				$.ajax({
                type : "POST",
				url  : baseurl+"usermanagement/delete_usermanagement",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "User Data Delete Successfully");
				

	show_user();	
					
					}
					else{
					$().toastmessage('showErrorToast', "User Data Delete Failed");

					}
	
                }
            });
            return false;
		});
		
	});
	
/*---------delete    calender row  end-----------------*/


	
});