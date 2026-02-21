$(document).ready(function() {
/*---------insert address  start-----------------*/
//        $('#btn_save').on('submit',function(e){
//	$("#btn_save").submit(function() {
//				e.preventDefault();
		
    $(document).on("submit","#officestaffsalary_form",function(e){
			e.preventDefault();
			
			var startdate1 = $('#startdate').val();
			var fdateAr = startdate1.split('/');
			var startdate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();

            var enddate1 = $('#enddate').val();
			var fdateAr = enddate1.split('/');
			var enddate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();
			
            var empname1 = $('#empname').val();
            var salary1 = $('#salary').val();
            var standardbonus1 = $('#standardbonus').val();  
            var additionalbonus1 = $('#additionalbonus').val();
            var save_update1 = $('#save_update').val(); 
			
			$.ajax({
			
                type : "POST",
				url  : baseurl+"officestaffsalary/save_officestaffsalary",
                dataType : "JSON",
                data : {id:save_update1 ,startdate:startdate1 ,enddate:enddate1,empname:empname1, salary:salary1,standardbonus:standardbonus1,additionalbonus:additionalbonus1},
                success: function(data){
			//salert(data);
			if(data == true){
				$().toastmessage('showSuccessToast', "officestaffsalary Save Successfully");
                    $('#startdate').val("");
                    $('#enddate').val("");
                    $('#empname').val("");
                    $('#salary').val("");
                    $('#standardbonus').val("");
                    $('#additionalbonus').val("");
                    $('#save_update').val("add");
		$("#hide_show").hide();
					$("#new").show();

	show_officestafsalary();	
			}
					else if(data == 0){
				$().toastmessage('showErrorToast', "Selected Date Allready Exist , Please Select Other Date");

//				$().toastmessage('showErrorToast', "Packingwages Save Failed");
			
				}
					
                }
            });
            return false;
			
        });
/*---------insert address  end-----------------*/

/*---------view packingwages list start-----------------*/

	show_officestafsalary();	//call function show all packingwages
		
	
		function show_officestafsalary(){
		
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"officestaffsalary/show_officestaffsalary",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Sr. No.</th>  			<th>Start Date</th><th>End Date</th><th>Employee Name</th><th>Salary</th><th>Standard Bonus</th><th>Additional Bonus</th><th style="display:none;"></th>	<th><center>Action</center></th></tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
					var fromdate = data[i].from_date;

					var fdateAr = fromdate.split('-');
					var from_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();

					var todate = data[i].to_date;
					
					var tdateAr = todate.split('-');
					var to_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();

					console.log(from_date);
					console.log(to_date);
					
					
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                        '<td id="from_date'+data[i].id+'">'+from_date+'</td>'+
	                        '<td id="to_date'+data[i].id+'">'+to_date+'</td>'+
	                        '<td id="employee_name'+data[i].id+'">'+data[i].name_as_aadhaar+'</td>'+
	                        '<td id="salary'+data[i].id+'">'+data[i].salary+'</td>'+
	                        '<td id="standard_bonus'+data[i].id+'">'+data[i].standard_bonus+'</td>'+
	                        '<td id="additional_bonus'+data[i].id+'">'+data[i].additional_bonus+'</td>'+
	                        '<td id="emp_id_'+data[i].id+'" style="display:none;">'+data[i].employee_id+'</td>'+
	                        '<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_officestaffsalary').html(html);
					
					
					
  
	   var msg = "Office Staff Salary List";
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
/*---------view packingwages list end-----------------*/

/*---------get  packingwages row  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		var id1 = $(this).attr('id');
		var from_date1 = $('#from_date'+id1).html();
		var to_date1 = $('#to_date'+id1).html();
		var empname = $('#employee_name'+id1).html();
		var emp_id = $('#emp_id_'+id1).html();
		var salary = $('#salary'+id1).html();
		var standard = $('#standard_bonus'+id1).html();
		var additional = $('#additional_bonus'+id1).html();
//alert(empname);
            $('#startdate').val(from_date1);
            $('#enddate').val(to_date1);
			
			var html = '<option selected value="'+emp_id+'" >'+empname+'</option>';
			$('#empname').html(html);
//            $('#empname').val(empname);
            $('#salary').val(salary);
            $('#standardbonus').val(standard);
            $('#additionalbonus').val(additional);
			
					$('#save_update').val(id1);
	$("#hide_show").show();
        });
	
/*---------get  packingwages row  end-----------------*/



/*---------delete    packingwages row  start-----------------*/

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
				url  : baseurl+"officestaffsalary/delete_officestaffsalary",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "officestaffsalary Delete Successfully");
				

	show_officestafsalary();	
					
					}
					else{
					$().toastmessage('showErrorToast', "officestaffsalary Delete Failed");
					}
	
                }
            });
            return false;
            });

		
	});
	
/*---------delete    packingwages row  end-----------------*/

/*---------view employee list start-----------------*/
					show_employee_list();	//call function show all address
		function show_employee_list(){
		
				$.ajax({
		        type  : 'ajax',
				url  : baseurl+"employee/get_employee_name",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select employee</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
					if(data[i].employee_type=='OFFICE STAFF')
					{
						html += '<option value="'+data[i].emp_id+'" >'+data[i].name_as_aadhaar+'</option>';
		            }
		            $('#empname').html(html);					
				}
				}
					
				});
		}
/*---------view employee list end-----------------*/

/*---------view employee list start-----------------*/
  	$(document).on('focusout','#startdate,#enddate',function(){
			var startdate1 = $('#startdate').val();
			var fdateAr = startdate1.split('/');
			var startdate = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();

            var enddate1 = $('#enddate').val();
			var fdateAr = enddate1.split('/');
			var enddate = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();
			var update = $('#save_update').val();
			if(update==""){
				$.ajax({
					type  : 'post',
					url  : baseurl+"employee/get_employee_name_from_date",
					data : {startdate:startdate,enddate:enddate},
					dataType : 'json',
					success : function(data){
						var html = '';
						var i;
							html += '<option value="" >Select employee</option>';
							
						for(i=0; i<data.length; i++){
						var sr = i+1;
						
							var data1 = data[i].split('####');
	
							html += '<option value="'+data1[0]+'" >'+data1[1]+'</option>';
	
					}
					$('#empname').html(html);
					}
						
					});
				}
				});
/*---------view employee list end-----------------*/



	
});