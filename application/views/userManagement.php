<?php
$title = "User Management";
  include('label.php');

		$result = array(
		"Dashboard" => 'Dashboard',
		"Master" => 'Company,Employee,Kyc Update,Contractor,Address',
		"Setup" => 'Paking Wages,Bidi Roller Wages,Professional Tax,Office Staff Salary,Challan Setup',
		"Entry" => 'Office Staff,Packers,Bidi Roller,Challan Date,Resignation',
		"Report" => 'Salary Sheet,Form,ECR Report,PMRPY Report,PF Challan Yearly,EPF Challan,PF Summary,Payment Advice,Bonus Sheet,Gratuity Calculation,Professional Tax',
		"Utility" => 'Calender,User Management,Employee Data Import,Employee Data Export,KYC Export,Attandance Printing,Missing Information,Delete Month Entry,Backup,Restore',
		"Todo List" => '3 Month Absent List,58 Years of age,Notes',
		"Convert Excel To Text" => 'Excel To Text'
		);

		
 
 ?>
 <style>
	.userm{
	text-transform:none;	   
   }
</style>
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
                  <form  id="usermanagement_form">
                     <!-- START panel-->
						<div id="hide_show">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
                          <div class="col-md-12">
                                        <div class="col-md-3">
											
											<div class="form-group">
                                              <label class="control-label">User Name</label>
                                              <input type="text" name="username" id="username" class="form-control userm" placeholder="Enter User Name" required>

                                           </div>

										</div>
                                        <div class="col-md-3">
	                                           <div class="form-group">
                                              <label class="control-label">User Id</label>
                                              <input type="text" name="userid" id="userid" class="form-control userm" placeholder="Enter User Id" required>

                                           </div>

										</div>
                                        <div class="col-md-3">
	                                           <div class="form-group">
                                              <label class="control-label">Password</label>
                                              <input type="password" name="password" id="password" class="form-control userm" placeholder="Enter Password" required>

                                           </div>

										</div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Designation</label>
                                              <select name="designation" id="designation" class="form-control"  required>
											<option value="" selected disabled >Select Designation</option>
											<option value="OWNER" id="owner">Owner</option>
											<option value="DATA ENTRY OPERATOR" id="dentry">Data entry operator</option>
											</select>
										   </div>
                                        </div>

<!--                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">DSC Expiredate</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control dscdate" id="dscdate" name="dscdate" value='' placeholder="Select Date*" required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
                                        </div>
-->                                   
     </div>
						<div class="col-md-12">
						<?php
						
						for($j=0;$j<8;$j++){
							
				if($j==0){ $index = "Dashboard"; 				$id = "d_";		}
				if($j==1){ $index = "Master"; 					$id = "m_";		}
				if($j==2){ $index = "Setup"; 					$id = "s_";		}
				if($j==3){ $index = "Entry"; 					$id = "e_";		}
				if($j==4){ $index = "Report"; 					$id = "r_";		}
				if($j==5){ $index = "Utility"; 					$id = "u_";		}
	    		if($j==6){ $index = "Todo List";				$id = "t_";		} 
				if($j==7){ $index = "Convert Excel To Text"; 	$id = "c_";		}		 	

echo '<div class="col-md-3">
                  <!-- START panel-->
                  <div id="panelDemo8" class="panel panel-primary">
                     <div class="panel-heading">'.$index.'</div>
                     <div class="panel-body">';
				
							
							
						$i=0;
						$menu = explode(",",$result[$index]);
						$mcount = count($menu);			
						for($i=0;$i<$mcount;$i++){
							
echo   '<div class="checkbox">
      <label><input type="checkbox" class="access" id="'.$id.$i.'"    value="'.$id.$i.'"   checked>'.$menu[$i].'</label>
    </div>';



							
						}
							
echo   '</div>
                  </div>
                  <!-- END panel-->
               </div>';				
							
							
							
						}
						
							
						
							
						
							
						?>
						</div>
				
						  
						  <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change">Save</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <a  id="close" class="btn btn-primary btn_cancel button_change">Cancel</a>	
										<input type="hidden" id="save_update" value="add"/>
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>

										
										
								</div>	
							</div>
                        </div>    
                     </div>                  
 				</form> 
 			</div>	
							<div class="panel-footer">
                           <div class="table-responsive" id="show_user_list">
						   
		
									
               
															
                           </div>
                        </div>

 </section>                          
             
 
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>

   <script src="<?php echo base_url().'assets/js/js/usermanagement_js.js';?>"></script>   
                     <script>
   $(document).ready(function() {
		$('.dscdate').datetimepicker({format:"DD/MM/YYYY",});
		 });
</script>    
   
   
   </div>
	

</body>

</html>