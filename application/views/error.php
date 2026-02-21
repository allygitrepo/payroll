<?php
$title = "";

				  
	


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
			
			
            <div class="row">
               <div class="col-lg-12">
                  <!-- START panel-->
                  <div id="panelDemo8" class="panel panel-danger">
                     <div class="panel-heading"><h4>Error</h4></div>
                     <div class="panel-body">
                                 <img src="<?php echo base_url('assets/images/icon/error.png'); ?>" alt="Avatar" width="100%" height="100%" >
                                 </div>
<div class="panel-footer"></div>
                  </div>
                  <!-- END panel-->
               </div>
		
			   </div>
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