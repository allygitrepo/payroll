
   <?php
   $title = "Company";
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
               <div class="col-md-12">
                     <!-- START panel-->
						<div id="hide_show">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
										<form  id="company_form">

                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $estbId; ?> *</label>
                                              <input type="text" name="estb_id" id="estb_id" class="form-control"  placeholder="Enter <?= $estbId; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter ESTB ID ')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $estaName; ?> *</label>
                                              <input type="text" name="esta_name" id="esta_name" class="form-control" placeholder="Enter <?= $estaName; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter ESTA Name')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $estaType; ?> *</label>
                                              <select type="text" name="estaType" id="estaType" class="form-control" placeholder="Enter <?= $estaType; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Esta Type')" onChange="this.setCustomValidity('')" required>											  <option Disabled Selected>Select</option>
											  <option value="PROPRIETORSHIP">Proprietorship</option>
											  <option value="PARTNERSHIP">Partnership</option>
											  <option value="PRIVATE LIMITED COMPANY">Private Limited company</option>
											  <option value="PUBLIC LIMITED COMPANY">Public Limited company</option>
											  </select>

                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $underEpfo; ?> *</label>
                                              <input type="text" name="underEpfo" id="underEpfo" class="form-control" placeholder="Enter <?= $underEpfo; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter EPFO Office')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $linNo; ?> *</label>
                                              <input type="text" name="linNo" id="linNo" class="form-control" placeholder="Enter <?= $linNo; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter LIN No.')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $address; ?> *</label>
                                              <select type="text" name="address" id="address_list" class="form-control" placeholder="Enter <?= $address; ?> * 	 				 												"oninvalid="this.setCustomValidity('please Select Address')" onChange="this.setCustomValidity('')" required >
												  
												 </select>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $postOffice; ?> *</label>
                                              <input type="text" name="postoffice" id="postoffice" class="form-control" placeholder="Enter <?= $postOffice; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Postoffice')" onChange="this.setCustomValidity('')"  disabled >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $dist; ?> *</label>
                                              <input type="text" name="district" id="district" class="form-control" placeholder="Enter <?= $dist; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter District')" onChange="this.setCustomValidity('')"  disabled >
                                           </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Pincode *</label>
                                              <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter <?= $pin; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Pincode')" onChange="this.setCustomValidity('')"  disabled	 >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $pan; ?> *</label>
                                              <input type="text" name="pan" id="pan" class="form-control" placeholder="Enter <?= $pan; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter PAN')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $tan; ?> *</label>
                                              <input type="text" name="tan" id="tan" class="form-control" placeholder="Enter <?= $tan; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter TAN')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $pTax; ?> *</label>
                                              <input type="text" name="pTax" id="pTax" class="form-control" placeholder="Enter <?= $pTax; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter P.TAX')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $primaryEmail; ?> *</label>
                                              <input type="text" name="primaryEmail" id="primaryEmail" class="form-control" placeholder="Enter <?= $primaryEmail; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Primary Email')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $phone; ?> *</label>
                                              <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter <?= $phone; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Phone no.')" onChange="this.setCustomValidity('')" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">WebSite Name</label>
                                              <input type="text" name="website" id="website" class="form-control" placeholder="Enter WebSite Name" >
                                           </div>
                                        </div>
                                        </div>
						       <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change">Save</button>											<input type="hidden" id="save_update" value="add" />		
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <button type="button"  id="close" class="btn btn-primary btn_cancel button_change">Cancel</button>	
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
								</form> 
								</div>	
							</div>
                        </div>    
                     </div>                  
 				
 			</div>	
						<div class="panel-footer">
                        <div class="" id="show_company_list">
						
						
						
						
					   </div>
                        </div>

 </section>                          
                            
 
	

   
   </div>
   
   <?php include('footer.php');?>
<script>
	
	</script>
   <script src="<?php echo base_url().'assets/js/js/company_js.js';?>"></script>   

   <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
 
</body>

</html>