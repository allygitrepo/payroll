<?php 
$title = "PF Claim Form";
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
		<form action="<?php echo base_url('Exportpdf/pfclaimform');?>" method="post" target="_blank">
                     <!-- START panel-->
						<div id="hide_show1">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
                                	<div class="col-md-4"></div>
                                	<div class="col-md-4">
                                           <div class="form-group">
                               <label class="control-label">Memeber Id</label>
                                 <input type="text" class="form-control" id="member_id" name="member_id" value='' placeholder="Enter Member id*" required>

                                           </div>
                                           </div>
                                	<div class="col-md-4"></div>
                                        </div>
                                	<div class="col-md-12">
									<center>
   		
<!--                		<a id="export_form" target="_blank" href="<?php echo base_url('Exportpdf/export_employee_pdf')?>" class="btn btn-primary " >Download Form 11</a>
-->
                		<button id="export_form" type="submit" href="" class="btn btn-primary " >Download PF Claim Form</button>

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
</script>    
<script>
</script>

   </div>
   


 
   
</body>

</html>