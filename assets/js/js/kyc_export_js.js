$(document).ready(function() {

/*---------insert address  start-----------------*/
//        $('#btn_save').on('submit',function(e){
//	$("#btn_save").submit(function() {
//				e.preventDefault();
		
    $(document).on("submit","#kyc_export_form",function(e){
			e.preventDefault();
			  $("#wait").css("display", "block");
			
			
			var startdate = $('#startdate').val();
		var tdateAr = startdate.split('/');
		var startdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(startdate);		

            var enddate = $('#enddate').val();
		var tdateAr = enddate.split('/');
		var enddate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(enddate);		
			
			$.ajax({
                type : "POST",
				url  : baseurl+"employee/show_kyc_export",
                dataType : "JSON",
                data : {enddate:enddate,startdate:startdate },
                success: function(data){
	            $('#show_kyc_export_list').html('');
				
				 var html = '';
				html += '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th style="white-space:nowrap;" >SR .NO.</th>'+
				'<th style="white-space:nowrap;" >Employee Name</th>'+
				'<th style="white-space:nowrap;" >Universal Account NUMBER (UAN)</th>'+
				'<th style="white-space:nowrap;" >KYC Type Code</th>'+
				'<th style="white-space:nowrap;" >KYC Document Number</th>'+
				'<th style="white-space:nowrap;" >Name as on KYC document</th>'+
				'<th style="white-space:nowrap;" >IFSC</th>'+
				'<th style="white-space:nowrap;" >Expiry Date</th></tr></thead><tbody >';
				var i;
		            for(i=0; i<data.length; i++){
				var doc_code = "";
			if(data[i].doc_type == "DRIVING LICENSE"){   doc_code="D";}
		else if(data[i].doc_type == "BANK"){			 doc_code="B"; }
		else if(data[i].doc_type == "PAN"){				 doc_code="P"; }
		else if(data[i].doc_type == "ELECTION CARD"){	 doc_code="E"; }
		else if(data[i].doc_type == "RATION CARD"){ 	 doc_code="R"; }
		else if(data[i].doc_type == "NATIONAL POPULATION REGISTER"){  doc_code="N"; }
		else if(data[i].doc_type == "AADHAAR CARD"){  doc_code ="A"; 	}

					
					var sr = i+1;
		                html += '<tr><td>'+sr+'</td>'+
						'<td>'+data[i].name_as_aadhaar+'</td>'+
						'<td>'+data[i].UAN+'</td>'+
						'<td>'+doc_code+'</td>'+
						'<td >'+data[i].doc_num+'</td>'+
						'<td>'+data[i].doc_name+'</td>'+
						'<td>'+data[i].ifsc+'</td>'+
						'<td></td></tr>';
		            }
					html += '</tbody></table>';
		            $('#show_kyc_export_list').append(html);
					$('#startdate').val('');
					$('#enddate').val('');
		//	alert(html);
					
					
var msg = "Kyc Data Export";
  $("#wait").css("display", "none");
    $('#example1').dataTable({
		'scrollX': true,
		'bDestroy': true,
        'paging':   true,  // Table pagination
//        'ordering': true,  // Column ordering
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
            {extend: 'copy',  className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'csv',   className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'excel', className: 'btn-sm',title:null,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'pdf',   className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
        ]
    });
  			
	
                }
            });
            return false;

			 
				   
		    });
			
     
		show_today_kyc_export();
		
		
		
		function show_today_kyc_export(){
		
			var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = yyyy+'-'+mm+'-'+dd;
//document.getElementById("DATE").value = today;
//	alert(today);
			
		
		
		var startdate = today;
            var enddate = today;
			
//			alert(today);
					$('#startdate').val(startdate);
					$('#enddate').val(enddate);

			$.ajax({
                type : "POST",
				url  : baseurl+"employee/show_kyc_export",
                dataType : "JSON",
                data : {enddate:enddate,startdate:startdate },
                success: function(data){
//					alert(data);
	            $('#show_kyc_export_list').html('');
				
				 var html = '';
				html += '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th style="white-space:nowrap;" >SR .NO.</th>'+
				'<th style="white-space:nowrap;" >Employee Name</th>'+
				'<th style="white-space:nowrap;" >Universal Account NUMBER (UAN)</th>'+
				'<th style="white-space:nowrap;" >KYC Type Code</th>'+
				'<th style="white-space:nowrap;" >KYC Document Number</th>'+
				'<th style="white-space:nowrap;" >Name as on KYC document</th>'+
				'<th style="white-space:nowrap;" >IFSC</th>'+
				'<th style="white-space:nowrap;" >Expiry Date</th></tr></thead><tbody >';
				var i;
		            for(i=0; i<data.length; i++){
				var doc_code = "";
			if(data[i].doc_type == "DRIVING LICENSE"){   doc_code="D";}
		else if(data[i].doc_type == "BANK"){			 doc_code="B"; }
		else if(data[i].doc_type == "PAN"){				 doc_code="P"; }
		else if(data[i].doc_type == "ELECTION CARD"){	 doc_code="E"; }
		else if(data[i].doc_type == "RATION CARD"){ 	 doc_code="R"; }
		else if(data[i].doc_type == "NATIONAL POPULATION REGISTER"){  doc_code="N"; }
		else if(data[i].doc_type == "AADHAAR CARD"){  doc_code ="A"; 	}

					
					var sr = i+1;
		                html += '<tr><td>'+sr+'</td>'+
						'<td>'+data[i].name_as_aadhaar+'</td>'+
						'<td>'+data[i].UAN+'</td>'+
						'<td>'+doc_code+'</td>'+
						'<td >'+data[i].doc_num+'</td>'+
						'<td>'+data[i].doc_name+'</td>'+
						'<td>'+data[i].ifsc+'</td>'+
						'<td></td></tr>';
		            }
					html += '</tbody></table>';
		            $('#show_kyc_export_list').append(html);
//					$('#startdate').val('');
//					$('#enddate').val('');
		//	alert(html);
					
					
var msg = "Kyc Data Export";
    $('#example1').dataTable({
		'scrollX': true,
		'bDestroy': true,
        'paging':   true,  // Table pagination
//        'ordering': true,  // Column ordering
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
            {extend: 'copy',  className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'csv',   className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'excel', className: 'btn-sm',title:null,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
            {extend: 'pdf',   className: 'btn-sm', title: msg,exportOptions: {
                    columns: [ 2,3,4,5,6,7]
                } },
        ]
    });
  			
	
                }
            });
  		 
							
	
  		
		
		
		}
	 
	
});