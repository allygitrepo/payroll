<?php
$title = "Employee Import";
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
										
										
<form   id="excelimport_form"  method="POST"  enctype="multipart/form-data">
<div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:10%;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
							<div class="col-md-7"    >
								<div class="form-group">
			<label class="control-label">Employee File Import</label>														
			<input type="file" class="form-control-primary" id="file" name="file" style="width:200px;" ><br><br>							
		    <input type="hidden" id="file_attachother" value=""/>
			<label class="control-label" style="color:red;" id="update_error"></label>														
								</div>
						</div>
													<div class="col-md-1">
                                    <center> 
    <button type="submit" id="btn_insert" class="btn btn-primary button_change">Import</button>										
                                    </center>
                                </div>
	</form> 
										<div class="col-md-4">
                                    <center> 
                		<a  href="<?php echo base_url('Employeeimport/excel_download')?>" class="btn btn-primary button_change" >Download Excel Format</a>
                                    </center> 
										</div>
								</div>	
							</div>
                        </div>    
                     </div>                  
 			</div>	
<div class="panel-footer">
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <?php include('footer.php');?>
  <script>
     $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
	
 $(document).ready(function() {
	 
	 
	 
    $(document).on("submit","#excelimport_form",function(e){
			e.preventDefault();
					$.ajax({
					url:"<?php echo base_url(); ?>Employeeimport/import_employee_file",
					method:"POST",
					data:new FormData(this),
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){
//						$('#update_error').html('Employee Not Found : '+data);
					$().toastmessage('showSuccessToast', "Employee Data Import Successfully");
					}
					})
        });

});
 
  </script> 
   </div>
</body>
</html>