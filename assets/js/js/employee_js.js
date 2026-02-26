$(document).ready(function(){

	
	
	
	/*---------insert address  start-----------------*/
/*---------get  address  start-----------------*/
$(document).on('change','#address_list_personalinfo',function(){
//	e.preventDefault();
	var address_id = $('#address_list_personalinfo').val();
	$.ajax({
		        type  : 'POST',
				url  : baseurl+"addresscontroller/get_address_detail",
		        dataType : 'json',
                data : { id:address_id },
		        success : function(data){
		            var i;
					
		            for(i=0; i<data.length; i++){
//					$('#').val(data[i].id);
					$('#postoffice').val(data[i].post_office);
					$('#district').val(data[i].district);
					$('#pincode').val(data[i].pincode);
//		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
					
//		            $('#address_list').html(html);					
				}
					
				});
	
	
});

/*---------get  address  end-----------------*/

		
show_address_personal_info();	//call function show all address
	
    $(document).on("click","#save_new_address",function(){
			
			var save_update1 = "add";
            var address1 = $('#new_address').val();
            var postoffice1 = $('#new_postoffice').val();
            var district1 = $('#new_district').val();
            var pincode1 = $('#new_pincode').val();  
			if(address1 == ""){ $('#new_address').attr('oninvalid','oninvalid'); }
			else if(postoffice1 == ""){ $('#new_postoffice').attr('oninvalid','oninvalid'); }
			else if(district1 == ""){ $('#new_district').attr('oninvalid','oninvalid'); }
			else if(pincode1 == ""){ $('#new_pincode').attr('oninvalid','oninvalid'); }
			else{
			
			$.ajax({
                type : "POST",
				url  : baseurl+"addresscontroller/save_address",
                dataType : "JSON",
                data : {id:save_update1 ,address:address1 , postoffice:postoffice1, district:district1,pincode:pincode1},
                success: function(data){
				if(data == true){
				$().toastmessage('showSuccessToast', "Addrss Save Successfully");
                    $('#new_address').val("");
                    $('#new_postoffice').val("");
                    $('#new_district').val("");
                    $('#new_pincode').val("");
						show_nomi_address('list');	//call function show all address
						show_address_personal_info();	//call function show all address
												$('#address_panel').hide(); 					 

					}
					else{
				$().toastmessage('showErrorToast', "Addrss Save Failed");
						}
	
                }
            });
            return false;
			}
        });
/*---------insert address  end-----------------*/


	
	$('#address_panel').hide();
	
		function show_address_personal_info(){
				$.ajax({
		        type  : 'ajax',
				url  : baseurl+"addresscontroller/view_address",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select Address</option>';
		                html += '<option value="add_new" >Add New Address</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
		            $('#address_list_personalinfo').html(html);					
				}
					
				});
		}
		
		$(document).on('change','#address_list_personalinfo',function(){
		         var add_new =  $('#address_list_personalinfo').val();					
				 if(add_new=="add_new"){
						$('#address_panel').show(); 
						$('#district').val(''); 					 
						$('#postoffice').val(''); 					 
						$('#pincode').val(''); 					 
				 }
				 else{
						$('#address_panel').hide(); 					 
				 }
		});
	
		$(document).on('click','#close_new_address',function(){
						$('#address_panel').hide(); 					 
		});
	
	/*------------kyc detail validation------------------------start---------------------*/
	/*------------kyc detail validation------------------------start---------------------*/
	/*------------kyc detail validation------------------------start---------------------*/
	/*------------kyc detail validation------------------------start---------------------*/
	/*------------kyc detail validation------------------------start---------------------*/
//            var kyc_row_id  = $('#kyc_row_id').val();          
//            var docType  = $('#docType').val();          
//            var old_docType  = $('#doctype_check').val();
//				var docType_text  = $("#docType option:selected").text();
//            var docNum   = $('#docNum').val();           
//            var nameasDoc= $('#nameasDoc').val();        
//            var ifsc     = $('#ifsc').val();       

		$(document).on('focusout','#docNum',function(){
			
	    var doctype  = $('#docType').val();          
	    var docnum  = $('#docNum').val();          

		if(doctype == "DRIVING_LICENSE"){ var msg = drivingL_validation(docnum); }
		else if(doctype == "BANK"){ var msg = accno_validation(docnum); }
		else if(doctype == "PAN"){ var msg =  panno_validation(docnum); }
		else if(doctype == "ELECTION_CARD"){ var msg = electionc_validation(docnum); }
		else if(doctype == "RATION_CARD"){ var msg = rationc_validation(docnum); }
		else if(doctype == "NATIONAL_POPULATION REGISTER"){ var msg = NPR_validation(docnum); }
		else if(doctype == "AADHAR_CARD"){ var msg = aadhaar_validation(docnum);	}

		$('#docNum_error').html(msg);
		if(msg == "")
		{
			$("#add_kycdetail").removeAttr('disabled'); 
		}
		else{
			$("#add_kycdetail").attr('disabled','disabled');
		}
			
		});

		$(document).on('focusout','#ifsc',function(){
	    var doctype  = $('#docType').val();          
	    var ifsc  = $('#ifsc').val();          
		if(doctype == "BANK"){ var msg = ifsc_validation(ifsc); }
		$('#ifsc_error').html(msg);
		if(msg == "")
		{
			$("#add_kycdetail").removeAttr('disabled'); 
		}
		else{
			$("#add_kycdetail").attr('disabled','disabled');
		}
	
		});

		$(document).on('focusout','#nameasDoc',function(){
		var nameasDoc= $('#nameasDoc').val();        
		var msg = nameasDoc_validation(nameasDoc);			
		$('#nameasDoc_error').html(msg);
		if(msg == "")
		{
			$("#add_kycdetail").removeAttr('disabled'); 
		}
		else{
			$("#add_kycdetail").attr('disabled','disabled');
		}
		});
		
		function nameasDoc_validation(nameasDoc){
		var msg = "";	
		if((nameasDoc == "")|| (nameasDoc == "null")){
		 msg = 'Please Enter  Name';
		}
		else if (!nameasDoc.match('^[a-zA-Z ]{1,100}$') ){
						msg = "Special Characters Not Allowed";
			}
			return msg;
	}

		function accno_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter Bank Account Number';
		}
		else if(!docnum.match('^[0-9]{10,20}$') ){
						msg = "Invalide Bank Account Number";
			}
			return msg;
		}
		
		function ifsc_validation(ifsc){
		var msg = "";	
		if((ifsc == "")||(ifsc == null)){
		 msg = 'Enter Bank IFSC Code';
		}
		else if(!ifsc.match('^[a-zA-Z0-9]{11}$') ){
						msg = "Invalide Bank IFSC Code";
			}
			return msg;
		}
		
		function panno_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter PAN Card Number';
		}
		else if(!docnum.match('^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$') ){
						msg = "Invalide PAN Card Number";
			}
			return msg;
		}

		function aadhaar_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter Aadhaar Card Number';
		}
		else if(!docnum.match('^[0-9]{12}$') ){
						msg = "Invalide Aadhaar Card Number";
			}
			return msg;
		}


		function drivingL_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter DRIVING LICENSE Number';
		}
		else if(!docnum.match('^[a-zA-Z0-9]{5,20}$') ){
						msg = "Invalide DRIVING LICENSE Number";
			}
			return msg;
		}


		
		function NPR_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter Document Number';
		}
		else if(!docnum.match('^[a-zA-Z0-9]{5,20}$') ){
						msg = "Invalide Document Number";
			}
			return msg;
		}

		function electionc_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter Document Number';
		}
		else if(!docnum.match('^[a-zA-Z0-9]{5,20}$') ){
						msg = "Invalide Document Number";
			}
			return msg;
		}
		
		function rationc_validation(docnum){
		var msg = "";	
		if((docnum == "")||(docnum == null)){
		 msg = 'Enter Document Number';
		}
		else if(!docnum.match('^[a-zA-Z0-9]{5,20}$') ){
						msg = "Invalide Document Number";
			}
			return msg;
		}
		
	/*------------kyc detail validation--------------------end-------------------------*/
	/*------------kyc detail validation--------------------end-------------------------*/
	/*------------kyc detail validation--------------------end-------------------------*/
	/*------------kyc detail validation--------------------end-------------------------*/
	/*------------kyc detail validation--------------------end-------------------------*/

	
		//add new row in KYC detail div
		$(document).on('change','#docType',function(){

		var docType = $('#docType').val();
		
		if(docType == "BANK"){		
			$("#ifsc").removeAttr('disabled'); 
		}
		else{
			$("#ifsc").attr('disabled','disabled');
		}
		
		});

		
			$("#g_name").hide(); 
			$("#g_address").hide(); 
			$("#not_guardian").show(); 
	
		$(document).on('focusout','#nomi_dob',function(){

		var nomi_dob = $('#nomi_dob').val();
		
		var tdateAr = nomi_dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);		
		
		dob = new Date(dob);
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
//		$('#age').html(age+' years old');
		if((age < 18))
		{
			$("#g_name").show(); 
			$("#g_address").show(); 
			$("#not_guardian").hide(); 
		}
		else{
			$("#g_name").hide(); 
			$("#g_address").hide(); 
			$("#not_guardian").show(); 
		}
		
		});

		
		
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
            var image_name  = $('#kyc_image_name').html(); 
			var entry = 0;

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
					var r1 = $('table#example1').find('tbody').find('tr');
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
				$('#edit_kycdetail'+id1).val(docType);
				
			$('#doctype'+id1).attr('id','doctype'+docType);			
			$('#docnum'+id1).attr('id','docnum'+docType);			
			$('#docname'+id1).attr('id','docname'+docType);			
			$('#ifsc'+id1).attr('id','ifsc'+docType);			
			$('#kycimage'+id1).attr('id','kycimage'+docType);			
			$('#edit_kycdetail'+id1).attr('id','edit_kycdetail'+docType);			
				
		
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
			var r1 = $('table#example1').find('tbody').find('tr');
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
				
			var appendDiv='<tr><td id="doctype'+docType+'" >'+docType_text+'</td><td id="docnum'+docType+'" >'+docNum+'</td><td id="docname'+docType+'" >'+nameasDoc+'</td><td id="ifsc'+docType+'">'+ifsc+'</td><td id="kycimage'+docType+'" >'+image_name+'</td><td style="white-space:nowrap;" ><button  class="del_kycdetail btn btn-danger " id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>   <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetail'+docType+'" value="'+docType+'" name="del_kycdetail"><em class="fa fa-edit"></em></button></td></tr>';
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
		

			
	});
	

	//delete row from  KYC detail div
	$(document).on("click",".del_kycdetail",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	
	
		//delete row from  family detail div
	$(document).on("click",".dlt_family",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	
		//delete row from  nominee detail div
		
		
		var rowNum =0;
		
	
	
	 $(document).on("click",".add_nominee",function(e){
        e.preventDefault();
		
            var row_id = $('#nominee_row_id').val();             

            var old_adhar = $('#nominee_adhar_check').val();             

            var name = $('#name').val();             
			var address = $("#nomi_address_list option:selected").text();
						
            var nomi_address = $('#nomi_address_list').val();   
            var nomi_postoffice = $('#nomi_postoffice').val();
            var nomi_district = $('#nomi_district').val();  
            var nomi_pincode = $('#nomi_pincode').val();   
            var nomi_adharno = $('#nomiadharno').val();         
            var nomi_relation = $('#nomi_relation').val();         
            var guardian_name = $('#guardian_name').val();         
            var guardian_address = $('#guardian_address').val();         
            var nomi_dob = $('#nomi_dob').val();         
            var share = $('#share').val();            
			
			var tdateAr = nomi_dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);		
		dob = new Date(dob);
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		var enrty = 0;
			if(row_id != 'Add')
			{

			if((name == "")||(name == null)||(nomi_address == "")||(nomi_address == null)||(nomi_dob == "")||(nomi_dob == null)||(share == "")||(share == null)||(nomi_adharno == "")||(nomi_adharno == null)||(nomi_relation == "")||(nomi_relation == null))
			{
				$().toastmessage('showSuccessToast', "Please Fill All Nominee Details");
			}
				else if((age < 18)&&((guardian_name == "")||(guardian_name == null)||(guardian_address == "")||(guardian_address == null)))
		{
		$().toastmessage('showSuccessToast', "Please Fill All Guardian Details");
		}
	
			else{
		
				var id1 = row_id;	
				//alert(id1);
				
			if(old_adhar == nomi_adharno)
			{
				entry = 0;
			}
			else{
					var r1 = $('table#example2').find('tbody').find('tr');
					var r = r1.length;
					for (var i = 0; i < r; i++) {
					var table_adharno = $(r1[i]).find('td:eq(6)').html();
						if(nomi_adharno == table_adharno){
							entry = 2;
						}
						else if(old_adhar == table_adharno){
							entry = 0;							
						}
				}
			}
			if(entry == 0)
			{

			$('#name'+id1).html(name);		
			$('#address_id'+id1).html(nomi_address);
			$('#address'+id1).html(address);
			$('#postoffice'+id1).html(nomi_postoffice);
			$('#district'+id1).html(nomi_district);
			$('#pincode'+id1).html(nomi_pincode);
			$('#adharno'+id1).html(nomi_adharno);
			$('#relation'+id1).html(nomi_relation);
			$('#dob'+id1).html(nomi_dob);
			$('#share'+id1).html(share);
			$('#g_name'+id1).html(guardian_name);
			$('#g_address'+id1).html(guardian_address);
			$('#edit_nomineedetail'+id1).val(nomi_adharno);			
			
			$('#name'+id1).attr('id','name'+nomi_adharno);			
			$('#address_id'+id1).attr('id','address_id'+nomi_adharno);			
			$('#address'+id1).attr('id','address'+nomi_adharno);			
			$('#postoffice'+id1).attr('id','postoffice'+nomi_adharno);			
			$('#district'+id1).attr('id','district'+nomi_adharno);			
			$('#pincode'+id1).attr('id','pincode'+nomi_adharno);			
			$('#adharno'+id1).attr('id','adharno'+nomi_adharno);			
			$('#relation'+id1).attr('id','relation'+nomi_adharno);			
			$('#dob'+id1).attr('id','dob'+nomi_adharno);			
			$('#share'+id1).attr('id','share'+nomi_adharno);			
			$('#g_name'+id1).attr('id','g_name'+nomi_adharno);			
			$('#g_address'+id1).attr('id','g_address'+nomi_adharno);			

			$('#edit_nomineedetail'+id1).attr('id','edit_nomineedetail'+nomi_adharno);			

			
			
			
					if((nomi_relation == "SON")||(nomi_relation == "DAUGHTER")||(nomi_relation == "WIFE"))
					{
					var r2 = $('table#example3').find('tbody').find('tr');
					var r1 = r2.length;
						for (var j = 0; j < r1; j++){
						var family_aadhar = $(r2[j]).find('td:eq(3)').html();
							if(id1 == family_aadhar){
								
								$('#fname'+id1).html(name);		
								$('#fdob'+id1).html(nomi_dob);
								$('#frelation'+id1).html(nomi_relation);
								$('#fadhar'+id1).html(nomi_adharno);
								$('#edit_familydetail'+id1).val(nomi_adharno);


			$('#edit_familydetail'+id1).val(nomi_adharno);	
			$('#fname'+id1).attr('id','fname'+nomi_adharno);			
			$('#fdob'+id1).attr('id','fdob'+nomi_adharno);			
			$('#frelation'+id1).attr('id','frelation'+nomi_adharno);			
			$('#fadhar'+id1).attr('id','fadhar'+nomi_adharno);			
			$('#edit_familydetail'+id1).attr('id','edit_familydetail'+nomi_adharno);			
								
							}
						}
					}
					
			$('#nominee_row_id').val('Add');             
			$('#nominee_adhar_check').val(''); 			

			$('#name').val('');             
			
            $('#nomi_address_list').val('');   
            $('#nomi_postoffice').val('');
            $('#nomi_district').val('');  
            $('#nomi_pincode').val('');   
            $('#nomi_dob').val('');         
            $('#share').val('');            
			
			$('#nomiadharno').val('');         
			$('#nomi_relation').val('');         
			$('#guardian_name').val('');         
            $('#guardian_address').val('');      

			$('#nominee_row_id').val('Add');             
			$('#nominee_adhar_check').val(''); 			
		
							$("#g_name").hide(); 
			$("#g_address").hide(); 
			$("#not_guardian").show(); 

				
			}
			else if(entry == 2){
		$().toastmessage('showSuccessToast', "Entered Aadhaar No. Already Exist !!!");
				
				}
	
			}		
			}
			else{

			
				
			if((name == "")||(name == null)||(nomi_address == "")||(nomi_address == null)||(nomi_dob == "")||(nomi_dob == null)||(share == "")||(share == null)||(nomi_adharno == "")||(nomi_adharno == null)||(nomi_relation == "")||(nomi_relation == null))
			{
				$().toastmessage('showSuccessToast', "Please Fill All Nominee Details");
			}
		else if((age < 18)&&((guardian_name == "")||(guardian_name == null)||(guardian_address == "")||(guardian_address == null)))
		{
		$().toastmessage('showSuccessToast', "Please Fill All Guardian Details");
		}
			else{
			var dlt = 0;	
			var r1 = $('table#example2').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var table_adharno = $(r1[i]).find('td:eq(6)').html();
			//alert(doc_type+'//'+docType_text);
			if(nomi_adharno == table_adharno){
								var dlt = 1		
				}
			}
			
			if(dlt == 1){ 
		$().toastmessage('showSuccessToast', "Entered Aadhaar No. Already Exist !!!");

				var dlt = 0;
				}
			else{
				
			var appendDiv='<tr><td id="name'+nomi_adharno+'"  >'+name+'</td><td style="display:none;"  id="address_id'+nomi_adharno+'"  >'+nomi_address+'</td><td  id="address'+nomi_adharno+'"  >'+address+'</td><td  id="postoffice'+nomi_adharno+'"  >'+nomi_postoffice+'</td><td  id="district'+nomi_adharno+'"  >'+nomi_district+'</td><td  id="pincode'+nomi_adharno+'"  >'+nomi_pincode+'</td><td  id="adharno'+nomi_adharno+'"  >'+nomi_adharno+'</td><td  id="relation'+nomi_adharno+'"  >'+nomi_relation+'</td><td  id="dob'+nomi_adharno+'"  >'+nomi_dob+'</td><td  id="share'+nomi_adharno+'"  >'+share+'</td><td  id="g_name'+nomi_adharno+'"  >'+guardian_name+'</td><td id="g_address'+nomi_adharno+'" >'+guardian_address+'</td><td><button  class="dlt_nominee btn btn-danger btn-xs" id="dlt_nominee" name="dlt_nominee"><em class="fa fa-minus"></em></button>  <button  class="edit_nomineedetail btn btn-primary btn-xs" id="edit_nomineedetail'+nomi_adharno+'" value="'+nomi_adharno+'" name="edit_nomineedetail"><em class="fa fa-edit"></em></button></td></tr>';
			//alert(appendDiv);
			
					$("#show_nominee_detail_list1").append(appendDiv);	
			
					
	         $('#name').val('');             
			
            $('#nomi_address_list').val('');   
            $('#nomi_postoffice').val('');
            $('#nomi_district').val('');  
            $('#nomi_pincode').val('');   
            $('#nomi_dob').val('');         
            $('#share').val('');            
			
			$('#nomiadharno').val('');         
			$('#nomi_relation').val('');         
			$('#guardian_name').val('');         
            $('#guardian_address').val('');      

			$('#nominee_row_id').val('Add');             
			$('#nominee_adhar_check').val(''); 			
	
			}		
			
			}
			}
		

			
	});
		
	$(document).on("click",".add_family",function(e){
        e.preventDefault();
		
           var row_id = $('#family_row_id').val();             

            var old_adhar = $('#family_adhar_check').val();             

            var familyname = $('#familyname').val();       
            var family_dob = $('#family_dob').val();       
            var family_relation = $('#family_relation').val();      
            var family_aadhaar = $('#family_aadhaar').val();      
            var msg = $('#family_aadhaar_error').html();      
						
		var enrty = 0;

			if(row_id != 'Add')
			{

			if((familyname == "")||(family_dob == "")||(family_relation == "")||(family_aadhaar == ""))
			{
			$().toastmessage('showSuccessToast', "Please Fill All Family Details");
			}
			else if(msg != "")
			{
			$().toastmessage('showSuccessToast', "Please Enter Valide Aadhaar No.");
			}
			else{
		
				var id1 = row_id;	
				
			if(old_adhar == family_aadhaar)
			{
				entry = 0;
			}
			else{
					var r1 = $('table#example3').find('tbody').find('tr');
					var r = r1.length;
					for (var i = 0; i < r; i++) {
					var table_adharno = $(r1[i]).find('td:eq(3)').html();
						if(family_aadhaar == table_adharno){
							entry = 2;
						}
				
				}
			}
			if(entry == 0)
			{

        
		 $('#fname'+id1).html(familyname);		
		$('#fdob'+id1).html(family_dob);
		$('#frelation'+id1).html(family_relation);
		$('#fadhar'+id1).html(family_aadhaar);
		$('#edit_familydetail'+id1).val(family_aadhaar);
		
			$('#fname'+id1).attr('id','fname'+family_aadhaar);			
			$('#fdob'+id1).attr('id','fdob'+family_aadhaar);			
			$('#frelation'+id1).attr('id','frelation'+family_aadhaar);			
			$('#fadhar'+id1).attr('id','fadhar'+family_aadhaar);			
			$('#edit_familydetail'+id1).attr('id','edit_familydetail'+family_aadhaar);			

			
			$('#familyname').val('');       
            $('#family_dob').val('');       
            $('#family_relation').val('');      
			$('#family_aadhaar').val('');      
			
			$('#family_row_id').val('Add');             
            $('#family_adhar_check').val('');
		
				
			}
			else if(entry == 2){
		$().toastmessage('showSuccessToast', "Entered Aadhaar No. Already Exist !!!");				
				}
	
			}		
			}
			else{


			if((familyname == "")||(family_dob == "")||(family_relation == "")||(family_aadhaar == ""))
			{
			$().toastmessage('showSuccessToast', "Please Fill All Family Details");
			}
			else if(msg != "")
			{
			$().toastmessage('showSuccessToast', "Please Enter Valide Aadhaar No.");
			}
			else{
			var dlt = 0;	
			var r1 = $('table#example3').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var table_adharno = $(r1[i]).find('td:eq(3)').html();
			//alert(doc_type+'//'+docType_text);
			if(family_aadhaar == table_adharno){
								var dlt = 1		
				}
			}
			
			if(dlt == 1){ 
		$().toastmessage('showSuccessToast', "Entered Aadhaar No. Already Exist !!!");

				var dlt = 0;
				}
			else{
				
	var appendDiv='<tr><td id="fname'+family_aadhaar+'" >'+familyname+'</td><td  id="fdob'+family_aadhaar+'"  >'+family_dob+'</td><td  id="frelation'+family_aadhaar+'"  >'+family_relation+'</td><td  id="fadhar'+family_aadhaar+'"  >'+family_aadhaar+'</td><td><button  class="dlt_family btn btn-danger" id="dlt_family" name="dlt_family"><em class="fa fa-minus"></em></button>  <button  class="edit_familydetail btn btn-primary" id="edit_familydetail'+family_aadhaar+'" value="'+family_aadhaar+'" name="edit_familydetail"><em class="fa fa-edit"></em></button></td></tr>';
		$("#family_detail_list1").append(appendDiv);	

			$('#familyname').val('');       
            $('#family_dob').val('');       
            $('#family_relation').val('');      
			
			$('#family_row_id').val('Add');             
			$('#family_adhar_check').val(''); 			
	
			}		
			
			}
			}
		

			
	});
		

		
	 	//add new row in nominee detail div
	$(document).on("click",".dlt_nominee",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	
	
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
		                html += '<option value="" >Select Contractor</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].contractor_id+'" >'+data[i].contractor_name+'</option>';
		            }
		            $('#contractor1').html(html);					
				}
					
				});
		}
		
		
