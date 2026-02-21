   <?php 
   $title = "PF Challan Yearly";
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
										<div class="col-md-4"></div>
										<div class="col-md-3">
										<center>
                                              <div class="form-group">
                                              <label class="control-label">Select Year</label>
                                                                                            <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control years" id="month_year" name="month_year" value='' placeholder="Select Year" oninvalid="this.setCustomValidity('please select Year')" onchange="this.setCustomValidity('')" required>
                                 <label id="d" style="color:red;"></label>
                              </div>  

                                           </div>
                                        </center>
										</div>
										      <div class="col-md-1">
                                    <center> 
                                        <button id="btn_insert" class="btn btn-primary button_change">Search</button>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
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
						  
<!--	<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
		    <tr>
	<th>From</th>	
<th>To</th>  			
<th >Month</th>  			
<th>Tax Rate</th>  			
<th>No of employee</th>  			
<th>Tax Amount</th>   			
<th>Total</th>  			
            </tr>
        </thead>
       <tbody>
	<tr>
	  	  	  		  

				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>April</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td></td>
				</tr>
<tr>			
				
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>April</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td>25,000</td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>May</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td></td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>May</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td>25,000</td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>June</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td></td>
		</tr>

<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>June</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td>25,000</td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>July</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td></td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>July</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td></td>
		</tr>
<tr>			
			
				<td>10,001.00</td>
				<td>15,000.00</td>
				<td>July</td>
				<td>110.00</td>
				<td>3</td>
				<td>330.00</td>
				<td>25,000</td>
		</tr>


</tbody>
			</table>
	-->														
                           </div>
                <div class="col-md-12">
                                          </div>
					
                           
                        </div>
 </section>                          
       
	
<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <?php include('footer.php');?>
   <script src="<?php echo base_url().'assets/js/js/pf_challan_yearly_js.js';?>"></script>    
   </div>

<script>
         $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
   $(document).ready(function() {
		$('.years').datetimepicker({format:"YYYY",});
		 });
</script> 

   <script>
   /*
$(document).ready(function() {
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="6"  class="danger">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );
	*/
</script>
 
   
</body>

</html>