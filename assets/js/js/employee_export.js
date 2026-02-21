$(document).ready(function(){

show_employee();

			function show_employee(){
				        $("#wait").css("display", "block");

					            $('#employee_data').html('');
					        
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"employee/show_employee_export",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead>'+
		    '<tr>'+
		'<th style="white-space:nowrap;">UAN</th>'+  			 
		'<th style="white-space:nowrap;">Previous Member Id</th>'+  			
		'<th style="white-space:nowrap;">Member Name</th>'+  			
		'<th style="white-space:nowrap;">Date Of Birth</th>'+  			
		'<th style="white-space:nowrap;">DateOfJoining</th>  '+			
		'<th style="white-space:nowrap;">Gender</th>  			'+
		'<th style="display:none;">Gender</th>  			'+
		'<th style="white-space:nowrap;">Father/Husband Name</th> '+ 			
		'<th style="white-space:nowrap;">Relationship with the Member</th>'+  			
		'<th style="display:none;">Relationship</th>  			'+
		'<th style="white-space:nowrap;">Mobile Number</th>  			'+
		'<th style="white-space:nowrap;">EmailId</th>  			'+
		'<th style="white-space:nowrap;">Nationality</th>  			'+
		'<th style="white-space:nowrap;">Wages as on Joining</th>  			'+
		'<th style="white-space:nowrap;">Qualification</th>  			'+
		'<th style="display:none;">Qualification</th>  			'+
		'<th style="white-space:nowrap;">Maritial Status</th>  			'+
		'<th style="display:none;">Maritial Status</th>  			'+
		'<th style="white-space:nowrap;">Is International Worker</th>  		'+	
		'<th style="white-space:nowrap;">County Of Origin</th>  			'+
		'<th style="white-space:nowrap;">Passport Number</th>  			'+
		'<th style="white-space:nowrap;">Passport Valid From Date</th>  	'+		
		'<th style="white-space:nowrap;">Passport Valid Till Date</th>  		'+	
		'<th style="white-space:nowrap;">Is Physical Handicap</th>  			'+
		'<th style="white-space:nowrap;">Locomotive</th>  			'+
		'<th style="white-space:nowrap;">Hearing</th>  			'+
		'<th style="white-space:nowrap;">Visual</th>  			'+
		'<th style="white-space:nowrap;">Employee Type</th>  		'+	
		'<th style="white-space:nowrap;">Bank Account Number</th>  		'+	
		'<th style="white-space:nowrap;">Bank IFSC</th>  			'+
		'<th style="white-space:nowrap;">Name as Per Bank Details</th>'+  			
		'<th style="white-space:nowrap;">Pan</th>  			'+
		'<th style="white-space:nowrap;">Name as on PAN</th>  '+			
		'<th style="white-space:nowrap;">AADHAAR Number</th>  	'+		
		'<th style="white-space:nowrap;">Name As On AADHAAR</th>  '+			
            '</tr>'+
        '</thead>'+
       '<tbody id="employee_list">';
		            var i;
					 for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					var sr = i+1;
		                html += '<tr>';
			html += '<td  >'+data1[1]+'</td>';	
			html += '<td>'+data1[2]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[30]+'</td>';

		var tdateAr = data1[3].split('-');
		var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(dob);		

		var tdateAr = data1[4].split('-');
		var doj = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(doj);		

		if(data1[17]=="0000-00-00"){
			data1[17]="";
		}
		else{
		var tdateAr = data1[17].split('-');
		var pvf = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvf);
			data1[17]=pvf;
		}
			
		if(data1[18]=="0000-00-00"){
			data1[18]="";
		}
		else{
		var tdateAr = data1[18].split('-');
		var pvt = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvt);
			data1[18]=pvt;
		}
			
			html += '<td style="width:5%;">'+dob+'</td>';	
			html += '<td style="width:5%;">'+doj+'</td>';	
								
	//gender code
	var gender = "";
	if(data1[5]=="MALE"){
		gender = "M";
		}
		else if(data1[5]=="FEMALE"){
		gender = "F";
		}
		else if(data1[5]=="TRANSGENDER"){
		gender = "T";
		}	
	
	
	//relation code
	var relation = "";
		if(data1[7]=="FATHER"){
		relation = "F";
		}
		else if(data1[7]=="HUSBAND"){
		relation = "H";
		}
	
	
	//marital status code
	var mstatus = "";
		if(data1[13]=="MARRIED"){
		mstatus = "M";
		}
		else if(data1[13]=="UNMARRIED"){
		mstatus = "U";
		}
		else if(data1[13]=="WIDOW/WIDOWER"){
		mstatus = "W";
		}
		else if(data1[13]=="DIVORCEE"){
		mstatus = "D";
		}
	
	//handicap code
	var relation = "";
		if(data1[7]=="FATHER"){
		relation = "F";
		}
		else if(data1[7]=="HUSBAND"){
		relation = "H";
		}

	//qualification code
	var qualification = "";
		if(data1[12]=="ILLITERATE"){
		qualification = "I";
		}
		else if(data1[12]=="LITERATE"){
		qualification = "L";
		}
		else if(data1[12]=="NON-MATRIC"){
		qualification = "N";
		}
		else if(data1[12]=="MATRIC"){
		qualification = "M";
		}
		else if(data1[12]=="SENIOR-SECONDARY"){
		qualification = "S";
		}
		else if(data1[12]=="GRADUATE"){
		qualification = "G";
		}
		else if(data1[12]=="POST-GRADUATE"){
		qualification = "P";
		}
		else if(data1[12]=="DOCTORATE"){
		qualification = "D";
		}
		else if(data1[12]=="TECHNICAL (PROFESSIONAL)"){
		qualification = "T";
		}
			html += '<td  style="white-space:nowrap;"  >'+data1[5]+'</td>';	
			html += '<td  style="display:none;"  >'+gender+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[6]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[7]+'</td>';	
			html += '<td  style="display:none;"  >'+relation+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[8]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[9]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[10]+'</td>';	
			html += '<td  style="white-space:nowrap;"  ></td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[12]+'</td>';	
			html += '<td  style="display:none;"  >'+qualification+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[13]+'</td>';	
			html += '<td  style="display:none;"  >'+mstatus+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[14]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[15]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[16]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[17]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[18]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[19]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[20]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[21]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[22]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[23]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[24]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[25]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[26]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[27]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[28]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[29]+'</td>';	
			html += '<td  style="white-space:nowrap;"  >'+data1[30]+'</td>';	

								
			html += '</tr>';
											
							
								
//	                      html +=  '<td>'+data[i].aadhaar_no+'</td>'+
//	                        '<td>'+data[i].name_as_aadhaar+'</td><tr>';
		            }
								html += '</tbody></table>';

		            $('#employee_data').append(html);
					
					
	
  
	     var msg = "Employee Data Export";
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
          {extend: 'excelHtml5', className: 'btn-sm', title:null,
					exportOptions: {
columns:[0,1,2,3,4,6,7,9,10,11,12,13,15,17,18,19,20,21,22,23,24,25,26,28,29,30,31,32,33,34]
					}   }
          ]
    });

		        }

		    });
		}
