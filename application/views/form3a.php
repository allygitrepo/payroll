<?php 
$title = "Form 3A";
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
		<form action="<?php echo base_url('Exportpdf/form3a');?>" method="post" target="_blank">
                     <!-- START panel-->
						<div id="hide_show1">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
                                	<div class="col-md-3"></div>
                                	<div class="col-md-3">
                                           <div class="form-group">
                               <label class="control-label">Select Year</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate2" id="month_year" name="month_year" value='' placeholder="Select Year" required>
                                 <label id="d" style="color:red;"></label>
                              </div>

                                           </div>
                                           </div>
                                	<div class="col-md-3">
                                 <div class="form-group">
									   <label class="control-label">Memeber ID</label>
											 <input type="text" class="form-control" id="member_id" name="member_id" value='' placeholder="Enter Memeber ID" >
										  </div>
                                 </div>

									</div>
                                	<div class="col-md-3"></div>
                                        
                                	<div class="col-md-12">
									<center>
   		
<!--                		<a id="export_form" target="_blank" href="<?php echo base_url('Exportpdf/export_employee_pdf')?>" class="btn btn-primary " >Download Form 11</a> -->
                	
					<button id="export_form" type="submit" href="" class="btn btn-primary " >Download Form 3A</button>

									</center>
               
                           </div>
                        </div>
 </section>                          
       
							
							</div>
                        </div>    
                     </div>                  
 				</form> 
				
 			</div>	
<div class="panel-footer">
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
<script>
   $(document).ready(function() {
		$('.starttoenddate2').datetimepicker({format:"YYYY",});
   });
   
</script>    
<script>
/*	$(document).on("click","#export_form",function(e){
            e.preventDefault();
			alert('ok');
                    $.ajax({
                   url:"<?php echo base_url('Exportpdf/export_employee_pdf')?>",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
						alert(data);
						
				//		$().toastmessage('showSuccessToast',data);
                    }
                    })
       });
	   */
</script>

   </div>
   


 
   
</body>

</html>