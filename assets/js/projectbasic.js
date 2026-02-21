$(document).ready(function(){

		//add new row in  client manager div 
    $(document).on("click",".add_clientmanager",function(e){
        e.preventDefault();
   
		var appendDiv="<div class='col-md-12'><div class='col-md-3'><div class='form-group'><label class='control-label'>Name *</label><input type='text' name='clientmanager_name' id='clientmanager_name' class='clientmanager_name form-control' placeholder='Enter Name*'   required> </div>  </div><div class='col-md-3'><div class='form-group'><label class='control-label'>Designation *</label><input type='text' name='clientmanager_designation' id='clientmanager_designation' class='clientmanager_designation form-control' placeholder='Enter Designation*'   required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>E-mail Id *</label><input type='email' name='email' id='email' class='email form-control' placeholder='Enter E-mail Id*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>Mobile No *</label><input type='text' name='mobileno' id='mobileno' class='mobileno form-control' placeholder='Enter Mobile No*'  required></div></div><div class='col-md-1' style='margin-top:25px;'><button type='button' class='del_clientmanager btn btn-danger' id='del_clientmanager' name='del_clientmanager' ><em class='fa fa-minus'></em></button></div></div></div></div></div></div>";
		$(".clientmanager_div").append(appendDiv);	
    });

	//delete row from client manager div 
	$(document).on("click",".del_clientmanager",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	
	//add new row in  architect representative div 
	$(document).on("click",".add_architectrepresentative",function(e){
        e.preventDefault();
		var appendDiv="<div class='row'> <div class='col-md-12'><div class='col-md-4'><div class='form-group'><label class='control-label'>Organization</label><input type='text' name='architect_organization' id='architect_organization' class='architect_organization form-control' placeholder='Enter Organization*' ></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Name *</label><input type='text' name='architect_name' id='architect_name' class='architect_name form-control' placeholder='Enter Name*'  required></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Designation *</label><input type='text' name='architect_designation' id='architect_designation' class='architect_designation form-control' placeholder='Enter Designation*'  required></div></div></div><div class='col-md-12'><div class='col-md-4'><div class='form-group'><label class='control-label'>E-mail Id *</label><input type='text' name='architect_email' id='architect_email' class='architect_email form-control' placeholder='Enter E-mail Id*'  required></div></div> <div class='col-md-4'> <div class='form-group'><label class='control-label'>Mobile No *</label><input type='text' name='architect_mobileno' id='architect_mobileno' class='architect_mobileno form-control' placeholder='Enter Mobile No*'  required></div></div><div class='col-md-1' style='margin-top:25px;'><button type='button' class='del_architectrepresentative btn btn-danger' id='del_architectrepresentative' name='del_architectrepresentative' ><em class='fa fa-minus'></em></button></div></div></div>";
		$('.architect_div').append(appendDiv);
	});	
	
	//delete row from  architect representative div 
	$(document).on("click",".del_architectrepresentative",function(e){
		e.preventDefault();
		//$(this).parent().parent().remove();
		$(this).parent().closest('div.row').remove();
	});
	
	//add new row in  Consultant Representative
	$(document).on("click",".add_consultantrepresentative",function(e){
        e.preventDefault();
		var appendDiv="<div class='row'><div class='col-md-12'><div class='col-md-4'><div class='form-group'><label class='control-label'>Organization *</label><input type='text' name='consultant_organization' id='consultant_organization' class='consultant_organization form-control' placeholder='Enter Organization*'  required></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Name *</label><input type='text' name='consultant_name' id='consultant_name' class='consultant_name form-control' placeholder='Enter Name*'  required></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Designation *</label> <input type='text' name='consultant_designation' id='consultant_designation' class='consultant_designation form-control' placeholder='Enter Designation*'  required></div></div></div><div class='col-md-12'><div class='col-md-4'><div class='form-group'><label class='control-label'>E-mail Id *</label><input type='email' name='consultant_email' id='consultant_email' class='consultant_email form-control' placeholder='Enter E-mail Id*'  required></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Mobile No *</label><input type='text' name='consultant_mobileno' id='consultant_mobileno' class='consultant_mobileno form-control' placeholder='Enter Mobile No*'  required></div></div><div class='col-md-1' style='margin-top:25px;'><button type='button' class='del_consultantrepresentative btn btn-danger' id='del_consultantrepresentative' name='del_consultantrepresentative'><em class='fa fa-minus'></em></button></div></div></div>";
		$('.consultant').append(appendDiv);
	});	
	
	//delete row from  Consultant Representative
	$(document).on("click",".del_consultantrepresentative",function(e){
		e.preventDefault();
		//$(this).parent().parent().remove();
		$(this).parent().closest('div.row').remove();
	});
	
	//add new row in  PMC Representative div 
	$(document).on("click",".add_pmcrepresentative",function(e){
        e.preventDefault();
		var appendDiv="<div class='row'><div class='col-md-12'><div class='col-md-4'> <div class='form-group'> <label class='control-label'>Organization *</label><input type='text' name='pmc_organization' id='pmc_organization' class='pmc_organization form-control' placeholder='Enter Organization*' required></div> </div><div class='col-md-4'> <div class='form-group'><label class='control-label'>Name *</label><input type='text' name='pmc_name' id='pmc_name' class='pmc_name form-control' placeholder='Enter Name*'  required></div> </div><div class='col-md-4'><div class='form-group'><label class='control-label'>Designation *</label><input type='text' name='pmc_designation' id='pmc_designation' class='pmc_designation form-control' placeholder='Enter Designation*' required></div> </div></div><div class='col-md-12'><div class='col-md-4'><div class='form-group'><label class='control-label'>E-mail Id *</label><input type='text' name='pmc_email' id='pmc_email' class='pmc_email form-control' placeholder='Enter E-mail Id*' required></div></div><div class='col-md-4'><div class='form-group'><label class='control-label'>Mobile No *</label><input type='text' name='pmc_mobileno' id='pmc_mobileno' class='pmc_mobileno form-control' placeholder='Enter Mobile No*'	 required></div></div> <div class='col-md-1' style='margin-top:25px;'><button type='button' class='del_pmcrepresentative btn btn-danger add_btn' id='del_pmcrepresentative' name='del_pmcrepresentative'><em class='fa fa-minus'></em></button></div></div></div>";
		$('.pmc_div').append(appendDiv);
	});	
	
	//delete row from  PMC Representative div 
	$(document).on("click",".del_pmcrepresentative",function(e){
		e.preventDefault();
		//$(this).parent().parent().remove();
		$(this).parent().closest('div.row').remove();
	});
	
	//add new row in  Internal Project Management div 
	$(document).on("click",".add_InternalProjectManagement",function(e){
        e.preventDefault();
		var appendDiv="<div class='row'><div class='col-md-12'><div class='col-md-3'><div class='form-group'><label class='control-label'>Organization *</label><input type='text' name='intproman_organization' id='intproman_organization' class='intproman_organization form-control' placeholder='Enter Organization*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Name *</label><input type='text' name='intproman_name' id='intproman_name' class='intproman_name form-control' placeholder='Enter Name*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Staff No</label><input type='email' name='intproman_staffno' id='intproman_staffno' class='intproman_staffno form-control' placeholder='Enter Staff No'></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Designation *</label><input type='email' name='intproman_designation' id='intproman_designation' class='intproman_designation form-control' placeholder='Enter Designation*'  required></div></div> </div><div class='col-md-12'><div class='col-md-3'><div class='form-group'><label class='control-label'>E-mail Id *</label><input type='text' name='intproman_email' id='intproman_email' class='intproman_email form-control' placeholder='Enter E-mail Id*' required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Mobile No *</label><input type='text' name='intproman_mobileno' id='intproman_mobileno' class='intproman_mobileno form-control' placeholder='Enter Mobile No*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Staff Id</label><input type='text' name='intproman_staffid' id='intproman_staffid' class='intproman_staffid form-control' placeholder='Enter Staff Id' ></div></div>	<div class='col-md-3'><div class='form-group'><label class='control-label'>Access Level *</label><select name='intproman_access' id='intproman_access' class='intproman_access form-control m-b' required><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option>      </select></div></div></div><div class='col-md-12'><div class='col-md-3'><div class='form-group'><label class='control-label'>User Id *</label><input type='text' name='intproman_uid' id='intproman_uid' class='intproman_uid form-control' placeholder='Enter User Id*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Password *</label><input type='password' name='intproman_password' id='intproman_password' class='intproman_password form-control' placeholder='Enter password*'  required></div></div><div class='col-md-1' style='margin-top:25px;'><button type='button' class='del_InternalProjectManagement btn btn-danger ' id='del_InternalProjectManagement'><em class='fa fa-minus'></em></button></div></div></div>";
		$('.intproman_div').append(appendDiv);
	});	
	
	//delete row from  Internal Project Management div 
	$(document).on("click",".del_InternalProjectManagement",function(e){
		e.preventDefault();
		//$(this).parent().parent().remove();
		$(this).parent().closest('div.row').remove();
	});

	//add new row in  payment  terms
	$(document).on("click",".add_payment",function(e){
        e.preventDefault();
		var appendDiv="<div class='col-md-12'><div class='col-md-2'> <div class='form-group'> <label class='control-label'>Payment Terms *</label><input type='text' name='payment_terms' id='payment_terms' class='payment_terms form-control' placeholder='Enter Payment Terms*' required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>PO Clause No. *</label><input type='text' name='payment_poclauseno' id='payment_poclauseno' class='payment_poclauseno form-control' placeholder='Enter PO Clause No.*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>% *</label><input type='text' name='payment_per' id='payment_per' class='payment_per form-control' placeholder='Enter %*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Amount Without Taxes *</label><input type='text' name='payment_amount' id='payment_amount' class='payment_amount form-control' placeholder='Enter Amount Without Taxes*'  required></div></div><div class='col-md-2'><div class='form-group'> <label class='control-label'>Milestone *</label><input type='text' name='payment_milestone' id='payment_milestone' class='payment_milestone form-control' placeholder='Enter Milestone*'  required></div></div><div class='col-md-1'><button type='button' class='btn btn-danger del_payment' id='add_payment' name='del_payment' style='margin-top:25px;'><em class='fa fa-minus'></em></button></div></div>";
		$('.payment_div').append(appendDiv);
	});	
	
	//delete row from  payment terms
	$(document).on("click",".del_payment",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
		
	});	
	
	//add new row in bonus clauses
	$(document).on("click",".add_bonus",function(e){
        e.preventDefault();
		var appendDiv="<div class='col-md-12'><div class='col-md-2'><div class='form-group'><label class='control-label'>Reward/Bonus Clause *</label><input type='text' name='bonus_clause' id='bonus_clause' class='bonus_clause form-control' placeholder='Enter Reward/Bonus Clause*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>PO Clause No. *</label><input type='text' name='bonus_poclauseno' id='bonus_poclauseno' class='bonus_poclauseno form-control' placeholder='Enter PO Clause No.*' required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>% *</label><input type='text' name='bonus_per' id='bonus_per' class='bonus_per form-control' placeholder='Enter %*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Amount Without Taxes *</label><input type='text' name='bonus_amount' id='bonus_amount' class='bonus_amount form-control' placeholder='Enter Amount Without Taxes*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>Milestone *</label><input type='text' name='bonus_milestone' id='bonus_milestone' class='bonus_milestone form-control' placeholder='Enter Milestone*' required></div></div><div class='col-md-1'><button type='button' class='btn btn-danger del_bonus' id='del_bonus' name='del_bonus' style='margin-top:25px;'><em class='fa fa-minus'></em></button></div></div>";
		$('.bonusclause_div').append(appendDiv);
	});	
	
	//delete row from   bonus clauses
	$(document).on("click",".del_bonus",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
		
	});	

	
	//add new row in  penaltyclause_div
	$(document).on("click",".add_penalty",function(e){
		e.preventDefault();
		var appendDiv="<div class='col-md-12'><div class='col-md-2'><div class='form-group'><label class='control-label'>LD/Penalty Clause *</label><input type='text' name='penalty_clause' id='penalty_clause' class='penalty_clause form-control' placeholder='Enter LD/Penalty Clause*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>PO Clause No. *</label><input type='text' name='penalty_clauseno' id='penalty_clauseno' class='penalty_clauseno form-control' placeholder='Enter PO Clause No.*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>% *</label><input type='text' name='penalty_per' id='penalty_per' class='penalty_per form-control' placeholder='Enter %*'  required></div></div><div class='col-md-3'><div class='form-group'><label class='control-label'>Amount Without Taxes *</label><input type='text' name='penalty_amount' id='penalty_amount' class='penalty_amount form-control' placeholder='Enter Amount Without Taxes*'  required></div></div><div class='col-md-2'><div class='form-group'><label class='control-label'>Milestone *</label><input type='text' name='penalty_milestone' id='penalty_milestone' class='penalty_milestone form-control' placeholder='Enter Milestone*' required></div></div><div class='col-md-1'><button type='button' class='btn btn-danger del_penalty' id='del_penalty' name='del_penalty' style='margin-top:25px;'><em class='fa fa-minus'></em></button></div></div>";
		$('.penaltyclause_div').append(appendDiv);
	});	
	
	//delete row from  penaltyclause_div
	$(document).on("click",".del_penalty",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
		
	});
	
	$(document).on('click','#btn_insert',function(e){
		e.preventDefault();
		var proiden=document.getElementById('proiden').value;
		var prodesc=document.getElementById('prodesc').value;
		var siteaddress=document.getElementById('siteaddress').value;
		var clientname=document.getElementById('clientname').value;
		var clientaddress=document.getElementById('clientaddress').value;
		var in_lev1=document.getElementById('in_lev1').value;
		var in_lev2=document.getElementById('in_lev2').value;
		var in_lev3=document.getElementById('in_lev3').value;
		var ex_lev1=document.getElementById('ex_lev1').value;
		var ex_lev2=document.getElementById('ex_lev2').value;
		var ex_lev3=document.getElementById('ex_lev3').value;
		var lastid='';
		$.ajax({
			
			type:'post',
			url:'ajax/projectbasic_data.php',
			data:{'proiden':proiden,'prodesc':prodesc,'siteaddress':siteaddress,'clientname':clientname,'clientaddress':clientaddress,'in_lev1':in_lev1,'in_lev2':in_lev2,'in_lev3':in_lev3,'ex_lev1':ex_lev1,'ex_lev2':ex_lev2,'ex_lev3':ex_lev3},
			success:function(data)
			{
				lastid=data;
				
				//client manager
				var clientmanager_name = [];
				$('.clientmanager_name').each(function(){
					clientmanager_name.push($(this).val());
					});
				
			
				var clientmanager_designation = [];
				$('.clientmanager_designation').each(function(){clientmanager_designation.push($(this).val());});
				
				var email = [];
				$('.email').each(function(){email.push($(this).val());});
				//alert(email);
				var mobileno = [];
				$('.mobileno').each(function(){mobileno.push($(this).val());});
				
				
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'clientmanager_name':clientmanager_name,'clientmanager_designation':clientmanager_designation,'email':email,'mobileno':mobileno},
				success:function(data1)
				{
					//alert(data);
				}
				});
				
				//Architect Representative
				var architect_organization = [];
				$('.architect_organization').each(function(){architect_organization.push($(this).val());});
				
				var architect_name = [];
				$('.architect_name').each(function(){architect_name.push($(this).val());});
				
				var architect_designation = [];
				$('.architect_designation').each(function(){architect_designation.push($(this).val());});
				
				var architect_email = [];
				$('.architect_email').each(function(){architect_email.push($(this).val());});
				
				var architect_mobileno = [];
				$('.architect_mobileno').each(function(){architect_mobileno.push($(this).val());});
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'architect_organization':architect_organization,'architect_name':architect_name,'architect_designation':architect_designation,'architect_email':architect_email,'architect_mobileno':architect_mobileno},
				success:function(data2)
				{
					//alert(data);
				}
				});	
				
				//Consultant Representative
				var consultant_organization = [];
				$('.consultant_organization').each(function(){consultant_organization.push($(this).val());});
				
				var consultant_name = [];
				$('.consultant_name').each(function(){consultant_name.push($(this).val());});
				
				var consultant_designation = [];
				$('.consultant_designation').each(function(){consultant_designation.push($(this).val());});
				
				var consultant_email = [];
				$('.consultant_email').each(function(){consultant_email.push($(this).val());});
				
				var consultant_mobileno = [];
				$('.consultant_mobileno').each(function(){consultant_mobileno.push($(this).val());});
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'consultant_organization':consultant_organization,'consultant_name':consultant_name,'consultant_designation':consultant_designation,'consultant_email':consultant_email,'consultant_mobileno':consultant_mobileno},
				success:function(data3)
				{
					//alert(data);
				}
				});	
				
				//PMC Representative Detail
				var pmc_organization = [];
				$('.pmc_organization').each(function(){pmc_organization.push($(this).val());});
				
				var pmc_name = [];
				$('.pmc_name').each(function(){pmc_name.push($(this).val());});
				
				var pmc_designation = [];
				$('.pmc_designation').each(function(){pmc_designation.push($(this).val());});
				
				var pmc_email = [];
				$('.pmc_email').each(function(){pmc_email.push($(this).val());});
				
				var pmc_mobileno = [];
				$('.pmc_mobileno').each(function(){pmc_mobileno.push($(this).val());});
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'pmc_organization':pmc_organization,'pmc_name':pmc_name,'pmc_designation':pmc_designation,'pmc_email':pmc_email,'pmc_mobileno':pmc_mobileno},
				success:function(data4)
				{
					//alert(data);
				}
				});	
				
				//Internal Project Management Detail
				var intproman_organization = [];
				$('.intproman_organization').each(function(){intproman_organization.push($(this).val());});
				
				var intproman_name = [];
				$('.intproman_name').each(function(){intproman_name.push($(this).val());});
				
				var intproman_staffno = [];
				$('.intproman_staffno').each(function(){intproman_staffno.push($(this).val());});
				
				var intproman_designation = [];
				$('.intproman_designation').each(function(){intproman_designation.push($(this).val());});
				
				var intproman_email = [];
				$('.intproman_email').each(function(){intproman_email.push($(this).val());});
				
				var intproman_mobileno = [];
				$('.intproman_mobileno').each(function(){intproman_mobileno.push($(this).val());});
				
				var intproman_staffid = [];
				$('.intproman_staffid').each(function(){intproman_staffid.push($(this).val());});
				
				var intproman_access = [];
				$('.intproman_access').each(function(){intproman_access.push($(this).val());});
				
				var intproman_uid = [];
				$('.intproman_uid').each(function(){intproman_uid.push($(this).val());});
				
				var intproman_password = [];
				$('.intproman_password').each(function(){intproman_password.push($(this).val());});
				
				
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'intproman_organization':intproman_organization,'intproman_name':intproman_name,'intproman_staffno':intproman_staffno,'intproman_designation':intproman_designation,'intproman_email':intproman_email,'intproman_mobileno':intproman_mobileno,'intproman_staffid':intproman_staffid,'intproman_access':intproman_access,'intproman_uid':intproman_uid,'intproman_password':intproman_password},
				success:function(data5)
				{
					//alert(data2);
				}
				});
				
				//po details
				var po_value=document.getElementById('po_value').value;
				var po_date=document.getElementById('podate').value;
				var po_condition=document.getElementById('po_condition').value;
				var po_remarks=document.getElementById('po_remark').value;
				var po_zdt=document.getElementById('zerodate').value;
				var porm_zdt=document.getElementById('remarkdate').value;
				var po_clodt=document.getElementById('schedule_closuredate').value;
				var porm_clodt=document.getElementById('remark_sche_closuredate').value;
				var po_lastdt=document.getElementById('defect_liaperdt').value;
				var porm_lastdt=document.getElementById('remark_defliaper').value;
				var po_wardt=document.getElementById('warranty_date').value;
				var porm_wardt=document.getElementById('remark_wardt').value;
			
				$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'lastid':lastid,'po_value':po_value,'po_date':po_date,'po_condition':po_condition,'po_remarks':po_remarks,'po_zdt':po_zdt,'porm_zdt':porm_zdt,'po_clodt':po_clodt,'porm_clodt':porm_clodt,'po_lastdt':po_lastdt,'porm_lastdt':porm_lastdt,'po_wardt':po_wardt,'porm_wardt':porm_wardt},
				success:function(data7)
				{
					var po_id=data7;
					//po payment details
					var payment_terms = [];
					$('.payment_terms').each(function(){payment_terms.push($(this).val());});
					
					var payment_poclauseno = [];
					$('.payment_poclauseno').each(function(){payment_poclauseno.push($(this).val());});
					
					var payment_per = [];
					$('.payment_per').each(function(){payment_per.push($(this).val());});
					
					var payment_amount = [];
					$('.payment_amount').each(function(){payment_amount.push($(this).val());});
					
					var payment_milestone = [];
					$('.payment_milestone').each(function(){payment_milestone.push($(this).val());});
					$.ajax({
					type:'post',
					url:'ajax/projectbasic_data.php',
					data:{'po_id':po_id,'payment_terms':payment_terms,'payment_poclauseno':payment_poclauseno,'payment_per':payment_per,'payment_amount':payment_amount,'payment_milestone':payment_milestone},
					success:function(data5)
					{
						
					}
					});
					
					//po bonus clause details
					
					var bonus_clause = [];
					$('.bonus_clause').each(function(){bonus_clause.push($(this).val());});
					
					var bonus_poclauseno = [];
					$('.bonus_poclauseno').each(function(){bonus_poclauseno.push($(this).val());});
					
					var bonus_per = [];
					$('.bonus_per').each(function(){bonus_per.push($(this).val());});
					
					var bonus_amount = [];
					$('.bonus_amount').each(function(){bonus_amount.push($(this).val());});
					
					var bonus_milestone = [];
					$('.bonus_milestone').each(function(){bonus_milestone.push($(this).val());});
					$.ajax({
					type:'post',
					url:'ajax/projectbasic_data.php',
					data:{'po_id':po_id,'bonus_clause':bonus_clause,'bonus_poclauseno':bonus_poclauseno,'bonus_per':bonus_per,'bonus_amount':bonus_amount,'bonus_milestone':bonus_milestone},
					success:function(data8)
					{
							
					}
					});
					
					//po bonus clause details
					var penalty_clause = [];
					$('.penalty_clause').each(function(){penalty_clause.push($(this).val());});
					
					var penalty_clauseno = [];
					$('.penalty_clauseno').each(function(){penalty_clauseno.push($(this).val());});
					
					var penalty_per = [];
					$('.penalty_per').each(function(){penalty_per.push($(this).val());});
					
					var penalty_amount = [];
					$('.penalty_amount').each(function(){penalty_amount.push($(this).val());});
					
					var penalty_milestone = [];
					$('.penalty_milestone').each(function(){penalty_milestone.push($(this).val());});
					
					$.ajax({
					type:'post',
					url:'ajax/projectbasic_data.php',
					data:{'po_id':po_id,'penalty_clause':penalty_clause,'penalty_poclauseno':penalty_clauseno,'penalty_per':penalty_per,'penalty_amount':penalty_amount,'penalty_milestone':penalty_milestone},
					success:function(data9)
					{
						//alert(data9);	
					}
					});
					//reference document details
					
					var po=document.getElementById('po').value;
					var po_file_attach='';
					$('.pofile').each(function(){po_file_attach=po_file_attach+	$(this).val()+',';});
					
					var mom=document.getElementById('mom').value;
					var mom_file_attach='';
					$('.momfile').each(function(){mom_file_attach=mom_file_attach+	$(this).val()+',';});
					
					var drawing=document.getElementById('drawing').value;
					var drawing_file_attach='';
					$('.drawingfile').each(function(){drawing_file_attach=drawing_file_attach+	$(this).val()+',';});
					
					var extra=document.getElementById('extra').value;
					var extra_file_attach='';
					$('.extrafile').each(function(){extra_file_attach=extra_file_attach+	$(this).val()+',';});
					//alert(po+" "+mom+" "+drawing+" "+extra);
					$.ajax({
					type:'post',
					url:'ajax/projectbasic_data.php',
					data:{'lastid':lastid,'po':po,'po_file_attach':po_file_attach,'mom':mom,'mom_file_attach':mom_file_attach,
					'drawing':drawing,'drawing_file_attach':drawing_file_attach,'extra':extra,'extra_file_attach':extra_file_attach},
					success:function(data10)
					{
						//alert(data10);	
					}
					});
										
				}
				});
			}
		});
	});
	
	
	//po file
	$('#po_uploadFile').ajaxfileupload({
	 //'action' : 'callAction',
	 
	'action' : 'ajax/projectbasic_uploads.php',
   // 'onStart': function() {$("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
	'onComplete' : function(response) 
	{
		  //alert(response);
		 if(response=='')
		 {
			 $("#msg").html("<font color='red'>"+"Error in file upload"+"</font>");
		 }
		 else
		 {
			 // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
			  //var res=response.split("/");
			  //$("#po_file_attach").val(response);
			  var fname=response.split(',');
			  
			  for(var i=0;i<fname.length;i++)
			  {
				 var html="<tr><td>"+fname[i]+"</td><td><button class='btn btn-xs btn-danger pofile' id='pofile' value='"+fname[i]+"'><em class='fa fa-trash'></em></button></td></tr>";
				$("#po_msg").append(html);	
			  }
		
			
			  
		 }

	}
	});

	//delete po file	
	$(document).on("click","#pofile",function(){
			
			
			var f_nm=$(this).val();
			var del_row=$(this).parent().parent();
			var flag=0;
			//alert(f_nm);
			
			$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'po_filenm':f_nm},
				success:function(data)
				{
					
					//alert(data);
					if(data!='0')
					{
						del_row.remove();
					}
					
				}
			});
			
			
					
		});
	
	//mom
	$('#mom_uploadFile').ajaxfileupload({
	 //'action' : 'callAction',
	 
	'action' : 'ajax/projectbasic_uploads.php',
    //'onStart': function() {$("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
	'onComplete' : function(response) 
	{
		  //alert(response);
		 if(response=='')
		 {
			 $("#msg").html("<font color='red'>"+"Error in file upload"+"</font>");
		 }
		 else
		 {
			 // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
			  //var res=response.split("/");
			  //$("#po_file_attach").val(response);
			  var mom_file=response.split(',');
			  
			  for(var i=0;i<mom_file.length;i++)
			  {
				 var html="<tr><td>"+mom_file[i]+"</td><td><button class='btn btn-xs btn-danger momfile' id='momfile' value='"+mom_file[i]+"'><em class='fa fa-trash'></em></button></td></tr>";
				$("#mom_msg").append(html);	
			  }
		
			
			  
		 }

	}
	});

	//delete mom file	
	$(document).on("click","#momfile",function(){
			
			
			var f_nm=$(this).val();
			var del_row=$(this).parent().parent();
			var flag=0;
			//alert(f_nm);
			
			$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'mom_filenm':f_nm},
				success:function(data)
				{
					
					//alert(data);
					if(data!='0')
					{
						del_row.remove();
					}
					
				}
			});
			
			
					
		});
	//drawing file
	$('#drawing_uploadFile').ajaxfileupload({
	 //'action' : 'callAction',
	 
	'action' : 'ajax/projectbasic_uploads.php',
   // 'onStart': function() {$("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
	'onComplete' : function(response) 
	{
		  //alert(response);
		 if(response=='')
		 {
			 $("#msg").html("<font color='red'>"+"Error in file upload"+"</font>");
		 }
		 else
		 {
			 // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
			  //var res=response.split("/");
			  //$("#po_file_attach").val(response);
			  var drawing=response.split(',');
			  
			  for(var i=0;i<drawing.length;i++)
			  {
				 var html="<tr><td>"+drawing[i]+"</td><td><button class='btn btn-xs btn-danger drawingfile' id='drawingfile' value='"+drawing[i]+"'><em class='fa fa-trash'></em></button></td></tr>";
				$("#drawing_msg").append(html);	
			  }
		
			
			  
		 }

	}
	});

	//delete drawing file	
	$(document).on("click","#drawingfile",function(){
			
			
			var f_nm=$(this).val();
			var del_row=$(this).parent().parent();
			var flag=0;
			//alert(f_nm);
			
			$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'drawing_filenm':f_nm},
				success:function(data)
				{
					
					//alert(data);
					if(data!='0')
					{
						del_row.remove();
					}
					
				}
			});
			
			
					
		});
	
	//extra file
	$('#extra_uploadFile').ajaxfileupload({
	 //'action' : 'callAction',
	 
	'action' : 'ajax/projectbasic_uploads.php',
   // 'onStart': function() {$("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
	'onComplete' : function(response) 
	{
		  //alert(response);
		 if(response=='')
		 {
			 $("#msg").html("<font color='red'>"+"Error in file upload"+"</font>");
		 }
		 else
		 {
			 // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
			  //var res=response.split("/");
			  //$("#po_file_attach").val(response);
			  var extra=response.split(',');
			  
			  for(var i=0;i<extra.length;i++)
			  {
				 var html="<tr><td>"+extra[i]+"</td><td><button class='btn btn-xs btn-danger extrafile' id='extrafile' value='"+extra[i]+"'><em class='fa fa-trash'></em></button></td></tr>";
				$("#extra_msg").append(html);	
			  }
		
			
			  
		 }

	}
	});

	//delete extra file	
	$(document).on("click","#extrafile",function(){
			
			
			var f_nm=$(this).val();
			var del_row=$(this).parent().parent();
			var flag=0;
			//alert(f_nm);
			
			$.ajax({
				type:'post',
				url:'ajax/projectbasic_data.php',
				data:{'extra_filenm':f_nm},
				success:function(data)
				{
					
					//alert(data);
					if(data!='0')
					{
						del_row.remove();
					}
					
				}
			});
			
			
					
		});
			
	// $(document).on("change","#po_uploadFile",function(e){
		// e.preventDefault();
		// var po=document.getElementById('po').value;
		
		// var po_file_attach=$('input[type=file]').val();
		// //var po_file_attach=document.getElementById('po_file_attach').value;
					// $.ajax({
					// type:'post',
					// url:'ajax/projectbasic_data.php',
					// data:{'po_file':po_file_attach},
					// success:function(data9)
					// {
						// alert(data9);	
					// }
					// });		
		// //alert(po+" "+po_file_attach);
	// });
});
