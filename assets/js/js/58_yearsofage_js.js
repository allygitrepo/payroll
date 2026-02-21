$(document).ready(function() {
	
//alert('ok');

/*---------view 58 years old list start-----------------*/

	show_58yearsoldemployee();	//call function show all list
		
	
		function show_58yearsoldemployee(){
		
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"reportcontroller/show_58yearsold_list",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>SR .NO.</th> <th>Name</th><th>Member Id</th><th>UAN</th><th>Date Of Birth </th><th>Type of Employee</th><th>Contractor Name</th></tr></thead><tbody>';
		            var i;
		            for(i=0; i<data.length; i++){
					
		
			
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					
					var fromdate = data1[4];
					var fdateAr = fromdate.split('-');
					var dob = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					console.log(dob);
					
					var sr = i+1;
		                html += '<tr>'+
               		'<td>'+sr+'</td>';
			html += '<td>'+data1[1]+'</td>';	
			html += '<td>'+data1[2]+'</td>';	
			html += '<td>'+data1[3]+'</td>';	
			html += '<td>'+dob+'</td>';	
			html += '<td>'+data1[5]+'</td>';	
			html += '<td>'+data1[6]+'</td>';									
			html += '</tr>';	
		
					}
	                html += '</tbody></table>';
		            $('#58yearsoldemployee').html(html);
					
					
					
  
   var msg = "58 Years of Age List";
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
/*---------view 58 years old list start-----------------*/



	
});