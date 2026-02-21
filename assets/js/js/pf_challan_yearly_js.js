$(document).ready(function() {
	
/*---------view packingwages list start-----------------*/
		var	month_year = $('#month_year').val((new Date()).getFullYear());
 
	show_professionaltax();			
	function show_professionaltax(){
		var	month_year = $('#month_year').val();
		    $.ajax({
		        type  : 'post',
				url  : baseurl+"pfchallanyearly/show_pfchallanyearly",
		        data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
					
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead><tr><th>For The Month Of</th>'+	
		"<th>Employee's Share Rs.</th>"+  			
		'<th>Employer Share Rs.</th>'+  			
		'<th>Due date of Payment</th>'+  			
		'<th>Actual Date of Payment</th>'+  			
	'</tr>'+
		'</thead><tbody>';
		            var i;
					var total1=0;
					var total2=0;
var count = 0; 
//	$row =  $dt->format("F").'####'.$from.'####'.$to.'####'.$tax_rate.'####'.$year;
		            for(i=0; i<data.length; i++){
												var data1 = data[i].split("####");
					if(data1[3]!=""){
					var fromdate = data1[3];
					var fdateAr = fromdate.split('-');
					var due_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
	
						}
						else{
							var due_date = "";
							}
					if(data1[4]!=""){
					var fromdate = data1[4];
					var fdateAr = fromdate.split('-');
					var challan_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
	
						}
						else{
							var challan_date = "";
							}

															html += '<tr>';
															html += '<td>'+data1[0]+'</td>';
															html += '<td>'+data1[1]+'</td>';
															html += '<td>'+data1[2]+'</td>';
															html += '<td>'+due_date+'</td>';
															html += '<td>'+challan_date+'</td>';
															html +='</tr>';					
															
						if(data1[1]!=""){
						total1 = parseInt(total1)+parseInt(data1[1]);																
						}
						if(data1[2]!=""){
						total2 = parseInt(total2)+parseInt(data1[2]);									
						}	
					}	
		            
	html += '</tbody><tfoot><tr>'+
				'<th>Total </th>'+
				'<th>'+total1+'</th>'+ 			
				'<th>'+total2+'</th>'+		
				'<th></th>'+
				'<th></th>'+
				'</tr></tfoot>';
	                html += '</table>';
		            $('#table_data1').html(html);
//					var year = $('#month_year').val();
//					var year1 = parseInt(year)+parseInt(1);
//	   var msg = "Professional Tax Report -"+year+"-"+year1;

 	   var msg = "PF Challan Yearly";
    $('#example1').dataTable({
       'bDestroy': true,
        'paging':   false,  // Table pagination
        'ordering': false,  // Column ordering
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


	$(document).on('click','#btn_insert',function(){
		show_professionaltax();			
		});


	
});

