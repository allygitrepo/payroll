   <?php
   $title = "EPF Challan";
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
										<div class="col-md-4"></div>
										<div class="col-md-3">
										<center>
                                           <div class="form-group">
                                              <label class="control-label">Month and Year</label>
                                              <div id="datetimepicker1" class="date">
                                 <input type="text" class="form-control year" id="month_year" name="month_year" value='' placeholder="Select Date*" oninvalid="this.setCustomValidity('please select date')" onchange="this.setCustomValidity('')" required>
                                 <label id="d" style="color:red;"></label>
                              </div>  
                                           </div>
                                        </center>
										</div>
										      <div class="col-md-1">
                                    <center> 
                                        <a id="btn_insert" class="btn btn-primary button_change">Search</a>													
                                       <!-- <button type="button" id="btn_update" class="btn btn-primary btn_update button_change" disabled>Update</button>	-->
                                        <input type="hidden" id="hid_id" value=""/>
										<input type="hidden" id="hid_up" value="Add"/>
                                    </center>
                                </div>
						
										<div class="col-md-4"></div>
                     	 		</div>	
				
                                	<div class="col-md-12">
		
									
									        <div class="table-responsive" id="table_data1">
						  <a class="download btn btn-primary"  >Export Excel</a>
        		  <div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>

	<table table  class="tb2excel  table table-striped table-bordered table-hover" >

       <tbody>
	<tr>
		<td style="color:blue;width:100%;white-space:none;" colspan="3">Summary of uploaded Electronic Challan cum Return (ECR):</td>
		  			
				<td></td>
				<td></td>
				<td></td>
	</tr>
<tr>			
		<td style="width:100%;background-color:#D9EDF7;" colspan="6" ><b>ECR Details:- <b></td>
