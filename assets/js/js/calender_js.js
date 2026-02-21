$(document).ready(function(){
			$("#date_calender").show();
			$("#year_calander").hide();


/*--------hide and show week days onchange of holidya type- weekly----------*/
		$(document).on('change','#holidaytype',function(){

		var holidaytype1 = $('#holidaytype').val();
		
		if(holidaytype1 == "WEEKLY"){
			$("#year_calender").show();
			$("#date_calender").hide();
			$("#weekdays").removeAttr('disabled'); 
			$("#years").removeAttr('disabled'); 
			$("#holiday_date").attr('disabled','disabled');
		}
		else{
			$("#date_calender").show();
			$("#year_calender").hide();
			$("#weekdays").attr('disabled','disabled');
			$("#years").attr('disabled','disabled');
			$("#holiday_date").removeAttr('disabled'); 
		}
		
		});		

		

/*---------insert calender  start-----------------*/
		    $(document).on("submit","#calender_form",function(e){
			e.preventDefault();
			var holidaytype1 = $('#holidaytype').val();
            var holiday_date1 = "";				
            var weekdays1 = "";
            var years1 = "";			
			if(holidaytype1=="WEEKLY")
			{
            var weekdays1 = $('#weekdays').val();
            var years1 = $('#years').val();			
			}
			else{
            var holiday_date1 = $('#holiday_date').val();	
					var fdateAr = holiday_date1.split('/');
					var holiday_date1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();			
			}
            var remark1 = $('#remark').val();  
            var save_update1 = $('#save_update').val(); 
			$.ajax({			
                type : "POST",
				url  : baseurl+"calendercontroller/save_calender",
                dataType : "JSON",
                data : {id:save_update1 ,holidaytype:holidaytype1 ,weekdays:weekdays1,holiday_date:holiday_date1, years:years1,remark:remark1},
                success: function(data){
			if(data == true){
				$().toastmessage('showSuccessToast', "Calender Save Successfully");
                    $('#holidaytype').val("");
                    $('#weekdays').val("");
                    $('#holiday_date').val("");
                    $('#years').val("");
                    $('#remark').val("");
                    $('#save_update').val("add");
		$("#hide_show").hide();
					$("#new").show();

	show_calender();	
			}
					else{
				$().toastmessage('showSuccessToast', "Calender Save Failed");

					}
					
                }
            });
            return false;
			
        });
/*---------insert calender  end-----------------*/


/*---------view calender list start-----------------*/

	show_calender();	//call function show all calender
		
	
		function show_calender(){
		
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"calendercontroller/show_calender",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Sr. No.</th>  			<th>Date</th><th>Year</th><th>Type</th><th>Week Day</th><th>Remark</th>	<th><center>Action</center></th></tr></thead><tbody id="">';
		            var i;
  	            for(i=0; i<data.length; i++){

			var sr = i+1;
			var type = data[i].holiday_type;
			
			if(type == "WEEKLY"){
				var date = "-";
				var year = data[i].year;
				var week = data[i].week_day;
			}
			else{
			var date = 	data[i].holiday_date;
			var tdateAr = date.split('-');
			var date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
			console.log(date);
			var year = "-";
			var week = "-";
				}
		  		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
	                        '<td id="holiday_date'+data[i].id+'">'+date+'</td>'+
	                        '<td id="year'+data[i].id+'">'+data[i].year+'</td>'+
	                        '<td id="holiday_type'+data[i].id+'">'+data[i].holiday_type+'</td>'+
	                        '<td id="week_day'+data[i].id+'">'+week+'</td>'+
	                        '<td id="remark'+data[i].id+'">'+data[i].remark+'</td>'+
		                        '<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';

	            }
	                html += '</tbody></table>';
		            $('#show_calender').html(html);
					
					
	
	   var msg = "Calender";
    $('#example1').dataTable({
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
/*---------view calender list end-----------------*/
	
/*---------get  calender row  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		var id1 = $(this).attr('id');
		var holiday_date = $('#holiday_date'+id1).html();
		var year = $('#year'+id1).html();
		var type = $('#holiday_type'+id1).html();
		var weekday = $('#week_day'+id1).html();
		var remark = $('#remark'+id1).html();

		$('#holidaytype').val(type);
		if(type == "WEEKLY")
		{
			$("#year_calender").show();
			$("#date_calender").hide();
			$("#weekdays").removeAttr('disabled'); 
			$("#years").removeAttr('disabled'); 
			$("#holiday_date").attr('disabled','disabled');

	
	
	
	
            $('#weekdays').val(weekday);
            $('#years').val(year);					
		}
		else{
			$("#date_calender").show();
			$("#year_calender").hide();
			$("#weekdays").attr('disabled','disabled');
			$("#years").attr('disabled','disabled');
			$("#holiday_date").removeAttr('disabled'); 

		
		
		
		
            $('#holiday_date').val(holiday_date);				
			}
            $('#remark').val(remark);				
	
					$('#save_update').val(id1);
	$("#hide_show").show();
        });
	
/*---------get  calender row  end-----------------*/

/*---------delete    calender row  start-----------------*/

  	$(document).on('click','.delete_row',function(){
		var id1 = $(this).attr('id');
		
		

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


		
//		 $('#myModal').show();
				$.ajax({
                type : "POST",
				url  : baseurl+"calendercontroller/delete_calender",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "officestaffsalary Delete Successfully");
				

	show_calender();	
					
					}
					else{
					$().toastmessage('showErrorToast', "officestaffsalary Delete Failed");
					}
	
                }
            });
            return false;

		});
	});
	
/*---------delete    calender row  end-----------------*/


	
});