/*---------view employe data list end-----------------*/
  	$(document).on('click','#btn_search',function(){
		  $("#wait").css("display", "block");
		
		var month_year = $('#month_year').val();
		if($.trim(month_year)==""){
			$().toastmessage('showErrorToast', "Please Select Month ..!");
		}
		else{
		            $('#employee_data').html('');
						       var month_year=    $('#month_year').val();
			var tdateAr = month_year.split('/');
			var month_year = tdateAr[1] + '-' + tdateAr[0].slice();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"employee/search_employee_export",
				data :{month_year:month_year},	
				dataType : 'json',
		        success : function(data){
		            var html1 = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead>'+
		    '<tr>'+
		'<th style="white-space:nowrap;">UAN</th>'+  			 
		'<th style="white-space:nowrap;">Previous Member Id</th>'+  			
		'<th style="white-space:nowrap;">Member Name</th>'+  			
		'<th style="white-space:nowrap;">Date Of Birth</th>'+  			
		'<th style="white-space:nowrap;">DateOfJoining</th>  '+			
		'<th style="white-space:nowrap;">Gender</th>  			'+
		'<th style="display:none;">Gender</th>  			'+
		'<th style="white-space:nowrap;">Father/Husband Name</th> '+ 			
		'<th style="white-space:nowrap;">Relationship with the Member</th>'+  			
		'<th style="display:none;">Relationship</th>  			'+
		'<th style="white-space:nowrap;">Mobile Number</th>  			'+
		'<th style="white-space:nowrap;">EmailId</th>  			'+
		'<th style="white-space:nowrap;">Nationality</th>  			'+
		'<th style="white-space:nowrap;">Wages as on Joining</th>  			'+
		'<th style="white-space:nowrap;">Qualification</th>  			'+
		'<th style="display:none;">Qualification</th>  			'+
		'<th style="white-space:nowrap;">Maritial Status</th>  			'+
		'<th style="display:none;">Maritial Status</th>  			'+
		'<th style="white-space:nowrap;">Is International Worker</th>  		'+	
		'<th style="white-space:nowrap;">County Of Origin</th>  			'+
		'<th style="white-space:nowrap;">Passport Number</th>  			'+
		'<th style="white-space:nowrap;">Passport Valid From Date</th>  	'+		
		'<th style="white-space:nowrap;">Passport Valid Till Date</th>  		'+	
		'<th style="white-space:nowrap;">Is Physical Handicap</th>  			'+
		'<th style="white-space:nowrap;">Locomotive</th>  			'+
		'<th style="white-space:nowrap;">Hearing</th>  			'+
		'<th style="white-space:nowrap;">Visual</th>  			'+
		'<th style="white-space:nowrap;">Employee Type</th>  		'+	
		'<th style="white-space:nowrap;">Bank Account Number</th>  		'+	
		'<th style="white-space:nowrap;">Bank IFSC</th>  			'+
		'<th style="white-space:nowrap;">Name as Per Bank Details</th>'+  			
		'<th style="white-space:nowrap;">Pan</th>  			'+
		'<th style="white-space:nowrap;">Name as on PAN</th>  '+			
		'<th style="white-space:nowrap;">AADHAAR Number</th>  	'+		
		'<th style="white-space:nowrap;">Name As On AADHAAR</th>  '+			
            '</tr>'+
        '</thead>'+
       '<tbody id="employee_list">';
		            var i;
					 for(i=0; i<data.length; i++){

					
//			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					var sr = i+1;
		                html1 += '<tr>';
			html1 += '<td  >'+data1[1]+'</td>';	
			html1 += '<td>'+data1[2]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[30]+'</td>';

		var tdateAr = data1[3].split('-');
		var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(dob);		

		var tdateAr = data1[4].split('-');
		var doj = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(doj);		

		if(data1[17]=="0000-00-00"){
			data1[17]="";
		}
		else{
		var tdateAr = data1[17].split('-');
		var pvf = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvf);
			data1[17]=pvf;
		}
			
		if(data1[18]=="0000-00-00"){
			data1[18]="";
		}
		else{
		var tdateAr = data1[18].split('-');
		var pvt = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvt);
			data1[18]=pvt;
		}
	//gender code
	var gender = "";
	if(data1[5]=="MALE"){
		gender = "M";
		}
		else if(data1[5]=="FEMALE"){
		gender = "F";
		}
		else if(data1[5]=="TRANSGENDER"){
		gender = "T";
		}	
	
	
	//relation code
	var relation = "";
		if(data1[7]=="FATHER"){
		relation = "F";
		}
		else if(data1[7]=="HUSBAND"){
		relation = "H";
		}
	
	
	//marital status code
	var mstatus = "";
		if(data1[13]=="MARRIED"){
		mstatus = "M";
		}
		else if(data1[13]=="UNMARRIED"){
		mstatus = "U";
		}
		else if(data1[13]=="WIDOW/WIDOWER"){
		mstatus = "W";
		}
		else if(data1[13]=="DIVORCEE"){
		mstatus = "D";
		}
	
	//handicap code
	var relation = "";
		if(data1[7]=="FATHER"){
		relation = "F";
		}
		else if(data1[7]=="HUSBAND"){
		relation = "H";
		}

	//qualification code
	var qualification = "";
		if(data1[12]=="ILLITERATE"){
		qualification = "I";
		}
		else if(data1[12]=="LITERATE"){
		qualification = "L";
		}
		else if(data1[12]=="NON-MATRIC"){
		qualification = "N";
		}
		else if(data1[12]=="MATRIC"){
		qualification = "M";
		}
		else if(data1[12]=="SENIOR-SECONDARY"){
		qualification = "S";
		}
		else if(data1[12]=="GRADUATE"){
		qualification = "G";
		}
		else if(data1[12]=="POST-GRADUATE"){
		qualification = "P";
		}
		else if(data1[12]=="DOCTORATE"){
		qualification = "D";
		}
		else if(data1[12]=="TECHNICAL (PROFESSIONAL)"){
		qualification = "T";
		}
			
			html1 += '<td style="width:5%;">'+dob+'</td>';	
			html1 += '<td style="width:5%;">'+doj+'</td>';	

			
			html1 += '<td  style="white-space:nowrap;"  >'+data1[5]+'</td>';	
			html1 += '<td  style="display:none;"  >'+gender+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[6]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[7]+'</td>';	
			html1 += '<td  style="display:none;"  >'+relation+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[8]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[9]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[10]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  ></td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[12]+'</td>';	
			html1 += '<td  style="display:none;"  >'+qualification+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[13]+'</td>';	
			html1 += '<td  style="display:none;"  >'+mstatus+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[14]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[15]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[16]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[17]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[18]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[19]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[20]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[21]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[22]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[23]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[24]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[25]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[26]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[27]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[28]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[29]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[30]+'</td>';	
	
	html1 += '</tr>';
											
							
								
//	                      html +=  '<td>'+data[i].aadhaar_no+'</td>'+
//	                        '<td>'+data[i].name_as_aadhaar+'</td><tr>';
		            }
					html1 += '</tbody></table>';

		            $('#employee_data').append(html1);
					
					
	
  
	     var msg = "Employee Data Export";
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
            {extend: 'excelHtml5', className: 'btn-sm', title:null,
					exportOptions: {
columns:[0,1,2,3,4,6,7,9,10,11,12,13,15,17,18,19,20,21,22,23,24,25,26,28,29,30,31,32,33,34]
					}   }
        ]
    });
  			
	        }

		    });
		
			}

		
	});	
	


