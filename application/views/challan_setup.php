   <?php 
   $title = "Challan Setup";
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
                     <!-- START panel-->
						<div id="hide_show">
                     <div class="panel panel-default" id="loanform">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                          	  <div class="panel-body">
                                	<div class="col-md-12">
                  <form  id="challan_form">
                                        <div class="col-md-12">
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $sdate; ?>  *</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="startdate" name="planstartdate" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" onchange="this.setCustomValidity('')" required>
                                 
                              </div>

                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $edate; ?>  *</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="enddate" name="planstartdate" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" onchange="this.setCustomValidity('')" required>
                              
                              </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Salary Limit </label>
                                              <input type="text" name="salarylimit" value="15000" id="salarylimit" class="form-control" placeholder="Enter Salary Limit" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">EDLI Wages </label>
                                              <input type="text" name="edliwages" value="15000" id="edliwages" class="form-control" placeholder="Enter EDLI Wages" required>
                                           </div>
                                        </div>

										
                                        </div>										
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.1 EE (Male)</label>
                                              <input type="text" name="ac1eemale" id="ac1eemale" class="form-control" placeholder="Enter A/c No.1 EE (Male)" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.1 EE (Female)</label>
                                              <input type="text" name="ac1eefemale" id="ac1eefemale" class="form-control" placeholder="Enter A/c No.1 EE (Female)" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No. 1 ER</label>
                                              <input type="text" name="ac1er" id="ac1er" class="form-control" placeholder="Enter A/c No. 1 ER" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.2</label>
                                              <input type="text" name="ac2" id="ac2" class="form-control" placeholder="Enter A/c No.2" required>
                                           </div>
                                        </div>
                                        </div>
                     	       		
										<div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.10</label>
                                              <input type="text" name="ac10" id="ac10" class="form-control" placeholder="Enter A/c No.2" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.21</label>
                                              <input type="text" name="ac21" id="ac21" class="form-control" placeholder="Enter A/c No.21" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.22</label>
                                              <input type="text" name="ac22" id="ac22" class="form-control" placeholder="Enter A/c No.22" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.2 Min</label>
                                              <input type="text" name="ac2min" id="ac2min" class="form-control" placeholder="Enter A/c No.2 Min" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/c No.22 Min</label>
                                              <input type="text" name="ac22min" id="ac22min" class="form-control" placeholder="Enter A/c No.22 Min" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">PMRPY</label>
                                              <input type="text" name="pmrpy" id="pmrpy" class="form-control" placeholder="Enter PMRPY" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="control-label">ESIC Wages</label>
                                          <input type="text" 
                                                name="esic_wages" 
                                                id="esic_wages" 
                                                class="form-control" 
                                                placeholder="Enter ESIC Wages" 
                                                required>
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="control-label">Employee Share (%)</label>
                                          <input type="text" 
                                                name="employee_share" 
                                                id="employee_share" 
                                                class="form-control" 
                                                placeholder="Enter Employee Share" 
                                                required>
                                       </div>
                                    </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Employer Share</label>
                                              <input type="text" name="employer_share" id="employer_share" class="form-control" placeholder="Enter Employer Share" required>
                                           </div>
                                        </div>
                                       
                                        </div>
                     	       <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change">Save</button>																				</form>
	
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <a   id="close" class="btn btn-primary btn_cancel button_change">Cancel</a>	
                                        <input type="hidden" id="save_update" value="add"/>
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
								</div>	
							</div>
                        </div>    
                     </div>                  
 				 
				
 			</div>	
<div class="panel-footer">
                           <div class="table-responsive" id="show_packingwages">
										    
                
					
                           </div>
                        </div>
 </section>                          
       
	

<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   
   <?php include('footer.php');?>
<script src="<?php echo base_url().'assets/js/js/challan_setup_js.js';?>"></script>   
   
   </div>
<script>
   $(document).ready(function() {
		
		$('.starttoenddate').datetimepicker({format:"DD/MM/YYYY", maxDate: new Date()});
		 });
</script> 
   <script>
   
   
 var table = $('#example').DataTable( {
	scrollX: true,
	pageLength: 10,
	 fixedHeader: true,
        lengthChange: false,
		order: [[ 0, "asc" ]],
       // buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
    // table.buttons().container()
        // .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
	
 /*  $('#example thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<label>'+title+'</label><br><input type="text" placeholder="Search '+title+'" />' );
    } );  */
 
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