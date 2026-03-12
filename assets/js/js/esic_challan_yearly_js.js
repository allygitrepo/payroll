$(document).ready(function() {
	
	var	month_year = $('#month_year').val((new Date()).getFullYear());
 
	show_esicchallanyearly();			
	function show_esicchallanyearly(){
		var	month_year = $('#month_year').val();
		    $.ajax({
		        type  : 'post',
				url  : baseurl+"esicchallanyearly/show_esicchallanyearly",
		        data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
					
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead><tr><th>For The Month Of</th>'+	
		"<th>Employee Share Rs.</th>"+  			
		'<th>Employer Share Rs.</th>'+  			
		'<th>Challan Number</th>'+  			
		'<th>Actual Date of Payment</th>'+  			
	'</tr>'+
		'</thead><tbody>';
		            var i;
		            for(i=0; i<data.length; i++){
                        var data1 = data[i].split("####");
                        
                        html += '<tr>';
                        html += '<td>'+data1[0]+'</td>';
                        html += '<td><input type="number" class="form-control" value="'+data1[1]+'" style="width:100px;"></td>';
                        html += '<td><input type="number" class="form-control" value="'+data1[2]+'" style="width:100px;"></td>';
                        html += '<td><input type="text" class="form-control" value="'+(data1[3] ? data1[3] : '')+'"></td>';
                        html += '<td><input type="text" class="form-control esic_date" value="'+(data1[4] ? data1[4] : '')+'"></td>';
                        html +='</tr>';					
					}	
		            
	                html += '</tbody></table>';
		            $('#table_data1').html(html);

                    $('.esic_date').datetimepicker({format:"DD/MM/YYYY",});

  	   var msg = "ESIC Challan Yearly";
    $('#example1').dataTable({
       'bDestroy': true,
        'paging':   false,  // Table pagination
        'ordering': false,  // Column ordering
        'info':     true,  // Bottom left status text
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

	$(document).on('click','#btn_insert',function(){
		show_esicchallanyearly();			
		});
});
