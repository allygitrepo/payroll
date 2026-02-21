   <?php
$title = "KYC Export";
  include('label.php'); ?>
   <!-- Main section-->
   <section>
    <div class="content-wrapper">
					<div class="clearfix">
						<div class="pull-left">
							<h3><?php if(isset($title)){ echo $title; } ?></h3>
						</div>
						<div class="pull-right">
<!--						<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> Office Staff</button>		
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
										<div class="col-md-2"></div>
										<form id="kyc_export_form"></form>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">From Date</label>
                                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" form="kyc_export_form" id="startdate" name="startdate" value='' placeholder="Select Date*"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
										</div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">To Date</label>
                                    <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" form="kyc_export_form" id="enddate" name="enddate" value='' placeholder="Select Date*"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>       </div>
										</div>
										      <div class="col-md-2">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change" form="kyc_export_form">Search</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	
							</div>
           
                        </div>
                       
       
							
							</div>
                        </div> 
<div class="panel-footer">
<div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
        		   <div class="table-responsive" id="show_kyc_export_list" >
						  								
                           </div>
          </section>   
						
                     </div>                  
 			


								</div>
               

			   </div>    
           

		   </div>                  
 				
				
 			</div>	

	<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
    <script src="<?php echo base_url().'assets/js/js/kyc_export_js.js';?>"></script>
    
   </div>
<script>
   $(document).ready(function() {
		
		$('.starttoenddate').datetimepicker({format:"DD/MM/YYYY",});
		
		
			
		 });
</script> 
   
</body>

</html>