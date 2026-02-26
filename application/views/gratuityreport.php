<?php
$title = "Gratuity Report";
include('label.php'); ?>
<!-- Required CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/dist/css/select2.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2-bootstrap-theme/dist/select2-bootstrap.css'); ?>">

<style>
  /* CRITICAL: Hide the raw multiple select so it doesn't show as a listbox */
  #contractor1 {
    display: none !important;
  }
  
  /* SaaS-style Multi-select Dropdown styling */
  .select2-container--bootstrap .select2-selection--multiple {
    min-height: 34px !important;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s !important;
  }
  
  .select2-container--bootstrap.select2-container--focus .select2-selection--multiple {
    border-color: #66afe9 !important;
    outline: 0 !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6) !important;
  }

  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #2e6da4 !important;
    color: #fff !important;
    padding: 2px 8px !important;
    margin-top: 4px !important;
    margin-bottom: 2px !important;
    border-radius: 3px !important;
    font-size: 12px !important;
  }
  
  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    margin-right: 5px !important;
    cursor: pointer !important;
  }
  
  .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #ffdada !important;
  }
</style>

<!-- Main section-->
<section>
  <div class="content-wrapper">
    <div class="clearfix">
      <div class="pull-left">
        <h3>Gratuity Report</h3>
        <p style="color:#666; font-size:12px; margin-top:5px;">Showing latest 7 employees with 5+ years of service. Use filters below to search specific data.</p>
      </div>
      <div class="pull-right">
      </div>
    </div>  
    <!-- START row-->
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="#" id="gratuityform">
          <!-- START panel-->
          <div id="hide_show1">
            <div class="panel panel-default" >
              <div class="panel-heading">
                <div class="panel-title"></div>
                <div class="panel-body">
                  <div class="col-md-12">
                    <div class="col-md-12">
                      <div class="col-md-2">
                        <center>
                          <div class="form-group">
                            <label class="control-label">Select Year</label>
                            <div id="datetimepicker1" class="date">
                              <input type="text" class="form-control month_year1" id="year" name="year" value='' placeholder="Select year">
                              <label id="d" style="color:red;"></label>
                            </div>  
                          </div>
                        </center>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Select Date</label>
                          <div id="datetimepicker1" class="date">
                            <input type="text" class="form-control month_year2" id="date" name="date" value='' placeholder="Select Month">
                            <label id="d" style="color:red;"></label>
                          </div>  
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label"><?= $typeEmp; ?></label>
                          <select type="text" name="typeEmp" form="employee_form" id="typeEmp" class="form-control">
                            <option value="" selected disabled>Select <?= $typeEmp; ?></option>
                            <option value="BIDI MAKER">Bidi Maker</option>
                            <option value="BIDI PACKER">Bidi Packer</option>
                            <option value="OFFICE STAFF">Office Staff</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Contractor</label>
                          <select name="contractor1[]" id="contractor1" class="form-control" multiple="multiple">
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <center> 
                          <button type="submit" id="btn_insert" class="btn btn-primary button_change">Search</button>													
                          <input type="hidden" id="hid_id" value=""/>
                          <input type="hidden" id="hid_up" value="Add"/>
                        </center>
                      </div>
                    </div>	
                  </div>
                </div>
              </div>    
            </div>                  
          </div>
        </form> 
      </div>	
      <div class="panel-footer">
        <div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br><center><h5>Loading...</h5></center></div>
        <div class="table-responsive" id="show_gratuitycalculation">
        </div>
      </div>
    </div>
  </div>
</section>                          

<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>

<?php include('footer.php');?>
</div>

<script>
$(document).ready(function() {
  $('.month_year1').datetimepicker({format:"YYYY", maxDate: new Date()});
  $('.month_year2').datetimepicker({format:"DD/MM/YYYY", maxDate: new Date()});
});
</script> 

<script src="<?php echo base_url('assets/vendor/select2/dist/js/select2.js'); ?>"></script>
<script src="<?php echo base_url().'assets/js/js/gratuity_calculation_js.js';?>"></script>   

<script>
var table = $('#example').DataTable({
  scrollX: true,
  pageLength: 10,
  fixedHeader: true,
  lengthChange: false,
  order: [[ 0, "asc" ]],
  dom: 'Bfrtip',
  buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
});

table.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)' );

var table = $('#example').DataTable();

table.columns().every( function () {
  var that = this;
  $( 'input', this.header() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that.search( this.value ).draw();
    }
  });
});
</script>
 
</body>
</html>