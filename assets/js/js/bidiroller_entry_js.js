$(document).ready(function() {
	
	
	
	
/*---------get  contracor  end-----------------*/

		show_contractor();	//call function show all address
		function show_contractor(){
				$.ajax({
		        type  : 'ajax',
				url  : baseurl+"contractorcontroller/view_contractor",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var html1 = '';
		            var i;
		                html += '<option value=""  selected >ALL</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].contractor_id+'" >'+data[i].contractor_name+' - '+data[i].pf_code+'</option>';
		            }
		            $('#contractor1').html(html);					
					
					
				}
					
				});
		}
		
		
/*---------view contracor list end-----------------*/

//		show_bidi_roller_entry();	//call function show all address
		function show_bidi_roller_entry(){
			        $("#wait").css("display", "block");

			
			
		var month_year = $('#month_year').val();
		var contractor = $('#contractor1').val();
		
		$.ajax({
		        type  : 'POST',
				url  : baseurl+"Bidirollewages/show_bidi_roller_entry",
		        data : {month_year:month_year,contractor:contractor},
		        dataType : 'json',
		        success : function(data){

				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th  style="display:none;"  >Employee id</th><th style="white-space:nowrap;" >Employee Name.</th><!--<th>UAN</th>-->'+
				'<th >No. of Unit worked</th>'+  			
				'<th >No. of Unit worked</th>'+  			
				'<th >No. of Days worked</th>'+  			
 				'<th>Leave With Pay</th>'+  			
				'<th>Wages</th>'+  			
				'<th>Bonus</th>'+  			
				'<th>Total</th>'+  			
				'<th>PF</th>'+  			
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


					
		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					$('#month_year').val(data1[3]);					
//					$('#leave_without_pay').val(data1[4]);
	//	            for(j=0;j<data1.length;j++){
		                html += '<tr>'+
								'<td  style="display:none;" >'+data1[0]+'</td>'+
								'<td id="name'+data1[0]+'"style="display:none;"  style="white-space:nowrap;" >'+data1[1]+'</td>'+
								'<td style="display:none;" id="uan'+data1[0]+'"  >'+data1[2]+'</td>'+
				'<td style="whiteSpace:nowrap;width:20%;"  >'+data1[1]+'<br>'+data1[21]+'<br>'+data1[2]+'</td>'+
				'<td><center><input type="text" name="'+data1[0]+'" id="unit1_'+data1[0]+'" class="unit_worked_days1 form-control" value="'+data1[17]+'" style="width:70%;" /></center></td>'+
				'<td><center><input type="text" name="'+data1[0]+'" id="unit2_'+data1[0]+'" class="unit_worked_days2 form-control" value="'+data1[18]+'" style="width:70%;" /></center></td>'+
				'<td id="remaining_days'+data1[0]+'" style="display:none;">'+data1[4]+'</td>'+
				'<td><center><input type="text"  name="'+data1[0]+'"  id="worked_days'+data1[0]+'" class="worked_days form-control" disabled value="'+data1[19]+'" style="width:70%;" /></center></td>'+
				'<td><center><input type="text"  name="'+data1[0]+'"  id="leave_with_pay'+data1[0]+'" class="leave_with_pay form-control" value="'+data1[20]+'" style="width:70%;" /></center></td>'+
				'<td id="br_id'+data1[0]+'" style="display:none;">'+data1[5]+'</td>'+
				'<td id="rate1'+data1[0]+'" style="display:none;">'+data1[6]+'</td>'+
				'<td id="rate2'+data1[0]+'" style="display:none;">'+data1[7]+'</td>'+
				'<td id="bonus1_'+data1[0]+'" style="display:none;">'+data1[8]+'</td>'+
				'<td id="bonus2_'+data1[0]+'" style="display:none;">'+data1[9]+'</td>'+
				'<td id="pf_rate'+data1[0]+'" style="display:none;">'+data1[10]+'</td>'+
				'<td id="ac10'+data1[0]+'" style="display:none;">'+data1[11]+'</td>'+
								'<td id="wages'+data1[0]+'">'+data1[12]+'</td>'+
								'<td id="bonus'+data1[0]+'">'+data1[13]+'</td>'+
								'<td id="total'+data1[0]+'">'+data1[14]+'</td>'+
								'<td id="pf'+data1[0]+'">'+data1[15]+'</td>'+
								'<td id="net_wages'+data1[0]+'">'+data1[16]+'</td>'+
								'<td  style="display:none;" id="ac1male'+data1[0]+'">'+data1[22]+'</td>'+
								'<td  style="display:none;" id="ncp_days'+data1[0]+'">'+data1[23]+'</td>'+
								'<td  style="display:none;" id="status'+data1[0]+'">'+data1[24]+'</td>'+
								'<td  style="display:none;" id="member_id_'+data1[0]+'">'+data1[21]+'</td>'+
								'<td  style="display:none;" id="total_no_of_days_'+data1[0]+'">'+data1[27]+'</td>'+
				                '</tr>';
								
						if(parseInt(data1[25])>0){
							$('#save_update').val('update');
						}
						else{
							$('#save_update').val('save');							
						}
													if(data1[26]>0){
				$('#table_insert').attr('disabled','disabled');												
						}
						else{
				$('#table_insert').removeAttr('disabled');																			
						}
//						data_1_total = unit1_'+data1[0];	
						data_1 =	parseInt(data_1)+parseInt(data1[17]);
						data_2 =	parseInt(data_2)+parseInt(data1[18]);
						data_3 =	parseInt(data_3)+parseInt(data1[19]);
						data_4 =	parseInt(data_4)+parseInt(data1[20]);
						data_5 =	parseInt(data_5)+parseInt(data1[12]);
						data_6 =	parseInt(data_6)+parseInt(data1[13]);
						data_7 =	parseInt(data_7)+parseInt(data1[14]);
						data_8 =	parseInt(data_8)+parseInt(data1[15]);
						data_9 =	parseInt(data_9)+parseInt(data1[16]);
						
						

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
					
					
					
 /* 
	   var msg = "Bidi Roller Entry List";
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
        ],

    });
	*/				        $("#wait").css("display", "none");

		        }

		    });
  
		}

	$(document).on('click','#btn_insert',function(){
		show_bidi_roller_entry();
        });
	
	$(document).on("blur",".unit_worked_days1",function(){	
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_'+emp_id).val();
		var unit_days2 = $('#unit2_'+emp_id).val();
		var remaining_days = $('#remaining_days'+emp_id).html();
		var unit = parseInt(unit_days1)+parseInt(unit_days2);
	var leave_with_pay=$('#leave_with_pay'+emp_id).val();
			if(remaining_days>unit){
			$('#worked_days'+emp_id).val(unit);
		}
		else{
			$('#worked_days'+emp_id).val(remaining_days);			
		}
		
		var worked_days=$('#worked_days'+emp_id).val();
		var rate1=$('#rate1'+emp_id).html();
		var rate2=$('#rate2'+emp_id).html();
		var bonus1=$('#bonus1_'+emp_id).html();
		var bonus2=$('#bonus2_'+emp_id).html();
		var pf_rate=$('#pf_rate'+emp_id).html();
		
		var wages1 = parseInt((unit_days1)*(rate1))+parseInt((unit_days2)*(rate2));
		if(worked_days==0){
		var wages2 = 0;		
		}
		else{
		var wages2 = (wages1/worked_days)*leave_with_pay;
		}
		var wages = (wages1)+(wages2);
		$('#wages'+emp_id).html(Math.round(wages));
		
		var bonus = (parseInt(unit_days1)*parseInt(bonus1))+(parseInt(unit_days2)*parseInt(bonus2));

		var total = parseInt(wages)+parseInt(bonus);
		$('#bonus'+emp_id).html(parseInt(bonus));
		$('#total'+emp_id).html(parseInt(total));
		
		var pf = (parseInt(wages)*parseInt(pf_rate))/100;
		$('#pf'+emp_id).html(parseInt(pf));

		var net_wages = parseInt(total)-parseInt(pf);	
		$('#net_wages'+emp_id).html(parseInt(net_wages));
		
		
		 get_grand_total();
     });

	$(document).on("blur",".unit_worked_days2",function(){	
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_'+emp_id).val();
		var unit_days2 = $('#unit2_'+emp_id).val();
		var remaining_days = $('#remaining_days'+emp_id).html();
		var unit = parseInt(unit_days1)+parseInt(unit_days2);
	var leave_with_pay=$('#leave_with_pay'+emp_id).val();
			if(remaining_days>unit){
			$('#worked_days'+emp_id).val(unit);
		}
		else{
			$('#worked_days'+emp_id).val(remaining_days);			
		}
		
		var worked_days=$('#worked_days'+emp_id).val();
		var rate1=$('#rate1'+emp_id).html();
		var rate2=$('#rate2'+emp_id).html();
		var bonus1=$('#bonus1_'+emp_id).html();
		var bonus2=$('#bonus2_'+emp_id).html();
		var pf_rate=$('#pf_rate'+emp_id).html();
		
		var wages1 = parseInt((unit_days1)*(rate1))+parseInt((unit_days2)*(rate2));
		if(worked_days==0){
		var wages2 = 0;		
		}
		else{
		var wages2 = (wages1/worked_days)*leave_with_pay;
		}
		var wages = (wages1)+(wages2);
		$('#wages'+emp_id).html(Math.round(wages));
		
		var bonus = (parseInt(unit_days1)*parseInt(bonus1))+(parseInt(unit_days2)*parseInt(bonus2));

		var total = parseInt(wages)+parseInt(bonus);
		$('#bonus'+emp_id).html(parseInt(bonus));
		$('#total'+emp_id).html(parseInt(total));
		
		var pf = (parseInt(wages)*parseInt(pf_rate))/100;
		$('#pf'+emp_id).html(parseInt(pf));

		var net_wages = parseInt(total)-parseInt(pf);	
		$('#net_wages'+emp_id).html(parseInt(net_wages));
		
		
		 get_grand_total();
     });

	$(document).on("blur",".leave_with_pay",function(){	
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_'+emp_id).val();
		var unit_days2 = $('#unit2_'+emp_id).val();
		var remaining_days = $('#remaining_days'+emp_id).html();
		var unit = parseInt(unit_days1)+parseInt(unit_days2);
	var leave_with_pay=$('#leave_with_pay'+emp_id).val();
			if(remaining_days>unit){
			$('#worked_days'+emp_id).val(unit);
		}
		else{
			$('#worked_days'+emp_id).val(remaining_days);			
		}
		
		var worked_days=$('#worked_days'+emp_id).val();
		var rate1=$('#rate1'+emp_id).html();
		var rate2=$('#rate2'+emp_id).html();
		var bonus1=$('#bonus1_'+emp_id).html();
		var bonus2=$('#bonus2_'+emp_id).html();
		var pf_rate=$('#pf_rate'+emp_id).html();
		
		var wages1 = parseInt((unit_days1)*(rate1))+parseInt((unit_days2)*(rate2));
		if(worked_days==0){
		var wages2 = 0;		
		}
		else{
		var wages2 = (wages1/worked_days)*leave_with_pay;
		}
		var wages = (wages1)+(wages2);
		$('#wages'+emp_id).html(Math.round(wages));
		
		var bonus = (parseInt(unit_days1)*parseInt(bonus1))+(parseInt(unit_days2)*parseInt(bonus2));

		var total = parseInt(wages)+parseInt(bonus);
		$('#bonus'+emp_id).html(parseInt(bonus));
		$('#total'+emp_id).html(parseInt(total));
		
		var pf = (parseInt(wages)*parseInt(pf_rate))/100;
		$('#pf'+emp_id).html(parseInt(pf));

		var net_wages = parseInt(total)-parseInt(pf);	
		$('#net_wages'+emp_id).html(parseInt(net_wages));
		
		
		 get_grand_total();
     });



  	$(document).on('click','#table_insert',function(){
		
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			var msg = 0;
			var i = 0;
			var month_year=$('#month_year').val();
			var save_update =	$('#save_update').val();
			
			for (var i = 0; i < r; i++) {

			
			var emp_id = $(r1[i]).find('td:eq(0)').html();
			var member_name = $(r1[i]).find('td:eq(1)').html();
			var uan = $(r1[i]).find('td:eq(2)').html();

			var unit_days1 = $('#unit1_'+emp_id).val();
			var unit_days2 = $('#unit2_'+emp_id).val();
			
			var worked_days=$('#worked_days'+emp_id).val();
			var leave_with_pay=$('#leave_with_pay'+emp_id).val();
			
			var uan = $('#uan'+emp_id).html();
			var name = $('#name'+emp_id).html();
			var br_id = $('#br_id'+emp_id).html();
			var wages = $('#wages'+emp_id).html();
			var bonus = $('#bonus'+emp_id).html();
			var total = $('#total'+emp_id).html();
			var pf	= $('#pf'+emp_id).html();
			var net_wages = $('#net_wages'+emp_id).html();
			var ac10 = $('#ac10'+emp_id).html();
			var ac1male = $('#ac1male'+emp_id).html();
			var ncp_days = $('#ncp_days'+emp_id).html();
			var status1 = $('#status'+emp_id).html();
			var member_id = $('#member_id_'+emp_id).html();
			var total_no_of_days = $('#total_no_of_days_'+emp_id).html();

			var pf_rate = $('#pf_rate'+emp_id).html();
			
			
			$.ajax({
				
                type : "POST",		
				url  : baseurl+"bidirollewages/bidiroller_entry_save",
                dataType : "JSON",
				data : {member_id:member_id,br_id:br_id,month_year:month_year,ac10:ac10,pf_rate:pf_rate,worked_days:worked_days,leave_with_pay:leave_with_pay,wages:wages,bonus:bonus,total:total,pf:pf,net_wages:net_wages,save_update:save_update,emp_id:emp_id,member_name:member_name,uan:uan,unit_days1:unit_days1,unit_days2:unit_days2,ac1male:ac1male
				,ncp_days:ncp_days,status1:status1,total_no_of_days:total_no_of_days},
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
							$().toastmessage('showSuccessToast', "Bidi Roller Entry data save successfully");
							$('#save_update').val('update');
				}    	
	
					
				
	
			}
			
			
		
	});
	
	
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
			
			
			for (var i = 0; i < r; i++) {
			var emp_id = $(r1[i]).find('td:eq(0)').html();
			
			var data_1 = $('#unit1_'+emp_id).val();
			var data_2 = $('#unit2_'+emp_id).val();
			var data_3 = $('#worked_days'+emp_id).val();
			var data_4 = $('#leave_with_pay'+emp_id).val();
			var data_5 = $('#wages'+emp_id).html();
			var data_6 = $('#bonus'+emp_id).html();
			var data_7 = $('#total'+emp_id).html();
			var data_8 = $('#pf'+emp_id).html();
			var data_9 = $('#net_wages'+emp_id).html();
			
			
			total_data_1 = parseInt(total_data_1) + parseInt(data_1);
			total_data_2 = parseInt(total_data_2) + parseInt(data_2);
			total_data_3 = parseInt(total_data_3) + parseInt(data_3);
			total_data_4 = parseInt(total_data_4) + parseInt(data_4);
			total_data_5 = parseInt(total_data_5) + parseInt(data_5);
			total_data_6 = parseInt(total_data_6) + parseInt(data_6);
			total_data_7 = parseInt(total_data_7) + parseInt(data_7);
			total_data_8 = parseInt(total_data_8) + parseInt(data_8);
			total_data_9 = parseInt(total_data_9) + parseInt(data_9);
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
			
			
		}
	
	
});