/*---------view contracor list end-----------------*/

		$(document).on('change','#typeEmp',function(){

		var empType1 = $('#typeEmp').val();
		
		if(empType1 == "BIDI MAKER"){
			
			$("#contractor1").removeAttr('disabled'); 
		}
		else{
			$("#contractor1").attr('disabled','disabled');
		}
		
		});
		
		$(document).on('focusout','#dob',function(){

		var dob1 = $('#dob').val();
			
		dob = new Date(dob1);

		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		
//		$('#age1').html(age+' years old');			
		
		if(age < 18)
		{
		$('#age1').html(age+' years old , invalid Age');						
		}
		else if(age > 55){
		$('#age1').html(age+' years old , invalid Age');									
		}
		else{
		$('#age1').html(age+' years old');			
		}
		
		});
		
/*		$(document).on('focusout','.address_info',function(){

		var addp1 = $('#address1').val();
		var addp2 = $('#address2').val();
		var addp3 = $('#address3').val();
			
		$('#nomi_address1').val(addp1);			
		$('#nomi_address2').val(addp2);			
		$('#nomi_address3').val(addp3);			
		
		});
*/		
		
			function show_nomi_address(id){
	//	alert(id)
				$.ajax({
		        type  : 'ajax',
				url  : baseurl+"addresscontroller/view_address",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" selected disabled >Select Address</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
		            $('#nomi_address_'+id).html(html);					
				}
					
				});
		}

	/*-----------------------------------------------------------*/	
	/*-----------------------------------------------------------*/	
	/*-----------------------------------------------------------*/	
	/*-----------------------------------------------------------*/	
	/*-----------------------------------------------------------*/	
	/*-----------------------------------------------------------*/	
				
    $(document).on("submit","#employee_form",function(e){
	
			e.preventDefault();
            var save_update1 = $('#save_update').val(); 
            var pmrpy      = $('#pmrpy').val(); 
            var emp_image      = $('#emp_image_name').html(); 
			var member_id      = $('#member_id').val(); 
			var uan_id      = $('#uan_id').val(); 
			var ip_number   = $('#ip_number').val();
			console.log('IP Number from form:', ip_number);
			
			if(emp_image){}
			else{
				var emp_image="";
				}
            var empName      = $('#empName').val();          
            var dob          = $('#dob').val();
		var tdateAr = dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);

            var adharno      = $('#adharno').val();          
            var gender       = $('#gender').val();           
            var fhName       = $('#fhName').val();           
            var relation     = $('#relation').val();         
            var status       = $('#status').val();           
            var mobile       = $('#mobile').val();           
            var qualification= $('#qualification').val();    
            var doj          = $('#doj').val();
			
		var tdateAr = doj.split('/');
		var doj = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(doj);

            var typeEmp      = $('#typeEmp').val();          
            var contractor1  = $('#contractor1').val();      
            var address_list = $('#address_list_personalinfo').val();     
            var postoffice   = $('#postoffice').val();       
            var district     = $('#district').val();         
            var pincode      = $('#pincode').val();          

             var nationality= $('#nationality').val();          
            var emailid   = $('#emailid').val();          
			//alert(emailid);
			
            var international_worker      = $('#international_worker').val();          
			if(international_worker=="Y"){
            var contry     = $('#contry').val();          
            var passportno = $('#passportno').val();
			
            var validefrom     = $('#validefrom').val();          
		var tdateAr = validefrom.split('/');
		var validefrom = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(validefrom);

		var validetill     = $('#validetill').val();          				
		var tdateAr = validetill.split('/');
		var validetill = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(validetill);
		
		
			}
			else{
			var contry     = "";    
            var passportno = "";          
            var validefrom = "";          
            var validetill = "";          							
			}
            var physical_handicap     = $('#physical_handicap').val();       
 //           var disability     = $("input[type='checkbox']").val();
			if(physical_handicap=="Y")
			{
				if ($('#locomotive').is(":checked")){ var locomotive = "L"; }else{ var locomotive = ""; }
		if ($('#hearing').is(":checked")){ var hearing = "H"; }else{ var hearing = ""; }
			if ($('#visual').is(":checked")){ var visual = "V"; }else{ var visual = ""; }
			}
			else{
				var locomotive = "";
				var hearing = "";
				var visual = "";
			}
			$.ajax({
			
                type : "POST",
				url  : baseurl+"employee/save_employee",
                dataType : "JSON",
                data : {pmrpy:pmrpy,id:save_update1,uan_id:uan_id,ip_number:ip_number,member_id:member_id,nationality:nationality,emailid:emailid,locomotive:locomotive,hearing:hearing,visual:visual,physical_handicap:physical_handicap,passportno:passportno,validefrom:validefrom,validetill:validetill,contry:contry,international_worker:international_worker,empName:empName ,dob:dob,adharno:adharno, gender:gender,fhName:fhName,relation:relation,status:status,mobile:mobile ,qualification:qualification,doj:doj, typeEmp:typeEmp,contractor1:contractor1,address_list:address_list,postoffice:postoffice,district:district,pincode:pincode,emp_image:emp_image},
                success: function(data){
				
		
				
					if(save_update1 != "add"){
						employee_id = save_update1;			
			}
			else{
				employee_id = data;
				}
			if(data != ""){
			
			
			
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var doc_type = $(r1[i]).find('td:eq(0)').html();
			var doc_no = $(r1[i]).find('td:eq(1)').html();
			var doc_name = $(r1[i]).find('td:eq(2)').html();
			var ifsc = $(r1[i]).find('td:eq(3)').html();
			var doc_img = $(r1[i]).find('td:eq(4)').html();
//			var employee_id = data;
			$.ajax({
				
                type : "POST",		
				url  : baseurl+"employee/save_kyc_detail",
                dataType : "JSON",
                data : {id:save_update1,doc_type:doc_type ,doc_no:doc_no,doc_name:doc_name,ifsc:ifsc,doc_img:doc_img,employee_id:employee_id},
				success: function(data1){
				}
				});
			}
			var r1 = $('table#example2').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++){
			var name = $(r1[i]).find('td:eq(0)').html();
			var address = $(r1[i]).find('td:eq(1)').html();
			
			var nomi_adhar_no = $(r1[i]).find('td:eq(6)').html();
			var nomi_relation = $(r1[i]).find('td:eq(7)').html();
			//alert(address);
			var dob = $(r1[i]).find('td:eq(8)').html();

			var g_name = $(r1[i]).find('td:eq(10)').html();
			var g_address = $(r1[i]).find('td:eq(11)').html();

		var tdateAr = dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();

			var share = $(r1[i]).find('td:eq(9)').html();
		
			$.ajax({
				
                type : "POST",
				url  : baseurl+"employee/save_nominee_detail",
                dataType : "JSON",
                data : {id:save_update1,name:name ,address:address,dob:dob,share:share,nomi_adhar_no:nomi_adhar_no,nomi_relation:nomi_relation,g_name:g_name,g_address:g_address,employee_id:employee_id},
				success: function(data2){
				}
				});
			}			
			var r1 = $('table#example3').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++){
			var name = $(r1[i]).find('td:eq(0)').html();
			var dob = $(r1[i]).find('td:eq(1)').html();
			var relation = $(r1[i]).find('td:eq(2)').html();
			var family_aadhaar = $(r1[i]).find('td:eq(3)').html();
					var tdateAr = dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
			
//			var employee_id = data;
			$.ajax({
                type : "POST",
				url  : baseurl+"employee/save_family_detail",
                dataType : "JSON",
                data : {id:save_update1,name:name,dob:dob,relation:relation,family_aadhaar:family_aadhaar,employee_id:employee_id},
				success: function(deta3){
				}
				});
			}			


			
			
				$().toastmessage('showSuccessToast', "Employee Data Save Successfully");
					show_employee();//show employee list
                    $('#save_update').val("add");
					$("#hide_show").hide();
					$("#new").show();
				}else{

				$().toastmessage('showErrorToast', "Employee Data Save Failed");
			
				}
				employee_form_clear();
                }
            });
            return false;
	});                       
		               
	
