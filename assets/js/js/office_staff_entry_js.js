$(document).ready(function() {
	
	show_office_staff();	//call function show all packingwages
		
	
		function show_office_staff(){
	//		        $("#wait").css("display", "block");

		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"officestaffsalary/show_office_staff",
		        async : false,
		        dataType : 'json',
		        success : function(data){
				if(data=="salary"){
	
							swal("Some Employee's Salary Not Define ...!")
							           $('#table_data1').html("");
	
				}
				else{
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
				'<th style="display:none;" >Employee id</th><th>Employee Name.</th><!--<th   >UAN</th>-->'+
				'<th >No. of days worked</th>'+  			
				'<th>Leave With Pay</th>'+  			
				'<th>Leave without Pay</th>'+  			
				'<th>Addition if any</th>'+  			
				'<th>Basic Salary</th>'+  			
				'<th>Total</th>'+  			
				'<th>PF</th>'+  			
				'<th>PT</th>'+  			
				'<th>ESIC</th>'+  			
				'<th>Net Wages</th>'+
					'</tr></thead><tbody id="">';
		            var i;
					
//					alert(data.length);

					var data_1 = 0;
					var data_2 = 0;
					var data_3 = 0;
					var data_4 = 0;
					var data_5 = 0;
					var data_6 = 0;
					var data_7 = 0;
					var data_8 = 0;
					var data_9 = 0;
					var data_10 = 0;

		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
$('#month_year').val(data1[7]);					
//					$('#leave_without_pay').val(data1[4]);
//	            for(j=0;j<data1.length;j++){
//		alert(data1[13]);
		                html += '<tr>'+
								'<td style="display:none;" >'+data1[0]+'</td>'+
								'<td style="display:none;">'+data1[1]+'</td>'+
								'<td style="display:none;">'+data1[2]+'</td>'+
								'<td style="whiteSpace:nowrap;">'+data1[1]+'<br>'+data1[20]+'<br>'+data1[2]+'</td>'+
				'<td><input type="text" id="'+data1[0]+'" class="worked_days" value="'+data1[12]+'" style="width:50%;" /></td>'+
								'<td  	id="leave_with_pay'+data1[0]+'"  >'+data1[3]+'</td>'+
								'<td 	id="leave_without_pay'+data1[0]+'" >'+data1[13]+'</td>'+
				'<td><input type="text" id="addition'+data1[0]+'" class="addition" name="'+data1[0]+'" style="width:100%;" value="'+data1[14]+'" /></td>'+
								'<td style="display:none;" id="salary_id'+data1[0]+'" >'+data1[8]+'</td>'+
								'<td  id="total_salary'+data1[0]+'" >'+data1[5]+'</td>'+
								'<td id="totalmonthsalary'+data1[0]+'">'+data1[16]+'</td>'+
								'<td id="pf'+data1[0]+'" >'+data1[17]+'</td>'+
								'<td style="display:none;" id="pt_id'+data1[0]+'" >'+data1[9]+'</td>'+
								'<td style="display:none;" id="pt_rate'+data1[0]+'" >'+data1[6]+'</td>'+
								'<td id="pt'+data1[0]+'" >'+data1[18]+'</td>'+
								'<td id="esic'+data1[0]+'" >'+data1[25]+'</td>'+
								'<td id="net_wages'+data1[0]+'" >'+data1[19]+'</td>'+
								'<td  style="display:none;"  id="ac1eemf'+data1[0]+'" >'+data1[10]+'</td>'+
								'<td  style="display:none;"  id="ac10'+data1[0]+'" >'+data1[11]+'</td>'+
								'<td  style="display:none;"  id="ncp_days'+data1[0]+'" >'+data1[21]+'</td>'+
								'<td  style="display:none;"  id="leave_without_pay_'+data1[0]+'" >'+data1[4]+'</td>'+
								'<td  style="display:none;"  id="ac1eemale'+data1[0]+'" >'+data1[22]+'</td>'+
								
		                        '</tr>';
						if(parseInt(data1[23])>0){
							$('#save_update').val('update');
						}
						else{
							$('#save_update').val('add');							
						}
						if(data1[24]>0){
				$('#save_table').attr('disabled','disabled');												
						}
						else{
				$('#save_table').removeAttr('disabled');																			
						}
						data_1 =	parseInt(data_1)+parseInt(data1[12]);
						data_2 =	parseInt(data_2)+parseInt(data1[3]);
						data_3 =	parseInt(data_3)+parseInt(data1[13]);
						data_4 =	parseInt(data_4)+parseInt(data1[14]);
						data_5 =	parseInt(data_5)+parseInt(data1[5]);
						data_6 =	parseInt(data_6)+parseInt(data1[16]);
						data_7 =	parseInt(data_7)+parseInt(data1[17]);
						data_8 =	parseInt(data_8)+parseInt(data1[18]);
						data_9 =	parseInt(data_9)+parseInt(data1[25]);
						data_10 =	parseInt(data_10)+parseInt(data1[19]);
		            }

					html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th id="total_data_1">'+data_1+'</th>'+ 			
				'<th id="total_data_2">'+data_2+'</th>'+		
				'<th id="total_data_3">'+data_3+'</th>'+
				'<th id="total_data_4">'+data_4+'</th>'+
				'<th id="total_data_5">'+data_5+'</th>'+ 			
				'<th id="total_data_6">'+data_6+'</th>'+ 			
				'<th id="total_data_7">'+data_7+'</th>'+
				'<th id="total_data_8">'+data_8+'</th>'+		
				'<th id="total_data_9">'+data_9+'</th>'+  			
				'<th id="total_data_10">'+data_10+'</th>'+  			
				'</tr></tfoot>';
	                html += '</table>';

					$('#table_data1').html(html);
					
					
					
  /*
	   var msg = "Office Staff Entry List";
    $('#example1').dataTable({
		 'scrollX': true,
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
            {extend: 'copy',  className: 'btn-sm', title: msg,footer:true },
            {extend: 'csv',   className: 'btn-sm', title: msg,footer:true },
            {extend: 'excel', className: 'btn-sm', title: msg,footer:true },
            {extend: 'pdf',   className: 'btn-sm', title: msg,footer:true },
            {extend: 'print', className: 'btn-sm', title: msg,footer:true }
        ]
    });
		*/			}	
					
					
		//	        $("#wait").css("display", "none");
		
					
		        }

		    });
		}

 	$(document).on('blur','.worked_days',function(){
		
		var emp_id = $(this).attr('id');
		var worked_days = $('#'+emp_id).val();
		
					var totalDays = $('#leave_without_pay_'+emp_id).html();
					var leaveWithoutPay = parseInt(totalDays)-parseInt(worked_days);
					if(leaveWithoutPay < 1){
						leaveWithoutPay = 0;
					}
				 $('#leave_without_pay'+emp_id).html(leaveWithoutPay);
		if(worked_days!=0){
				 
			 var totalsalary = $('#total_salary'+emp_id).html();
			 var leave_with_pay = $('#leave_with_pay'+emp_id).html();
			 var addition = $('#addition'+emp_id).val();
			 
			 

			 
			//		var month_day = parseInt(totalDays)+parseInt(leave_with_pay);
					var month_day = parseInt(totalDays);
				   
			//		var perdaysalary = (parseInt(totalsalary)+parseInt(addition))/parseInt(month_day);
						var perdaysalary = Math.round(parseInt(totalsalary)/parseInt(month_day));
					
			//		var total = (perdaysalary*worked_days)+parseInt(addition);
			var cut_salary = 0;
/*					if(worked_days!=0)
					{
				
					 cut_salary = perdaysalary * leaveWithoutPay;
					}
					else{
*/
					 cut_salary = perdaysalary * (parseInt(leaveWithoutPay)	);
//					}

					var totalmonthsalary = parseInt(totalsalary)-parseInt(cut_salary)+parseInt(addition);
						
					$('#totalmonthsalary'+emp_id).html(totalmonthsalary);

					var pf = Math.round((totalmonthsalary*10)/100);
					$('#pf'+emp_id).html(pf);

			/*		var tax_rate =	$('#pt_rate'+emp_id).html();
					var pt = parseInt(tax_rate);
					$('#pt'+emp_id).html(pt);
					
					var net_wages = totalmonthsalary-(parseInt(pf)+parseInt(pt));
					$('#net_wages'+emp_id).html(net_wages);
			*/
					get_pf(totalmonthsalary,emp_id,pf);



//					get_grand_total();
			}
								get_grand_total();

	    });
	$(document).on('blur','.addition',function(){
		
				var emp_id = $(this).attr('name');
				var worked_days = $('#'+emp_id).val();
		if(worked_days!=0){		
				var totalDays = $('#leave_without_pay_'+emp_id).html();
				var leaveWithoutPay = parseInt(totalDays)-parseInt(worked_days);
				if(leaveWithoutPay < 1){
					leaveWithoutPay = 0;
				}
			 $('#leave_without_pay'+emp_id).html(leaveWithoutPay);
			 
		 var totalsalary = $('#total_salary'+emp_id).html();
		 var leave_with_pay = $('#leave_with_pay'+emp_id).html();
		 var addition = $('#addition'+emp_id).val();

		 
		//		var month_day = parseInt(totalDays)+parseInt(leave_with_pay);
				var month_day = parseInt(totalDays);
		 
		//		var perdaysalary = (parseInt(totalsalary)+parseInt(addition))/parseInt(month_day);
					var perdaysalary = Math.round(parseInt(totalsalary)/parseInt(month_day));
				
		//		var total = (perdaysalary*worked_days)+parseInt(addition);
		var cut_salary = 0;
				if(worked_days!=0)
				{
			
				 cut_salary = perdaysalary * leaveWithoutPay;
				}
				else{
				 cut_salary = perdaysalary * (parseInt(leaveWithoutPay));
				}
				
				var totalmonthsalary = parseInt(totalsalary)-parseInt(cut_salary)+parseInt(addition);
					
					
				$('#totalmonthsalary'+emp_id).html(totalmonthsalary);
				
				var pf = Math.round((parseInt(totalmonthsalary)*10)/100);
				$('#pf'+emp_id).html(pf);

				var tax_rate =	$('#pt_rate'+emp_id).html();
		/*		var pt = parseInt(tax_rate);
				$('#pt'+emp_id).html(pt);
				
				var net_wages = totalmonthsalary-(parseInt(pf)+parseInt(pt));
				$('#net_wages'+emp_id).html(net_wages);
		*/		
				get_pf(totalmonthsalary,emp_id,pf);
				
				
				
				
				get_grand_total();
		}
	    });

			
		
		
