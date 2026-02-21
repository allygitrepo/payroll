<?php
$title = "Dashboard";

	if(isset($access)){
			
			foreach($access as $right)
			{
				$menu = $right->menu;
				if($menu==1){ $menu_1 = 1;	}
			}
		}
				  
	


//echo $header;
//   include('header.php');

   ?>
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
						
						
	   <h4 class="page-header"></h4>
            <!-- START row-->
			
				 <?php		 if(isset($menu_1)) {  ?>	 
			
            <div class="row">
               <div class="col-lg-6">
                  <!-- START panel-->
                  <div id="panelDemo8" class="panel panel-success">
                     <div class="panel-heading"><b>Last Month Data Entered</b></div>
                     <div class="panel-body">
            <div class="table-responsive">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Month</th>
                                    <th></th>
                                    <th id="last_month"></th>
                                    <th></th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Nos.</b></td>
                                    <td><b>Amount</b></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td><b>Office Staff</b></td>
                                    <td></td>
                                    <td id="os_nos" >0</td>
                                    <td id="os_amount" >0.00</td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td><b>Packing Staff</b></td>
                                    <td></td>
                                    <td id="ps_nos" >0</td>
                                    <td id="ps_amount" >0.00</td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td><b>Bidi Roller</b></td>
                                    <td></td>
                                    <td id="br_nos" >0</td>
                                    <td id="br_amount" >0.00</td>
                                    <td></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                                 </div>
              <!--       <div class="panel-footer">Panel Footer</div>   -->
                  </div>
                  <!-- END panel-->
               </div>
		
                 <div class="col-lg-6">
                  <!-- START panel-->
                  <div id="panelDemo9" class="panel panel-warning">
                     <div class="panel-heading"><b>Challan & Return Status</b></div>
                     <div class="panel-body">


     <div class="table-responsive">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Month</th>
                                    <th></th>
                                    <th id="challan_last_month"></th>
                                    <th></th>
                                 </tr>							  
                                 <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><b>PF Challan</b></td>
                                    <td id="challan"></td>
                                    <td id="challan_date"></td>
                                    <th></th>
                                 </tr>
                                 <tr>
                                    <td><b>PF Return</b></td>
                                    <td id="return"></td>
                                    <td id="return_date"></td>
                                    <th></th>
                                 </tr>
                              </tbody>
                           </table>
						   <br>
                        </div>
       



                     </div>
<!--                     <div class="panel-footer">Panel Footer</div>  -->
                  </div>
                  <!-- END panel-->
               </div>
			   
			   </div>
              <div class="row"> 
			
			      <div class="col-lg-6">
                  <!-- START panel-->
                  <div id="panelDemo11" class="panel panel-danger">
                     <div class="panel-heading"><b>3 Month Absent List</b></div>
                     <div class="panel-body">
						<div class="table-responsive"  id="show_absentlist" >
                         </div>
                       </div>
<!--                     <div class="panel-footer">Panel Footer</div>			-->
                  </div>
                  <!-- END panel-->
               </div>

			   
			            <div class="col-lg-6">
                  <!-- START panel-->
                  <div id="panelDemo10" class="panel panel-info">
                     <div class="panel-heading"><b>Employee Complete 58 Year of Age</b></div>
                     <div class="panel-body">

						<div class="table-responsive" id="oldemployeelist" >
                        </div>
  

                     </div>
<!--                     <div class="panel-footer">Panel Footer</div>  -->
                  </div>
                  <!-- END panel-->
               </div>
      
			   
            </div>
            <!-- END row-->
          	       <!-- START row-->
            <div class="row">
            
    <div class="col-lg-6">
                  <!-- START panel-->
                  <div id="panelDemo8" class="panel panel-danger">
                     <div class="panel-heading"><b>Notes</b></div>
                     <div class="panel-body">
					    <div class="table-responsive" id="show_notes">
							
						</div>
                     </div>
 <!--                    <div class="panel-footer">Panel Footer</div> -->
                  </div>
                  <!-- END panel-->
               </div>
						   
			   <!--             <div class="col-lg-6">
                  <div id="panelDemo12" class="panel panel-default">
                     <div class="panel-heading"></div>
                     <div class="panel-body">
					 <br>
					 <br>
					 <br>
<b>Last Login Date :</b><br>	
					 <br>
<b>Last Login User :</b>	
					 <br>
					 <br>
					 <br>
					 <br>
					 <br>
					 <br>
                     </div>
                  </div>
               </div>
			   -->
            </div>
            <!-- END row-->
     				
				 <?php		 }  ?>	 
						
						
          </div>  
          </div>  
          </section>  
          </div>  
            <!-- START row-->
       <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>			
   <?php include('footer.php');?>
<script src="<?php echo base_url().'assets/js/js/dashboard_js.js';?>"></script>
   </div>
</body>

</html>