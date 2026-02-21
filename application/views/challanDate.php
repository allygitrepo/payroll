<?php
$title = "Challan Date Entry";
  include('label.php'); ?>
   <!-- Main section-->
   <section>
    <div class="content-wrapper">
					<div class="clearfix">
						<div class="pull-left">
							<h3><?php if(isset($title)){ echo $title; } ?></h3>
						</div>
						<div class="pull-right">
	<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> Challan Date</button>		
		</div>
          </div>  
            <!-- START row-->
            <div class="row">
                 
                     <!-- START panel-->
						<div id="hide_show1">
                   
							  
							  
			
              <div class="col-md-12">
                  <form method="post"  id="challan_date_form">
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
                                              <label class="control-label">TRRN</label>
                                              <input type="text" name="trrn" id="trrn" class="form-control" placeholder="TRRN  " >
                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">CRN NO.</label>
                                              <input type="text" name="crnno" id="crnno" class="form-control" placeholder="CRN NO." >
                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Wage Month *</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year"  id="wagemonth" name="wagemonth" value='' required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                              
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Due Date</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="duedate" name="duedate" value='' placeholder="Select Date" required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
                                        </div>
                                        </div>										
                                        <div class="col-md-12">
                                       <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Challan Date *</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="challandate" name="challandate" value='' placeholder="Select Date">
                                 <label id="d" style="color:red;"></label>
                              </div>
							  </div>
                                        </div>

                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 1 (EE) </label>
                                              <input type="text" name="ac1" id="ac1" class="form-control a_c" placeholder="Enter A/C 1">
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 1 (ER) </label>
                                              <input type="text" name="ac1" id="ac1er" class="form-control a_c" placeholder="Enter A/C 1">
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 2 </label>
                                              <input type="text" name="ac2" id="ac2" class="form-control a_c" placeholder="Enter A/C 2" >
											  
                                           </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 10 </label>
                                              <input type="text" name="ac10" id="ac10" class="form-control a_c" placeholder="Enter A/C 10" >
                                           </div>
                                        </div>
									<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 21 </label>
                                              <input type="text" name="ac21" id="ac21" class="form-control a_c" placeholder="Enter A/C 21" >
                                           </div>
                                        </div>

                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">A/C 22 </label>
                                              <input type="text" name="ac22" id="ac22" class="form-control a_c" placeholder="Enter A/C 22" >
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Total Amount </label>
                                              <input type="text" name="totalamount" id="totalamount" class="form-control" placeholder="Enter Total Amount" disabled >
                                           </div>
                                        </div>
                              
                                        </div>
                                        <div class="col-md-12">
								          <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Return Date</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="returndate" name="returndate" value=''  >
                                 <label id="d" style="color:red;"></label>
                              </div>
											  </div>
                                        </div>
                                        </div>
                     	       <div class="col-md-12">
                                    <center> 
                                        <button type="submit" id="btn_insert" class="btn btn-primary button_change add_challan_date_entry">Save</button>													
                                  <button  id="close" class="btn btn-primary btn_cancel button_change">Cancel</button>	
                                         <input type="hidden" id="save_update" value="save"/>
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
 			</div>	
			
			
			<div class="panel-footer">
               <div class="table-responsive" id="table_data1">
                        </div>
         
   </div>
 </section>        	                   

   <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
 <?php include('footer.php');?>

   <script src="<?php echo base_url().'assets/js/js/challandate_js.js';?>"></script> 
  

<script>
   $(document).ready(function() {
		
		$('.starttoenddate').datetimepicker({format:"DD/MM/YYYY",});
		$('.month_year').datetimepicker({format:"MM/YYYY",});
		
		     $('#example4').dataTable({ 
		'scrollX': true,
		'bDestroy': true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
 //       'responsive': true, // https://datatables.net/extensions/responsive/examples/
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns:',
            sLengthMenu:  '_MENU_ records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        },
        // Datatable Buttons setup
        dom: '<"html5buttons"B>lTfgitp',
		
        buttons: [
            {extend: 'colvis',  className: 'btn-sm', title: msg },
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'excel', className: 'btn-sm', title: msg },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
  //          {extend: 'text',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ]
    });
  			

		
		 });
</script>    
</body>

</html>