/*
 	$(document).on('focusout','.addition',function(){
		
		var emp_id = $(this).attr('name');
		var worked_days = $('#'+emp_id).val();
		
		var totalDays = $('#leave_without_pay').val();
		var leaveWithoutPay = parseInt(totalDays)-parseInt(worked_days);
		if(leaveWithoutPay < 1){
			leaveWithoutPay = 0;
		}
	 $('#leave_without_pay'+emp_id).html(leaveWithoutPay);
	 
 var totalsalary = $('#total_salary'+emp_id).html();
 var leave_with_pay = $('#leave_with_pay'+emp_id).html();
 var addition = $('#addition'+emp_id).val();

 
		var month_day = parseInt(totalDays)+parseInt(leave_with_pay);


		var perdaysalary = (parseInt(totalsalary)+parseInt(addition))/parseInt(month_day);
		
		var cut_salary = perdaysalary * leaveWithoutPay;

		var totalmonthsalary = (parseInt(totalsalary)+parseInt(addition))-parseInt(cut_salary);//;
			
		$('#totalmonthsalary'+emp_id).html(totalmonthsalary);
		
		var pf = Math.round((parseInt(totalmonthsalary)*10)/100);
		$('#pf'+emp_id).html(pf);

		var tax_rate =	$('#pt_rate'+emp_id).html();
		var pt = parseInt(tax_rate);
		$('#pt'+emp_id).html(pt);
		
		var net_wages = totalmonthsalary-(parseInt(pf)+parseInt(pt));
		$('#net_wages'+emp_id).html(net_wages);
		
	    });

		
	*/	
		

  	$(document).on('click','#btn_insert',function(){
					   //     $("#wait").css("display", "block");

		var month_year = $('#month_year').val();
		
		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"officestaffsalary/show_office_staff_month",
		        data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
	//				alert('ok');
					
			if(data=="salary"){
	
							swal("Some Employee's Salary Not Define ...!")
								            $('#table_data1').html("");

				}
				else{
					var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th  style="display:none;"  >Employee id</th><th>Employee Name.</th><!--<th>UAN</th>-->'+
				'<th >No. of days worked</th>'+  			
				'<th>Leave With Pay</th>'+  			
				'<th>Leave without Pay</th>'+  			
				'<th>Addition if any</th>'+  			
				'<th>Basic Salary</th>'+  			
				'<th>Total</th>'+  			
				'<th>PF</th>'+  			
				'<th>PT</th>'+  			
				'<th>Net Wages</th>'+  			

					'</tr></thead><tbody id="">';
		            var i;
							var data_1 = 0;
					var data_2 = 0;
					var data_3 = 0;
					var data_4 = 0;
					var data_5 = 0;
					var data_6 = 0;
					var data_7 = 0;
					var data_8 = 0;
					var data_9 = 0;

					
//					alert(data.length);
		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
//$('#month_year').val(data1[7]);					
//					$('#leave_without_pay').val(data1[4]);
	//	            for(j=0;j<data1.length;j++){
		                html += '<tr>'+
								'<td style="display:none;" >'+data1[0]+'</td>'+
								'<td style="display:none;">'+data1[1]+'</td>'+
								'<td style="display:none;">'+data1[2]+'</td>'+
								'<td style="whiteSpace:nowrap;">'+data1[1]+'<br>'+data1[19]+'<br>'+data1[2]+'</td>'+
				'<td><input type="text" id="'+data1[0]+'"  class="worked_days" value="'+data1[11]+'" style="width:50%;" /></td>'+
								'<td  id="leave_with_pay'+data1[0]+'"  >'+data1[3]+'</td>'+
								'<td id="leave_without_pay'+data1[0]+'" >'+data1[12]+'</td>'+
				'<td><input type="text" id="addition'+data1[0]+'" class="addition" name="'+data1[0]+'" style="width:100%;" value="'+data1[13]+'" /></td>'+
								'<td style="display:none;" id="office_staff_entry_id'+data1[0]+'" >'+data1[7]+'</td>'+
								'<td style="display:none;" id="salary_id'+data1[0]+'" >'+data1[7]+'</td>'+
								'<td  id="total_salary'+data1[0]+'"  >'+data1[5]+'</td>'+
								'<td id="totalmonthsalary'+data1[0]+'" >'+data1[15]+'</td>'+
								'<td id="pf'+data1[0]+'" >'+data1[16]+'</td>'+
								'<td style="display:none;" id="pt_id'+data1[0]+'" >'+data1[8]+'</td>'+
								'<td style="display:none;" id="pt_rate'+data1[0]+'" >'+data1[6]+'</td>'+
								'<td id="pt'+data1[0]+'" >'+data1[17]+'</td>'+
								'<td id="net_wages'+data1[0]+'" >'+data1[18]+'</td>'+
								'<td  style="display:none;"  id="ac1eemf'+data1[0]+'" >'+data1[9]+'</td>'+
								'<td  style="display:none;"  id="ac10'+data1[0]+'" >'+data1[10]+'</td>'+
								'<td  style="display:none;"  id="ncp_days'+data1[0]+'" >'+data1[20]+'</td>'+
								'<td  style="display:none;"  id="leave_without_pay_'+data1[0]+'" >'+data1[4]+'</td>'+
								'<td  style="display:none;"  id="ac1eemale'+data1[0]+'" >'+data1[21]+'</td>'+
												

								
		                        '</tr>';
								if(parseInt(data1[22])>0){
							$('#save_update').val('update');
						}
						else{
							$('#save_update').val('add');							
						}
										if(data1[23]>0){
				$('#save_table').attr('disabled','disabled');												
						}
						else{
				$('#save_table').removeAttr('disabled');																			
						}		
						data_1 =	parseInt(data_1)+parseInt(data1[11]);
						data_2 =	parseInt(data_2)+parseInt(data1[3]);
						data_3 =	parseInt(data_3)+parseInt(data1[12]);
						data_4 =	parseInt(data_4)+parseInt(data1[13]);
						data_5 =	parseInt(data_5)+parseInt(data1[5]);
						data_6 =	parseInt(data_6)+parseInt(data1[15]);
						data_7 =	parseInt(data_7)+parseInt(data1[16]);
						data_8 =	parseInt(data_8)+parseInt(data1[17]);
						data_9 =	parseInt(data_9)+parseInt(data1[18]);

		            }
					html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th id="total_data_1">'+data_1+'</th>'+ 			
				'<th id="total_data_2">'+data_2+'</th>'+		
				'<th id="total_data_3">'+data_3+'</th>'+
				'<th id="total_data_4">'+data_4+'</th>'+
				'<th id="total_data_5">'+data_5+'</th>'+ 			
				'<th id="total_data_6">'+data_6+'</th>'+ 			
				'<th id="total_data_7">'+data_7+'</th>'+
				'<th id="total_data_8">'+data_8+'</th>'+		
				'<th id="total_data_9">'+data_9+'</th>'+  			
				'</tr></tfoot>';
	                html += '</table>';

		            $('#table_data1').html(html);
					
					
					
  
	/*   var msg = "Office Staff Entry List";
    $('#example1').dataTable({
       'scrollX': true,
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
		*/			
		        }
						//		        $("#wait").css("display", "none");
	
				}

		    });
        });
	