/*---------view employe data list end-----------------*/
  	$(document).on('click','#search_employee',function(){
		var name = "";
		var dob = "";
		var doj = "";
		var gender = "";
		var relation = "";
		var maritalstatus = "";
		var qualification = "";
		var adharkyc      = "";
		var pankyc        = "";
		var bankkyc       = "";


		if ($('#name').is(":checked")){				 name = "Y"; }
		if ($('#dob').is(":checked")){				dob = "Y"; 		   }
		if ($('#doj').is(":checked")){              doj = "Y";          }
		if ($('#gender').is(":checked")){           gender = "Y";       }
		if ($('#relation').is(":checked")){         relation = "Y";     }
		if ($('#maritalstatus').is(":checked")){    maritalstatus = "Y";}
		if ($('#qualification').is(":checked")){ 	qualification = "Y";}	
		if ($('#adharkyc').is(":checked")){      	adharkyc      = "Y";}	
		if ($('#pankyc').is(":checked")){        	pankyc        = "Y";}	
		if ($('#bankkyc').is(":checked")){       	bankkyc       = "Y";}	
		

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"employee/search_imssing_details",
				data :{name:name,dob:dob,doj:doj,gender:gender,relation:relation,maritalstatus:maritalstatus,qualification:qualification,adharkyc:adharkyc,pankyc:pankyc,bankkyc:bankkyc},	
				dataType : 'json',
		        success : function(data){
//					alert(data);
		            var html1 = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
        '<thead>'+
		    '<tr>'+
			'<th style="white-space:nowrap;">UAN</th>'+  			 
			'<th style="white-space:nowrap;">Previous Member Id</th>'+  			
			'<th style="white-space:nowrap;">Member Name</th>'+  			
			'<th style="white-space:nowrap;">Date Of Birth</th>'+  			
			'<th style="white-space:nowrap;">DateOfJoining</th>  '+			
			'<th style="white-space:nowrap;">Gender</th>  			'+
			'<th style="white-space:nowrap;">Father/Husband Name</th> '+ 			
			'<th style="white-space:nowrap;">Relationship with the Member</th>'+  			
			'<th style="white-space:nowrap;">Mobile Number</th>  			'+
			'<th style="white-space:nowrap;">EmailId</th>  			'+
			'<th style="white-space:nowrap;">Nationality</th>  			'+
			'<th style="white-space:nowrap;">Qualification</th>  			'+
			'<th style="white-space:nowrap;">Maritial Status</th>  			'+
			'<th style="white-space:nowrap;">Is International Worker</th>  		'+	
			'<th style="white-space:nowrap;">County Of Origin</th>  			'+
			'<th style="white-space:nowrap;">Passport Number</th>  			'+
			'<th style="white-space:nowrap;">Passport Valid From Date</th>  	'+		
			'<th style="white-space:nowrap;">Passport Valid Till Date</th>  		'+	
			'<th style="white-space:nowrap;">Is Physical Handicap</th>  			'+
			'<th style="white-space:nowrap;">Locomotive</th>  			'+
			'<th style="white-space:nowrap;">Hearing</th>  			'+
			'<th style="white-space:nowrap;">Visual</th>  			'+
			'<th style="white-space:nowrap;">Employee Type</th>  		'+	
			'<th style="white-space:nowrap;">Bank Account Number</th>  		'+	
			'<th style="white-space:nowrap;">Bank IFSC</th>  			'+
			'<th style="white-space:nowrap;">Name as Per Bank Details</th>'+  			
			'<th style="white-space:nowrap;">Pan</th>  			'+
			'<th style="white-space:nowrap;">Name as on PAN</th>  '+			
			'<th style="white-space:nowrap;">AADHAAR Number</th>  	'+		
			'<th style="white-space:nowrap;">Name As On AADHAAR</th>  '+			
            '</tr>'+
        '</thead>'+
       '<tbody id="employee_list">';
		            var i;
					 for(i=0; i<data.length; i++){

					
//			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					var sr = i+1;
		                html1 += '<tr>';
			html1 += '<td  >'+data1[1]+'</td>';	
			html1 += '<td>'+data1[2]+'</td>';	
			html1 += '<td  style="white-space:nowrap;"  >'+data1[30]+'</td>';

		var tdateAr = data1[3].split('-');
		var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(dob);		

		var tdateAr = data1[4].split('-');
		var doj = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(doj);		

		if(data1[17]=="0000-00-00"){
			data1[17]="";
		}
		else{
		var tdateAr = data1[17].split('-');
		var pvf = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvf);
			data1[17]=pvf;
		}
			
		if(data1[18]=="0000-00-00"){
			data1[18]="";
		}
		else{
		var tdateAr = data1[18].split('-');
		var pvt = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(pvt);
			data1[18]=pvt;
		}
			
			html1 += '<td style="width:5%;">'+dob+'</td>';	
			html1 += '<td style="width:5%;">'+doj+'</td>';	
								
			for(j=5; j<data1.length-1; j++){
			if(j != 11){
			html1 += '<td  style="white-space:nowrap;"  >'+data1[j]+'</td>';	
				
			}	
			
			}
			html1 += '</tr>';
											
							
								
//	                      html +=  '<td>'+data[i].aadhaar_no+'</td>'+
//	                        '<td>'+data[i].name_as_aadhaar+'</td><tr>';
		            }
					html1 += '</tbody></table>';

		            $('#employee_data1').html(html1);
					
					
	
  
	     var msg = "Employee Data Export";
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
            {extend: 'excelHtml5', className: 'btn-sm', title:null }
        ]
    });
  			
	        
				}
		    });		
	});	
	
'checked', false
/*---------view employe data list end-----------------*/
  	$(document).on('click','#reset_selected',function(){

		
		$("#name").prop('checked', false); 
		$("#dob").prop('checked', false); 		
		$("#doj").prop('checked', false); 		
		$("#gender").prop('checked', false);
		$("#relation").prop('checked', false); 
		$("#maritalstatus").prop('checked', false); 
		$("#qualification").prop('checked', false); 
		$("#adharkyc").prop('checked', false); 
		$("#pankyc").prop('checked', false); 
		$("#bankkyc").prop('checked', false); 




 	
		});
});

