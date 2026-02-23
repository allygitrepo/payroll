   <?php
$title = "Employee";
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
						<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> <?php if(isset($title)){ echo $title; } ?></button>		
					
						</div>
          </div>  
            <!-- START row-->
            <div class="row">
                 
                     <!-- START panel-->
					 <div id="hide_show">
                   
							  
							  
			
  <ul class="nav nav-tabs" >
    <li class="active"><a data-toggle="tab" href="#personalinfo">Personal Info</a></li>
    <li  ><a data-toggle="tab" id="kyc_detail_tab"   href="#kycdetail">KYC Detail</a></li> 
    <li  ><a data-toggle="tab" id="nominee_detail_tab" href="#nomineeFamily">Nominee  Details</a></li>
    <li  ><a data-toggle="tab" id="family_detail_tab" href="#Family">Family Members Details</a></li>
	</ul>
  <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">	
 <div class="tab-content" style="border:0;">
  <div id="personalinfo" class="tab-pane fade in active">
 <form id="employee_form"></form>
                      	<div class="col-md-12">
                                        <div class="col-md-12">
                                        <div class="col-md-4">
	    <div class="form-group">
			<label for="user name">Select Employee Image:</label>
			<input type="file" class="form-control" id="uploadFile_emp" name="uploadFile_emp" accept="image/*">							
		    <input type="hidden" id="file_attachother_emp" value=""/>
			<div id="msg_emp">
			</div>
			

			
        </div>
</div>
			<div class="col-md-2" style="margin-top:30px;margin-bottom:30px;">
				<div id="containerother_emp" ></div>