/*---------get  packingwages row  end-----------------*/



/*---------delete    packingwages row  start-----------------*/

  	$(document).on('click','.delete_row',function(){
		var id1 = $(this).attr('id');
//		 $('#myModal').show();
				$.ajax({
                type : "POST",
				url  : baseurl+"notescontroller/delete_notes",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Notes Delete Successfully");
				

					show_notes();	//call function show all product					
					
					}
					else{
					$().toastmessage('showErrorToast', "Notes Delete Failed");
					}
	
                }
            });
            return false;

		
	});
	
  	$(document).on('click','#save_table',function(){
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			var msg = 0;
			var i = 0;
						var save_update =	$('#save_update').val();

			for (var i = 0; i < r; i++) {
				
			var emp_id = $(r1[i]).find('td:eq(0)').html();
			var member_name = $(r1[i]).find('td:eq(1)').html();
			var uan = $(r1[i]).find('td:eq(2)').html();
			var worked_days = $('#'+emp_id).val();
			var month_year = $('#month_year').val();
			var addition = $('#addition'+emp_id).val();
			var pt_id = $('#pt_id'+emp_id).html();
			var salary_id = $('#salary_id'+emp_id).html();
			var total = $('#totalmonthsalary'+emp_id).html();
			var ac1eemf = $('#ac1eemf'+emp_id).html();
			var ac10 = $('#ac10'+emp_id).html();
			var ncp_days = $('#leave_without_pay'+emp_id).html();
			var remainig_days = $('#ncp_days'+emp_id).html();
			var ac1eemale = $('#ac1eemale'+emp_id).html();
			var net_wages = $('#net_wages'+emp_id).html();
			
			$.ajax({
				
                type : "POST",		
				url  : baseurl+"officestaffsalary/save_office_staff_entry",
                dataType : "JSON",
                data : {net_wages:net_wages,remainig_days:remainig_days,ac1eemale:ac1eemale,save_update:save_update,emp_id:emp_id,ncp_days:ncp_days,ac10:ac10,ac1eemf:ac1eemf,member_name:member_name ,uan:uan,worked_days:worked_days,month_year:month_year,addition:addition,pt_id:pt_id,salary_id:salary_id,total:total},
				success: function(data){
								if(data == true){
									msg = 1;
					}
					else{
						msg = 2;
					}
					
				}	
				

				
				});
				var n = r-1;
				
				if(n==i)
				{
					$().toastmessage('showSuccessToast', "office staff salary data save successfully");
							$('#save_update').val('update');

				}	
	
					
				
	
			}
			
			
		
	});
				
  	function get_pf(totalmonthsalary,emp_id,pf){

		var salary11 = totalmonthsalary;
		var emp_id11 = emp_id;
		var pf11 = pf;
		if(salary11==0){
				$('#net_wages'+emp_id11).html('0');
				$('#pt'+emp_id11).html('0');
				$('#esic'+emp_id11).html('0');
		}
			
				$.ajax({
                type : "POST",
				url  : baseurl+"Packingwages/get_ptax",
                dataType : "JSON",
                data : { salary:salary11 },
                success: function(data){
				var data1 = data.split("####");

						var pt = data1[0];
						console.log(pt);

		$('#pt'+emp_id11).html(parseInt(pt));
		$('#pt_id'+emp_id11).html(parseInt(data1[1]));
		
		// Get ESIC value
		var esic = parseInt(data1[2]) || 0;
		$('#esic'+emp_id11).html(esic);
		
			var net_wages = parseInt(salary11)-(parseInt(pt)+parseInt(pf11)+parseInt(esic));
		$('#net_wages'+emp_id11).html(parseInt(net_wages));
		
                }
            });
	}

