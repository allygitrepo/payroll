<?php
   	if(!isset($_SESSION['userid'])){
			redirect(base_url('payroll/index'));
	}

?><!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title><?php if(isset($title)){ echo $title; } ?></title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/fontawesome/css/font-awesome.min.css'; ?>">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/simple-line-icons/css/simple-line-icons.css';?>">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/animate.css/animate.min.css';?>">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/whirl/dist/whirl.css';?>">
   <!-- DATATABLES-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/datatables-colvis/css/dataTables.colVis.css';?>">
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/datatables/media/css/dataTables.bootstrap.css';?>">
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/dataTables.fontAwesome/index.css';?>">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- WEATHER ICONS-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/weather-icons/css/weather-icons.min.css';?>">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/app/css/bootstrap.css';?>" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/app/css/app.css';?>" id="maincss">
   <!-- =============== Toast Message ===============-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/toastmessage/css/jquery.toastmessage.css';?>" id="maincss">
   <!-- =============== sweet alert ===============-->
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/sweetalert/dist/sweetalert.css'?>" id="maincss">
      <!-- DATATABLES-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/datatables-colvis/css/dataTables.colVis.css';?>">
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/datatables/media/css/dataTables.bootstrap.css';?>">
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/dataTables.fontAwesome/index.css';?>">
      <!-- DATETIMEPICKER-->
   <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css';?>">
   
   <style>
   .sub_panel_heading {width:100%; height:auto; float:left; border:1px solid #cfdbe2; border-top-width:3px; padding:25px 25px 10px 25px; margin-top:15px; border-radius:4px;}
   .button_change {margin-top:26px;}
   .add_btn {float:right;}
   
   .input-sm{
	   resize:none;
   }
   </style>
   
</head>
<script>
</script>
<body>
        

   <div class="wrapper">

<!-- JQUERY-->

  
<?php
//include('label.php');


?>
<style>
	.form-control{
	text-transform:uppercase;	   
   }
</style>
  <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="index.php" class="navbar-brand">
                  <div class="brand-logo">
                     <img src="<?php echo base_url().'assets/app/img/logo.jpeg" alt="App Logo" class="img-responsive';?>">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img src="<?php echo base_url().'assets/app/img/logo-single.png" alt="App Logo" class="img-responsive';?>">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
               <!-- START Left navbar-->
               <ul class="nav navbar-nav">
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#" data-trigger-resize="" id="click" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
                  <!-- START User avatar toggle-->
                 <!--  <li> -->
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <!--   <a id="user-block-toggle" href="#user-block" data-toggle="collapse">
                        <em class="icon-user"></em>
                     </a>
                  </li> -->
                  <!-- END User avatar toggle-->
                  <!-- START lock screen-->
               <!--   <li>
                     <a href="#" title="Lock screen">
                        <em class="icon-lock"></em>
                     </a>
                  </li> -->
                  <!-- END lock screen-->
               </ul>
               <!-- END Left navbar-->
               <!-- START Right Navbar-->
               <ul class="nav navbar-nav navbar-right">
                  <!-- Search icon-->
                  <li>
                     <a href="#" data-search-open="">
                        <em class="icon-magnifier"></em>
                     </a>
                  </li>
                  <!-- Fullscreen (only desktops)-->
                  <li class="visible-lg">
                     <a href="#" data-toggle-fullscreen="">
                        <em class="fa fa-expand"></em>
                     </a>
                  </li>
                  <!-- START Alert menu-->
                  <li class="dropdown dropdown-list">
                     <a href="#" data-toggle="dropdown">
                        <em class="icon-bell"></em>
                        <div class="label label-danger">11</div>
                     </a>
                     <!-- START Dropdown menu-->
                     <ul class="dropdown-menu animated flipInX">
                        <li>
                           <!-- START list group-->
                           <div class="list-group">
                              <!-- list item-->
                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-twitter fa-2x text-info"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">New followers</p>
                                       <p class="m0 text-muted">
                                          <small>1 new follower</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                              <!-- list item-->
                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-envelope fa-2x text-warning"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">New e-mails</p>
                                       <p class="m0 text-muted">
                                          <small>You have 10 new emails</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                              <!-- list item-->
                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-tasks fa-2x text-success"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">Pending Tasks</p>
                                       <p class="m0 text-muted">
                                          <small>11 pending task</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                              <!-- last list item-->
                              <a href="#" class="list-group-item">
                                 <small>More notifications</small>
                                 <span class="label label-danger pull-right">14</span>
                              </a>
                           </div>
                           <!-- END list group-->
                        </li>
                     </ul>
                     <!-- END Dropdown menu-->
                  </li>
                  <!-- END Alert menu-->
                  <!-- START Offsidebar button-->
                  <li>
					 <?php echo anchor(base_url('payroll/logout'),'<em class="fa fa-sign-out"></em>'); ?>
                  </li>
				        <!--  <li>
                     <a href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
                        <em class="icon-notebook"></em>
                     </a>
                  </li> -->
                  <!-- END Offsidebar menu-->
               </ul>
               <!-- END Right Navbar-->
            </div>
            <!-- END Nav wrapper-->
            <!-- START Search form-->
            <form role="search" action="search.html" class="navbar-form">
               <div class="form-group has-feedback">
                  <input type="text" placeholder="Type and hit enter ..." class="form-control">
                  <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
               </div>
               <button type="submit" class="hidden btn btn-default">Submit</button>
            </form> 
            <!-- END Search form-->
         </nav>
         <!-- END Top Navbar-->
      </header>
      <!-- sidebar-->
      <aside class="aside">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
               <!-- START sidebar nav-->
               <ul class="nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div id="user-block" class="collapse">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status">
                                 <img src="app/img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                 <div class="circle circle-success circle-lg"></div>
                              </div>
                           </div>
                           <!-- Name and Job-->
                           <div class="user-block-info">
                              <span class="user-block-name">Hello, Mike</span>
                              <span class="user-block-role">Designer</span>
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- END user info-->
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">Main Navigation</span>
                  </li>
				  <li class="">
					<a href="<?php echo base_url('payroll/dashboard'); ?>" title="Dashboard" >
                        <em class="fa fa-dashboard"></em>
                        <span >Dashboard</span>
                     </a>  
				  </li>	
                  
				
				 
				  <li class=" ">
                    <a href="#company" title="Dashboard" data-toggle="collapse">
                        <em class="icon-user"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Master</span>
                     </a>  
                     <ul id="company" class="nav sidebar-subnav collapse">
                       
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/company'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Comapany</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/employee'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> employee</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/kyc_update'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> KYC Update</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/contractor'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Contractor</span>
                           </a>
                        </li>
						
                        
                     </ul>
                  </li>
				    <li class=" ">
                    <a href="#contractor" title="Dashboard" data-toggle="collapse">
                        <em class="icon-list"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Setup</span>
                     </a>  
                     <ul id="contractor" class="nav sidebar-subnav collapse">
                       
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/packing_wages'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Packing Wages</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/bidi_rolle_wages'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Bidi Roller Wages</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/professional_tax'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Professional Tax</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/officestaffsalary'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Office Staff Salary</span>
                           </a>
                        </li>
						
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/challanSetup'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em>  Challan Setup</span>
                           </a>
                        </li>
						
                        
                     </ul>
                  </li>
      			  			  <li class=" ">
                    <a href="#entry" title="Dashboard" data-toggle="collapse">
                        <em class="icon-pencil"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Entry</span>
                     </a>  
                     <ul id="entry" class="nav sidebar-subnav collapse">
                       
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/officestaff'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Office Staff</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/packers'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Packers</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/bidiroller'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Bidi Roller </span>
                           </a>
                        </li>

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/challandate'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> EPF Challan Date</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/resignation'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Resignation</span>
                           </a>
                        </li>
<!--                        <li class=" ">
                           <a href="returnDate.php" title="Projects Basic">
								<span><em class="icon-plus"></em> Return Date</span>
                           </a>
                        </li>
						
                        <li class=" ">
                           <a href="resignation.php" title="Projects Basic">
								<span><em class="icon-plus"></em> Resignation</span>
                           </a>
                        </li>
-->						
                        
                     </ul>
                  </li>
	
				  
				
			
		   
      			  			  <li class=" ">
                    <a href="#utility" title="Dashboard" data-toggle="collapse">
                        <em class="icon-equalizer"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Utility</span>
                     </a>  
                     <ul id="utility" class="nav sidebar-subnav collapse">
                       
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/address'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Address</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/calender'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Calender</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/user_management'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> User Management</span>
                           </a>
                        </li>
						<!--
                        <li class=" ">
                           <a href="attendance_import.php" title="Projects Basic">
								<span><em class="icon-plus"></em> Attendance Import</span>
                           </a>
                        </li>
						-->
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/employee_data_import'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Employee Data Import</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/employee_data_export'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Employee Data Export</span>
                           </a>
                        </li>
<!--                        <li class=" ">
                           <a href="ecr_export.php" title="Projects Basic">
								<span><em class="icon-plus"></em> ECR Export</span>
                           </a>
                        </li>
-->                        <li class=" ">
                           <a href="<?php echo base_url('payroll/kyc_export'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> KYC Export</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/attendance_printing'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Attandance Printing</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/pfclaimform'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> PF Claim Form</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/delete_month_entry'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Delete Month Entry</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/db_backup'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Backup</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/db_restore'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Restore</span>
                           </a>
                        </li>
<!--                        <li class=" ">
                           <a href="<?php echo base_url('payroll/excelformat'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Excel Format</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/gratuity_data_import'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Gratuity Data Import</span>
                           </a>
                        </li>
-->                    </ul>
                  </li>
		   
      			  			  <li class=" ">
                    <a href="#report" title="Dashboard" data-toggle="collapse">
                        <em class="icon-equalizer"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Report</span>
                     </a>  
                     <ul id="report" class="nav sidebar-subnav collapse">
                       
					   
					 
				    			  <li class=" ">
                    			  
                    <a href="#salaryreport" title="Dashboard" data-toggle="collapse">
                        <em class="fa fa-angle-right"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Salary Sheet</span>
                     </a>  
                     <ul id="salaryreport" class="nav sidebar-subnav collapse">

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/office_salary_sheet'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Office Salary </span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/packing_salary'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Packing Salary </span>
                           </a>
                        </li>
                    <li class=" ">
                           <a href="<?php echo base_url('payroll/contractor_salary'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Contractor Salary </span>
                           </a>
                        </li>
                        
                     </ul>
					 
                  </li>  
					   
					   	    			  <li class=" ">
                    <a href="#forms" title="Dashboard" data-toggle="collapse">
                        <em class="fa fa-angle-right"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Forms</span>
                     </a>  
                     <ul id="forms" class="nav sidebar-subnav collapse">

						<li class=" ">
                           <a href="<?php echo base_url('payroll/form2'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Form 2</span>
                           </a>
                        </li>
	                        <li class=" ">
                           <a href="<?php echo base_url('payroll/form3a'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Form 3A</span>
                           </a>
                        </li>
	                        <li class=" ">
                           <a href="<?php echo base_url('payroll/form5'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Form 5</span>
                           </a>
                        </li>
	                        <li class=" ">
                           <a href="<?php echo base_url('payroll/form10'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Form 10</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/form_eleven'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Form 11</span>
                           </a>
                        </li>
                        
                     </ul>
                  </li>

			
						      


                        <li class=" ">
                           <a href="<?php echo base_url('payroll/ecr_report'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> ECR Report </span>
                           </a>
                        </li>

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/esic_report'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> ESIC Report </span>
                           </a>
                        </li>


                        <li class=" ">
                           <a href="<?php echo base_url('payroll/pmrpy_report'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> PMRPY Report </span>
                           </a>
                        </li>

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/pf_challan_yearly'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> PF Challan Yearly</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/pf_challan'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> EPF Challan</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/pf_summary'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> PF Summary</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/employeemissingdata'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Missing Information</span>
                           </a>
                        </li>
						
						
						
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/payment_advice'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Payment Advice</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/bonus_sheet'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Bonus Sheet</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/gratuity_calculation'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Gratuity Calculation</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/professionalTax'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Professional Tax</span>
                           </a>
                        </li>
						 
						 
						
                     </ul>
                  </li>
	
				    			  <li class=" ">
                    <a href="#todolist" title="Dashboard" data-toggle="collapse">
                        <em class="icon-pencil"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Todo List</span>
                     </a>  
                     <ul id="todolist" class="nav sidebar-subnav collapse">

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/tmonth_absent_list'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> 3 Month Absent List</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="<?php echo base_url('payroll/yearsofage'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> 58 Years of age</span>
                           </a>
                        </li>
                    <li class=" ">
                           <a href="<?php echo base_url('payroll/notes'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Notes</span>
                           </a>
                        </li>
                        
                     </ul>
                  </li>
	
			
				    			  <li class=" ">
                    <a href="#convert" title="Dashboard" data-toggle="collapse">
                        <em class="icon-pencil"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Convert Excel To Text</span>
                     </a>  
                     <ul id="convert" class="nav sidebar-subnav collapse">

                        <li class=" ">
                           <a href="<?php echo base_url('payroll/excel_to_text'); ?>" title="Projects Basic">
								<span><em class="icon-plus"></em> Excel To Text</span>
                           </a>
                        </li>
                     </ul>
                  </li>
	
			
		   
                     </ul>
               
               <!-- END sidebar nav-->
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>
      <!-- offsidebar-->
      <aside class="offsidebar hide">
         <!-- START Off Sidebar (right)-->
         <nav>
            <div role="tabpanel">
               <!-- Nav tabs-->
               <ul role="tablist" class="nav nav-tabs nav-justified">
                  <li role="presentation" class="active">
                     <a href="#app-settings" aria-controls="app-settings" role="tab" data-toggle="tab">
                        <em class="icon-equalizer fa-lg"></em>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#app-chat" aria-controls="app-chat" role="tab" data-toggle="tab">
                        <em class="icon-user fa-lg"></em>
                     </a>
                  </li>
               </ul>
               <!-- Tab panes-->
               <div class="tab-content">
                  <div id="app-settings" role="tabpanel" class="tab-pane fade in active">
                     <h3 class="text-center text-thin">Settings</h3>
                     <div class="p">
                        <h4 class="text-muted text-thin">Themes</h4>
                        <div class="table-grid mb">
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-a.css">
                                    <input type="radio" name="setting-theme" checked="checked">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info"></span>
                                       <span class="color bg-info-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-b.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green"></span>
                                       <span class="color bg-green-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-c.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple"></span>
                                       <span class="color bg-purple-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-d.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger"></span>
                                       <span class="color bg-danger-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="table-grid mb">
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-e.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info-dark"></span>
                                       <span class="color bg-info"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-f.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green-dark"></span>
                                       <span class="color bg-green"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-g.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple-dark"></span>
                                       <span class="color bg-purple"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-h.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger-dark"></span>
                                       <span class="color bg-danger"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="p">
                        <h4 class="text-muted text-thin">Layout</h4>
                        <div class="clearfix">
                           <p class="pull-left">Fixed</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-fixed" type="checkbox" data-toggle-state="layout-fixed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">Boxed</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-boxed" type="checkbox" data-toggle-state="layout-boxed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">RTL</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-rtl" type="checkbox">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="p">
                        <h4 class="text-muted text-thin">Aside</h4>
                        <div class="clearfix">
                           <p class="pull-left">Collapsed</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-collapsed" type="checkbox" data-toggle-state="aside-collapsed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">Collapsed Text</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-collapsed-text" type="checkbox" data-toggle-state="aside-collapsed-text">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">Float</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-float" type="checkbox" data-toggle-state="aside-float">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">Hover</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-hover" type="checkbox" data-toggle-state="aside-hover">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="pull-left">Show Scrollbar</p>
                           <div class="pull-right">
                              <label class="switch">
                                 <input id="chk-hover" type="checkbox" data-toggle-state="show-scrollbar" data-target=".sidebar">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="app-chat" role="tabpanel" class="tab-pane fade">
                     <h3 class="text-center text-thin">Connections</h3>
                     <ul class="nav">
                        <!-- START list title-->
                        <li class="p">
                           <small class="text-muted">ONLINE</small>
                        </li>
                        <!-- END list title-->
                        <li>
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-success circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/05.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Juan Sims</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-success circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/06.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Maureen Jenkins</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-danger circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/07.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Billie Dunn</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-warning circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/08.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Tomothy Roberts</strong>
                                    <br>
                                    <small class="text-muted">Designer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                        </li>
                        <!-- START list title-->
                        <li class="p">
                           <small class="text-muted">OFFLINE</small>
                        </li>
                        <!-- END list title-->
                        <li>
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/09.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Lawrence Robinson</strong>
                                    <br>
                                    <small class="text-muted">Developer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                           <!-- START User status-->
                           <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/10.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                              <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Tyrone Owens</strong>
                                    <br>
                                    <small class="text-muted">Designer</small>
                                 </span>
                              </span>
                           </a>
                           <!-- END User status-->
                        </li>
                        <li>
                           <div class="p-lg text-center">
                              <!-- Optional link to list more users-->
                              <a href="#" title="See more contacts" class="btn btn-purple btn-sm">
                                 <strong>Load more..</strong>
                              </a>
                           </div>
                        </li>
                     </ul>
                     <!-- Extra items-->
                     <div class="p">
                        <p>
                           <small class="text-muted">Tasks completion</small>
                        </p>
                        <div class="progress progress-xs m0">
                           <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-success progress-80">
                              <span class="sr-only">80% Complete</span>
                           </div>
                        </div>
                     </div>
                     <div class="p">
                        <p>
                           <small class="text-muted">Upload quota</small>
                        </p>
                        <div class="progress progress-xs m0">
                           <div role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-warning progress-40">
                              <span class="sr-only">40% Complete</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
         <!-- END Off Sidebar (right)-->
      </aside>
	  <script>
	  
	  /* $("#click").on('click',(function(e){
		  var a=$('#click').attr('data-toggle-state');
		  if(a=='aside-collapsed'){
			  $('#click').attr('data-toggle-state','aside-toggled');
		  }else{
			  $('#click').attr('data-toggle-state','aside-collapsed');
		  }
	  })); */
	  </script>