</div>
															<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">UAN *</label>
                                              <input type="text" name="uan_id" form="employee_form" id="uan_id" class="form-control" placeholder="Enter UAN No" required>
                                 <label id="uan_id_error" style="color:red;"></label>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">IP Number *</label>
                                              <input type="text" name="ip_number" form="employee_form" id="ip_number" class="form-control" placeholder="Enter IP Number" required>
                                 <label id="ip_number_error" style="color:red;"></label>
                                           </div>
                                        </div>
    
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Member Id</label>
                                              <input type="text" name="member_id" form="employee_form" id="member_id" class="form-control" placeholder="Enter member Id" >
                                 <label id="member_id" style="color:red;"></label>
                                           </div>
                                        </div>
		
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $empName; ?> *</label>
                                              <input type="text" name="empName" form="employee_form" id="empName" class="form-control" placeholder="Enter <?= $empName; ?>" >
                                 <label id="empname_error" style="color:red;"></label>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
										<label class="control-label" >Date Of Birth As Per Aadhaar</label>
                                        <div class="form-group">
                                  <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control" id="dob" form="employee_form" name="planstartdate" value='' placeholder="Select Date*"   required>
                                 <label id="dob_error" style="color:red;"></label>
                              </div>
                                           </div>
										   
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $adharno; ?>  *</label>
                                              <input type="text" name="adharno" form="employee_form" id="adharno" class="form-control" placeholder="<?= $adharno; ?>  *" >
                                 <label id="adharno_error" style="color:red;"></label>
	                                       </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
										  <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $gender; ?> *</label>
                                              <select type="text" name="gender" id="gender" form="employee_form" class="form-control" placeholder="Enter <?= $gender; ?>" required>											  <option Disabled Selected>Select Gender</option>
											  <option value="FEMALE">FEMALE</option>
											  <option value="MALE">MALE</option>
											  </select>
                                 <label id="gender_error" style="color:red;"></label>
											
                                           </div>
                                        </div>
                                      
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $fhName; ?> </label>
                                              <input type="text" name="fhName" id="fhName" form="employee_form" class="form-control" placeholder="Enter <?= $fhName; ?>" >
                                 <label id="fhname_error" style="color:red;"></label>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $relation; ?> </label>
                                              <select name="relation" id="relation" form="employee_form" class="form-control"  >
											  <option value="" selected disabled>Select <?= $relation; ?></option>
												<option value="FATHER">Father</option>
												<option value="HUSBAND">Husband</option>
											  </select>
                                <label id="relation_error" style="color:red;"></label>
 
                                           </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $status; ?> </label>
                                              <select name="status" id="status" form="employee_form" class="form-control"  >
											  <option value="" selected disabled>Select <?= $status; ?></option>
												<option value="MARRIED">Married   </option>
												<option value="UNMARRIED">Un-Married</option>
												<option value="WIDOW/WIDOWER">WIDOW/WIDOWER</option>
												<option value="DIVORCEE">Divorcee  </option>
											  </select>
                                <label id="status_error" style="color:red;"></label>
                                           </div>
                                        </div>
                        
                                        </div>
                                        <div class="col-md-12">
										                <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $mobile; ?> *</label>
                                              <input type="text" name="mobile" id="mobile" form="employee_form" class="form-control" placeholder="Enter <?= $mobile; ?>*" required>
                                <label id="mobile_error" style="color:red;"></label>
                                           </div>
                                        </div>

										                                        <div class="col-md-3">
																					<div class="form-group">
                                              <label class="control-label"><?= $qualification; ?> </label>
                                              <select name="qualification" id="qualification" form="employee_form" class="form-control"  >
		<option value="" selected disabled>Select <?= $qualification; ?></option>
		<option value="NOT AVAILABLE">NOT AVAILABLE</option>
		<option value="ILLITERATE">ILLITERATE</option>
		<option value="LITERATE">LITERATE</option>
		<option value="NON-MATRIC">NON-MATRIC</option>
		<option value="MATRIC">MATRIC</option>
		<option value="SENIOR-SECONDARY">SENIOR-SECONDARY</option>
		<option value="GRADUATE">GRADUATE</option>
		<option value="POST-GRADUATE">POST-GRADUATE</option>
		<option value="DOCTORATE">DOCTORATE</option>
		<option value="TECHNICAL (PROFESSIONAL)">TECHNICAL (PROFESSIONAL)</option>

											  </select>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $doj; ?>  *</label>
                                                  <div id="datetimepicker1" class="date">
                                 <input type="text" form="employee_form" class="form-control" id="doj" name="doj" value='' placeholder="Select Date*" >
                                 <label id="doj_error" style="color:red;"></label>
                              </div>
                              
                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $typeEmp; ?> *</label>
                                              <select type="text" name="typeEmp" form="employee_form" id="typeEmp" class="form-control"  required>
											  <option value="" selected disabled>Select <?= $typeEmp; ?></option>
												<option value="BIDI MAKER">Bidi Maker</option>
												<option value="BIDI PACKER">Bidi Packer</option>
												<option value="OFFICE STAFF">Office Staff</option>
											  </select>
                                           </div>
                                        </div>
										
										</div> 
										<div class="col-md-12">
										     
                                         <div class="col-md-3">
										  <div class="form-group">
                                              <label class="control-label">Contractor</label>
                                              <select type="text" name="Contractor" id="contractor1" form="employee_form" class="form-control"  disabled>
											  <option value="" selected disabled>Select Contractor</option>
											  </select>
                                           </div>
                                        </div>

						<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $address; ?> *</label>
                                              <select type="text" name="address" form="employee_form" id="address_list_personalinfo" class="form-control" placeholder="Enter <?= $address; ?> *"  >
												  
												 </select>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
											<div class="form-group">
                                              <label class="control-label"><?= $postOffice; ?> *</label>
                                              <input type="text" name="postoffice" id="postoffice" form="employee_form" class="form-control" placeholder="Enter <?= $postOffice; ?> *"  disabled >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $dist; ?> *</label>
                                              <input type="text" name="district" form="employee_form" id="district" class="form-control" placeholder="Enter <?= $dist; ?> *" disabled >
                                           </div>
                                        </div>
										
											<div class="col-md-12" id="address_panel" >
												<div class="panel panel-primary">
												<div class="panel-heading">Add New Address</div>
												<div class="panel-body">
												
										<div class="col-md-12">
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Address</label>
                                              <textarea type="text" row="3" name="new_address" id="new_address" class="form-control" placeholder="Address" oninvalid="this.setCustomValidity('please Enter  Address')" onchange="this.setCustomValidity('')" required></textarea>
                                           </div>
                                        </div>
										
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">Post Office</label>
			<input type="text"  name="new_postoffice" id="new_postoffice" class="form-control" placeholder="Post Office" oninvalid="this.setCustomValidity('please Enter  Post Office')" onchange="this.setCustomValidity('')" required  />
                             
  													</div>
														</div>
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">District</label>
			<input type="text"  name="new_district" id="new_district" class="form-control" placeholder="District" oninvalid="this.setCustomValidity('please Enter  District')" onchange="this.setCustomValidity('')" required  />
                             
  													</div>
														</div>
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">Pincode</label>
			<input type="number"  name="new_pincode" id="new_pincode" class="form-control" placeholder="Pincode" oninvalid="this.setCustomValidity('Pincode Must be 6 Digit')" onchange="this.setCustomValidity('')" required />
                             
  													</div>
														</div>
										
								</form>
										
										      <div class="col-md-12">
                                    <center > 
                                        <button  id="save_new_address" class="btn btn-info"  >Add Address</button>															
                                        <button  id="close_new_address" class="btn btn-danger"  >Close</button>															
                                    </center>
									<input type="hidden" id="save_update" value="add" />
                                </div>
						
										<div class="col-md-4"></div>
										
                     	 		</div>	
												
												
												</div>
												</div>
											</div>
										
                                  
                                        </div>
										
		
    <div class="col-md-12">
	<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Pincode *</label>
                                              <input type="text" name="pincode" form="employee_form" id="pincode" class="form-control" placeholder="Enter <?= $pin; ?> *	"disabled	 >
                                           </div>
                                        </div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Nationality</label>
				<input type="text" name="nationality" form="employee_form" id="nationality" class="form-control" value="Indian"	 >
				<label id="nationality_error" style="color:red;"></label>				
  </div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Email Id</label>
				<input type="text" name="emailid" form="employee_form" id="emailid" class="form-control">
				<label id="emailid_error" style="color:red;"></label>				
				
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Is InterNational Worker </label>
				<select name="international_worker" form="employee_form" id="international_worker" class="form-control"  >
				<option value="N" selected >No</option>
				<option value="Y" >Yes</option>
				</select>
				</div>
		</div>
	
		</div>
		<div class="col-md-12">
			<div class="col-md-3" id="hide_contry" >
			<div class="form-group">
				<label class="control-label">Contry of Origin</label>
				<input type="text" name="contry" form="employee_form" id="contry" class="form-control" placeholder="Enter Conrty Of Origin">
				<label id="contry_error" style="color:red;"></label>				
			</div>
		</div>
		<div class="col-md-3" id="hide_passportno">
			<div class="form-group">
				<label class="control-label">Passport No.</label>
				<input type="text" name="passportno" form="employee_form" id="passportno" class="form-control" placeholder="Enter Passport No.">
				<label id="passportno_error" style="color:red;"></label>				
			</div>
		</div>
		<div class="col-md-3" id="hide_validefrom" >
                                           <div class="form-group">
                                              <label class="control-label">Passport Valide From Date </label>
                                                                                 <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control validefrom" id="validefrom" form="employee_form" name="validefrom" value='' placeholder="Select Date*"  >
 				<label id="validefrom_error" style="color:red;"></label>				
                                                         </div>

                                           </div>
                                        </div>
		<div class="col-md-3" id="hide_validetill" >
                                     <div class="form-group">
                                              <label class="control-label">Passport Valide Till Date </label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control validetill" id="validetill" form="employee_form" name="validetill" value='' placeholder="Select Date*"  >
                               				<label id="validetill_error" style="color:red;"></label>				
                           </div>

                                           </div>
                                        </div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Physical Handicap </label>
				<select name="international_worker" form="employee_form" id="physical_handicap" name="physical_handicap" class="form-control"  >
				<option value="N" selected >No</option>
				<option value="Y" >Yes</option>
				</select>
				</div>
		</div>
		<div class="col-md-6" id="hide_physical_handicap">
			<div class="form-group">
				<label class="checkbox-inline"><input type="checkbox" id="locomotive" name="disability" value="L">LOCOMOTIVE</label>
				<label class="checkbox-inline"><input type="checkbox" id="hearing" name="disability" value="H">HEARING</label>
				<label class="checkbox-inline"><input type="checkbox" id="visual" name="disability" value="V">VISUAL</label>
	        </div>
	    </div>
										  <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">PMRPY ?</label>
                                              <select type="text" name="pmrpy" id="pmrpy" form="employee_form" class="form-control" required>
								<!--			  <option value="" selected disabled>Select PMRPY</option>
								-->			  <option value="YES"  >YES</option>
											  <option value="NO" selected>NO</option>
											  </select>
										
                                           </div>
                                        </div>
							
										
	         </div>
						       <div class="col-md-12">
                                    <center> 
                                       
                                        <a  id="close" class="btn btn-primary btn_cancel button_change close_form">Cancel</a>	
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
								</div>	
		
 
 </div>
  <div id="kycdetail" class="tab-pane fade">
  

  
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
                               				<label id="docNum_error" style="color:red;"></label>				
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
														<label class="control-label"><?= $nameasDoc; ?> *</label>
														<input type="text" name="nameasDoc" id="nameasDoc"  form="employee_form" class="nameasDoc form-control" placeholder="Enter <?= $nameasDoc; ?>*"   >
                               				<label id="nameasDoc_error" style="color:red;"></label>				
													</div>
													</div>
													<div class="col-md-3">
													<div class="form-group">
														<label class="control-label"><?= $ifsc; ?> *</label>
														<input type="text" name="ifsc" form="employee_form" id="ifsc" class="ifsc form-control" placeholder="Enter <?= $ifsc; ?>*" disabled >
                               				<label id="ifsc_error" style="color:red;"></label>				
													</div>
													</div>
													</div>
   											<div class="col-md-12">
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
										<input type="hidden" id="kyc_row_id" value="Add"/>
										<input type="hidden" id="doctype_check" value=""/>
                
										<input type="hidden" id="nominee_row_id" value="Add"/>
										<input type="hidden" id="nominee_adhar_check" value=""/>
                
										<input type="hidden" id="family_row_id" value="Add"/>
										<input type="hidden" id="family_adhar_check" value=""/>
		
		</div>
	
												</div>
									<div class="kycdetail_div">
						
	  <table id="example1" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Document Type</th><th>Document No.</th><th>Name as Per Document</th><th>IFSC</th><th>Kyc Image Name</th><th><center>Remove</center></th></tr></thead><tbody id="show_kycdetail_list1">
		</tbody></table>
	</div>
				
											
											
				
  </div>
  <div id="nomineeFamily" class="tab-pane fade">
												<div class="col-md-12">
													<div class="col-md-3">
														<div class="form-group">
														<label class="control-label"><?= $name; ?></label>
														<input type="text" name="name1" form="employee_form" id="name" class="name form-control" placeholder="Enter <?= $name; ?>">
														</div>
													</div>
							<div class="col-md-3">
                               <div class="form-group">
                                  <label class="control-label "><?= $address; ?> *</label>
                                  <select type="text" name="0" id="nomi_address_list" form="employee_form" class="form-control nomi_address" placeholder="Enter <?= $address; ?> *" >
  
 </select>
                               </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $postOffice; ?> *</label>
                                              <input type="text" name="nomi_postoffice" id="nomi_postoffice" form="employee_form" class="form-control nomi_postoffice" placeholder="Enter <?= $postOffice; ?> *"  disabled >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $dist; ?> *</label>
                                              <input type="text" name="nomi_district" id="nomi_district" form="employee_form" class="form-control nomi_district" placeholder="Enter <?= $dist; ?> *" disabled >
                                           </div>
                                        </div>
                </div>
					<div class="col-md-12">
				<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Pincode *</label>
                                              <input type="text" name="nomi_pincode" form="employee_form" id="nomi_pincode" class="form-control nomi_pincode" placeholder="Enter <?= $pin; ?> *" disabled	 >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
			<div class="form-group">
                                       <label class="control-label"><?= $adharno; ?>  *</label>
                                       <input type="text" name="nomiadharno" form="" id="nomiadharno" class="form-control" placeholder="<?= $adharno; ?>  *" >
                          <label id="nomiadharno_error" style="color:red;"></label>
                                 </div>
                                 </div>
								<div class="col-md-3">
											<div class="form-group">
															<label class="control-label">Relation </label>
    <select type="text"  name="nomi_relation" id="nomi_relation" class="form-control"  > 
	<option Disabled Selected>Select Relation</option>
	<option value="WIFE">WIFE</option>
	<option value="HUSBAND">Husband</option>
	<option value="SON">SON</option>
	<option value="DAUGHTER">DAUGHTER</option>
	<option value="FATHER">FATHER</option>
	<option value="MOTHER">MOTHER</option>
											  </select>
														</div>
													</div>
	
																	<div class="col-md-3">
																		<div class="form-group">
                                              <label class="control-label"><?= $dob; ?>  </label>
                                                 <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control nomi_dob" form="employee_form" id="nomi_dob" name="planstartdate" value='' placeholder="Select Date" >
                                 <label id="d" style="color:red;"></label>
                              </div>
													</div>
													</div>
	
									</div>
									<div class="col-md-12">
									<div class="col-md-3">
                                           <div class="form-group">
														<label class="control-label"><?= $share; ?></label>
														<input type="text" name="share" form="employee_form" id="share" class="share form-control" placeholder="Enter <?= $share; ?>">
                              
                                           </div>
                                        </div>
	
		<div class="col-md-3" id="g_name" >
		<div class="form-group">
		<label class="control-label">Guardian Name</label>
		<input type="text" name="guardian_name"  id="guardian_name" class="form-control" placeholder="Enter Guardian Name">
		</div>
	</div>
		<div class="col-md-3" id="g_address">
		<div class="form-group">
		<label class="control-label">Guardian Address</label>
		<textarea  name="guardian_address"  id="guardian_address" class="form-control" placeholder="Enter Guardian Address" ></textarea>
		</div>
	</div>
		<div class="col-md-6" id="not_guardian"></div>
	
	<div class="col-md-1" style="margin-top:25px;">
														<a class="add_nominee btn btn-primary" id="add_nominee"   name="add_nominee"><em class="fa fa-plus"></em></a>
													</div>
									</div>
  						<div class="nomineefamily_div">
						