/*---------view employe data list start-----------------*/
/*
	show_employee();	//call function show all packingwages
		
	
		function show_employee(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"employee/show_employee",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example4" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th style="white-space:nowrap;"><center>Action (Edit/Delete)</center></th><th style="white-space:nowrap;">SR No.</th><th style="white-space:nowrap;">Name as per Aadhaar Card</th><th style="white-space:nowrap;">Date Of Birth</th><th style="white-space:nowrap;">Aadhar Card Number </th><th >Gender </th><th style="white-space:nowrap;" >Father`s/Husband`s Name</th><th style="white-space:nowrap;">      Relation        </th><th style="white-space:nowrap;">Marital Status</th><th style="white-space:nowrap;" >Mobile Number</th><th style="white-space:nowrap;">Qualification</th><th style="white-space:nowrap;">Date of Joining </th><th style="white-space:nowrap;">Type of Employee</th><th style="white-space:nowrap;">Contractor Name</th><th >Address</th><th>Post Office</th><th >  District</th><th>Pincode</th>	<th style="white-space:nowrap;">Employee Image Name</th></tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
					var dob = data[i].dob;
		var tdateAr = dob.split('-');
		var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(dob);

					var doj = data[i].doj;
		var tdateAr = doj.split('-');
		var doj = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(doj);

					
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td><!--<button  class="view_row_detail btn btn-sm btn-primary"  id="'+data[i].emp_id+'"  data-toggle="modal" data-target="#myModal"  ><i class="fa fa-edit"></i></button>--><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].emp_id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].emp_id+'" ><i class="fa fa-trash"></i></button></td>'+
								'<td>'+sr+'</td>'+
		                        '<td>'+data[i].name_as_aadhaar+'</td>'+
	                        '<td>'+dob+'</td>'+
	                        '<td>'+data[i].aadhaar_no+'</td>'+
	                        '<td>'+data[i].gender+'</td>'+
	                        '<td>'+data[i].father_husband+'</td>'+
	                        '<td>'+data[i].relation+'</td>'+
	                        '<td>'+data[i].marital_status+'</td>'+
	                        '<td>'+data[i].mobile+'</td>'+
	                        '<td style="white-space:nowrap;">'+data[i].qualification+'</td>'+
	                        '<td>'+doj+'</td>'+
	                        '<td>'+data[i].employee_type+'</td>'+
	                        '<td>'+data[i].contractor+'</td>'+
	                        '<td style="white-space:nowrap;" >'+data[i].address+'</td>'+
	                        '<td>'+data[i].post_office+'</td>'+
	                        '<td>'+data[i].district+'</td>'+
	                        '<td>'+data[i].pincode+'</td><td>'+data[i].emp_image+'</td></tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_employee_list').html(html);
					
					
	
  
	   var msg = "Employee List";
    $('#example4').dataTable({
		'scrollX': true,
		'scroller': {rowHeight: 5},
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
		
/*---------view employe data list end-----------------*/


