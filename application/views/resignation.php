   <?php 
   $title = "Resignation";
  include('label.php'); ?>
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
                  <form  id="resignation_form">
                                        <div class="col-md-12">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">Account No.</label>
                                              <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Enter Account No." required>
                                           </div>
                                        </div>
                                        </div>
										                                 <div class="col-md-12">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">UAN</label>
                                              <input type="text" name="uan" id="uan" class="form-control"  >
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">Name Of Member</label>
                                              <input type="text" name="name" id="name" class="form-control"  >	
											  </div>
                                        </div>
                                        <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">Name Of Parents</label>
                                              <input type="text" name="parents" id="parents" class="form-control"  >
                                           </div>
                                        </div>
                                        </div>
       
	                                     <div class="col-md-12">
   									<div class="col-md-4">
                                           <div class="form-group">
                               <label class="control-label">Date of Leaving</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate1" id="leaving_date" name="leaving_date" value='' placeholder="Select Date*" required>
                                 <label id="d" style="color:red;"></label>
                              </div>

                                           </div>
                                        </div>
										<div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">Reason Of Leaving</label>
                            <select  class="form-control starttoenddate" id="reason" name="reason" required >
<option value="" selected disabled >Select Reason Of Leaving</option>
<option value="R" >RETIREMENT</option>
<option value="D" >DEATH IN SERVICE</option>
<option value="S" >SUPERNNUATION</option>
<option value="P" >PERMANENT DISABLEMENT</option>
<option value="C" >CESSATION (SHORT SERVICE)</option>
<option value="A" >DEATH AWAY FROM SERVICE</option>
							</option>
                            </select>  
							<label id="d" style="color:red;"></label>
                                              </div>
                                        </div>
										<div class="col-md-4"></div>
                                        </div>	
										
                     	       <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change">Save</button>																				</form>
	
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <a   id="close" class="btn btn-primary btn_cancel button_change">Cancel</a>	
                                        <input type="hidden" id="save_update" value="add"/>
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
								</div>	
							</div>
                        </div>    
                     </div>                  
 				 
				
 			</div>	
					<div class="panel-footer">
	             <div class="col-md-12">
   									<div class="col-md-3">
                                           <div class="form-group">
                               <label class="control-label">Month Wise Search</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate2" id="month_year" name="month_year" value='' placeholder="Select Date*" required>
                                 <label id="d" style="color:red;"></label>
                              </div>

                                           </div>
                                        </div>
                                        </div>
							<div class="col-md-12">
                        <div class="table-responsive" id="show_resignation"></div>
                    </div>
                                        </div>
 </section>                          
       
	
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
   
   
   </div>
<script src="<?php echo base_url().'assets/js/js/resignation_js.js';?>"></script>   
<script>
   $(document).ready(function() {
		$('.starttoenddate1').datetimepicker({format:"DD/MM/YYYY",});
		$('.starttoenddate2').datetimepicker({format:"MM/YYYY",});
   });
   
</script> 

   
</body>

</html>