<table id="example2" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th>Name</th>
	<th>Address</th>
	<th>Postoffice</th>
	<th>District</th>
	<th>Pincode</th>
	<th>Aadhaar Card No.</th>
	<th>Relation</th>
	<th>DOB</th>
	<th>% of Share</th>
	<th>Guardian Name</th>
	<th>Guardian Address</th>
	<th>
		<center>Remove</center></th></tr></thead><tbody id="show_nominee_detail_list1">
		</tbody></table>

							</div>



											
 </div>
   <div id="Family" class="tab-pane fade">
												<div class="col-md-12">
														<div class="col-md-2">
											<div class="form-group">
															<label class="control-label">Relation </label>
    <select type="text"  name="family_relation" id="family_relation" class="relation form-control"  > 
	
	<option Disabled Selected>Select Relation</option>
	<option value="WIFE">WIFE</option>
	<option value="HUSBAND">Husband</option>
	<option value="SON">SON</option>
	<option value="DAUGHTER">DAUGHTER</option>
<!--	<option value="FATHER">FATHER</option>
	<option value="MOTHER">MOTHER</option>
-->											  </select>
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
														<label class="control-label"><?= $name; ?> </label>
														<input type="text" form="employee_form" name="familyname" id="familyname" class="name form-control" placeholder="Enter <?= $name; ?>" >
														</div>
													</div>
												<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $dob; ?> </label>
                                                                                 <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control family_dob" id="family_dob" form="employee_form" name="planstartdate" value='' placeholder="Select Date*"  >
                                                          </div>

                                           </div>
                                        </div>
	           <div class="col-md-3">
			<div class="form-group">
                                       <label class="control-label"><?= $adharno; ?>  *</label>
                                       <input type="text" name="family_aadhaar" form="" id="family_aadhaar" class="form-control" placeholder="<?= $adharno; ?>  *" >
                          <label id="family_aadhaar_error" style="color:red;"></label>
                                 </div>
                                 </div>
												<div class="col-md-1" style="margin-top:25px;">
														<a class="add_family btn btn-primary" id="add_family" name="add_family"><em class="fa fa-plus"></em></a>
													</div>
												</div>
								  						<div class="family_div">
															
