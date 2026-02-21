<?php 
$title = "Employee Export";
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
                  <form method="post" action="#" id="progress_form">
                     <!-- START panel-->
						<div id="hide_show1">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	                                 <div class="col-md-12">
										<div class="col-md-4"></div>
										<div class="col-md-3">
										<center>
                                           <div class="form-group">
                                              <label class="control-label">Month and Year</label>
                                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year" id="month_year" name="month_year" value='' >
                                 <label id="d" style="color:red;"></label>
                              </div>  
                                           </div>
                                        </center>
										</div>
										      <div class="col-md-1">
                                    <center> 
                                        <a id="btn_search" class="btn btn-primary button_change">Search</a>													
                                    </center>
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	

								<div class="col-md-12">
<div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>

							   <div class="table-responsive" id="employee_data">
						  
	
															
                           </div>
               
                           </div>
                        </div>
 </section>                          
       
							
							</div>
                        </div>    
                     </div>                  
 				</form> 
				
 			</div>	
<div class="panel-footer">
   <?php include('footer.php');?>
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

<script src="<?php echo base_url().'assets/js/js/employee_export.js';?>"></script>
<script>
   $(document).ready(function() {
		
		$('.month_year').datetimepicker({format:"MM/YYYY",});
		
		
	
		
		
		 });
</script> 

   </div>
   


 
   
</body>

</html>