$(document).ready(function(){
		//add new row in KYC detail div

		
		$(document).on('click','#reset_button',function(){

			$("#empname").val('');
			$('#search_uan').val('');          
			$('#employee_code').val('');

			$("#kyc_update_id").val('');	
            $('#kyc_save_update').val('');
			$("#show_kycdetail_list1").html('');	

		});
		$(document).on('click','#close',function(){
			$("#empname").val('');
			$('#search_uan').val('');          
			$('#employee_code').val('');

			$("#kyc_update_id").val('');	
            $('#kyc_save_update').val('');
			$("#show_kycdetail_list1").html('');


			$('#docNum').val('');           
            $('#nameasDoc').val('');        
            $('#ifsc').val('');             
            $('#kyc_image_name').html('');
            $('#msg').html('');
            $('#containerother_kyc').html('');
            $('#uploadFile').val('');
			$('#kyc_row_id').val('Add');

			

		});
		
		$(document).on('change','#docType',function(){

		var docType = $('#docType').val();
		
		if(docType == "BANK"){		
			$("#ifsc").removeAttr('disabled'); 
		}
		else{
			$("#ifsc").attr('disabled','disabled');
		}
		
		});
/*---------view employee list start-----------------*/
					show_employee_list();	//call function show all address
		function show_employee_list(){
		
				$.ajax({	
		        type  : 'ajax',
				url  : baseurl+"employee/get_employee_name",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select employee</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
              html += '<option value="'+data[i].emp_id+'" >'+data[i].name_as_aadhaar+'</option>';
		            }
		            $('#empname').html(html);					
				}
					
				});
		}
/*---------view employee list end-----------------*/

/*---------search by uan row  start-----------------*/

  	$(document).on('click','#search_button',function(){
	 var emp_name = $("#empname").val();
            var uan  = $('#search_uan').val();          
            var emp_id  = $('#employee_code').val();
			var entered_emp_id = emp_id; 
			var member_id = emp_id.length;
			if(emp_id != "")
			{
				if(member_id < 7)
				{
					var remain = 7-parseInt(member_id);
					var emp_id1 = "";
					for(i=1;i<=remain;i++)
					{
						emp_id1 += '0';
					}
					emp_id = emp_id1+emp_id;
				}
			}
				if(((emp_name=="")||(emp_name==null))&&(uan=="")&&(emp_id==""))
				{
						$().toastmessage('showSuccessToast', "Please Fill Details");
				}
				else{
					$.ajax({
                type : "POST",
				url  : baseurl+"employee/search_kyc_details",
                dataType : "JSON",
                data : { uan:uan,emp_id:emp_id,emp_name:emp_name },
                success: function(data){
						$("#show_kycdetail_list1").html('');	
				var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
					var emp_kyc_id = data[i].emp_id;
					var sr = i+1;

					if(data[i].doc_type=="DRIVING LICENSE"){ var doc_type_text="DRIVING_LICENSE"; }
					else if(data[i].doc_type=="BANK"){ var doc_type_text="BANK"; }
					else if(data[i].doc_type=="PAN"){ var doc_type_text="PAN"; }
					else if(data[i].doc_type=="ELECTION CARD"){ var doc_type_text="ELECTION_CARD"; }
					else if(data[i].doc_type=="RATION CARD"){ var doc_type_text="RATION_CARD"; }
					else if(data[i].doc_type=="NATIONAL POPULATION REGISTER"){ var doc_type_text="NATIONAL_POPULATION_REGISTER"; }
					else if(data[i].doc_type=="AADHAAR CARD"){ var doc_type_text="AADHAAR_CARD"; }
					
					html += '<tr><td id="doctype'+doc_type_text+'" >'+data[i].doc_type+'</td><td id="docnum'+doc_type_text+'" >'+data[i].doc_num.toUpperCase()+'</td><td id="docname'+doc_type_text+'" >'+data[i].doc_name.toUpperCase()+'</td><td id="ifsc'+doc_type_text+'">'+data[i].ifsc.toUpperCase()+'</td><td id="kycimage'+doc_type_text+'" >'+data[i].kyc_image+'</td><td style="display:none;" id="kycdate'+doc_type_text+'" >'+data[i].date+'</td><td style="white-space:nowrap;" ><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-trash"></em></button>   <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetail" value="'+doc_type_text+'" name="del_kycdetail"><em class="fa fa-edit"></em></button></td></tr>';
		            
			$("#empname").val(data[i].emp_id);
            $('#search_uan').val(data[i].UAN);  
			if((entered_emp_id == "")||(entered_emp_id == null))
			{
            $('#employee_code').val(data[i].member_id);          				
			}
			else{
	            $('#employee_code').val(entered_emp_id);          
			}	
					
					}
						$("#show_kycdetail_list1").append(html);	

		
		if(data.length == 0){
			$().toastmessage('showSuccessToast', "KYC Details Empty");
						   $('#kyc_save_update').val(emp_name);
						}
						else{
						$("#kyc_update_id").val(html);	
		            $('#kyc_save_update').val(emp_kyc_id);
    						}
	            }
            });
        		
				}				
		    return false;

		
	});
	