/*---------get  employe row details by click on view  start-----------------*/
/*
  	$('#show_address').on('click','.view_row_detail',function(){
		var id1 = $(this).attr('id');
		$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_kyc_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var kyc = '';
				for(i=0; i<data.length; i++){
				kyc += '<tr><td>'+data[i].doc_type+'</td><td>'+data[i].doc_num+'</td><td>'+data[i].doc_name+'</td><td>'+data[i].ifsc+'</td><td>'+data[i].kyc_image+'</td></tr>';
				}
				$('#kyc_detail_view_list').html(kyc);
					
				}
				});

				
				$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_family_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var family = '';
				for(i=0; i<data.length; i++){
				
									var dob = data[i].dob_as_aadhaar;
					var tdateAr = dob.split('-');
					var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
					console.log(dob);

				
				kyc += '<tr><td>'+data[i].family_name+'</td><td>'+data[i].dob_as_aadhaar+'</td><td>'+data[i].relation+'</td></tr>';
				}
				$('#family_detail_view_list').html(family);
					
				}
				});

				$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_nominee_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var nominee = '';
				for(i=0; i<data.length; i++){
					var dob = data[i].dob;
					var tdateAr = dob.split('-');
					var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();

					console.log(dob);

				nominee += '<tr><td>'+data[i].nominee_name+'</td><td>'+data[i].address+'</td><td>'+data[i].post_office+'</td><td>'+data[i].district+'</td><td>'+data[i].pincode+'</td><td>'+data[i].dob+'</td><td>'+data[i].share+'</td></tr>';
				}
				$('#nominee_detail_view_list').html(nominee);
					
				}
				});

				
	});
	
/*---------get  employe row details by click on view  end----------------*/
   
			
/*---------get  employe row details in form by click on edit button  start--*/

