$(document).ready(function() {
	
	var	month_year = $('#month_year').val((new Date()).getFullYear());
 
	show_esicchallanyearly();			
	function show_esicchallanyearly(){
		var	month_year = $('#month_year').val();
		$("#table_data1").html("");
		$("#wait").show();
		
		    $.ajax({
		        type  : 'post',
				url  : baseurl+"esicchallanyearly/show_esicchallanyearly",
		        data : {month_year:month_year},
		        dataType : 'json',
		        global: false,
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
                    '<thead><tr><th>For The Month Of</th>'+	
                    '<th>Employee Share Rs.</th>'+  			
                    '<th>Employer Share Rs.</th>'+  			
                    '<th>Challan Number</th>'+  			
                    '<th>Actual Date of Payment</th>'+  			
                    '<th>Action</th>'+
                '</tr>'+
                    '</thead><tbody>';
		            var i;
                    var total1 = 0;
                    var total2 = 0;
		            for(i=0; i<data.length; i++){
                        var data1 = data[i].split("####");
                        var ee_share = data1[1];
                        var er_share = data1[2];
                        var challan_no = data1[3] || "";
                        var raw_date = data1[4] || ""; // YYYY-MM-DD
                        var wage_month = data1[5];

                        var display_date = "";
                        if (raw_date && raw_date != "0000-00-00") {
                            var d = raw_date.split('-');
                            display_date = d[2] + '/' + d[1] + '/' + d[0];
                        }
                        
                        html += '<tr>';
                        html += '<td>'+data1[0]+'</td>';
                        html += '<td><span class="ee_share">'+ee_share+'</span></td>';
                        html += '<td><span class="er_share">'+er_share+'</span></td>';
                        html += '<td><input type="text" class="form-control input-sm challan_no" value="'+challan_no+'"></td>';
                        html += '<td><input type="text" class="form-control input-sm challan_date date" value="'+display_date+'" placeholder="DD/MM/YYYY"></td>';
                        html += '<td><button class="btn btn-xs btn-success btn_save_inline" data-month="'+wage_month+'">Save</button></td>';
                        html +='</tr>';		

                        total1 += parseFloat(ee_share) || 0;
                        total2 += parseFloat(er_share) || 0;
					}	
		            
	                html += '</tbody><tfoot><tr>'+
                        '<th>Total</th>'+
                        '<th>'+total1.toFixed(2)+'</th>'+
                        '<th>'+total2.toFixed(2)+'</th>'+
                        '<th></th>'+
                        '<th></th>'+
                        '<th></th>'+
                        '</tr></tfoot></table>';
                        
		            $('#table_data1').html(html);

                    // Initialize datepicker for the new inputs
                    $('.date').datetimepicker({format:"DD/MM/YYYY"});

                    var msg = "ESIC Challan Yearly";
                    $('#example1').dataTable({
                    'bDestroy': true,
                        'paging':   false,
                        'ordering': false,
                        'info':     true,
                        oLanguage: {
                            sSearch:      'Search all columns:',
                            sLengthMenu:  '_MENU_ records per page',
                            info:         'Showing page _PAGE_ of _PAGES_',
                            zeroRecords:  'Nothing found - sorry',
                            infoEmpty:    'No records available',
                            infoFiltered: '(filtered from _MAX_ total records)'
                        },
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            {
                                extend: 'excel', 
                                className: 'btn-sm', 
                                title: msg,
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4], // Exclude Action column
                                    format: {
                                        body: function (data, row, column, node) {
                                            // If the cell contains an input (Challan No or Date), return its value
                                            var input = $(node).find('input');
                                            if (input.length > 0) {
                                                return input.val();
                                            }
                                            // Strip any other HTML tags (like <span>) and return plain text
                                            return $(node).text().trim();
                                        }
                                    }
                                }
                            }
                        ]
                    });
                    $("#wait").hide();
		        },
		        error: function() {
		            $("#wait").hide();
		        }

		    });
		}

	$(document).on('click','#btn_insert',function(){
		show_esicchallanyearly();			
	});

    $(document).on('click', '.btn_save_inline', function(){
        var btn = $(this);
        var row = btn.closest('tr');
        var wage_month = btn.data('month');
        var ee_share = row.find('.ee_share').text();
        var er_share = row.find('.er_share').text();
        var challan_no = row.find('.challan_no').val();
        var challan_date = row.find('.challan_date').val();

        // Convert date from DD/MM/YYYY to YYYY-MM-DD
        var final_date = "";
        if (challan_date) {
            var d = challan_date.split('/');
            if (d.length == 3) {
                final_date = d[2] + '-' + d[1] + '-' + d[0];
            }
        }

        $.ajax({
            type: 'post',
            url: baseurl + "esicchallanyearly/save_inline",
            data: {
                wage_month: wage_month,
                employee_share: ee_share,
                employer_share: er_share,
                challan_no: challan_no,
                challan_date: final_date
            },
            dataType: 'json',
            success: function(res) {
                if (res) {
                    $().toastmessage('showSuccessToast', "Saved successfully");
                } else {
                    $().toastmessage('showErrorToast', "Save failed");
                }
            },
            error: function() {
                $().toastmessage('showErrorToast', "Error occurred");
            }
        });
    });
});
