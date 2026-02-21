   <?php
$title = "Attendance Sheet Printing";
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
									
		<form id="printpdf" action="<?php echo base_url('Exportpdf/print_attendance_sheet_pdf')?>" method="post" target="_blank"></form>
                                        <div class="col-md-12">
										<div class="col-md-4">
                                           <div class="form-group">
                                              <label class="control-label">Select Month</label>
								<div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year" id="month_year" name="month_year" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" form="printpdf" onchange="this.setCustomValidity('')" required>
                                 <label id="d" style="color:red;"></label>
                              </div>                                           </div>
										</div>
														<div class="col-md-4">
										  <div class="form-group">
                                              <label class="control-label">Contractor</label>
                                              <select name="contractor1" id="contractor1" form="printpdf" class="form-control">
											  </select>
                                           </div>
                                        </div>
						
										<div class="col-md-2">
										</div>
													<div class="col-md-2">
                                        <button id="btn_insert" class="btn btn-primary button_change">Search Attendance </button>     
                                        <button id="btn_print" form="printpdf" class="btn btn-primary button_change">Print Attendance </button>     
										<input type="hidden" value="" id="daysofmonth" />
										<input type="hidden" value="" id="days_1" />
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	
								
							</div>
                        </div>    
                     </div>                  
 			
 			</div>	
<div class="panel-footer">

<div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>


							<div class="panel-footer">
                           <div class="" id="attandance_list">


 <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
  <script src="<?php echo base_url().'assets/js/js/attendance_print_js.js';?>"></script>   
        

   </div>
<script>
   $(document).ready(function() {	
		
		$('.month_year').datetimepicker({format:"MM-YYYY",});
		 });
</script> 
<script>
/*
	$(document).on("click","#export_form",function(e){
            e.preventDefault();
			alert('ok');
                    $.ajax({
                   url:"<?php echo base_url('Exportpdf/print_attendance_sheet_pdf')?>",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
//						alert(data);
						
				//		$().toastmessage('showSuccessToast',data);
                    }
                    })
       });
*/	   
</script>

 
   
</body>

</html>