function get_grand_total(){
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			var msg = 0;
			var i = 0;

			
			var total_data_1 = 0;
			var total_data_2 = 0;
			var total_data_3 = 0;
			var total_data_4 = 0;
			var total_data_5 = 0;
			var total_data_6 = 0;
			var total_data_7 = 0;
			var total_data_8 = 0;
			var total_data_9 = 0;
			var total_data_10 = 0;
			
			
			for (var i = 0; i < r; i++) {
			var emp_id = $(r1[i]).find('td:eq(0)').html();
			
			var data_1 = $('#'+emp_id).val();
			var data_2 = $('#leave_with_pay'+emp_id).html();
			var data_3 = $('#leave_without_pay'+emp_id).html();
			var data_4 = $('#addition'+emp_id).val();
			var data_5 = $('#total_salary'+emp_id).html();
			var data_6 = $('#totalmonthsalary'+emp_id).html();
			var data_7 = $('#pf'+emp_id).html();
			var data_8 = $('#pt'+emp_id).html();
			var data_9 = $('#esic'+emp_id).html();
			var data_10 = $('#net_wages'+emp_id).html();
			
			
			total_data_1 = parseInt(total_data_1) + parseInt(data_1);
			total_data_2 = parseInt(total_data_2) + parseInt(data_2);
			total_data_3 = parseInt(total_data_3) + parseInt(data_3);
			total_data_4 = parseInt(total_data_4) + parseInt(data_4);
			total_data_5 = parseInt(total_data_5) + parseInt(data_5);
			total_data_6 = parseInt(total_data_6) + parseInt(data_6);
			total_data_7 = parseInt(total_data_7) + parseInt(data_7);
			total_data_8 = parseInt(total_data_8) + parseInt(data_8);
			total_data_9 = parseInt(total_data_9) + parseInt(data_9);
			total_data_10 = parseInt(total_data_10) + parseInt(data_10);
			}
		
			$('#total_data_1').html(total_data_1);
			$('#total_data_2').html(total_data_2);
			$('#total_data_3').html(total_data_3);
			$('#total_data_4').html(total_data_4);
			$('#total_data_5').html(total_data_5);
			$('#total_data_6').html(total_data_6);
			$('#total_data_7').html(total_data_7);
			$('#total_data_8').html(total_data_8);
			$('#total_data_9').html(total_data_9);
			$('#total_data_10').html(total_data_10);
			
			
		}
	
});