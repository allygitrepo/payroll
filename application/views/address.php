<?php
$title = "Address";
   include('label.php');
 
 ?>
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
<!--								<iframe name="votar" style="display:none;"></iframe>
                      -->             <form class="form" action=""  >
										<div class="col-md-12">
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label">Address</label>
                                              <textarea type="text" row="3" name="address" id="address" class="form-control" placeholder="Address" oninvalid="this.setCustomValidity('please Enter  Address')" onchange="this.setCustomValidity('')" required></textarea>
                                           </div>
                                        </div>
										
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">Post Office</label>
			<input type="text"  name="postoffice" id="postoffice" class="form-control" placeholder="Post Office" oninvalid="this.setCustomValidity('please Enter  Post Office')" onchange="this.setCustomValidity('')" required  />
                             
  													</div>
														</div>
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">District</label>
			<input type="text"  name="district" id="district" class="form-control" placeholder="District" oninvalid="this.setCustomValidity('please Enter  District')" onchange="this.setCustomValidity('')" required  />
                             
  													</div>
														</div>
										<div class="col-md-3">
										
										<div class="form-group">
							<label class="control-label">Pincode</label>
			<input type="number"  name="pincode" id="pincode" class="form-control" placeholder="Pincode" oninvalid="this.setCustomValidity('Pincode Must be 6 Digit')" onchange="this.setCustomValidity('')" required />
                             
  													</div>
														</div>
										
								</form>
										
										      <div class="col-md-12">
                                    <center> 
                                        <button  id="btn_save" class="btn_save btn btn-primary button_change" >Save</button>															
                                    </center>
									<input type="hidden" id="save_update" value="add" />
                                </div>
						
										<div class="col-md-4"></div>
										
                     	 		</div>	
							
							</div>
                        </div>    
                     </div>                  
 				
				
				</div>	
			<div class="panel-footer">
                        
          <div class="table-responsive" id="show_address">
						  
	

	   <!--<td><center><button class="btn_up btn btn-xs btn-danger user_edit" value="" >
			<i class="fa fa-edit"></i></button>
		<button  class=" btn btn-xs btn-danger user_delete"   value="" >
			<i class="fa fa-trash"></i></button>
		</center></td>
		-->

															
                           </div>
                
					
                           
                        </div>


 </section>                          
   <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>    
	

   <?php include('footer.php');?>
   </div>
   
      <script src="<?php echo base_url().'assets/js/js/address_js.js';?>"></script>   

   <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <script>
   $(document).ready(function() {
	 
  
	   var msg = "Address List";
    $('#example1').dataTable({
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
        'responsive': true, // https://datatables.net/extensions/responsive/examples/
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