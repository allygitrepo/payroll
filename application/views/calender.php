<?php
$title = "Calender";
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
                  <form  id="calender_form">
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
                                              <label class="control-label">Holiday Type</label>
                                              <select name="holidaytype" id="holidaytype" class="form-control" required>
											<option value="" selected disabled>Select Holiday Type</option>
											<option value="COMPANY">Company Holiday</option>
											<option value="WEEKLY">WEEKLY Holiday</option>
											</select>
										   </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Week Days</label>
                                              <select name="weekdays" id="weekdays" class="form-control" disabled required>
											<option value="" selected disabled>Select Week Day</option>
											<option value="Monday">Monday</option>
											<option value="Tuesday">Tuesday</option>
											<option value="Wednesday">Wednesday</option>
											<option value="Thursday">Thursday</option>
											<option value="Friday">Friday</option>
											<option value="Saturday">Saturday</option>
											<option value="Sunday">Sunday</option>
											</select>
										   </div>
                                        </div>
                                        <div class="col-md-3" id="date_calender">
                                           <div class="form-group">
                                              <label class="control-label">Select Date</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="holiday_date" name="holiday_date" value='' placeholder="Select Date*"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
                                        </div>
										<div class="col-md-3" id="year_calender" hidden>
						                   <div class="form-group">
                                              <label class="control-label">Select Year</label>
                              
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control years" id="years" name="years1" value='' placeholder="Select Date*"  required disabled>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
                        				</div>
						
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Remark</label>
                                              <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark" >

                                           </div>
                                        </div>

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
                           <div class="table-responsive" id="show_calender">
						   
						   				  
<!--	<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="50%">
        <thead>
            <tr>
				<th>Date</th>  			
				<th>Type</th>  			
				<th>Remark</th>  			
				<th><center>Action</center></th>  
            </tr>
        </thead>
       <tbody>
	<tr>
				<td>21/01/2015</td>
				<td>public</td>
				<td>holiday</td>				
		<td><center><button class="btn_up btn btn-xs btn-danger user_edit" value="" >
			<i class="fa fa-edit"></i></button>
		<button  class=" btn btn-xs btn-danger user_delete"   value="" >
			<i class="fa fa-trash"></i></button>
		</center></td>
		
</tr>
<tr>			
				<td>11/01/2015</td>
				<td>company</td>
				<td>company holiday</td>				
		<td><center><button class="btn_up btn btn-xs btn-danger user_edit" value="" >
			<i class="fa fa-edit"></i></button>
		<button  class=" btn btn-xs btn-danger user_delete"   value="" >
			<i class="fa fa-trash"></i></button>
		</center></td>
		
		</tr>
<tr>			
				<td>20/11/2017</td>
				<td>company</td>
				<td>Power cut</td>				
		<td><center><button class="btn_up btn btn-xs btn-danger user_edit" value="" >
			<i class="fa fa-edit"></i></button>
		<button  class=" btn btn-xs btn-danger user_delete"   value="" >
			<i class="fa fa-trash"></i></button>
		</center></td>
		</tr>

</tbody>
			</table>
	-->														
               
															
                           </div>
                        </div>

 </section>                          
                            
 <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <?php include('footer.php');?>
   <script src="<?php echo base_url().'assets/js/js/calender_js.js';?>"></script>   
<script>
   $(document).ready(function() {		
		$('.starttoenddate').datetimepicker({format:"DD/MM/YYYY", maxDate: new Date()});
		$('.years').datetimepicker({format:"YYYY", maxDate: new Date()});
		 });
</script>    

   </div>

</body>

</html>