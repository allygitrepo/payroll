<?php
$title = "Bidi Roller Entry";
  include('label.php'); ?>
   <!-- Main section-->
   <section>
    <div class="content-wrapper">
					<div class="clearfix">
						<div class="pull-left">
							<h3><?php if(isset($title)){ echo $title; } ?></h3>
						</div>
						<div class="pull-right">
<!--						<button type="button" class="btn btn-primary" id="new"><em class="fa fa-plus"></em> Bidi Roller</button>		
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
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Month and Year</label>
                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control month_year" id="month_year" name="planstartdate" value="" >
                                 <label id="d" style="color:red;"></label>
                              </div>
                                           </div>
                                        </div>
										
<!--										<div class="col-md-3">
										
										<div class="form-group">
						<label class="control-label">Contractor Code.</label>
    <select type="text" name="contractor_code1" id="contractor_code1" class="form-control" placeholder="Select Contractor Code" >
											  </select>
														</div>
														</div>
-->										<div class="col-md-4">
										
										<div class="form-group">
						<label class="control-label">Contractor Name - Pf Code</label>
    <select type="text" name="contractor1" id="contractor1" class="form-control" placeholder="Select Contractor" >
											  </select>
														</div>
														
														</div>
										<div class="col-md-1">
                                        </div>
										
										
										      <div class="col-md-2">
                                    <center> 
                                        <button id="btn_insert" class="btn btn-primary button_change">Search</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
										<input type="hidden" id="save_update" value="save"/>
                                    </center>
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	
							</div>
                        </div>    
                     </div>                  
 				
 			</div>	
<div class="panel-footer">
         <div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
                 
										                     
          <div class="table-responsive" id="table_data1">
						  
<!--	<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>Emp No.</th>  			
				<th>Name</th>  			
				<th>UAN	</th>  		
 				<th style="width:10%;">No. of unit worked</th>  			
 				<th style="width:10%;">No. of unit worked</th>  			
 				<th style="width:10%;">No. of days worked</th>  			
				<th style="width:10%;">Leave with Pay</th>  			
				<th >Wages</th>  			
				<th>Bonus</th>  			
				<th>Total</th>  			
				<th>PF</th>  			
				<th>Net Wages</th>  					
            </tr>
        </thead>	
       <tbody>


				
</tbody>
			</table>
	-->														
                           </div>
                <div class="col-md-12">
                                    <center> 
                                        <button  id="table_insert" class="btn btn-primary button_change">Save</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
										<input type="hidden" id="save_update" value="save"/>
                                    </center>
                                </div>
					
					
                          
                        </div>
 </section>                          
       
	

	 <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
	 
   <?php include('footer.php');?>
    <script src="<?php echo base_url().'assets/js/js/bidiroller_entry_js.js';?>"></script>   
 
   </div>
     <script>
 $(document).ready(function() {
		$('.month_year').datetimepicker({format:"MM/YYYY",});	
	});
</script>
  <script>
 $(document).ready(function() {

 	   var msg = "Bidi Roller Entry List";
    $('#example1').dataTable({
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
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'excel', className: 'btn-sm', title: msg },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ]
    });
} );
</script>
 
 
</body>

</html>