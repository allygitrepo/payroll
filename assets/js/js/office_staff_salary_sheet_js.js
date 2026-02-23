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
        }
    };
	
	
						show_packer_entry();	//call function show all packingwages
		
	
		function show_packer_entry(){
					var month_year = $('#month_year').val();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"officesalarysheet/officesalarysheet_show",
                data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
	var html = '<table id="example1" class="table table-striped table-bordered table-hover" style="font-Size:12px;table-layout: auto" cellspacing="0" width="100%">'+
    '<thead>'+
    '<tr>'+
	'<th style="max-width:10%;overflow: hidden;text-overflow: ellipsis;">SR NO.</th> '+ 			
	'<th style="white-space: nowrap;" >Employee Name</th>'+  			
	'<th style="whiteSpace:nowrap;" >Basic Salary</th>  	'+		
	'<th style="whiteSpace:nowrap;" >NO.Of Days Worked</th>  '+			
	'<th style="whiteSpace:nowrap;" >Holiday</th>  		'+	
	'<th style="whiteSpace:nowrap;" >Absent</th>  			'+
	'<th style="whiteSpace:nowrap;" >Additional</th>  		'+	
	'<th style="whiteSpace:nowrap;" >Total Amount</th>  			'+
	'<th style="whiteSpace:nowrap;" >PT</th>  			'+
	'<th style="whiteSpace:nowrap;" >PF</th>  			'+
	'<th style="whiteSpace:nowrap;" >Net Amount Paid</th>  			'+
	'<th style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" >Signature of The Employee</th>'+
	//'<th style="whiteSpace:nowrap;" >ER E.P.F</th>'+
	//'<th style="whiteSpace:nowrap;" >SHARE E.P.S</th>'+  			
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
					var data10 = 0;	
					var data11 = 0;	
					var data12 = 0;	
					var data13 = 0;	
					var data14 = 0;	
		            for(i=0; i<data.length; i++){
					var sr = i+1;
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
$('#month_year').val(data1[3]);					
//	            for(j=0;j<data1.length;j++){
		                html += '<tr>'+
								'<td>'+sr+'</td>'+	
	'<td   >'+data1[0]+'<br>Member Id:'+data1[2]+'<br>UAN:'+data1[1]+'</td>'+
								'<td>'+data1[4]+'</td>'+	
								'<td>'+data1[5]+'</td>'+	
								'<td>'+data1[6]+'</td>'+	
								'<td>'+data1[7]+'</td>'+	
								'<td>'+data1[8]+'</td>'+	
								'<td>'+data1[9]+'</td>'+	
								'<td>'+data1[10]+'</td>'+	
								'<td>'+data1[11]+'</td>'+	
								'<td>'+data1[12]+'</td>'+	
								'<td style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"></td>'+	
								//'<td>'+data1[13]+'</td>'+	
								//'<td>'+data1[14]+'</td>'+	
		                        '</tr>';
								
							
					data4	 = 	parseInt(data4)+parseInt(data1[4]);	
					data5	 = 	parseInt(data5)+parseInt(data1[5]);	
					data6	 = 	parseInt(data6)+parseInt(data1[6]);	
					data7	 = 	parseInt(data7)+parseInt(data1[7]);	
					data8	 = 	parseInt(data8)+parseInt(data1[8]);	
					data9	 = 	parseInt(data9)+parseInt(data1[9]);	
					data10 	=	parseInt(data10)+parseInt(data1[10]);	
					data11 	=	parseInt(data11)+parseInt(data1[11]);	
					data12 	=	parseInt(data12)+parseInt(data1[12]);	
					data13 	=	parseInt(data13)+parseInt(data1[13]);	
					data14 	=	parseInt(data14)+parseInt(data1[14]);	
						var msgtop = "COMPANY NAME : "+data1[15]+" , ADDRESS:  "+data1[16]+" , POSTOFFICE:  "+data1[17]+" , DISTRICT:  "+data1[18]+" , PINCODE:  "+data1[19];
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
	'<th  >'+data10+'</th>  			'+
	'<th  >'+data11+'</th>  			'+
	'<th  >'+data12+'</th>  			'+
	'<th  ></th>'+
	//'<th  >'+data13+'</th>'+
	//'<th  >'+data14+'</th>'+  			
	'</tr>'+
    '</tfoot>'+				
					'</table>';
		            $('#table_data1').html(html);
					
  						var month_year = $('#month_year').val();
						

	   var msg = "Office Staff Salary Sheet_"+month_year;
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
						extend: 'pdfHtml5',   className: 'btn-sm', title: msg,messageTop:msgtop,	footer: true,header: true, orientation: 'landscape',pageSize: 'A4',
				customize: function(doc) {
						doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
						doc.styles.tableHeader.fontSize = 8;
						doc.styles.tableFooter.fontSize = 8;
						doc.defaultStyle.alignment = 'center';
doc.content[2].table.widths = [ '2%', '20%', '5%', '5%', '5%', '5%', '6%', '5%', '4%', '4%', '5%', '25%', '5%', '5%'];
						
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