<table id="example3" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	<tr>	
	<th>Name</th>
	<th>DOB As Per Aadhar</th>
	<th>Relation</th>
	<th>Aadhaar No.</th>
	<th>
		<center>Remove</center></th></tr></thead><tbody id="family_detail_list1">
		</tbody></table>

						</div>
											             
						       <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" form="employee_form" class="btn btn-primary button_change">Save</button>						
			<input type="hidden" id="save_update" form="employee_form" value="add" />		
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <a  id="close" class="btn btn-primary btn_cancel button_change close_form">Cancel</a>	
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>

								
											</div>



											
 </div>
 
</div>							  
					  
							  
        					</div>
                        </div>    
                     </div>                  
 				
 			</div>	


			<div id="show_employee_list">
			</div>
			
			<!--
			<button  class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#myModal"   ><i class="fa fa-edit"></i></button>
	-->
	
	
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
  


   </div>
  	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
<h3>Kyc Details</h3>
		
		<table id="example1" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Document Type</th><th>Document No.</th><th>Name as Per Document</th><th>IFSC</th><th>File Upload</th></tr></thead><tbody id="kyc_detail_view_list">
		</tbody></table>
		
		<br><br>
		
				<h3>Nominee Details</h3>

		<table id="" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th>Name</th>
	<th>Address</th>
	<th>Postoffice</th>
	<th>District</th>
	<th>Pincode</th>
	<th>DOB</th>
	<th>% of Share</th>
	</tr></thead><tbody id="nominee_detail_view_list">
		</tbody></table>
		
		
		<br><br>
		
				<h3>Faimly Details</h3>

			<table id="" class="table table-danger table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	<tr>	
	<th>Name</th>
	<th>DOB As Per Aadhar</th>
	<th>Relation</th>
	</tr></thead><tbody id="family_detail_view_list">
		</tbody></table>
		
        </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

	 <?php include('footer.php');?>
