<?php
$title = "Contractor Salary Sheet";
include('label.php');
?>

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
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Contractor Name - Pf Code</label>
                    <select name="contractor1" id="contractor1" class="form-control">
                      <option value="">Select Contractor</option>
                      <?php
                      // Purana logic (agar aapka DB se contractor aa raha hai)
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
                <div class="col-md-5">
                  <center>
                    <a id="btn_insert" class="btn btn-primary">Search</a>
                    <input type="hidden" id="hid_id" value=""/>
                    <input type="hidden" id="hid_up" value="Add"/>
                  </center>
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

<!-- Required JS & CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/css/tempusdominus-bootstrap-4.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Aapka original JS file (report load karta hai) -->
<script src="<?php echo base_url().'assets/js/js/contractor_sheet_js.js';?>"></script>

<script type="text/javascript">
var baseurl = "<?php print base_url(); ?>";

$(document).ready(function () {

  // Loader show/hide
  $(document).ajaxStart(function(){
    $("#wait").show();
  }).ajaxComplete(function(){
    $("#wait").hide();
  });

  // Initialize Month-Year Picker
  $('#datetimepicker1').datetimepicker({
    format: 'MM/YYYY'
  });

  // Auto Search Trigger
  function autoTriggerSearch() {
    const month = $('#month_year').val();
    const contractor = $('#contractor1').val();
    if (month && contractor) {
      console.log("Auto search triggered for:", month, contractor);
      setTimeout(function() {
        $('#btn_insert').trigger('click');
      }, 400);
    }
  }

  // Trigger on selection
  $('#month_year').on('change blur', autoTriggerSearch);
  $('#contractor1').on('change', autoTriggerSearch);

});
</script>

<?php include('footer.php'); ?>
