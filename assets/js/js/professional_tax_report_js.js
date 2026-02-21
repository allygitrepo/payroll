$(document).ready(function() {
	
		
	
/*---------view packingwages list start-----------------*/

	show_professionaltax();			
		function show_professionaltax(){
		var	month_year = $('#month_year').val();
		    $.ajax({
		        type  : 'post',
				url  : baseurl+"professionaltax/show_professionaltax_report",
		        data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
					
					
		            var html = '<table id="example1" class="tb2excel  table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead>'+
		'<tr>'+
		'<th colspan="6" id="title_msg" style="font-size:22px;text-align:center;" ></th>'+  			
		'</tr>'+
		'<tr><th>From</th>'+	
		'<th>To</th>'+  			
		'<th >Month</th>'+  			
		'<th>Tax Rate</th>'+  			
		'<th>No of employee</th>'+  			
		'<th>Tax Amount</th>'+   			
	'</tr>'+
		'</thead><tbody>';
		            var i;
					var total=0;
var count = 0; 
var n = data.length-1;
		            for(i=0; i<data.length; i++){
						
												console.log(data[i]);			
												var data1 = data[i].split("####");
						if(month_day == data1[0]){
							
							total = parseInt(total)+parseInt(data1[6]);			
							count = count+1;	
						}
						else{

						
						if(i>1){
								html += '<tr><td></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ><b>Total : </b></td>'+
																	'<td ><b>'+total+'</b></td></tr>';
								html += '<tr>'+
																	'<td></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td></tr>';
							
						}
							
														count=0;
							total=0;
							total = parseInt(total)+parseInt(data1[6]);
							count = count+1;	
						}
						
												$('#month_year').val(data1[4]);	
//alert(data1[4]);												
															html += '<tr>'+
																	'<td>'+data1[1]+'</td>'+
																	'<td >'+data1[2]+'</td>'+
																	'<td ><b>'+data1[0]+'</b></td>'+
																	'<td >'+data1[3]+'</td>'+
																	'<td >'+data1[5]+'</td>'+
																	'<td >'+data1[6]+'</td>';
															//		if(total==0){
						//				html += '<td  >'+total+'</td>';																	
																//	}
																	html +='</tr>';
							var month_day = data1[0];
					if(i==n){
							
								if(i>1){
								html += '<tr><td></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ><b>Total : </b></td>'+
																	'<td ><b>'+total+'</b></td></tr>';
								html += '<tr>'+
																	'<td></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td>'+
																	'<td ></td></tr>';
							
						}
							
														count=0;
							total=0;
							total = parseInt(total)+parseInt(data1[6]);
							count = count+1;	
						
						}
						
						}	
		            
				      html += '</tbody></table>';
		            $('#table_data1').html(html);
					var year = $('#month_year').val();
					var year1 = parseInt(year)+parseInt(1);
	   var msg = "Professional Tax Report -"+year+"-"+year1;
		            $('#title_msg').html(msg);
	   
//	    $('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
 
     var table = $('#example1').DataTable({
       "ordering": false,
		"paging": false,
		 "searching": false,
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="6"  class="danger">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
        }
//	
    });
	


 

				
		        }

		    });
		}
/*---------view packingwages list end-----------------*/


	$(document).on('click','#btn_insert',function(){
			show_professionaltax();			
    });


	
});

