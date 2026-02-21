$(document).ready(function() {
	
	
	
	 var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 1 ?
//                        data.replace( /[$,]/g, '' ) :
  data.replace( /<br\s*\/?>/ig, "\n" ) :
				data;
                }
            },
			 columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16 ]
        }
    };
	
	
						show_packer_entry();	//call function show all packingwages
		
	
		function show_packer_entry(){
					var month_year = $('#month_year').val();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"packersalarysheet/packersalarysheet_show",
                data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
	var html = '<table id="example1" class="table table-striped table-bordered table-hover" style="font-Size:12px;" cellspacing="0" width="100%">'+
    '<thead>'+
    '<tr>'+
	'<th style="max-width:5px;">SR NO.</th>'+  			
	'<th style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">Name of Employee</th> '+ 			
	'<th  style="max-width:20px;">No. of working Day	</th>'+  			
	'<th>Unit-1</th>  		'+	
	'<th>Unit-2</th>  			'+
	'<th>Unit-3</th>  			'+
	'<th>Unit-4</th>  			'+
	'<th>Total wages</th>  		'+	
	'<th>Extra payment </th>  			'+
	'<th>Holiday payment</th>  			'+
	'<th>Total Gross Amount</th>  			'+
	'<th>PT</th>  			'+
	'<th>PF</th>  			'+
	'<th>Net Amount Payable</th>  			'+
	'<th style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"  >Signature of The Employee</th>'+
	'<th>ER E.P.F</th>'+
	'<th>SHARE E.P.S</th>'+  			
    '</tr>'+
    '</thead>'+
    '<tbody>';
		            var i;
					var data4 = 0;	
					var data5 = 0;	
					var data6 = 0;	
					var data7 = 0;	
					var data8 = 0;	
					var data9 = 0;	
					var data13 = 0;	
					var data14 = 0;	
					var data15 = 0;	
					var data16 = 0;	
					var data17 = 0;	
					var data18 = 0;	
					var data19 = 0;	
					var data20 = 0;	
					
					var total_wages = 0;
		            for(i=0; i<data.length; i++){
					var sr = i+1;
			console.log(data[i]);			
			var data1 = data[i].split("####");
				total_wages = parseInt(data1[9])+parseInt(data1[10])+parseInt(data1[11])+parseInt(data1[12]);	
$('#month_year').val(data1[3]);					
		                html += '<tr>'+
								'<td>'+sr+'</td>'+	
	'<td  " >'+data1[0]+'<br/>Member Id:'+data1[2]+'<br/>UAN:'+data1[1]+'</td>'+
								'<td>'+data1[4]+'</td>'+	
								'<td style="white-space: nowrap;">'+data1[5]+' X '+data1[21]+'</td>'+	
								'<td style="white-space: nowrap;">'+data1[6]+' X '+data1[22]+'</td>'+	
								'<td style="white-space: nowrap;">'+data1[7]+' X '+data1[23]+'</td>'+	
								'<td style="white-space: nowrap;">'+data1[8]+' X '+data1[24]+'</td>'+	
								'<td>'+total_wages+'</td>'+	
								'<td>'+data1[13]+'</td>'+	
								'<td>'+data1[14]+'</td>'+	
								'<td>'+data1[15]+'</td>'+	
								'<td>'+data1[16]+'</td>'+	
								'<td>'+data1[17]+'</td>'+	
								'<td>'+data1[18]+'</td>'+	
								'<td style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" ></td>'+	
								'<td>'+data1[19]+'</td>'+	
								'<td>'+data1[20]+'</td>'+	
		                        '</tr>';
								
								
   						data4 = parseInt(data4)+parseInt(data1[4]);				
						data5 = parseInt(data5)+parseInt(data1[5]);				
						data6 = parseInt(data6)+parseInt(data1[6]);				
						data7 = parseInt(data7)+parseInt(data1[7]);				
						data8 = parseInt(data8)+parseInt(data1[8]);				
						data9 = parseInt(data9)+parseInt(total_wages);				
   						data13 = parseInt(data13)+parseInt(data1[13]);				
						data14 = parseInt(data14)+parseInt(data1[14]);				
						data15 = parseInt(data15)+parseInt(data1[15]);				
						data16 = parseInt(data16)+parseInt(data1[16]);				
						data17 = parseInt(data17)+parseInt(data1[17]);				
						data18 = parseInt(data18)+parseInt(data1[18]);				
						data19 = parseInt(data19)+parseInt(data1[19]);				
						data20 = parseInt(data20)+parseInt(data1[20]);				
								var msgtop = "COMPANY NAME : "+data1[25]+" , ADDRESS:  "+data1[26]+" , POSTOFFICE:  "+data1[27]+" , DISTRICT:  "+data1[28]+" , PINCODE:  "+data1[29];
		
		            }
		                html += '</tbody>'+
	    '<tfoot>'+
    '<tr>'+
	'<th></th><th  ><b>Total<b></th>'+  			
	'<th  >'+data4+'</th>  	'+		
	'<th  >'+data5+'</th>  '+			
	'<th  >'+data6+'</th>  		'+	
	'<th  >'+data7+'</th>  			'+
	'<th  >'+data8+'</th>  		'+	
	'<th  >'+data9+'</th>  			'+
	'<th  >'+data13+'</th>  	'+		
	'<th  >'+data14+'</th>  '+			
	'<th  >'+data15+'</th>  		'+	
	'<th  >'+data16+'</th>  			'+
	'<th  >'+data17+'</th>  		'+	
	'<th  >'+data18+'</th>  			'+
	'<th  style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"  ></th>  			'+
	'<th  >'+data19+'</th>  			'+
	'<th  >'+data20+'</th>  			'+
	'</tr>'+
    '</tfoot></table>';				
	
	

		            $('#table_data1').html(html);
						var month_year = $('#month_year').val();
					
	   var msg = "Packers Salary Sheet_"+month_year;
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
		
		columnDefs: [
//           { width: 200, targets: 17 }
       ],
		
		
		
        // Datatable Buttons setup
        dom: 'Bfrtip',
        buttons: [
/*            {extend: 'pdfHtml5',   className: 'btn-sm', title: msg,footer: true, orientation: 'landscape',pageSize: 'A4',

				customize: function(doc) {
						doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
	//				 doc.defaultStyle.margin= [ 10, 10, 10, 10 ];
		//			 doc.defaultStyle.align= 'left';
				},
				   exportOptions: {
//                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
						columns: ':visible',
		
				},
				
				
			},
*/
	$.extend( true, {}, buttonCommon, {
						extend: 'pdfHtml5',   className: 'btn-sm', title: msg,messageTop:msgtop,footer: true,header: true, orientation: 'landscape',pageSize: 'A4',
				customize: function(doc) {
						doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
						doc.styles.tableHeader.fontSize = 8;
						doc.styles.tableFooter.fontSize = 8;
						doc.defaultStyle.alignment = 'center';

//doc.content[1].table.widths = [ '2%', '25%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '50%', '5%', '5%'];
			
							}
  				
				})				
        ],
		
		defaultStyle: {
       fontSize: 8
   }
    });
				
		        }

		    });
		}
 	



 	
	  	$(document).on('click','#search_month',function(){
		show_packer_entry();	//call function show all packingwages		
	});
		

	
});