$(document).on('click','.edit_row',function(){
	var id1 = $(this).attr('id');
	
	$.ajax({
		        type  : 'POST',
				url  : baseurl+"employee/show_employee_detail",
		        dataType : "JSON",
                data : {id:id1},
		        success : function(data){

					var i = 0;
				var dob = data[0].dob;
					
					var fdateAr = dob.split('-');
					var dob = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();

					var doj = data[0].doj;
					var tdateAr = doj.split('-');
					var doj = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();

					console.log(dob);
					console.log(doj);
					$('#uan_id').val(data[i].UAN);
	                $('#member_id').val(data[i].member_id);
	                $('#empName').val(data[i].name_as_aadhaar);
	                $('#dob').val(dob);
	                $('#adharno').val(data[i].aadhaar_no);
	                $('#gender').val(data[i].gender);
	                $('#fhName').val(data[i].father_husband);
	                $('#relation').val(data[i].relation);
	                $('#status').val(data[i].marital_status);
	                $('#mobile').val(data[i].mobile);
	                $('#qualification').val(data[i].qualification);
	                $('#doj').val(doj);
	                $('#typeEmp').val(data[i].employee_type);
					
							if(data[i].pmrpy==""){
									$('#pmrpy').val('YES');								
							}
							else{
									$('#pmrpy').val(data[i].pmrpy);																
							}
							
					
							if(data[i].employee_type == "BIDI MAKER"){		
							$("#contractor1").removeAttr('disabled'); 
							}
							else{
							$("#contractor1").attr('disabled','disabled');
							}

								
					
	                $('#contractor1').val(data[i].contractor);
					
	                $('#address_list_personalinfo').val(data[i].address_id);
	                $('#postoffice').val(data[i].post_office);
	                $('#district').val(data[i].district);
	                $('#pincode').val(data[i].pincode);        
	                $('#msg_emp').html("<font id='emp_image_name' color='green'>"+data[i].emp_image+"</font>"); 
					$('#containerother_emp').html('<img id="myImage" src="'+baseurl+'assets/images/employee/profile/'+data[i].emp_image+'" width="150" />');

        $('#nationality').val(data[i].nationality);          
        $('#emailid').val(data[i].email);          
		
		
        $('#international_worker').val(data[i].international_worker);  

		if(data[i].international_worker=="Y"){
			$("#hide_contry").show(); 
			$("#hide_passportno").show(); 
			$("#hide_validefrom").show(); 		
			$("#hide_validetill").show(); 		

        $('#contry').val(data[i].contry_origin);          
        $('#passportno').val(data[i].passport_no);
        	
		var tdateAr = data[i].passport_from_date.split('-');
		var validefrom = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(validefrom);
		$('#validefrom').val(validefrom);          
		
		var tdateAr = data[i].passport_till_date.split('-');
		var validetill = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
		console.log(validetill);
		$('#validetill').val(validetill);          			
	
		}
		else{
   			$("#hide_contry").hide(); 
			$("#hide_passportno").hide(); 
			$("#hide_validefrom").hide(); 		
			$("#hide_validetill").hide(); 		
		}
        
		$('#physical_handicap').val(data[i].physical_handicap);       
		if($('#physical_handicap').val()=="Y")
		{
			$("#hide_physical_handicap").show(); 
		if (data[i].locomotive=="L"){ $("#locomotive").prop('checked', true);  }else{ $("#locomotive").prop('checked', false);  }
		if (data[i].hearing=="H"){$("#hearing").prop('checked', true);  }else{ $("#hearing").prop('checked', false);  }
		if (data[i].visual=="V"){ $("#visual").prop('checked', true);  }else{ $("#visual").prop('checked', false);  }
			
		}	
		
				
					
					
					
					
			$('#save_update').val(id1); 
			$("#hide_show").show();
			$("#new").hide();
			$("#close").show();
			
			
		$("#show_kycdetail_list1").html("");
		
				$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_kyc_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var kyc_detail = '';
			//	alert(data.length);	
				var i;
				for(i=0; i<data.length; i++)
				{
				
					if(data[i].doc_type=="DRIVING LICENSE"){ var doc_type_text="DRIVING_LICENSE"; }
					else if(data[i].doc_type=="BANK"){ var doc_type_text="BANK"; }
					else if(data[i].doc_type=="PAN"){ var doc_type_text="PAN"; }
					else if(data[i].doc_type=="ELECTION CARD"){ var doc_type_text="ELECTION_CARD"; }
					else if(data[i].doc_type=="RATION CARD"){ var doc_type_text="RATION_CARD"; }
					else if(data[i].doc_type=="NATIONAL POPULATION REGISTER"){ var doc_type_text="NATIONAL_POPULATION_REGISTER"; }
					else if(data[i].doc_type=="AADHAAR CARD"){  var doc_type_text="AADHAAR_CARD"; }
				
//'<tr><td  id="doctypeAADHAAR_CARD"  >AADHAAR CARD</td><td  id="docnumAADHAAR_CARD" >'+adharno+'</td><td  id="docnameAADHAAR_CARD"  >'+empName+'</td><td  id="ifscAADHAAR_CARD"  ></td><td  id="kycimageAADHAAR_CARD"  ></td><td><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>  <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetailAADHAAR_CARD" value="AADHAAR_CARD" name="edit_kycdetail"><em class="fa fa-edit"></em></button><input type="hidden" value="ok" id="adharno_kyc_cf" /></td></tr>';
					
			kyc_detail += '<tr><td id="doctype'+doc_type_text+'" >'+data[i].doc_type+'</td><td id="docnum'+doc_type_text+'" >'+data[i].doc_num+'</td><td id="docname'+doc_type_text+'" >'+data[i].doc_name+'</td><td id="ifsc'+doc_type_text+'">'+data[i].ifsc+'</td><td id="kycimage'+doc_type_text+'" >'+data[i].kyc_image+'</td><td style="white-space:nowrap;" ><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>   <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetail'+doc_type_text+'" value="'+doc_type_text+'" name="del_kycdetail"><em class="fa fa-edit"></em></button><input type="hidden" value="ok" id="adharno_kyc_cf" /></td></tr>';
				}
				$("#show_kycdetail_list1").append(kyc_detail);					
				}
				});
			
				$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_nominee_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var nominee = '';
				for(i=0; i<data.length; i++){
					var dob = data[i].dob;
					var tdateAr = dob.split('-');
					var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					console.log(dob);

				nominee += '<tr><td  id="name'+data[i].nomi_aadhar+'"   >'+data[i].nominee_name+'</td><td style="display:none"   id="address_id'+data[i].nomi_aadhar+'"   >'+data[i].address_id+'</td><td  id="address'+data[i].nomi_aadhar+'"  >'+data[i].address+'</td><td  id="postoffice'+data[i].nomi_aadhar+'"  >'+data[i].post_office+'</td><td  id="district'+data[i].nomi_aadhar+'"  >'+data[i].district+'</td><td  id="pincode'+data[i].nomi_aadhar+'"  >'+data[i].pincode+'</td><td  id="adharno'+data[i].nomi_aadhar+'"  >'+data[i].nomi_aadhar+'</td><td  id="relation'+data[i].nomi_aadhar+'"  >'+data[i].nomi_relation+'</td><td  id="dob'+data[i].nomi_aadhar+'"  >'+dob+'</td><td  id="share'+data[i].nomi_aadhar+'"  >'+data[i].share+'</td><td  id="g_name'+data[i].nomi_aadhar+'"  >'+data[i].guardian_name+'</td><td  id="g_address'+data[i].nomi_aadhar+'"  >'+data[i].guardian_address+'</td><td><button  class="del_kycdetail btn btn-danger btn-xs" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>   <button  class="edit_nomineedetail btn btn-primary btn-xs" id="edit_nomineedetail'+data[i].nomi_aadhar+'" value="'+data[i].nomi_aadhar+'" name="edit_nomineedetail"><em class="fa fa-edit"></em></button></td></td></tr>';
				}
				$('#show_nominee_detail_list1').html(nominee);
					
				}
				});
			
			
			$.ajax({
                type : "POST",
				url  : baseurl+"employee/view_family_detail",
                dataType : "JSON",
                data : {id:id1},
				success: function(data){
				var family = '';
				for(i=0; i<data.length; i++){
				
					var dob = data[i].dob_as_aadhaar;
					var tdateAr = dob.split('-');
					var dob = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					console.log(dob);

				family += '<tr><td  id="fname'+data[i].family_aadhaar+'"  >'+data[i].family_name+'</td><td  id="fdob'+data[i].family_aadhaar+'"  >'+dob+'</td><td  id="frelation'+data[i].family_aadhaar+'"  >'+data[i].relation+'</td><td  id="fadhar'+data[i].family_aadhaar+'"  >'+data[i].family_aadhaar+'</td><td><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>   <button  class="edit_familydetail btn btn-primary" id="edit_familydetail'+data[i].family_aadhaar+'" value="'+data[i].family_aadhaar+'" name="edit_familydetail"><em class="fa fa-edit"></em></button></td></tr>';
				}
				$('#family_detail_list1').html(family);
					
				}
				});

			
				}
				});

});
/*---------get  employe row details in form by click on edit button  end----*/
$(document).on('click','.close_form',function(){
			employee_form_clear();
			});

/*---------delete  employee data  start-----------------*/

