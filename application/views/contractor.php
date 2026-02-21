   <?php 
   $title = "Contractor";
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
                  <form   id="contractor_form">

                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $cCode; ?> *</label>
                                              <input type="text" name="ccode" id="ccode" class="form-control" placeholder="Enter <?= $cCode; ?> *" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $name; ?> *</label>
                                              <input type="text" name="name" id="name" class="form-control" placeholder="Enter <?= $name; ?>" required>
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
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Pincode *</label>
                                              <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter <?= $pin; ?> * 	 				 												"oninvalid="this.setCustomValidity('please enter Pincode')" onChange="this.setCustomValidity('')"  disabled	 >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $pfCode; ?> *</label>
                                              <input type="text" name="pfcode" id="pfcode" class="form-control" placeholder="Enter <?= $pfCode; ?>" required>
                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $doj; ?>  *</label>
                                  <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control" id="doj" name="doj" value='' placeholder="Select Date*" required >
                                 <label id="d" style="color:red;"></label>
                              </div>
							  </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $pan; ?> </label>
                                              <input type="text" name="pan" id="pan" class="form-control" placeholder="Enter <?= $pan; ?>">
                                           </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $adhar; ?> </label>
                                              <input type="text" name="adhar" id="adhar" class="form-control" placeholder="Enter <?= $adhar; ?>" >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $gstno; ?> </label>
                                              <input type="text" name="gstno" id="gstno" class="form-control" placeholder="Enter <?= $gstno; ?>" >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $bankac; ?> </label>
                                              <input type="text" name="bankac" id="bankac" class="form-control" placeholder="Enter <?= $bankac; ?>" >
                                           </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $bankName; ?> </label>
                                              <input type="text" name="bankname" id="bankname" class="form-control" placeholder="Enter <?= $bankName; ?>" >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $ifsc; ?> </label>
                                              <input type="text" name="ifsc" id="ifsc" class="form-control" placeholder="Enter <?= $ifsc; ?>" >
                                           </div>
                                        </div>
                                        </div>
						       <div class="col-md-12">
                                    <center> 
                                        <input type="submit" id="btn_insert" name="btn_insert" class="btn btn-primary button_change" value="Save" />
										
										<input type="hidden" id="save_update" value="add" />															
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
<div id="wait" style="display:;width:100px;height:100px;position:absolute;top:180%;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>

                           <div class="table-responsive" id="table_data1">
										                     
          <div class="table-responsive"  id="show_contractor_list">
						  
	
      
															
                           </div>
           
 </section>                          
                            
 

   </div>
   <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
  <?php include('footer.php');?>
      <script src="<?php echo base_url().'assets/js/js/contractor_js.js';?>"></script>   
	<script>
   $(document).ready(function() {
		
		$('#doj').datetimepicker({format:"DD/MM/YYYY",});
		 });
</script> 

 
</body>

</html>


				