<div id="wait" style="display:;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
	 
	 <script src="<?php echo base_url().'assets/js/AjaxFileUpload.js';?>"></script>
	 <script src="<?php echo base_url().'assets/js/js/employee_js.js';?>"></script>

<script>

//     $(document).ajaxStart(function(){
//        $("#wait").css("display", "block");
//    });
//    $(document).ajaxComplete(function(){
 //       $("#wait").css("display", "none");
 //   });
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
<script>

$('#uploadFile_emp').ajaxfileupload({
  //'action' : 'callAction',
  'action' : baseurl+'employee/employee_image_upload',
  'params': {
    'ip_number': function() { return $('#ip_number').val(); }
  },
  'onStart': function() {
    $("#msg_emp").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>");
  },
  'onComplete' : function(response) {
  
//	alert(JSON.stringify(response));
//alert(response);
      if(response==''){
          $("#msg_emp").html("<font color='red'>"+"Error in file upload"+"</font>");
      }else{
          // $("#message").html("<font color='green'>"+"file upload successfully"+"</font>");
           //var res=response.split("/");
           $("#file_attachother_emp").val(response);
           $("#msg_emp").html("<font id='emp_image_name' color='green'>"+response+"</font>");
		   $('#containerother_emp').empty();
		   var url = getRootUrl_emp();  
	var img = $('<img />').addClass('img').attr({
						'id': 'myImage',
				'src': baseurl+'assets/images/employee/profile/'+response,
						'width': 150,					
						}).appendTo('#containerother_emp');
    } 

    }
	});
	function getRootUrl_emp() {
	return window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
}
</script>


<script>
   $(document).ready(function() {
		$('#dob').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		$('#doj').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		$('.nomi_dob').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		$('.family_dob').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		$('.validefrom').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		$('.validetill').datetimepicker({format:"DD/MM/YYYY",useCurrent: false});
		
		
		
		 });
</script> 
</body>

</html>