$(document).on('click','.delete_row',function(){
	
		var id1 = $(this).attr('id');
	

		      swal({
        title : "Are you sure?",
        text : "You will not be able to recover this imaginary Data!",
        type : "warning",
        showCancelButton : true,
        confirmButtonColor : "#DD6B55",
        confirmButtonText : "Yes, delete it!",
        closeOnConfirm : true
      },
        function () {
			
		
			
				$.ajax({
                type : "POST",
				url  : baseurl+"employee/delete_employee",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Employee Data Delete Successfully");
			
					show_employee();//call function show all show_employee					
					
					}
					else{
					$().toastmessage('showErrorToast', "Employee Data Delete Failed");
					}
	
                }
            });
            return false;
		   });

		
	});
	
/*---------delete  employee data  end-----------------*/

     
employee_form_clear();

			function employee_form_clear(){
           $('#save_update').val('add'); 
		   $('#empName').val('');  
		   $('#uan_id').val('');          
           $('#dob').val('');              
           $('#adharno').val('');          
           $('#gender').val('');           
           $('#fhName').val('');           
           $('#relation').val('');         
           $('#status').val('');           
           $('#mobile').val('');           
           $('#qualification').val('');    
           $('#doj').val('');              
           $('#typeEmp').val('');          
           $('#contractor1').val('');      
           $('#address_list_personalinfo').val('');     
           $('#postoffice').val('');       
           $('#district').val('');         
           $('#pincode').val('');          
		   $('#member_id').val(''); 

	                $('#uploadFile_emp').val(''); 
				      $('#msg_emp').html(''); 
					$('#containerother_emp').html('');

	                $('#msg').html(''); 
					$('#containerother_kyc').html('');
					$("#show_kycdetail_list1").html('');	
					$("#family_detail_list1").html('');	
					$("#show_nominee_detail_list1").html('');	
					
					
	
        $('#nationality').val('INDIAN');          
        $('#emailid').val('');          
		
		
        $('#international_worker').val('N');  

			$("#hide_contry").hide(); 
			$("#hide_passportno").hide(); 
			$("#hide_validefrom").hide(); 		
			$("#hide_validetill").hide(); 		

        $('#contry').val('');          
        $('#passportno').val('');
        	
		$('#validefrom').val('');          
		$('#validetill').val('');          			
	
	    
		$('#physical_handicap').val('N');       
		$("#hide_physical_handicap").hide(); 
		
	$("#locomotive").prop('checked', false);
$("#hearing").prop('checked', false);
$("#visual").prop('checked', false);	

			}	
				
		
/*----------dob validation------------------start--------*/
$(document).on('focusout','#dob',function(){
		var dob = $('#dob').val();
	
			dob_validation(dob);
			
		});

		function dob_validation(dob){
			console.log(dob);
			//start=dob;
			
			
		if(dob == ""){
					//$('#dob_error').html('Age Must be 18 Year to 50 Year');
		}
		else{
				
						var tdateAr = dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);

		
		dob = new Date(dob);
		
		var today = new Date();
	
		//today = today.toString('dd-MM-yyyy');
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		

//		$('#age').html(age+' years old');
		if((age < 18) || (age > 50))
		{
			$('#dob').attr('oninvalid','oninvalid'); 

					//$('#dob').val('');
					$('#dob_error').html('Age Must be 18 Year to 50 Year');
		}
		else{
					$('#dob_error').html('');
			}
			}
		if($('#dob_error').html() == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

				}

/*----------dob validation------------------end--------*/
/*----------doj validation------------------start--------*/
$(document).on('focusout','#doj',function(){
		var doj = $('#doj').val();
	
		var msg = 	doj_validation(doj);
					$('#doj_error').html(msg);
					if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

		});

		function doj_validation(doj){
		var dob = $('#dob').val();
			
		if((doj == "")||(doj == null)){
				var msg = "Please Enter Date Of Joining";
		}
		else{
				
		var tdateAr = doj.split('/');
		var doj = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(doj);

		var tdateAr = dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);

		
		doj = new Date(doj);
		dob = new Date(dob);
		var today = new Date();
		if((doj < dob) || (doj > today))
		{
				var msg = "Enter Valide Date Of Joining";
			
		}
		else{
				var msg = "";
			
			}
			}
			return msg;

				}

/*----------doj validation------------------end--------*/


/*----------Employee Name validation------------------start--------*/
$(document).on('focusout','#empName',function(){
		var empName = $('#empName').val();
			empName_validation(empName);
			
		});

		function empName_validation(empName){
		var msg = "";	
		if((empName == "")|| (empName == "null")){
		 msg = 'Please Enter  Name';
		}
		else{
					if (!empName.match('^[a-zA-Z ]{1,100}$') ){
						msg = "Special Characters Not Allowed";
					}
			}
					$('#empname_error').html(msg);
							if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

	}
/*-----------Employee Name  validation------------------end--------*/



/*----------Aadhaarcard validation------------------start--------*/
$(document).on('focusout','#adharno',function(){
		var adharno = $('#adharno').val();
			var msg = adharno_validation(adharno);	
				if(msg==""){
//			var email = adharno+'@dineshbidi.com';
//			$('#emailid').val(email);
			
			
//update email field using website name of company and adhar no			

					$.ajax({
                type : "POST",
				url  : baseurl+"employee/update_email_address",
                dataType : "JSON",
                data : { adharno:adharno },
                success: function(data){
			$('#emailid').val(data);
	
                }
            });	
			
			
				}
			$('#adharno_error').html(msg);
					if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

		});
		
$(document).on('focusout','#nomiadharno',function(){
		var nomiadharno = $('#nomiadharno').val();
			var msg = adharno_validation(nomiadharno);
			if(msg != ""){ 		
			$("#add_nominee").attr('disabled','disabled');
			}
		else{
			$("#add_nominee").removeAttr('disabled'); 
			}
			
			$('#nomiadharno_error').html(msg);
					if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

		});
$(document).on('focusout','#family_aadhaar',function(){
		var family_aadhaar = $('#family_aadhaar').val();
			var msg = adharno_validation(family_aadhaar);
			if(msg != ""){ 		
//			$("#add_family").hide();
			}
		else{
//			$("#add_family").show(); 
			}
			
			$('#family_aadhaar_error').html(msg);
		});

		function adharno_validation(adharno){
		var msg = "";	
		if((adharno == "")||(adharno == null)){
		 msg = 'Please Enter Aadhaar No';
		}
		else{
					if (!adharno.match('^[0-9]{12}$')){
						msg = "Invalid Aadhaar No.";
					}
			}
			return msg;
				if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}
	
		}
/*-----------Aadhaarcard  validation------------------end--------*/
/*----------gender validation------------------start--------*/
 $(document).on('focusout','#gender',function(){
		var gender = $('#gender').val();
			gender_validation(gender);
			
		});

		function gender_validation(gender){
		var msg = "";	
		if((gender == "")||(gender == null)){
		 msg = 'Please Select Gender';
		}
		else{
/*-If gender is “Male” than Relation must be “Father” start-----------------*/
		if(gender == "MALE"){			
			$("#relation").val('FATHER'); 
		}
		else{
			$("#relation").val(''); 
			}
		}
					$('#gender_error').html(msg);
							if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

		}
/*----------gender  validation------------------end--------*/

/*----------Father/husband name validation------------------start--------*/
$(document).on('focusout','#fhName',function(){
	var fhName = $('#fhName').val();
			fhName_validation(fhName);
			
		});

		function fhName_validation(fhName){
		var msg = "";	
		if((fhName == "")||(fhName == null)){
		 msg = 'Enter Father/Husband Name';
		}
		else{
					if (!fhName.match('^[a-zA-Z ]{1,100}$') ){
						msg = "Special Characters Not Allowed";
					}
			}
					$('#fhname_error').html(msg);
							if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

	}
/*----------Father/husband name validation------------------start--------*/
/*----------relation validation------------------start--------*/
 $(document).on('focusout','#relation',function(){
		var relation = $('#relation').val();
			relation_validation(relation);
			
		});

		function relation_validation(relation){
		var msg = "";	
		if((relation == "")||(relation == null)){
		 msg = 'Please Select Relation';
		}
				if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

					$('#relation_error').html(msg);
		}
/*----------relation  validation------------------end--------*/

/*----------marital status validation------------------start--------*/
 $(document).on('focusout','#status',function(){
		var status = $('#status').val();
		var msg = status_validation(status);
		$('#status_error').html(msg);
		
		if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

		
		});

		function status_validation(status){
		var msg = "";	
		if((status == "")||(status == null)){
		 msg = 'Please Select Status';
		}
		return msg;
		}
/*----------marital status  validation------------------end--------*/



