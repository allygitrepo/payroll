   <?php 
   $title = "Bidi Rolle Wages";
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
                  <form  id="bidirollewages_form">
                                        <div class="col-md-12">
										<div class="col-md-3"></div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $sdate; ?>  *</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="startdate" name="planstartdate" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" onchange="this.setCustomValidity('')" required>
                                 <label id="d" style="color:red;"></label>
                              </div>

                                           </div>
                                        </div>
										<div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $edate; ?>  *</label>
                             <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control starttoenddate" id="enddate" name="planstartdate" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" onchange="this.setCustomValidity('')" required>
                                 <label id="d" style="color:red;"></label>
                              </div>
                                          </div>
                                        </div>
										<div class="col-md-3"></div>
                                        </div>										
                                        <div class="col-md-12">
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $rate; ?> 1 </label>
                                              <input type="text" name="rate1" id="rate1" class="form-control" placeholder="Enter <?= $rate; ?>1" required>
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $bonus; ?> 1</label>
                                              <input type="text" name="bonus1" id="bonus1" class="form-control" placeholder="Enter <?= $bonus; ?>" required>	
											  </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $rate; ?> 2 </label>
                                              <input type="text" name="rate2" id="rate2" class="form-control" placeholder="Enter <?= $rate; ?>2" required>
                                           </div>
                                        </div>
										                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <label class="control-label"><?= $bonus; ?> 2</label>
                                              <input type="text" name="bonus2" id="bonus2" class="form-control" placeholder="Enter <?= $bonus; ?>" required>	
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
                           <div class="table-responsive" id="show_bidirollewages">
										    
                
					
                           </div>
                        </div>
 </section>                          
       
	

<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
   <?php include('footer.php');?>
   
   
   </div>
<script src="<?php echo base_url().'assets/js/js/bidirollerwages_js.js';?>"></script>   
<script>
   $(document).ready(function() {
		
		$('.starttoenddate').datetimepicker({format:"DD/MM/YYYY",});
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