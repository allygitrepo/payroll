$(document).ready(function() {
	
/*---------view notes list start-----------------*/

	show_3monthabsentlist();	//call function show all packingwages
		
	
		function show_3monthabsentlist(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"monthabsentlist/show_monthabsentlist",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
					'<th>Sr. No.</th>'+
					'<th>Name</th>'+
					'<th>Member Id</th>'+
					'<th>UAN</th>'+
					'<th>DOB</th>'+
					'<th>Type Of Employee</th>'+
					'<th>Contactor Name</th>'+
					'</tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
//					var fromdate = data[i].dob;

					var data1 = data[i].split('####');
					
//					var note_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					//console.log(note_date);
				
				if(data1[3]!=""){
					var fromdate = data1[3];
					var fdateAr = fromdate.split('-');
					var dob_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
	
						}
						else{
							var dob_date = "";
							}

					
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                  		'<td>'+data1[0]+'</td>'+
		                  		'<td>'+data1[1]+'</td>'+
		                  		'<td>'+data1[2]+'</td>'+
		                  		'<td>'+dob_date+'</td>'+
		                  		'<td>'+data1[4]+'</td>'+
		                  		'<td>'+data1[5]+'</td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_absentlist').html(html);
					
					
					
  
	   var msg = "3 Month Absent List";
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
/*---------view packingwages list end-----------------*/

	
});