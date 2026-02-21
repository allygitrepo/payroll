<?php 
$title = "Employee Missing Details";
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
							<table class="table">
    <tbody>
      <tr>
        <td><label class="checkbox-inline"><input id="name" type="checkbox" value="" checked>Name</label></td>
        <td><label class="checkbox-inline"><input checked id="dob" type="checkbox" value="">Dob</label></td>
        <td><label class="checkbox-inline"><input checked id="doj" type="checkbox" value="">Doj</label></td>
        <td><label class="checkbox-inline"><input checked id="gender" type="checkbox" value="">Gender</label></td>
      </tr>
      <tr>
        <td><label class="checkbox-inline"><input checked id="relation" type="checkbox" value="">Relation</label></td>
        <td><label class="checkbox-inline"><input checked id="maritalstatus" type="checkbox" value="">Marital Status</label></td>
        <td><label class="checkbox-inline"><input checked id="qualification" type="checkbox" value="">Qualification</label></td>
		<td></td>
      </tr>
      <tr>
        <td><label class="checkbox-inline"><input checked id="adharkyc" type="checkbox" value="">AADHAAR KYC</label></td>
        <td><label class="checkbox-inline"><input checked id="pankyc" type="checkbox" value="">PAN KYC</label></td>
        <td><label class="checkbox-inline"><input checked id="bankkyc" type="checkbox" value="">BANK KYC</label></td>
		<td></td>
      </tr>
    </tbody>
  </table><br>
  										      <div class="col-md-12">
                                    <center> 
                                        <button  id="search_employee" class="btn btn-info"  >Search</button>															
                                        <button  id="reset_selected" class="btn btn-danger"  >Reset</button>															
                                    </center>
									<input type="hidden" id="save_update" value="add" />
                                </div>

                     	 		</div>	

								<div class="col-md-12">
                           	<div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>

							   <div class="table-responsive" id="employee_data1">
						  
	
															
                           </div>
               
                           </div>
                        </div>
 </section>                          
       
							
							</div>
                        </div>    
                     </div>                  
 				
				
 			</div>	
<div class="panel-footer">
   <?php include('footer.php');?>
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

<script src="<?php echo base_url().'assets/js/js/employee_export.js';?>"></script>
<script>
         $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
   $(document).ready(function() {
		
		$('.month_year').datetimepicker({format:"MM/YYYY",});
		
		
	
		
		
		 });
</script> 

   </div>
   


 
   
</body>

</html>