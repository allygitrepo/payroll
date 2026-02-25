$(document).ready(function() {
	
	show_esic_report();	//call function show ESIC report
		
	
	function show_esic_report(){
		var month_year = $('#month_year').val();
		
		$.ajax({
			type  : 'POST',
			url  : baseurl+"esicreport/esicreport_show",
			data : {month_year:month_year},
			dataType : 'json',
			success : function(data){
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" style="font-size:12px;" cellspacing="0" width="100%">'+
				'<thead>'+
				'<tr>'+
				'<th style="white-space:nowrap;">IP Number<br>(10 Digits)</th>'+
				'<th style="white-space:nowrap;">IP Name<br>(Only alphabets and space)</th>'+
				'<th style="white-space:nowrap;">No of Days for which wages<br>paid/payable during the month</th>'+  			
				'<th style="white-space:nowrap;">Total Monthly Wages</th>'+  			
				'<th style="white-space:nowrap;">Reason Code for Zero working<br>days(numeric only, provide 0 for all<br>other reasons- Click on the link for<br>reference)</th>'+
				'<th style="white-space:nowrap;">Last Working Day<br>(Format DD/MM/YYYY or<br>DD-MM-YYYY)</th>'+  			
				'</tr>'+
				'</thead>'+
				'<tbody>';
				
				var i;
				var total_days = 0;				
				var total_wages = 0;				

				for(i=0; i<data.length; i++){
					
					console.log(data[i]);			
					var data1 = data[i].split("####");

					$('#month_year').val(data1[6]);					
					
					html += '<tr>'+
					'<td style="white-space:nowrap;">'+data1[0]+'</td>'+
					'<td style="white-space:nowrap;">'+data1[1]+'</td>'+
					'<td>'+data1[2]+'</td>'+
					'<td>'+data1[3]+'</td>'+
					'<td>'+data1[4]+'</td>'+
					'<td>'+data1[5]+'</td>'+
					'</tr>';
					
					total_days = parseInt(total_days)+parseInt(data1[2]);				
					total_wages = parseInt(total_wages)+parseInt(data1[3]);				
				}
				
				html += '</tbody>'+
				'<tfoot>'+
				'<tr>'+
				'<th>Total</th>'+
				'<th></th>'+
				'<th>'+total_days+'</th>'+  			
				'<th>'+total_wages+'</th>'+  			
				'<th></th>'+
				'<th></th>'+  			
				'</tr>'+
				'</tfoot>'+
				'</table>';
				
				$('#table_data1').html(html);
				var month_year = $('#month_year').val();
			
				var msg = "ESIC Report_"+month_year;
				$('#example1').dataTable({
					'bDestroy': true,
					'paging':   true,  // Table pagination
					'ordering': true,  // Column ordering
					'info':     true,  // Bottom left status text
					// Text translation options
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
						{extend: 'excel', className: 'btn-sm', filename:msg, title:null}
					]
				});
				
			}

		});
	}
 	
	$(document).on('click','#btn_insert',function(){
		show_esic_report();
	});
	
});
