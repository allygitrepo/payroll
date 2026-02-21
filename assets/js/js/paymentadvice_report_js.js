
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
		        type  : 'ajax',
				url  : baseurl+"contractorcontroller/view_contractor",
		        async : false,
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
		
	
		function 	show_paymentadvicereport(month_year,emptype,contractor){
        $("#wait").css("display", "block");

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"paymentadvicereport/paymentadvicereport_show",
                data : {month_year:month_year,emptype:emptype,contractor:contractor},
		        dataType : 'json',
		        success : function(data){
				


				var html = '<table  class="tb2excel  table table-striped table-bordered table-hover" border=1>'+
				'<tbody>';
		            var i;
							var amount = 0;			

				html += '<tr>'+
				'<td >Company Name : </td>'+
				'<td id="company_name"></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

				html += '<tr>'+
				'<td >Company Address :</td>'+
				'<td id="address"></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

				html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';
				
				html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

				
	var d = new Date();
		var strDate =  d.getDate() + "/" + (d.getMonth()+1) + "/" +d.getFullYear();
				
				html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td >'+strDate+'</td>'+  			
				'</tr>';
	
 	
				html += '<tr>'+
				'<td >Sir/Madam,</td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';
				html += '<tr>'+
				'<td > I am sending you the cheque of amount <b id="amt" > ₹ '+amount+'</b></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';
				html += '<tr>'+
				'<td colspan="2" >so please transfer the amount in the accounts as per details given below	</td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

				html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

				
					html += '<tr>'+
				'<td style="white-space:nowrap;"><b>Beneficiary Name</b></td>'+
				'<td style="white-space:nowrap;"><b>Emp. Code</b></td>'+
				'<td style="white-space:nowrap;"><b>Beneficiary Account Number</b></td>'+
				'<td style="white-space:nowrap;"><b>IFSC</b></td>'+  			
				'<td style="white-space:nowrap;"><b>Amount</b></td>'+  			
				'</tr>';
	
		            for(i=0; i<data.length; i++){
																		

			console.log(data[i]);			
			var data1 = data[i].split("####");
	amount = parseInt(amount)+parseInt(data1[4]);	
		                html += '<tr>'+
				'<td style="whiteSpace:nowrap;">'+data1[0]+'</td>'+
				'<td style="whiteSpace:nowrap;">'+data1[1]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[2]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[3]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[4]+'</td>'+
		                        '</tr>';
								

						
		            }
					
				
		html += '<tr>'+
				'<td ><b>Total </b></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ><b>'+amount+'</b></td>'+  			
				'</tr>';
				
				
				html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';






							

				
						html += '<tr>'+
				'<td >Thanks,</td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';
					html += '<tr>'+
				'<td >with regards,</td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

	html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

	html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';

	html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';


				
					html += '<tr>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+
				'<td ></td>'+  			
				'</tr>';
			
					
	                html += '</tbody></table>';
					
					
		            $('#table_data1').html(html);
					            $("#wait").css("display", "none");

						
					$('#amt').html('₹'+amount);
					$('#company_name').html(data1[5]);
					$('#address').html(data1[6]);
					$('.download').show();
					
						var month_year = $('#month_year').val();
							var rowcount = parseInt(data.length)+parseInt(1);
		
	
		
	   var msg = "Payment Advice Report_"+month_year;



		        }

		    });
			
			

		}
 	
	$(document).on('click','#btn_insert',function(){

	var month_year = $('#month_year').val();
	var emptype = $('#typeEmp').val();
	
	if(emptype == "BIDI MAKER"){		
				var contractor = $('#contractor1').val();
		}
		else{
				var contractor = "";
		}
	
		if((month_year=="")||(emptype=="")||(emptype==null)){
					$().toastmessage('showErrorToast', "Please Select Month & Type of Employee");
		}else{
					show_paymentadvicereport(month_year,emptype,contractor);
		}
		
        });
	
});

