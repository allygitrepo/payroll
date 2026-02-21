
$(document).ready(function() {
					//	show_packer_entry();	//call function show all packingwages
		/*---------get  contracor  end-----------------*/

		
		$(document).on('change','#typeEmp',function(){

		var emptype = $('#typeEmp').val();
		
		if(emptype == "BIDI MAKER"){		
			$("#contractor1").removeAttr('disabled'); 
		}
		else{
			$("#contractor1").attr('disabled','disabled');
		}
		
		});
		
		
		
		
		show_contractor();	//call function show all address
		function show_contractor(){
				$.ajax({
		        type  : 'GET',
				url  : baseurl+"contractorcontroller/view_contractor",
//		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
           html += '<option value="all" selected >ALL</option>';
		            var i;
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].contractor_id+'" >'+data[i].contractor_name+' - '+data[i].pf_code+'</option>';
		            }
		            $('#contractor1').html(html);	
				}
				});
		}
		

 	
	$(document).on('submit','#gratuityform',function(e){
e.preventDefault();
	var year = $('#year').val();
	var date = $('#date').val();
	var emptype = $('#typeEmp').val();
	
	if(emptype == "BIDI MAKER"){		
				var contractor = $('#contractor1').val();
		}
		else{
				var contractor = "";
		}
	
		if((year=="")||(date=="")||(emptype=="")||(emptype==null)){
					$().toastmessage('showErrorToast', "Please Select Type of Employee");
		}else{




						$.ajax({
							type  : 'POST',
							url  : baseurl+"Reportcontroller/show_gratuitycalculation",
							data : {date:date,year:year,emptype:emptype,contractor:contractor},
							dataType : 'json',
							success : function(data){
								var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
								'<thead>'+
								'<tr>'+
								'<th>SR No.</th>'+
								'<th>Employee Name</th>'+
								'<th>DOJ</th>'+
								'<th>DOR</th>'+
								'<th>Total Year of Working</th>'+
								'<th id="year_1" >'+data[0].year1+'</th>'+
								'<th id="year_2" >'+data[0].year2+'</th>'+
								'<th id="year_3" >'+data[0].year3+'</th>'+
								'<th id="year_4" >'+data[0].year4+'</th>'+
								'<th id="year_5" >'+data[0].year5+'</th>'+
								'<th>Salary</th>'+
								'<th>Gratuity Amount</th>'+
								'</tr></thead><tbody id="">';
								var i;
								
								for(i=1; i<data.length; i++){

								var gratuity = 0;
									
								if((data[i].total_years > 5)&&(data[i].gtotal_days0 >= 240)&&(data[i].gtotal_days1 >= 240)&&(data[i].gtotal_days2 >= 240)&&(data[i].gtotal_days3 >= 240)&&(data[i].gtotal_days4 >= 240))
								{
									gratuity = (data[i].salary/26)*(data[i].total_years)*15;		
								}
							
								var sr = i+1;
									html += '<tr>'+
											'<td>'+sr+'</td>'+
											'<td>'+data[i].name_as_aadhaar+'</td>'+
											'<td>'+data[i].doj+'</td>'+
											'<td>'+data[i].dor+'</td>'+
											'<td>'+data[i].total_years+'</td>'+
											'<td>'+data[i].gtotal_days0+'</td>'+
											'<td>'+data[i].gtotal_days1+'</td>'+
											'<td>'+data[i].gtotal_days2+'</td>'+
											'<td>'+data[i].gtotal_days3+'</td>'+
											'<td>'+data[i].gtotal_days4+'</td>'+
											'<td>'+data[i].salary+'</td>'+
											'<td>'+Math.round(gratuity);+'</td>'+
											'</tr>';
								}
								html += '</tbody></table>';
								$('#show_gratuitycalculation').html(html);
								
								
								
			  
				   var msg = "Gratuity Calculation List";
				$('#example1').dataTable({
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
		
        });

	
	
});