/*---------search by uan row  end-----------------*/


    $(document).on("click",".add_kycdetail",function(e){
        e.preventDefault();
		
            var kyc_row_id  = $('#kyc_row_id').val();          
            var docType  = $('#docType').val();          
            var old_docType  = $('#doctype_check').val();
			
			var docType_text  = $("#docType option:selected").text();
            var docNum   = $('#docNum').val();           
            var nameasDoc= $('#nameasDoc').val();        
            var ifsc     = $('#ifsc').val();       
			var image_name="";
            var image_name     = $('#kyc_image_name').html(); 
			var entry = 0;
			
			
				var d = new Date();
				
				var month = d.getMonth()+1;
				var day = d.getDate();
				
				var kyc_date = d.getFullYear() + '-' +
					(month<10 ? '0' : '') + month + '-' +
					(day<10 ? '0' : '') + day;

			if(image_name){}
			else{
				var image_name="";
				}
			

				
				
							if(kyc_row_id != 'Add')
			{
		//	alert('ok');

			if((docType== "")||(docNum== "")||(nameasDoc== ""))
			{
			$().toastmessage('showSuccessToast', "Please Fill All KYC Details");
			}
			else{
		
				var id1 = kyc_row_id;	
				//alert(id1);
				
			if(old_docType == docType_text)
			{
				entry = 0;
			}
			else{
					var r1 = $('table#example11').find('tbody').find('tr');
					var r = r1.length;
					for (var i = 0; i < r; i++) {
					var doc_type = $(r1[i]).find('td:eq(0)').html();
						if(docType_text == doc_type){
							entry = 2;
						}
				
				}
			}
			if(entry == 0)
			{
				
				$('#doctype'+id1).html(docType_text);
				$('#docnum'+id1).html(docNum);
				$('#docname'+id1).html(nameasDoc);
				$('#ifsc'+id1).html(ifsc);
				$('#kycimage'+id1).html(image_name);
				$('#kycdate'+id1).html(kyc_date);
		
			$('#docType').val('');          
            $('#docNum').val('');           
            $('#nameasDoc').val('');        
            $('#ifsc').val('');             
            $('#kyc_image_name').html('');
            $('#msg').html('');
            $('#containerother_kyc').html('');
            $('#uploadFile').val('');
            $('#doctype_check').val('');
			$('#kyc_row_id').val('Add');
			
			            
		
				entry = 0;
			}
			else if(entry == 2){
		$().toastmessage('showSuccessToast', "This KYC Details Already Uploaded");
				
				}

			}		
			}
			else{

			
				
			if((docType== "")||(docNum== "")||(nameasDoc== ""))
			{
			$().toastmessage('showSuccessToast', "Please Fill All KYC Details");
			}
			else{
			var dlt = 0;	
			var r1 = $('table#example11').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var doc_type = $(r1[i]).find('td:eq(0)').html();
			//alert(doc_type+'//'+docType_text);
				if(docType_text===doc_type){
					var dlt = 1		
				}
			}
			
			if(dlt == 1){ 
		$().toastmessage('showSuccessToast', "This KYC Details Already Uploaded");

				var dlt = 0;
				}
			else{


			
			var appendDiv='<tr><td id="doctype'+docType+'" >'+docType_text+'</td><td id="docnum'+docType+'" >'+docNum.toUpperCase()+'</td><td id="docname'+docType+'" >'+nameasDoc.toUpperCase()+'</td><td id="ifsc'+docType+'">'+ifsc.toUpperCase()+'</td><td id="kycimage'+docType+'" >'+image_name+'</td><td style="display:none;" id="kycdate'+docType+'" >'+kyc_date+'</td><td style="white-space:nowrap;" ><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-trash"></em></button>   <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetail" value="'+docType+'" name="del_kycdetail"><em class="fa fa-edit"></em></button></td></tr>';
			//alert(appendDiv);
			
					$("#show_kycdetail_list1").append(appendDiv);	
					
					
								$('#docType').val('');          
            $('#docNum').val('');           
            $('#nameasDoc').val('');        
            $('#ifsc').val('');             
            $('#kyc_image_name').html('');
            $('#msg').html('');
            $('#containerother_kyc').html('');
            $('#uploadFile').val('');
			$('#kyc_row_id').val('Add');


			}		
			
			}
			}
		

						$("#ifsc").attr('disabled','disabled'); 	
				
				
			
			


	});
	
				//delete row from  KYC detail div
	$(document).on("click",".del_kycdetail",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	

/*---------get  kyc   start-----------------*/
	
  	$(document).on('click','.edit_kycdetail',function(){
	
		var id1 = $(this).attr('value');
//	alert(id1);
		var docType = $('#doctype'+id1).html();
		var docNum = $('#docnum'+id1).html();
		
		if(docType == "BANK"){		
			$("#ifsc").removeAttr('disabled'); 
		}
		else{
			$("#ifsc").attr('disabled','disabled');
		}		
		
		
		
		
		var nameasDoc = $('#docname'+id1).html();
		var ifsc = $('#ifsc'+id1).html();
		var kyc_image_name = $('#kycimage'+id1).html();
            $('#doctype_check').val(docType);

			
            $('#docType').val(id1);
            $('#docNum').val(docNum);
            $('#nameasDoc').val(nameasDoc);
            $('#ifsc').val(ifsc);
			
//            $('#kyc_image_name').val(kyc_image_name);
              $('#msg').html("<font id='kyc_image_name' color='green'>"+kyc_image_name+"</font>"); 
			  $('#containerother_kyc').html('<img id="myImage" src="'+baseurl+'assets/images/employee/'+kyc_image_name+'" width="50" />');

			$('#kyc_row_id').val(id1);
				

	});
	
/*---------get  kyc  start-----------------*/

   $(document).on("click","#btn_insert",function(){
			
			employee_id = $('#kyc_save_update').val();
			
		
//alert(employee_id);
			if(employee_id=="Add"){
				
				$().toastmessage('showErrorToast', "KYC Details Not Available to Save");
			
			}
			else{
		

			
		//	alert(employee_id);
			$.ajax({
				
                type : "POST",
				url  : baseurl+"employee/delete_kyc_detail",
                dataType : "JSON",
                data : {employee_id:employee_id},
				success: function(data){
							$().toastmessage('showSuccessToast', "KYC Details Update successfully");
							
		var r1 = $('table#example11').find('tbody').find('tr');
			var r = r1.length;

for (var i = 0; i < r; i++) {

			var doc_type = $(r1[i]).find('td:eq(0)').html();
			var doc_no = $(r1[i]).find('td:eq(1)').html();
			var doc_name = $(r1[i]).find('td:eq(2)').html();
			var ifsc = $(r1[i]).find('td:eq(3)').html();
			var doc_img = $(r1[i]).find('td:eq(4)').html();
			var kyc_date = $(r1[i]).find('td:eq(5)').html();

//			var employee_id = data;
			$.ajax({
				
                type : "POST",
				url  : baseurl+"employee/save_kyc_detailkycupdate",
                dataType : "JSON",
                data : {kyc_date:kyc_date,doc_type:doc_type ,doc_no:doc_no,doc_name:doc_name,ifsc:ifsc,doc_img:doc_img,employee_id:employee_id},
				success: function(data1){
					
				}
				});
				var n = r-1;
					if(i==n)
					{
						$("#show_kycdetail_list1").html('');
		$("#empname").val("");
            $('#search_uan').val("");          
            $('#employee_code').val("");          
						            $('#kyc_save_update').val('Add');
		
					}
			}

				}
				});
		
			}		
		
	});
	
});