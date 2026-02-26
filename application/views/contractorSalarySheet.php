<?php
$title = "Contractor Salary Sheet";
include('label.php');
?>

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

<section>
  <div class="content-wrapper">
    <div class="clearfix">
      <div class="pull-left">
        <h3><?php if(isset($title)){ echo $title; } ?></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div id="hide_show1">
          <div class="panel panel-default" id="loanform">
            <div class="panel-heading">
              <div class="panel-title"></div>
            </div>
            <div class="panel-body">
              <div class="col-md-12">

                <!-- Month and Year -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Month and Year</label>
                    <div class="input-group date" id="datetimepicker1">
                      <input type="text" class="form-control month_year" id="month_year" name="month_year"
                        placeholder="Select Date*" required>
                      <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                    </div>
                  </div>
                </div>

                <!-- Contractor Name -->
                <div class="col-md-6">
                  <div class="form-group" style="display: block !important;">
                    <label class="control-label">Contractor Name - Pf Code</label>
                    <select name="contractor1[]" id="contractor1" class="form-control" multiple="multiple">
                      <?php
                      if(isset($contractors)){
                        foreach($contractors as $c){
                          echo '<option value="'.$c['contractor_id'].'">'.$c['contractor_name'].' - '.$c['pf_code'].'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Search button -->
                <div class="col-md-3">
                  <div style="margin-top: 25px;">
                    <center>
                      <a id="btn_insert" class="btn btn-primary btn-block">Search</a>
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
          <div id="wait" style="display:none;width:100px;height:100px;position:absolute;left:45%;padding:2px;">
            <img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" />
            <br><center><h5>Loading...</h5></center>
          </div>
          <div class="table-responsive" id="table_data1"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
  console.log("ALLY BASEURL:", baseurl);
</script>

<!-- Script Inclusions move to bottom to prevent clobbering by footer scripts -->
<script src="<?php echo base_url('assets/vendor/select2/dist/js/select2.js'); ?>"></script>
<script src="<?php echo base_url().'assets/js/js/contractor_sheet_js.js';?>"></script>

<script type="text/javascript">
$(document).ready(function () {
  // CRITICAL: Ensure baseurl is available and jQuery is ready
  console.log("Contractor Salary Sheet ready.");

  // Loader show/hide
  $(document).ajaxStart(function(){
    $("#wait").show();
  }).ajaxComplete(function(){
    $("#wait").hide();
  });

  // Re-init Month Picker using footer's datetimepicker
  if($.fn.datetimepicker) {
    $('#datetimepicker1').datetimepicker({
      format: 'MM/YYYY',
      defaultDate: moment()
    });
  }

  $('#month_year').val(moment().format('MM/YYYY'));

  // Auto Search Trigger
  function autoTriggerSearch() {
    const month = $('#month_year').val();
    const contractor = $('#contractor1').val();
    if (month && contractor && (Array.isArray(contractor) ? contractor.length > 0 : contractor != "")) {
      setTimeout(function() {
        $('#btn_insert').trigger('click');
      }, 400);
    }
  }

  $('#month_year').on('change blur', autoTriggerSearch);
  $('#contractor1').on('change', autoTriggerSearch);

  // Auto-load trigger
  setTimeout(function() {
    const month = $('#month_year').val();
    const contractor = $('#contractor1').val();
    if (month && contractor && (Array.isArray(contractor) ? contractor.length > 0 : contractor != "")) {
      $('#btn_insert').trigger('click');
    }
  }, 1200);
});
</script>
