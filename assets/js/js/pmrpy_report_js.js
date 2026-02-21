$(document).ready(function() {
	
						show_packer_entry();	//call function show all packingwages
		
	
		function show_packer_entry(){
					var month_year = $('#month_year').val();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"pmrpyreport/pmrpyreport_show",
                data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
				'<th style="white-space:nowrap;">UAN</th>'+
				'<th style="white-space:nowrap;">Aadhaar No.</th>'+
				'<th style="white-space:nowrap;">Gross Wages</th>'+  			
				'<th style="white-space:nowrap;">Job Description Id </th>'+  			
				'</tr></thead><tbody id="">';
		            var i;
							var gross = 0;				

		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");

					
$('#month_year').val(data1[5]);					
		                html += '<tr>'+
				'<td style="whiteSpace:nowrap;">'+data1[2]+'</td>'+
				'<td style="whiteSpace:nowrap;">'+data1[3]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[4]+'</td>'+
				'<td >80</td>'+
				                '</tr>';
		                        '</tr>';
								
						gross = parseInt(gross)+parseInt(data1[4]);				
								
		            }
					
					html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th ></th>'+
				'<th >'+gross+'</th>'+  			
				'<th ></th>'+
				'</tr></tfoot>';
	                html += '</table>';
		            $('#table_data1').html(html);
						var month_year = $('#month_year').val();
				
	   var msg = "PMRPY Report_"+month_year;
//	      $('#example1').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
 
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
        dom: 'Bfrtip',
        buttons: [
            {extend: 'excelHtml5', title: null, footer: false		},
        ]
    });
					
		        }

		    });
		}
 	
	$(document).on('click','#btn_insert',function(){
		show_packer_entry();
        });
	
});