/*----------Mobile Number validation------------------start--------*/
 $(document).on('focusout','#mobile',function(){
		var mobile = $('#mobile').val();
		var msg1 = mobile_validation(mobile);
//		alert(msg1);
//		alert(msg1+'//');
		if(msg1=="")
		{
			$.ajax({
		        type  : 'POST',
				url  : baseurl+"employee/check_mobileno",
                data : {mobile:mobile},
		        dataType : 'json',
		        success : function(data){
					if(data == 1)
					{
					var	msg = "Mobile Number Allredy Exist";
					$('#mobile_error').html(msg);			
					}
					else{
					$('#mobile_error').html('');									
					}
				}					
				});
	
		}
		else{
				$('#mobile_error').html(msg1);			
			}
			
		if($('#mobile_error').html() == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

 });

		
		function mobile_validation(mobile){
		var msg = "";	
		if((mobile == "")||(mobile == null)){
		 msg = 'Please Enter Mobile No.';
		}
		else if(!mobile.match('^[0-9]{10}$')){
						msg = "Invalid Mobile No.";
					}
			
				return msg;
	}
/*----------Mobile Number  validation------------------end--------*/
/*----------doj validation------------------start--------*/
$(document).on('focusout','#nationality',function(){
	var nationality =  $('#nationality').val();
	var msg = nationality_validation(nationality);
	
		$('#nationality_error').html(msg);
						if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}
	
		});
		function nationality_validation(nationality){
			
		if((nationality == "")||(nationality = null)){
			var msg = "Please Enter Nationality";
		}
		else{
			var msg ="";
		}
			return msg;
		}

/*----------doj validation------------------end--------*/

/*----------Contry of Origin validation------------------start--------*/
$(document).on('focusout','#contry',function(){
	var contry =  $('#contry').val();
	var msg = contry_validation(contry);
	
		$('#contry_error').html(msg);
				if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}
			
		});
		function contry_validation(contry){
			
		if((contry == "")||(contry = null)){
		var	msg = "Please Enter Contry of Origin";
		}
		else{
		var	msg ="";
		}
			return msg;
		}

/*----------Contry of Origin validation------------------end--------*/


/*----------Passport no validation------------------start--------*/
$(document).on('focusout','#passportno',function(){
	var passportno =  $('#passportno').val();
	var msg = passportno_validation(passportno);
	
		$('#passportno_error').html(msg);
				if(msg == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}

			
		});
		function passportno_validation(passportno){
			
		if((passportno == "")||(passportno = null)){
		var	msg = "Please Enter Passport No.";
		}
		else{
		var	msg ="";
		}
			return msg;
		}

/*----------passportno validation------------------end--------*/


/*----------Passport from date validation------------------start--------*/
$(document).on('focusout','#validefrom',function(){
	var validefrom =  $('#validefrom').val();
	var msg = validefrom_validation(validefrom);
	
		$('#validefrom_error').html(msg);
		if($('#validefrom_error').html() == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}
			
		});
		function validefrom_validation(validefrom){
			
		if((validefrom == "")||(validefrom = null)){
		var	msg = " Enter Passport valide from date.";
		}
		else{
		var	msg ="";
		}
			return msg;
		}
/*----------Passport from date validation------------------end-------*/


/*----------Passport valide till date validation------------------start--------*/
$(document).on('focusout','#validetill',function(){
	var validetill =  $('#validetill').val();
	var msg = validetill_validation(validetill);
		$('#validetill_error').html(msg);
		
		if($('#validetill_error').html() == "")
		{
			$("#btn_insert").removeAttr('disabled'); 
		}
		else{
			$("#btn_insert").attr('disabled','disabled');
		}
			
		});
		function validetill_validation(validetill){
			
		if((validetill == "")||(validetill = null)){
		var	msg = "Enter Passport valide till date.";
		}
		else{
		var	msg ="";
		}
			return msg;
		}
/*----------Passport valide till date validation------------------start--------*/


/*----------kyc aadhaar no carry from personal info------------------start--------*/
$(document).on('focusout','#adharno',function(){
		var adharno = $('#adharno').val();
		var empName = $('#empName').val();
		if((adharno == "")||(adharno == null)||(empName == "")||(empName == null)){
		}
		else{
			
		
			var dlt = 0;	
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var doc_type = $(r1[i]).find('td:eq(0)').html();
				if(doc_type == "AADHAAR CARD"){
					var dlt = 1
					if($('#adharno_kyc_cf').val()=="ok")
					{
						var id1= "AADHAAR_CARD";
						$('#doctype'+id1).html('AADHAAR CARD');
					     $('#docnum'+id1).html(adharno);
					 	$('#docname'+id1).html(empName);
				
					}	
				}
			}
			if(dlt == 1){
				dlt = 0;
				}
				else{
					var appendDiv='<tr><td  id="doctypeAADHAAR_CARD"  >AADHAAR CARD</td><td  id="docnumAADHAAR_CARD" >'+adharno+'</td><td  id="docnameAADHAAR_CARD"  >'+empName+'</td><td  id="ifscAADHAAR_CARD"  ></td><td  id="kycimageAADHAAR_CARD"  ></td><td><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>  <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetailAADHAAR_CARD" value="AADHAAR_CARD" name="edit_kycdetail"><em class="fa fa-edit"></em></button><input type="hidden" value="ok" id="adharno_kyc_cf" /></td></tr>';
					$("#show_kycdetail_list1").append(appendDiv);	
					}		
		}
		});
/*----------kyc aadhaar no carry from personal info------------------end--------*/
/*----------kyc aadhaar no carry from personal info------------------start--------*/
$(document).on('focusout','#empName',function(){
		var adharno = $('#adharno').val();
		var empName = $('#empName').val();
		if((adharno == "")||(adharno == null)||(empName == "")||(empName == null)){
		}
		else{
			
		
			var dlt = 0;	
			var r1 = $('table#example1').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++) {
			var doc_type = $(r1[i]).find('td:eq(0)').html();
				if(doc_type == "AADHAAR CARD"){
					var dlt = 1
					if($('#adharno_kyc_cf').val()=="ok")
					{
						var id1= "AADHAAR_CARD";
						$('#doctype'+id1).html('AADHAAR CARD');
					     $('#docnum'+id1).html(adharno);
					 	$('#docname'+id1).html(empName);
						
					}	
				}
			}
			if(dlt == 1){
				dlt = 0;
				}
				else{
					var appendDiv='<tr><td  id="doctypeAADHAAR_CARD"  >AADHAAR CARD</td><td  id="docnumAADHAAR_CARD" >'+adharno+'</td><td  id="docnameAADHAAR_CARD"  >'+empName+'</td><td  id="ifscAADHAAR_CARD"  ></td><td  id="kycimageAADHAAR_CARD"  ></td><td><button  class="del_kycdetail btn btn-danger" id="del_kycdetail" name="del_kycdetail"><em class="fa fa-minus"></em></button>  <button  class="edit_kycdetail btn btn-primary" id="edit_kycdetailAADHAAR_CARD" value="AADHAAR_CARD" name="edit_kycdetail"><em class="fa fa-edit"></em></button><input type="hidden" value="ok" id="adharno_kyc_cf" /></td></tr>';
					$("#show_kycdetail_list1").append(appendDiv);	
					}		
		}
		});
/*----------kyc aadhaar no carry from personal info------------------end--------*/

/*----------family detail carry from nominee detail------------------start--------*/

$(document).on('change','#family_relation',function(){
		var family_relation = $('#family_relation').val();
		
		
		if((family_relation == "SON")||(family_relation == "DAUGHTER")||(family_relation == "WIFE")||(family_relation == "HUSBAND"))
		{	var r1 = $('table#example2').find('tbody').find('tr');
			var r = r1.length;
			for (var i = 0; i < r; i++){
			var nomi_relation = $(r1[i]).find('td:eq(7)').html();

			if(nomi_relation == family_relation)
			{
				
			var familyname = $(r1[i]).find('td:eq(0)').html();
			var nomi_aadhaar  = $(r1[i]).find('td:eq(6)').html();
			var family_dob = $(r1[i]).find('td:eq(8)').html();
			
			var row = $('table#example3').find('tbody').find('tr');
			var row1 = row.length;
			var entry = 0;					

				for (var j = 0; j < row1; j++){
				var family_aadhaar  = $(row[j]).find('td:eq(3)').html();
				
					
					if(family_aadhaar == nomi_aadhaar){
						var entry = 1;					
					}
				}
			
				if(entry==1)
				{
					entry = 0;
				}
				else{

				var appendDiv='<tr><td id="fname'+nomi_aadhaar+'" >'+familyname+'</td><td  id="fdob'+nomi_aadhaar+'" >'+family_dob+'</td><td  id="frelation'+nomi_aadhaar+'" >'+family_relation+'</td><td  id="fadhar'+nomi_aadhaar+'" >'+nomi_aadhaar+'</td><td><button  class="dlt_family btn btn-danger" id="dlt_family" name="dlt_family"><em class="fa fa-minus"></em></button>   <button  class="edit_familydetail btn btn-primary" id="edit_familydetail'+nomi_aadhaar+'" value="'+nomi_aadhaar+'" name="edit_familydetail"><em class="fa fa-edit"></em></button><input type="hidden" value="ok" id="family_carryfw'+nomi_aadhaar+'" /></td></tr>';				
				$("#family_detail_list1").append(appendDiv);						
				
				
				}	
				
			}
		}
		}
		
		});
/*----------family detail carry from nominee detail------------------start--------*/


