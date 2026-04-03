<?php
$title = "UAN to IP Mapping";
?>
<section>
    <div class="content-wrapper">
        <div class="clearfix">
            <div class="pull-left">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload Excel Sheet (UAN and IP columns)</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Excel File</label>
                                    <input type="file" id="excel_file" class="form-control" accept=".xlsx, .xls">
                                </div>
                            </div>
                             <div class="col-md-4" style="margin-top: 25px;">
                                 <button type="button" class="btn btn-primary" id="btn_preview">Preview</button>
                                 <a href="<?php echo base_url('payroll/download_uan_template'); ?>" class="btn btn-info">Download Template</a>
                             </div>
                        </div>
                        
                        <div id="preview_section" style="display:none; margin-top:20px;">
                            <div class="alert alert-info">
                                Total Records Found: <span id="record_count" >0</span>
                            </div>
                            <table class="table table-bordered table-striped" id="preview_table">
                                <thead>
                                    <tr>
                                        <th>UAN</th>
                                        <th>Employee Name</th>
                                        <th>IP Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button type="button" class="btn btn-success" id="btn_save">Update Records</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="wait" style="display:none;width:100px;height:100px;position:fixed;top:50%;left:50%;margin-top:-50px;margin-left:-50px;padding:2px;z-index:9999;">
    <img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" />
    <br><center><h5>Loading...</h5></center>
    <br><center><h5>It may take a while</h5></center>
</div>

<?php include('footer.php'); ?>

<script>
var baseurl = '<?php echo base_url(); ?>';
$(document).ready(function() {
    console.log("UAN-IP Mapping: Page loaded, base_url: " + baseurl);
    var previewData = [];

    $('#btn_preview').click(function() {
        console.log('[IMPORT] → Button Clicked → UAN-IP Mapping Preview Started');
        var file_data = $('#excel_file').prop('files')[0];
        if (!file_data) {
            console.warn("UAN-IP Mapping: No file selected");
            alert("Please select a file first");
            return;
        }

        console.log('[IMPORT] → File Selected → ' + file_data.name);
        console.log('[IMPORT] → engine → Using PhpSpreadsheet (Modern Logic)');

        var form_data = new FormData();
        form_data.append('file', file_data);

        console.log('[IMPORT] → API Call Start → Uploading to Server');
        $("#wait").show();
        $('#btn_preview').prop('disabled', true);

        $.ajax({
            url: '<?php echo base_url("payroll/preview_uan_ip_mapping"); ?>',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                console.log('[IMPORT] → API Response Received → Processing result');
                console.log("UAN-IP Mapping Response:", response);
                $("#wait").hide();
                $('#btn_preview').prop('disabled', false);

                if (response.status === false) {
                    console.error("Error Type:", response.type);
                    console.error("Message:", response.message);
                    
                    if (response.type === "zip_error") {
                        alert("Server issue: Zip extension not enabled");
                    } else {
                        alert(response.message || "An error occurred during processing");
                    }
                    return;
                }

                var data = response.data;
                if (!data || data.length == 0) {
                    console.warn("UAN-IP Mapping: No data found in response");
                    alert("No valid data found in the Excel sheet. Please ensure Column A has UAN and Column B has IP.");
                    $('#preview_section').hide();
                } else {
                    console.log("UAN-IP Mapping: Rendering preview table");
                    previewData = data;
                    $('#record_count').text(data.length);
                    var html = '';
                    $.each(data, function(i, item) {
                        html += '<tr><td>' + item.uan + '</td><td>' + item.name + '</td><td>' + item.ip + '</td></tr>';
                    });
                    $('#preview_table tbody').html(html);
                    $('#preview_section').show();
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                console.error("XHR response:", xhr.responseText);
                $("#wait").hide();
                $('#btn_preview').prop('disabled', false);
                alert("Error in file upload or processing. Check console for details.");
            }
        });
    });

    $('#btn_save').click(function() {
        console.log('[IMPORT] → Button Clicked → Update Records Started');
        if (previewData.length == 0) {
            alert("No data to save");
            return;
        }

        console.log("UAN-IP Mapping: Showing loader and starting update AJAX");
        $("#wait").show();
        $('#btn_save').prop('disabled', true);

        $.ajax({
            url: '<?php echo base_url("payroll/update_uan_ip_mapping"); ?>',
            type: 'post',
            data: { data: JSON.stringify(previewData) },
            success: function(response) {
                console.log('[IMPORT] → API Response Received → Update successful');
                console.log("UAN-IP Mapping: Update success", response);
                $("#wait").hide();
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("UAN-IP Mapping: Update AJAX error", status, error);
                console.log("UAN-IP Mapping: XHR response", xhr.responseText);
                $("#wait").hide();
                $('#btn_save').prop('disabled', false);
                alert("Error updating records. Check console for details.");
            }
        });
    });
});
</script>
