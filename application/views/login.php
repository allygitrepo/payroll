
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Login Page</title>
   
   
   
   <link rel='icon' type='image/x-icon' href='favicon.ico' />
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/fontawesome/css/font-awesome.min.css'; ?>">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/simple-line-icons/css/simple-line-icons.css';?>">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/app/css/bootstrap.css';?>" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/app/css/app.css';?>" id="maincss">
</head>

<body>
   <div class="wrapper" style="margin-top:100px;">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img src="<?php echo base_url().'assets/app/img/logo.jpeg';?>" alt="Image" class="block-center img-rounded">
               </a>
            </div>
            <div class="panel-body">
               <p class="text-center pv" style="color:#4c8e41">SIGN IN TO CONTINUE.</p>
		<form action="<?php echo base_url('payroll/login');?>" method="post" >
                  <div class="form-group has-feedback">
                     <input id="user_id" name="user_id" type="text" placeholder="Enter User Id" autocomplete="off" required class="form-control" oninvalid="this.setCustomValidity('please enter User Id')" onchange="this.setCustomValidity('')">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <input id="password" name="password" type="password" placeholder="Password" required class="form-control" oninvalid="this.setCustomValidity('please enter password')" onchange="this.setCustomValidity('')">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <select id="company_name" name="company_name"  placeholder="Select Company Name" required class="form-control" oninvalid="this.setCustomValidity('please enter Company')" onchange="this.setCustomValidity('')">
    				 </select>
                     <span class="fa fa-building form-control-feedback text-muted"></span>
                  </div>
	              </div>
				  <center>
				  <label style="color:red;">
				  <?php
				  if(isset($data)){
					  if($data==0){
						  echo "Invalide Login Details";
					  }
				  }
				  ?>
				  </label>
				  </center>
                  <button type="submit" class="btn btn-block btn-primary mt-lg" style="background-color:#90b63d">Login</button>
									 <label id='l' style="color:red;"></label>
               </form>
			   <br/>
			   
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span>&copy;</span>
            <span>2018</span>
            <span>-</span>
            <span>@dineshbidi</span>
            <br>
            <span></span>
         </div>
      </div>
   </div>
   <!-- Modal for terms and condition-->
   <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
      <div class="modal-dialog" style="height:800px !important;">
         <div class="modal-content">
            <div class="modal-header" style="background-color:#90b63d;color:#fff;">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 id="myModalLabel" class="modal-title">Terms and Conditions</h4>
            </div>
            <div class="modal-body" style="height: 500px !important;overflow-Y:auto;">
				<?php echo $terms;?> 
			</div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
         </div>
      </div>
   </div> 
   
   <!-- Modal for privacy policy-->
   <div id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
      <div class="modal-dialog" style="height:700px !important;">
         <div class="modal-content">
            <div class="modal-header" style="background-color:#90b63d;color:#fff;">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 id="myModalLabel" class="modal-title">Privacy Policy</h4>
            </div>
            <div class="modal-body" style="height: 500px !important;overflow-Y:auto;">
			</div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
         </div>
      </div>
   </div>
   
   <script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

   <!-- =============== VENDOR SCRIPTS ===============-->
   <?php include('footer.php');?>
   <!-- =============== APP SCRIPTS ===============-->
      <script src="<?php echo base_url().'assets/js/js/login_js.js';?>"></script>   
</body>

</html>