/*---------get  kyc in form  by click on edit button   start-----------------*/
	
  	$(document).on('click','.edit_kycdetail',function(){
	
		var id1 = $(this).attr('value');
//	alert(id1);
		var docType = $('#doctype'+id1).html();
		
		var docNum = $('#docnum'+id1).html();
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
/*---------get  kyc in form  by click on edit button   end-----------------*/


/*---------get  nominee in form  by click on edit button   start-----------------*/
	
  	$(document).on('click','.edit_familydetail',function(){

		var id1 = $(this).attr('value');
		var fname = $('#fname'+id1).html();		
		var fdob = $('#fdob'+id1).html();
		var frelation = $('#frelation'+id1).html();
		var fadhar = $('#fadhar'+id1).html();
	

	
			$('#familyname').val(fname);       
            $('#family_dob').val(fdob);       
            $('#family_relation').val(frelation);      
			$('#family_aadhaar').val(fadhar);      
			
			$('#family_row_id').val(id1);
            $('#family_adhar_check').val(fadhar);

	});
/*---------get  nominee in form  by click on edit button   e-----------------*/

/*---------get  nominee in form  by click on edit button   start-----------------*/
	
  	$(document).on('click','.edit_nomineedetail',function(){

		var id1 = $(this).attr('value');

		var name = $('#name'+id1).html();		
		var address_id = $('#address_id'+id1).html();
		var address = $('#address'+id1).html();
		var postoffice = $('#postoffice'+id1).html();
		var district = $('#district'+id1).html();
		var pincode = $('#pincode'+id1).html();
		var adharno = $('#adharno'+id1).html();
		var relation = $('#relation'+id1).html();
		var dob = $('#dob'+id1).html();
		var share = $('#share'+id1).html();
		var g_name = $('#g_name'+id1).html();
		var g_address = $('#g_address'+id1).html();
		
            $('#nominee_adhar_check').val(docType);

            $('#name').val(name);             
			
            $('#nomi_address_list').val(address_id);   
            $('#nomi_postoffice').val(postoffice);
            $('#nomi_district').val(district);  
            $('#nomi_pincode').val(pincode);   
            $('#nomi_dob').val(dob);         
            $('#share').val(share);            
			
			$('#nomiadharno').val(adharno);         
			$('#nomi_relation').val(relation);         
			$('#guardian_name').val(g_name);          
            $('#guardian_address').val(g_address);  


		var nomi_dob = $('#nomi_dob').val();	
		var tdateAr = nomi_dob.split('/');
		var dob = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		console.log(dob);		
		dob = new Date(dob);
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
//		$('#age').html(age+' years old');
		if((age < 18))
		{
			$("#g_name").show(); 
			$("#g_address").show(); 
			$("#not_guardian").hide(); 
		}
		else{
			$("#g_name").hide(); 
			$("#g_address").hide(); 
			$("#not_guardian").show(); 
		}

			

			$('#nominee_row_id').val(id1);             
			$('#nominee_adhar_check').val(id1); 							

	});
/*---------get  nominee in form  by click on edit button end-----------------*/

			$("#g_name").hide(); 
			$("#g_address").hide(); 
			$("#not_guardian").show(); 

/*---------if international worker------------------start--------*/
$(document).on('change','#international_worker',function(){
		var international_worker = $('#international_worker').val();
		
		if(international_worker=="Y"){
			$("#hide_contry").show(); 
			$("#hide_passportno").show(); 
			$("#hide_validefrom").show(); 		
			$("#hide_validetill").show(); 		
			
		}
		else{
			$("#hide_contry").hide(); 
			$("#hide_passportno").hide(); 
			$("#hide_validefrom").hide(); 		
			$("#hide_validetill").hide(); 		
			
		}
		});
			$("#hide_contry").hide(); 
			$("#hide_passportno").hide(); 
			$("#hide_validefrom").hide(); 		
			$("#hide_validetill").hide(); 		

/*---------if international worker------------------end--------*/
		

/*---------if Physical Handicap  worker------------------start--------*/
$(document).on('change','#physical_handicap',function(){
		var physical_handicap = $('#physical_handicap').val();
		
		if(physical_handicap=="Y"){
			$("#hide_physical_handicap").show(); 
			
		}
		else{
			$("#hide_physical_handicap").hide(); 
		}
		});
			$("#hide_physical_handicap").hide(); 

/*---------if Physical Handicap  worker------------------end--------*/

// click event of ABRY applicable checkbox
$(document).on('click','.abry_applicable',function(){
	var emp_id = $(this).attr('id');
	var abry = '';

	if( $(this).is(':checked') ){
		abry = 1;
	}else{
		abry = 0;
	}
	
	$.ajax({
		type  : 'POST',
		url  : baseurl+"employee/update_abry_details",
		dataType : "JSON",
        data : {id:emp_id,abry:abry},
		success : function(data){
			if(data == true){
				$().toastmessage('showSuccessToast', "ABRY Updated Successfully!");
				// show_employee();
			}else{
				$().toastmessage('showSuccessToast', "Problem to Update ABRY!");
			}
		}
	});
});
		
show_employee();

			function show_employee(){
       $("#wait").css("display", "block");
					            $('#employee_list').html('');

		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"employee/show_employee_export",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example4" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
         html += '<thead>';
		    html += '<tr>';
		    html += '<th style="white-space:nowrap;"><center>Action (Edit/Delete)</center></th>';
			html += '<th style="white-space:nowrap;">ABRY Applicable?</th>';  			 
			html += '<th style="white-space:nowrap;">UAN</th>';  			 
			html += '<th style="white-space:nowrap;">Member Id</th>';  			
			html += '<th style="white-space:nowrap;">Member Name</th>';  			
			html += '<th style="white-space:nowrap;">Date Of Birth</th>';  			
			html += '<th style="white-space:nowrap;">DateOfJoining</th>';  			
			html += '<th style="white-space:nowrap;">Gender</th>';  			
			html += '<th style="white-space:nowrap;">Father/Husband Name</th>';  			
			html += '<th style="white-space:nowrap;">Relationship with theMember</th>';  			
			html += '<th style="white-space:nowrap;">Mobile Number</th>';  			
			html += '<th style="white-space:nowrap;">EmailId</th>';  			
			html += '<th style="white-space:nowrap;">Nationality</th>';              			
		//	html += '<th style="white-space:nowrap;">Wages as on Joining</th>';  			
			html += '<th style="white-space:nowrap;">Qualification</th>';  			
			html += '<th style="white-space:nowrap;">Maritial Status</th>';  			
			html += '<th style="white-space:nowrap;">Is International Worker</th>';  			
			html += '<th style="white-space:nowrap;">County Of Origin</th>';  			
			html += '<th style="white-space:nowrap;">Passport Number</th>';  			
			html += '<th style="white-space:nowrap;">Passport Valid From Date</th>';  			
			html += '<th style="white-space:nowrap;">Passport Valid Till Date</th>';  			
			html += '<th style="white-space:nowrap;">Is Physical Handicap</th>';  			
			html += '<th style="white-space:nowrap;">Locomotive</th>';  			
			html += '<th style="white-space:nowrap;">Hearing</th>';  			
			html += '<th style="white-space:nowrap;">Visual</th>';  			
			html += '<th style="white-space:nowrap;">Employee Type</th>';  			
			html += '<th style="white-space:nowrap;">Bank Account Number</th>';  			
			html += '<th style="white-space:nowrap;">Bank IFSC</th>';  			
			html += '<th style="white-space:nowrap;">Name as Per Bank Details</th>';  			
			html += '<th style="white-space:nowrap;">Pan</th>';  			
			html += '<th style="white-space:nowrap;">Name as on PAN</th>';  			
			html += '<th style="white-space:nowrap;">AADHAAR Number</th>';  			
			html += '<th style="white-space:nowrap;">Name As On AADHAAR</th>';  			
			html += '<th style="white-space:nowrap;">PMRPY</th>';  			
            html += '</tr>';
            html += '</thead>';
            html += '<tbody id="employee_list">';
		            var i;
					 for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");
					
					var sr = i+1;
		                html += '<tr>';
	html += '<td><!--<button  class="view_row_detail btn btn-sm btn-primary"  data="'+data1[0]+'"  data-toggle="modal" data-target="#myModal"  ><i class="fa fa-edit"></i></button>--><button  class="edit_row btn btn-sm btn-primary"  id="'+data1[0]+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data1[0]+'" ><i class="fa fa-trash"></i></button></td>';
			var checked = '';
			if(data1[33] == 1){
				checked = 'checked';
			}
			html += '<td><center><input type="checkbox" class="form-check-input abry_applicable" id="'+data1[0]+'" '+checked+'></center></td>';
			html += '<td>'+data1[1]+'</td>';	
			html += '<td>'+data1[31]+'</td>';
			html += '<td style="white-space:nowrap;" >'+data1[30]+'</td>';	

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
			
								console.log(data1.length);
			
			for(j=5; j<data1.length-3; j++){
			if(j != 11){
			html += '<td >'+data1[j]+'</td>';	
				
			}	
			}
			html += '<td >'+data1[32]+'</td>';	
			html += '</tr>';
											
							
								
//	                      html +=  '<td>'+data[i].aadhaar_no+'</td>'+
//	                        '<td>'+data[i].name_as_aadhaar+'</td><tr>';
		            }
			html += '</tbody></table>';
					
		         $('#show_employee_list').html(html);
					
	
  
	     var msg = "Employee Data Export";
    $('#example4').dataTable({ 
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
            {extend: 'colvis',  className: 'btn-sm', title: msg },
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'excelHtml5', className: 'btn-sm', title: msg,   exportOptions: {
                    columns: ':visible'
                } },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
  //          {extend: 'text',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ]
    });
  						       $("#wait").css("display", "none");

		        }

		    });

		}
/*---------view employe data list end-----------------*/


});