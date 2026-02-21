$(document).ready(function(){
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
		            var i;
		                html += '<option value="all" selected >All </option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].contractor_id+'" >'+data[i].contractor_name+'</option>';
		            }
		            $('#contractor1').html(html);					
				}
					
				});
		}

		
		
/*---------view contracor list end-----------------*/
    $(document).on("focusout",".month_year",function(){
			var month_year = $('#month_year').val();
			get_all_date(month_year);
	});

    $(document).on("click","#btn_insert",function(){
					  $("#wait").css("display", "block");

			var month_year = $('#month_year').val();
	       var days = $('#daysofmonth').val();
	          var contractor = $('#contractor1').val();
			//var days = ;	//call get_all_date of given month
			$.ajax({
                type : "POST",
				url  : baseurl+"Attandanceprinting/print_attendance_sheet",
                dataType : "JSON",
                data : {month_year:month_year,contractor1:contractor},
                success: function(data){	
					
						


	$('#attandance_list').html('');

				 var html = '';
				var i;
				var count_span = parseInt(days)+parseInt(4);
html += '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
html += '<thead style="display:table-header-group;"><tr><th style="white-space:nowrap;" >SR .NO.</th>'+
		'<th style="white-space:nowrap;" >Contractor Name</th>'+
		'<th style="white-space:nowrap;" >Employee Name</th>';

				for(k=1; k<=days;k++){
					if(k<10){
						               html += '<th>0'+k+'</th>';
						
					}
					else{
						               html += '<th>'+k+'</th>';
						
					}
		            }		
				html += '<th>Total Days Of Work</th></tr>';
				
				html += '</thead><tbody >';
		            for(i=0; i<data.length; i++){
						
			console.log(data[i]);			
			var data1 = data[i].split("####");
						
						var sr = i+1;
							html += '<tr><td>'+sr+'</td><td>'+data1[1]+'</td><td>'+data1[2]+'</td>';
						var j = 1;	
						for(j=1; j<=days;j++){
						var row = 1;	
							
						day1 = j+'-'+month_year;
						var datelist = data1[3].split('*');
						var c = 1;
						for(c=1;c<datelist.length;c++)
						{
				 
						 var tdateAr = datelist[c].split('-');
						 var tdateAr1 = tdateAr[2];
				 
							if(tdateAr1==j){
								row = 2;		
							}
						}	
								
						if(row==1){
		                html += '<td></td>';															
						}
						else{
			
							html += '<td class="td" style="background-color:red;font-size:20px;" >*</td>';
//				                    $('.td').css('background-color', 'Red');
						}
						
						}
		                html += '<td></td></tr>';
		            }
					html += '</tbody></table>';
		            $('#attandance_list').append(html);
					
					
	
					
	
					
					
					
var contracor_name = $("#contractor1 option:selected").text();
			var month_year = $('#month_year').val();
			  $("#wait").css("display", "none");

var msg = "Attendance Sheet_"+month_year+'\n\r  Contractor :'+contracor_name;
//alert(contracor_name);
var msgt = contracor_name;
    $('#example1').dataTable({
		'scrollX': true,
		'bDestroy': true,
        'paging':   true,  // Table pagination
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
   "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="'+count_span+'"  class="danger">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
        },		
        // Datatable Buttons setup
    
	
	     
	
	
	
	
	
	
	});
					
			

			
			
	
                }
            });
			
			
			
			
			
	    });
			

		function get_all_date(month){
			var month = month;
				$.ajax({
                type : "POST",
				url  : baseurl+"Attandanceprinting/get_all_date",
                data : {month:month},
		        dataType : 'json',
		        success : function(data){
		            $('#daysofmonth').val(data);					
					}				
				});
				
		}
});