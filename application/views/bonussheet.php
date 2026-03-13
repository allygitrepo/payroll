   <?php
   $title = "Bonus Sheet";
  include('label.php'); ?>
<!-- Required CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/dist/css/select2.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css'); ?>">

<style>
  /* SaaS-style Multi-select Dropdown styling */
  .select2-container--bootstrap .select2-selection--multiple {
    min-height: 34px !important;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s !important;
  }
  
  .select2-container--bootstrap.select2-container--focus .select2-selection--multiple {
    border-color: #66afe9 !important;
    outline: 0 !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6) !important;
  }

  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #2e6da4 !important;
    color: #fff !important;
    padding: 2px 8px !important;
    margin-top: 4px !important;
    margin-bottom: 2px !important;
    border-radius: 3px !important;
    font-size: 12px !important;
  }
  
  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    margin-right: 5px !important;
    cursor: pointer !important;
  }
  
  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #ffdada !important;
  }
</style>
   <!-- Main section-->
   <section>
    <div class="content-wrapper">
					<div class="clearfix">
						<div class="pull-left">
							<h3>Bonus Sheet</h3>
						</div>
						<div class="pull-right">
<!--						<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> Office Staff</button>		
	-->					
						</div>
          </div>  
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="post" action="#" id="bonussheetform">
                     <!-- START panel-->
						<div id="hide_show1">
                     <div class="panel panel-default" >
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
                                        <div class="col-md-12">
										<div class="col-md-3">
										<center>
                                           <div class="form-group">
                                              <label class="control-label">From Month and Year</label>
                                          <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year" id="month_year1" name="month_year" value='' placeholder="Select Month"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>  

                                           </div>
                                        </center>
										</div>
										<div class="col-md-3">
					                       <div class="form-group">
                                              <label class="control-label">To Month and Year</label>
                                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year" id="month_year2" name="month_year" value='' placeholder="Select Month"  required>
                                 <label id="d" style="color:red;"></label>
                              </div>  
                                           </div>
                    					</div>
																			<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $typeEmp; ?> *</label>
                                               <select name="typeEmp" form="employee_form" id="typeEmp" class="form-control"  required>
                                                  <option value="OFFICE STAFF">Office Staff</option>
                                                  <option value="BIDI PACKER">Bidi Packer</option>
                                                  <option value="BIDI MAKER">Bidi Maker</option>
											  </select>
                                           </div>
                                        </div>

                                        <div class="col-md-3" id="contractor_div" style="display:none;">
                                           <div class="form-group">
                                              <label class="control-label">Contractor Name - Pf Code</label>
                                              <select name="contractor1[]" id="contractor1" class="form-control" multiple="multiple">
                                              </select>
                                           </div>
                                        </div>
	
										      <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change" style="width: 200px; margin-top: 10px;">Search</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
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
	<div id="wait" style="display:none;width:100px;height:100px;position:fixed;top:50%;left:50%;margin-top:-50px;margin-left:-50px;padding:2px;z-index:9999;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
                     					                     
									                     
          <div class="table-responsive" id="table_data1">
						  
																
                           </div>
					
                           
                        </div>
 </section>                          
       
	
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <?php include('footer.php');?>
   </div>


<script>
    $(document).ajaxStart(function(){
        $("#wait").show();
    });
    $(document).ajaxComplete(function(){
        $("#wait").hide();
    });
   $(document).ready(function() {
		
		$('.month_year').datetimepicker({format:"MM/YYYY",});
		 });
</script> 


   <script src="<?php echo base_url('assets/vendor/select2/dist/js/select2.js'); ?>"></script>
   <script src="<?php echo base_url().'assets/js/js/bonussheet_js.js';?>"></script>

   <script>

 var table = $('#example').DataTable( {
	scrollX: true,
	pageLength: 10,
	 fixedHeader: true,
        lengthChange: false,
		order: [[ 0, "asc" ]],
		
		
		
	   dom: 'Bfrtip',
		buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	   
	   
    } );
     table.buttons().container()
         .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
	/*
  $('#example thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<label>'+title+'</label><br><input type="text" placeholder="Search '+title+'" />' );
    } );  
 */
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	
	
</script>
 
   
</body>

</html>