   <?php
$title = "Notes";
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
                  <form  id="notes_form">
                                        <div class="col-md-12">
										<div class="col-md-2 "></div>
										<div class="col-md-3 ">
                                           <div class="form-group">
                                              <label class="control-label">Select Date</label>
                                                                                            <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control note_date" id="note_date" name="note_date" value='' placeholder="Select Date"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>  

                                           </div>
										</div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Note</label>
                                              <textarea type="textarea" name="notes" id="notes" class="form-control" placeholder="Write Note" required ></textarea>
                                           </div>
										</div>
										      <div class="col-md-1">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change">Save Note</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="save_update" value="add"/>
									      <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	
								</form> 
							</div>
                        </div>    
                     </div>                  
 				
				
 			</div>	
<div class="panel-footer">
                           <div class="table-responsive" id="show_notes">
                           </div>
                        </div>
 </section>                          
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
<script>
   $(document).ready(function() {
		$('.note_date').datetimepicker({format:"DD/MM/YYYY",});
		 });
</script> 
   <script src="<?php echo base_url().'assets/js/js/notes_js.js';?>"></script>   
   </div>



   
 
   
</body>

</html>