</tr>
		<tr>			
			
				<td><b>Establishment Name</b></td>
				<td id="company_name" ></td>
				<td><b>Establishment Id</b></td>
				<td id="estb_id" ></td>
				<td></td>
				<td></td>
		</tr>

		<tr>						

				<td><b >Wage Month</b></td>
				<td id="wages_month">May-18</td>
				<td><b>Return Month</b></td>
				<td id="return_month" >Jun-18</td>
				<td></td>
				<td></td>
		</tr>
			

		<tr>						

				<td><b>CRN</b></td>
				<td id="crn" ></td>
				<td><b>Challan Date</b></td>
				<td id="challan_date" >15-06-18</td>
				<td></td>
				<td></td>
		</tr>
		<tr>						

				<td  ><b>TRRN:</b></td>
				<td id="trrn" > 4741806005355</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>CONTRIBUTION RATE (%)</b></td>
				<td id="contrib" ></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>

		<tr>						
				<td><b>Return Date</b></td>
				<td id="return_date"></td>
				<td><b>Total Number of UAN's</b></td>
				<td id="total_uan_count"  >676</td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td colspan="6"></td>
		</tr>
		<tr>						
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td style="font-size:18px;" >ECR Summary</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>

		<tr>						
				<td style="background-color:#D9EDF7;" ></td>
				<td style="background-color:#D9EDF7;" ><b>	Total<b></td>
				<td style="background-color:#D9EDF7;" ></td>
				<td style="background-color:#D9EDF7;" ><b>UAN Count</b></td>
				<td style="background-color:#D9EDF7;" ><b>Contribution Remitted ()<b/></td>
				<td style="background-color:#D9EDF7;" ></td>
		</tr>
		
		<tr>						
				<td><b>Gross Wages ()<b/></td>
				<td id="gross_wages" ></td>
				<td><b>EPF EE Share<b/></td>
				<td id="uan_count1" ></td>
				<td id="epf_ee_share" ></td>
				<td></td>
		</tr>
		<tr>						
				<td ><b>EPF Wages ()<b/></td>
				<td id="epf_wages"  ></td>
				<td><b>EPF ER Share<b/></td>
				<td id="uan_count2" ></td>
				<td id="epf_er_share" ></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>EPS Wages ()<b/></td>
				<td id="eps_wages"  ></td>
				<td><b>EPS Contribution<b/></td>
				<td id="uan_count3" ></td>
				<td  id="eps_contri" >117,857</td>
				<td></td>
		</tr>
		<tr>						
				<td><b>EDLI Wages ()<b/></td>
				<td id="edli_wages" ></td>
				<td><b>EDLI Contribution<b/></td>
				<td id="uan_count4" ></td>
				<td id="edli_contri" ></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>NCP Days<b/></td>
				<td id="ncp_days"  ></td>
				<td><b>Total Refund of Advance<b/></td>
				<td  ></td>
				<td id="total_refund" ></td>
				<td></td>
		</tr>
		<tr>						
				<td colspan="2"></td>
				<td><b>Total Contribution Remitted</b></td>
				<td></td>
				<td id="total_contri" ></td>
				<td></td>
		</tr>
		<tr  >						
				<td style="background-color:#D9EDF7;" colspan="2" rowspan="2"><b>Details:-</b></td>
				<td style="background-color:#D9EDF7;"><b>Remitted as per ECR<b></td>
				<td style="background-color:#D9EDF7;"><b>PMRPY/PMPRPY Upfront Benefit<b></td>
				<td style="background-color:#D9EDF7;"><b>Net Payable<b></td>
				<td style="background-color:#D9EDF7;white-space:nowrap;"><b>Net Paid<b></td>
		</tr>
		<tr>						
				<td style="background-color:#D9EDF7;" ><b>()</b></td>
				<td style="background-color:#D9EDF7;" ><b>()</b></td>
				<td style="background-color:#D9EDF7;" ><b>()</b></td>
				<td style="background-color:#D9EDF7;" ><b>()</b></td>
		</tr>
		<tr>						
				<td colspan="2"><b>Total EPF Contribution EE Share (A/C 1)	</b></td>
				<td id="total_epf_ecr" ></td>
				<td id="pmrpy1">0</td>
				<td id="net_pay1" ></td>
				<td id="net_paid_ac1ee" ></td>
		</tr>
		<tr>						
				<td colspan="2"><b>Total EPS Contribution (A/C 10)</b></td>
				<td  id="total_eps_ecr"  ></td>
				<td id="pmrpy2"></td>
				<td id="net_pay2" ></td>
				<td id="net_paid_ac10" ></td>
		</tr>
		<tr>						
				<td colspan="2"><b>Total Difference Between EPF & EPS (ER Share A/C 1)</b></td>
				<td  id="total_diff_ecr"  ></td>
				<td id="pmrpy3"></td>
				<td id="net_pay3" ></td>
				<td id="net_paid_ac1er" ></td>
		</tr>
		<tr>						
				<td colspan="2"><b>Total EDLI Contribution (ER Share A/C 21) *	</b></td>
				<td  id="total_edli_ecr"  ></td>
				<td>0</td>
				<td id="net_pay4" ></td>
				<td id="net_paid_ac21er" ></td>
		</tr>
		<tr>						
				<td rowspan="2">Total EPF Charges (A/C 2)</td>
				<td>Administration *</td>
				<td id="total_epf_charges" ></td>
				<td>0</td>
				<td id="net_pay5" ></td>
				<td id="net_paid_ac2" ></td>
		</tr>
		<tr>						
				<td>Inspection *</td>
				<td></td>
				<td>-</td>
				<td id="net_pay6" ></td>
				<td></td>
		</tr>
		<tr>						
				<td rowspan="2">Total EDLI Charges (A/C 22)</td>
				<td>Administration *</td>
				<td id="total_edli_charges" ></td>
				<td>-</td>
				<td id="net_pay7" ></td>
				<td id="net_paid_ac22" ></td>
		</tr>
		<tr>						
				<td>Inspection *</td>
				<td></td>
 				<td>-</td>
				<td id="net_pay8" ></td>
				<td></td>
		</tr>
		<tr>						
				<td colspan="2" >Total Refund of Advance (A/C 1)	</td>
				<td id="total_refund_ac1" ></td>
 				<td>-</td>
				<td id="net_pay9" ></td>
				<td  >0</td>
		</tr>
		<tr  >						
				<td colspan="2"><b>Total	</b></td>
				<td><b id="total_col" ></b></td>
				<td><b id="total_pmrpy" ></b></td>
				<td><b id="net_total" ></b></td>
				<td><b id="net_paid_total"></b></td>
		</tr>
		<tr>						
				<td colspan="2" style="background-color:#D9EDF7;" ><b>Employer Details :-	</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>Total number of Employees in the month *</b></td>
				<td id="total_emp" ></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>Number of excluded employees *</b></td>
				<td>0</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>
		<tr>						
				<td><b>Gross wages of the Excluded Employees () *</b></td>
				<td>0</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
		</tr>

</tbody>
			</table>
															
                           </div>
  
                   		</div>
                        </div>    
                     </div>                  
 			
				
 			</div>	
<div class="panel-footer">
                  			                     
                <div class="col-md-12">
             					   
                                </div>
					
                          
                        </div>
 </section>                          
       
	
 <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <?php include('footer.php');?>
   </div>
	<script src="<?php echo base_url().'assets/js/jquery.table2excel.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/js/challan_format_js.js'; ?>"></script>
<script>
         $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
   $(document).ready(function() {		
		$('.year').datetimepicker({format:"MM/YYYY",});
		 });
</script> 
<script>
$(function() {  

   $(".download").click(function() {  

   var d = new Date();
		var month =  (d.getMonth()+1) + "/" +d.getFullYear();
   
	$(".tb2excel").table2excel({
				        exclude: ".noExl",
				        name: "Excel Document Name",
					filename: "Challan Format_"+month,
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
   });

});
</script>


   <script>
</script>
   
</body>

</html>