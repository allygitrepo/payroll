$(document).ready(function() {
	
						show_packer_entry();	//call function show all packingwages
		
	
		function show_packer_entry(){
			      $("#wait").css("display", "block");

					var month_year = $('#month_year').val();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"Packingwages/packers_entry_show",
                data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
				'<th style="white-space:nowrap;display:none;">Employee id</th>'+
				'<th style="white-space:nowrap;">Employee Name.</th><!--<th>UAN</th>-->'+
				'<th style="white-space:nowrap;">No. of days worked</th>'+  			
				'<th style="white-space:nowrap;">Unit-1</th>'+  			
				'<th style="white-space:nowrap;">Unit-2</th>'+  			
				'<th style="white-space:nowrap;">Unit-3</th>'+  			
				'<th style="white-space:nowrap;">Unit-4</th>'+  			
				'<th style="display:none;"></th>'+
				'<th style="white-space:nowrap;">Rate-1</th>'+  			
				'<th style="white-space:nowrap;">Rate-2</th>'+  			
				'<th style="white-space:nowrap;">Rate-3</th>'+  			
				'<th style="white-space:nowrap;">Rate-4</th>'+  			
				'<th style="white-space:nowrap;">Additional Paid Wages</th>'+  			
				'<th style="white-space:nowrap;">Wages</th>'+  			
				'<th style="white-space:nowrap;">Weekly Leave</th>'+  			
				'<th style="white-space:nowrap;">Total</th>'+  			
				'<th style="white-space:nowrap;">PF</th>'+  			
				'<th style="display:none;"></th>'+
				'<th style="white-space:nowrap;">PT</th>'+  			
				'<th style="white-space:nowrap;">Net Wages</th>'+  			
				'<th style="display:none;"></th>'+
				'<th style="display:none;"></th>'+
					'</tr></thead><tbody id="">';
		            var i;
					
			
								var data_0 = 0;
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
					var data_11 = 0;
					var data_12 = 0;
					var data_13 = 0;
					var data_14 = 0;
					var data_15 = 0;
						
						
						
						
						
					
		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
$('#month_year').val(data1[7]);					
					$('#leave_without_pay').val(data1[4]);
//	            for(j=0;j<data1.length;j++){
		                html += '<tr>'+
								'<td style="display:none;" id="emp_id'+data[0]+'">'+data1[0]+'</td>'+
								'<td style="display:none;">'+data1[1]+'</td>'+
								'<td style="display:none;">'+data1[2]+'</td>'+
				'<td style="whiteSpace:nowrap;">'+data1[1]+'<br>'+data1[24]+'<br>'+data1[2]+'</td>'+
									
				'<td><center><input type="text" id="daysofwork'+data1[0]+'" class="daysofwork" value="'+data1[12]+'" style="width:50%;" /></center></td>'+
				'<td><center><input type="text" id="unit1'+data1[0]+'" name="'+data1[0]+'"class="unit" value="'+data1[13]+'" style="width:100%;" /></center></td>'+
				'<td><center><input type="text" id="unit2'+data1[0]+'" name="'+data1[0]+'"class="unit" value="'+data1[14]+'" style="width:100%;" /></center></td>'+
				'<td><center><input type="text" id="unit3'+data1[0]+'" name="'+data1[0]+'"class="unit" value="'+data1[15]+'" style="width:100%;" /></center></td>'+
				'<td><center><input type="text" id="unit4'+data1[0]+'" name="'+data1[0]+'" class="unit" value="'+data1[16]+'" style="width:100%;" /></center></td>'+
				'<td style="display:none;" id="pw_id'+data1[0]+'" >'+data1[8]+'</td>'+
				'<td id="rate1'+data1[0]+'" >'+data1[3]+'</td>'+
				'<td id="rate2'+data1[0]+'" >'+data1[4]+'</td>'+
				'<td id="rate3'+data1[0]+'" >'+data1[5]+'</td>'+
				'<td id="rate4'+data1[0]+'" >'+data1[6]+'</td>'+
				'<td><center><input type="text" id="addition'+data1[0]+'" name="'+data1[0]+'" class="unit" value="'+data1[17]+'" style="width:80%;" /></center></td>'+
				'<td id="wages'+data1[0]+'">'+data1[18]+'</td>'+
				'<td id="weekly_leave'+data1[0]+'">'+data1[19]+'</td>'+
				'<td  id="total'+data1[0]+'">'+data1[20]+'</td>'+
				'<td id="pf'+data1[0]+'">'+data1[21]+'</td>'+
				'<td style="display:none;" id="pt_id'+data1[0]+'" >'+data1[30]+'</td>'+
				'<td id="pt'+data1[0]+'">'+data1[22]+'</td>'+
				'<td id="net_wages'+data1[0]+'">'+data1[23]+'</td>'+
				'<td style="display:none;" id="ac1eemf'+data1[0]+'" >'+data1[9]+'</td>'+
				'<td style="display:none;" id="ac10'+data1[0]+'" >'+data1[10]+'</td>'+
				'<td style="display:none;" id="total_days'+data1[0]+'" >'+data1[11]+'</td>'+
				'<td style="display:none;" id="ncp_days'+data1[0]+'" >'+data1[26]+'</td>'+
				'<td style="display:none;" id="ac1eemale'+data1[0]+'" >'+data1[25]+'</td>'+
				'<td style="display:none;" id="total_no_of_days_'+data1[0]+'" >'+data1[29]+'</td>'+
		                        '</tr>';
						if(data1[27] != ""){
							$('#save_update').val('update');
						}
						else{
							$('#save_update').val('add');							
						}
				if(data1[28]>0){
				$('#table_save').attr('disabled','disabled');												
						}
						else{
				$('#table_save').removeAttr('disabled');																			
						}
								
						data_0 =	parseInt(data_0)+parseInt(data1[12]);
						data_1 =	parseInt(data_1)+parseInt(data1[13]);
						data_2 =	parseInt(data_2)+parseInt(data1[14]);
						data_3 =	parseInt(data_3)+parseInt(data1[15]);
						data_4 =	parseInt(data_4)+parseInt(data1[16]);
						data_5 =	parseInt(data_5)+parseInt(data1[3]);
						data_6 =	parseInt(data_6)+parseInt(data1[4]);
						data_7 =	parseInt(data_7)+parseInt(data1[5]);
						data_8 =	parseInt(data_8)+parseInt(data1[6]);
						data_9 =	parseInt(data_9)+parseInt(data1[17]);
						data_10 =	parseInt(data_10)+parseInt(data1[18]);
						data_11 =	parseInt(data_11)+parseInt(data1[19]);
						data_12 =	parseInt(data_12)+parseInt(data1[20]);
						data_13 =	parseInt(data_13)+parseInt(data1[21]);
						data_14 =	parseInt(data_14)+parseInt(data1[22]);
						data_15 =	parseInt(data_15)+parseInt(data1[23]);
						
						
				
						
						
		            }
	            
				html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th id="total_data_0">'+data_0+'</th>'+ 			
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
				'<th id="total_data_11">'+data_11+'</th>'+  			
				'<th id="total_data_12">'+data_12+'</th>'+  			
				'<th id="total_data_13">'+data_13+'</th>'+  			
				'<th id="total_data_14">'+data_14+'</th>'+  			
				'<th id="total_data_15">'+data_15+'</th>'+  			
				'</tr></tfoot>';
	                html += '</table>';
		       

				$('#table_data1').html(html);
		      $("#wait").css("display", "none");

	   var msg = "Packer Entry List";
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
 	$(document).on('focusout','.unit',function(){
		var emp_id = $(this).attr('name');

		var addition = $('#addition'+emp_id).val();

		var unit1 = $('#unit1'+emp_id).val();
		var unit2 = $('#unit2'+emp_id).val();
		var unit3 = $('#unit3'+emp_id).val();
		var unit4 = $('#unit4'+emp_id).val();
		
		var rate1 = $('#rate1'+emp_id).html();
		var rate2 = $('#rate2'+emp_id).html();
		var rate3 = $('#rate3'+emp_id).html();
		var rate4 = $('#rate4'+emp_id).html();
		
				
		var wages1 = (unit1 * rate1);
		var wages2 = (unit2 * rate2);
		var wages3 = (unit3 * rate3);
		var wages4 = (unit4 * rate4);

		var wages = parseInt(wages1)+parseInt(wages2)+parseInt(wages3)+parseInt(wages4);
		$('#wages'+emp_id).html(wages);
	
		var weekly = parseInt(wages)/6;
		$('#weekly_leave'+emp_id).html(parseInt(weekly));
		
		var total = parseInt(wages)+parseInt(weekly)+parseInt(addition);
		$('#total'+emp_id).html(parseInt(total));
		
		
		var pf = (parseInt(total)*10)/100;
		$('#pf'+emp_id).html(Math.round(pf));

//		var pt = $('#pt'+emp_id).html();

get_grand_total();

	});	

		

 	$(document).on('focusout','.daysofwork',function(){
			get_grand_total();

	});	

  	$(document).on('focusout','.unit',function(){
		var emp_id = $(this).attr('name');
		var salary = $('#total'+emp_id).html();
		var pf = $('#pf'+emp_id).html();
		
		if(salary==0){
				$('#net_wages'+emp_id).html('0');
				$('#pt'+emp_id).html('0');
		}
				$.ajax({
                type : "POST",
				url  : baseurl+"Packingwages/get_ptax",
                dataType : "JSON",
                data : { salary:salary },
                success: function(data){
					
						var data1 = data.split("####");
						
						
			var pt = data1[0];
		$('#pt'+emp_id).html(parseInt(pt));
		$('#pt_id'+emp_id).html(parseInt(data1[1]));
		
			var net_wages = parseInt(salary)-(parseInt(pt)+parseInt(pf));
		$('#net_wages'+emp_id).html(parseInt(net_wages));
		
                }
            });
	});
	
	  	$(document).on('click','#search_month',function(){
		show_packer_entry();	//call function show all packingwages		
	});
		


  	$(document).on('click','#table_save',function(){
		
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			var msg = 0;
			var i = 0;
						var save_update =	$('#save_update').val();

			for (var i = 0; i < r; i++) {
				
			var emp_id = $(r1[i]).find('td:eq(0)').html();

			var member_name = $(r1[i]).find('td:eq(1)').html();
			var uan = $(r1[i]).find('td:eq(2)').html();
			
			var worked_days = $('#daysofwork'+emp_id).val();

			var unit1 = $('#unit1'+emp_id).val();
			var unit2 = $('#unit2'+emp_id).val();
			var unit3 = $('#unit3'+emp_id).val();
			var unit4 = $('#unit4'+emp_id).val();
			
			var month_year = $('#month_year').val();
			var addition = $('#addition'+emp_id).val();

			var pt_id = $('#pt_id'+emp_id).html();
			var pw_id = $('#pw_id'+emp_id).html();
			
			var total = $('#total'+emp_id).html();
			
			var ac1eemf = $('#ac1eemf'+emp_id).html();
			var ac1eemale = $('#ac1eemale'+emp_id).html();
			var ac10 = $('#ac10'+emp_id).html();
			
			var total_days = $('#total_days'+emp_id).html();
			var net_wages = $('#net_wages'+emp_id).html();
			
			var ncp_days =  $('#ncp_days'+emp_id).html();
			var total_no_of_days =  $('#total_no_of_days_'+emp_id).html();
			$.ajax({
				
                type : "POST",		
				url  : baseurl+"Packingwages/packers_entry_save",
                dataType : "JSON",
                data : {net_wages:net_wages,ac1eemale:ac1eemale,unit1:unit1,unit2:unit2,unit3:unit3,unit4:unit4,save_update:save_update,emp_id:emp_id,ncp_days:ncp_days,ac10:ac10,ac1eemf:ac1eemf,member_name:member_name ,uan:uan,worked_days:worked_days,month_year:month_year,addition:addition,pt_id:pt_id,pw_id:pw_id,total:total,total_no_of_days:total_no_of_days},
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
	

	
	function get_grand_total(){
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			var msg = 0;
			var i = 0;

			
			var total_data_0 = 0;
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
			var total_data_11 = 0;
			var total_data_12 = 0;
			var total_data_13 = 0;
			var total_data_14 = 0;
			var total_data_15 = 0;
			
			
			for (var i = 0; i < r; i++) {
			var emp_id = $(r1[i]).find('td:eq(0)').html();

			var data_0 = $('#daysofwork'+emp_id).val();
			var data_1 = $('#unit1'+emp_id).val();
			var data_2 = $('#unit2'+emp_id).val();
			var data_3 = $('#unit3'+emp_id).val();
			var data_4 = $('#unit4'+emp_id).val();
			var data_5 = $('#rate1'+emp_id).html();
			var data_6 = $('#rate2'+emp_id).html();
			var data_7 = $('#rate3'+emp_id).html();
			var data_8 = $('#rate4'+emp_id).html();
			var data_9 = $('#addition'+emp_id).val();
			var data_10 = $('#wages'+emp_id).html();
			var data_11 = $('#weekly_leave'+emp_id).html();
			var data_12 = $('#total'+emp_id).html();
			var data_13 = $('#pf'+emp_id).html();
			var data_14 = $('#pt'+emp_id).html();
			var data_15 = $('#net_wages'+emp_id).html();
			
			
			total_data_0 = parseInt(total_data_0) + parseInt(data_0);
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
			total_data_11 = parseInt(total_data_11) + parseInt(data_11);
			total_data_12 = parseInt(total_data_12) + parseInt(data_12);
			total_data_13 = parseInt(total_data_13) + parseInt(data_13);
			total_data_14 = parseInt(total_data_14) + parseInt(data_14);
			total_data_15 = parseInt(total_data_15) + parseInt(data_15);
			}
		
			$('#total_data_0').html(total_data_0);
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
			$('#total_data_11').html(total_data_11);
			$('#total_data_12').html(total_data_12);
			$('#total_data_13').html(total_data_13);
			$('#total_data_14').html(total_data_14);
			$('#total_data_15').html(total_data_15);
			
			
		}
	
	
	
});