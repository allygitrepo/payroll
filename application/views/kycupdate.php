   <?php
$title = "KYC Update";
   include('label.php');
   
   
   ?>
   <!-- Main section-->
   <section>
   
    <div class="content-wrapper">
					<div class="clearfix">
						<div class="pull-left">
							<h3><?php if(isset($title)){ echo $title; } ?></h3>
						</div>
						<div class="pull-right">
<!--						<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> KYC Update</button>		
	-->					
						</div>
          </div>  
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                     <!-- START panel-->
						<div id="hide_show1">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
							  
							  					
												<div class="col-md-12">
												<div class="col-md-12">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label"><?= $empName;?> </label>
    <select  name="empname" id="empname" class="form-control" placeholder="Enter <?= $empName; ?> " > <option Disabled Selected>Select</option>
											  </select>
														</div>
													
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Enter UAN  </label>
    <input type="text" name="search_uan" id="search_uan" class="form-control" placeholder="Enter UAN "  />								</div>
													
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Enter Member ID</label>
    <input type="text" name="employee_code" id="employee_code" class="form-control" placeholder="Enter Member ID  "  />								</div>
													
													</div>
	<div class="col-md-12">
	<center><button  id="search_button" name="search_button" class="btn btn-primary button_change" >Search</button>
	 <button  id="reset_button" name="reset_button" class="btn btn-primary  button_change" >Reset</button>
	</center>	 <br><br><br><br>												
	 <br><br><br><br>												
	 <center>
                                    </center>
	</div>
													
												
</div>	

									<div class="col-md-12">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label"><?= $docType;?> *</label>
    <select type="text" form="employee_form" name="docType" id="docType" class="form-control" placeholder="Enter <?= $docType; ?> *" > <option Disabled Selected>Select</option>
	<option value="BANK">BANK</option>
	 <option value="PAN">PAN</option>
	 <option value="DRIVING_LICENSE">DRIVING LICENSE</option>
	 <option value="ELECTION_CARD">ELECTION CARD</option>
	 <option value="RATION_CARD">RATION CARD</option>
	 <option value="NATIONAL_POPULATION_REGISTER">NATIONAL POPULATION REGISTER</option>
	<option value="AADHAAR_CARD">AADHAAR CARD</option>
	</select>
	
														</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
														<label class="control-label"><?= $docNum; ?> *</label>
														<input type="text" name="docNum" id="docNum" form="employee_form" class="docNum form-control" placeholder="Enter <?= $docNum; ?>*"   >
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
														<label class="control-label"><?= $nameasDoc; ?> *</label>
														<input type="text" name="nameasDoc" id="nameasDoc"  form="employee_form" class="nameasDoc form-control" placeholder="Enter <?= $nameasDoc; ?>*"   >
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
														<label class="control-label"><?= $ifsc; ?> *</label>
														<input type="text" name="ifsc" form="employee_form" id="ifsc" class="ifsc form-control" placeholder="Enter <?= $ifsc; ?>*" disabled >
													</div>
													</div>
													<div class="col-md-4"    >
													    <div class="form-group">
			<label for="user name">Select KYC Image:</label>
			<input type="file" class="form-control" id="uploadFile" name="uploadFile" accept="image/*">							
		    <input type="hidden" id="file_attachother" value=""/>
			<div id="msg"></div>
			
			<div class="col-md-2" style="margin-top:30px;">
				<div id="containerother_kyc" ></div>
</div>
			
        </div>

													</div>
																										<div class="col-md-1" ></div>

												<div class="col-md-1" >
												<br>
	<button type="button"  class="add_kycdetail btn btn-primary" id="add_kycdetail" name="add_kycdetail"><em class="fa fa-plus"></em></button>
													</div>
	
												</div>
									<div class="kycdetail_div">
						
	  <table id="example11" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Document Type</th><th>Document No.</th><th>Name as Per Document</th><th>IFSC</th><th>Kyc Image Name</th><th><center>Remove</center></th></tr></thead><tbody id="show_kycdetail_list1">
		</tbody></table>
	</div>
			
	</div>
												
											
											 <div class="col-md-12">
                                    <center> 
                                        <button  id="btn_insert" class="btn btn-primary button_change">Save</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <button type="button"  id="close" class="btn btn-primary btn_cancel button_change">Cancel</button>	
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
										<input type="hidden" id="kyc_row_id" value="Add"/>
										<input type="hidden" id="kyc_save_update" value="Add"/>
                                 	<input type="hidden" id="doctype_check" value=""/>
                                    </center>
                                </div>
                  			</div>
                        </div>    
                     </div>                  
 			</div>	
 </section>                          
                            
 
	
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>


   <?php include('footer.php');?>
<script src="<?php echo base_url().'assets/js/js/kyc_update_js.js';?>"></script>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script>
   $('#uploadFile').ajaxfileupload({
  //'action' : 'callAction',
  'action' : baseurl+'payroll/kyc_image_upload',
  'onStart': function() {$("#msg").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
  'onComplete' : function(response) {
  
//	alert(JSON.stringify(response));
//alert(response);
      if(response==''){
          $("#msg").html("<font color='red'>"+"Error in file upload"+"</font>");
      }else{
          // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
           //var res=response.split("/");
           $("#file_attachother").val(response);
           $("#msg").html("<font id='kyc_image_name' color='green'>"+response+"</font>");
		   $('#containerother_kyc').empty();
		   var url = getRootUrl();  
	var img = $('<img />').addClass('img').attr({
						'id': 'myImage',
				'src': baseurl+'assets/images/employee/'+response,
						'width': 50,					
						}).appendTo('#containerother_kyc');
    } 

    }
	});
	function getRootUrl() {
	return window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
}
</script>

</body>

</html>




					  
															
   