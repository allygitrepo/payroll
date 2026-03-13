$(document).ready(function() {
	
		   var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 0 ?
//                        data.replace( /[$,]/g, '' ) :
  data.replace( /<br\s*\/?>/ig, "\n" ) :
				data;
                }
            },
        }
    };

	
	
  var yyyy1 = (new Date()).getFullYear();
  var yyyy2 = parseInt(yyyy1)-parseInt(1);
  var mnth = (new Date()).getMonth(); // getMonth() is zero-based
  if(mnth==12)
  {
  var mm = 1;	  	  
  }
  else{
  var mm = mnth+1;	  
  }
  if(mm<10)
  {
	mm = '0'+mm;
  }
	
	$('#month_year1').val(mm+'/'+yyyy2);
	$('#month_year2').val(mm+'/'+yyyy1);

    // Function to load contractors
    function show_contractor() {
        $.ajax({
            type: 'ajax',
            url: baseurl + "contractorcontroller/view_only_contractor",
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '<option value="all">Select All</option>';
                if (data && Array.isArray(data)) {
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].contractor_id + '" >' + data[i].contractor_name + ' - ' + data[i].pf_code + '</option>';
                    }
                }
                $('#contractor1').html(html);
                if ($.fn.select2) {
                    $('#contractor1').select2({
                        theme: "bootstrap",
                        placeholder: "Select Contractors",
                        allowClear: true,
                        width: '100%'
                    });

                    // Mutual exclusivity: "Select All" vs. specific contractors
                    $('#contractor1').on('select2:select', function (e) {
                        var data = e.params.data;
                        if (data.id === 'all') {
                            // If "Select All" is picked, clear all other selections
                            $(this).val(['all']).trigger('change');
                        } else {
                            // If a specific contractor is picked, remove "Select All" from the selection
                            var values = $(this).val();
                            if (values && values.includes('all')) {
                                var newValues = values.filter(function(v) { return v !== 'all'; });
                                $(this).val(newValues).trigger('change');
                            }
                        }
                    });
                }
            }
        });
    }

    // Toggle contractor dropdown visibility
    $('#typeEmp').change(function() {
        if ($(this).val() === 'BIDI MAKER') {
            $('#contractor_div').show();
            if ($('#contractor1 option').length === 0) {
                show_contractor();
            }
        } else {
            $('#contractor_div').hide();
            $('#contractor1').val(null).trigger('change');
        }
    });
		
    $(document).on("submit","#bonussheetform",function(e){
			e.preventDefault();
			var month_year1 = $('#month_year1').val();
			var month_year2 = $('#month_year2').val();
			var employee_type = $('#typeEmp').val();
            var contractor = $('#contractor1').val();

			$.ajax({
			
                type : "POST",
				url  : baseurl+"bonussheet/show_bonussheet",
                dataType : "JSON",
                data : {
                    month_year1: month_year1,
                    month_year2: month_year2,
                    employee_type: employee_type,
                    contractor: contractor
                },
                success: function(data){
				var html = '';
				html += '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
				html +=	'<thead>'+
				'<tr>'+
				'<th>Name</th>';
			            var i;
							var total = [];
						var data1 = data[0].split("####");
						var n = data1.length;
						
						for(i=0; i<n; i++){
							html += '<th>'+data1[i]+'</th>';
						}
		                html += '<th>Signature Of Employee</th>'+
								'</tr></thead>';

						html += '<tbody>';
					var j;			
					for(r=0; r<=data1.length+2; r++){
								
								 total[r] = 0;
								
							}
					for(j=1; j<data.length-1; j++){
		            
						html += '<tr>';
							var data2 = data[j].split("####");
							var k;
							var r;
							for(k=0; k<data2.length; k++){
								if(k==0)
								{
								html += '<td>'+data2[0]+'<br>Member ID :'+data2[1]+'<br>UAN :'+data2[2]+'</td>';																		
								}
								else if(k > 2){
								html += '<td>'+data2[k]+'</td>';					
								 total[k] = parseInt(total[k])+parseInt(data2[k]);						
								 
								}
							}
						html += '<td></td></tr>';
						
						
							
		            
							var msgt = data[data.length-1].split("####");
					var msgtop = "COMPANY NAME : "+msgt[0]+" , ADDRESS:  "+msgt[1]+" , POSTOFFICE:  "+msgt[2]+" , DISTRICT:  "+msgt[3]+" , PINCODE:  "+msgt[4];
							
					}
								
							
	                html += '</tbody>';
			                html += '<tfoot><tr><th>Total</th>';
							for(s=3; s<data2.length; s++){
									html += '<th>'+total[s]+'</th>';
							}
							
			                html += '<th></th>'+
								'</tr></tfoot>';

				
					'</table>';
		            $('#table_data1').html(html);
			
			
   var msg = "Bonus Sheet";
   var msg_top = "From : "+month_year1+" To : "+month_year2+" - "+msgtop;
    $('#example1').dataTable({                 
       'bDestroy': true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
 //       'responsive': true, // https://datatables.net/extensions/responsive/examples/
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns:',
            sLengthMenu:  '_MENU_ records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        },
        // Datatable Buttons setup
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            	{extend: 'excel', className: 'btn-sm', title: msg ,messageTop:msg_top,	footer: true,header: true, },

	$.extend( true, {}, buttonCommon, {
						extend: 'pdfHtml5',   className: 'btn-sm', title: msg,messageTop:msg_top,	footer: true,header: true, orientation: 'landscape',pageSize: 'A4',
				customize: function(doc) {
						doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
						doc.styles.tableHeader.fontSize = 8;
						doc.styles.tableFooter.fontSize = 8;
						doc.defaultStyle.alignment = 'center';
						
							}
  				
				})	


			
        ]
    });

                    if (data.length > 2) {
                        var recordCount = data.length - 2; // Subtracting header (index 0) and metadata (last index)
                        $().toastmessage('showSuccessToast', recordCount + " records fetched successfully.");
                    } else if (data.length == 2) {
                        // Only header and footer exist, no employee records
                        $().toastmessage('showWarningToast', "No records found for the selected criteria.");
                    }
                },
                error: function(xhr, status, error) {
                    $().toastmessage('showErrorToast', "Error fetching records: " + error);
                }
            });
            return false;
        });


	
});