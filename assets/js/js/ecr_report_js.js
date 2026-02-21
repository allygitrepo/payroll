$(document).ready(function() {
	
						show_packer_entry();	//call function show all packingwages
		
	
		function show_packer_entry(){
					var month_year = $('#month_year').val();
					var pmrpy = $('#pmrpy').val();
		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"ecrreport/ecrreport_show",
                data : {month_year:month_year,pmrpy:pmrpy},
		        dataType : 'json',
		        success : function(data){
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
				'<th style="white-space:nowrap;">UAN</th>'+
				'<th style="white-space:nowrap;">Employee Name</th>'+
				'<th style="white-space:nowrap;">Gross Wages</th>'+  			
				'<th style="white-space:nowrap;">EPF Wages</th>'+  			
				'<th style="white-space:nowrap;">EPS Wages</th>'+  
				'<th style="white-space:nowrap;">EDLI Wages</th>'+  
				'<th style="white-space:nowrap;">EPF Contribution remitted</th>'+  			
				'<th style="white-space:nowrap;">EPS Contribution remitted</th>'+  			
				'<th style="white-space:nowrap;">EPF and EPS Diff remitted</th>'+
				'<th style="white-space:nowrap;">NCP Days</th>'+  			
				'<th style="white-space:nowrap;">Refund of Advances</th>'+  			
				'</tr></thead><tbody id="">';
		            var i;
							var gross = 0;				
							var epf = 0;				
							var eps = 0;				
							var edli = 0;				
							var epfcr = 0;				
							var epscr = 0;				
							var diff = 0;				
							var ncp = 0;				
							var refund = 0;				

		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");

					
$('#month_year').val(data1[12]);					
		                html += '<tr>'+
				'<td style="whiteSpace:nowrap;">'+data1[2]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[0]+'</td>'+
				'<td >'+data1[3]+'</td>'+
				'<td >'+data1[4]+'</td>'+
				'<td >'+data1[5]+'</td>'+
				'<td >'+data1[6]+'</td>'+
				'<td >'+data1[7]+'</td>'+
				'<td >'+data1[8]+'</td>'+
				'<td >'+data1[9]+'</td>'+
				'<td >'+data1[10]+'</td>'+
				'<td >'+data1[11]+'</td>'+
				                '</tr>';
		                        '</tr>';
								
								
							gross = parseInt(gross)+parseInt(data1[3]);				
							epf   = parseInt(epf)+parseInt(data1[4]);				
							eps   = parseInt(eps)+parseInt(data1[5]);				
							edli  = parseInt(edli)+parseInt(data1[6]);				
							epfcr = parseInt(epfcr)+parseInt(data1[7]);				
							epscr = parseInt(epscr)+parseInt(data1[8]);				
							diff  = parseInt(diff)+parseInt(data1[9]);				
							ncp   = parseInt(ncp)+parseInt(data1[10]);				
						refund    = parseInt(refund)+parseInt(data1[11]);				
								
		            }
					
					html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th ></th>'+
				'<th >'+gross+'</th>'+  			
				'<th >'+epf+'</th>'+  			
				'<th >'+eps+'</th>'+  
				'<th >'+edli+'</th>'+  
				'<th >'+epfcr+'</th>'+  			
				'<th >'+epscr+'</th>'+  			
				'<th >'+diff+'</th>'+
				'<th >'+ncp+'</th>'+  			
				'<th >'+refund+'</th>'+  			
				'</tr></tfoot>';
	                html += '</table>';
		            $('#table_data1').html(html);
						var month_year = $('#month_year').val();
				
	   var msg = "ECR Report_"+month_year;
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
            {extend: 'excel', className: 'btn-sm',filename:msg,title:null  },
        ]
    });
					
		        }

		    });
		}
 	
	$(document).on('click','#btn_insert',function(){
		show_packer_entry();
        });
	
});