<?php
$title = "Excel To Text";
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
										<div class="col-md-3"></div>
<!--										<div class="col-md-3">
										<center>
                                           <div class="form-group">
                                              <label class="control-label">Select Month</label>
                                              <input type="month" name="monthyear" id="monthyear" class="form-control" placeholder="Month and Year" required>
                                           </div>
                                        </center>
										</div>
	-->										

<form  action="<?php echo base_url().'Employeeimport/convert_excel_to_text'?>" method="POST"
           enctype="multipart/form-data">
									<div class="col-md-10"    >
													<div class="form-group">
														<label class="control-label">Select Excel File For Convert</label>
														
			<input type="file" class="form-control-primary" id="file" name="file" style="width:200px;" ><br><br>							
		    <input type="hidden" id="file_attachother" value=""/>
				</div>
													</div>
													<div class="col-md-1">
                                    <center> 
    <button type="submit" id="btn_insert" class="btn btn-primary button_change">Convert</button>										
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
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
        

   <?php include('footer.php');?>
   
   
   </div>
</body>

</html>