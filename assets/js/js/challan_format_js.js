$(document).ready(function() {
	
	
						show_challan_format();	//call function show all packingwages
		
	
		function show_challan_format(){
			        $("#wait").css("display", "block");

					var month_year = $('#month_year').val();

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"pfchallanyearly/show_challanformat",
                data : {month_year:month_year},
		        dataType : 'json',
		        success : function(data){
		            $('#estb_id').html(data[0]);
		            $('#company_name').html(data[1]);
		            $('#wages_month').html(data[2]);
		            $('#month_year').val(data[3]);
		            $('#return_month').html(data[4]);
		            $('#challan_date').html(data[5]);
		            $('#crn').html(data[6]);
		            $('#trrn').html(data[7]);
		            $('#contrib').html(data[8]);
		            $('#return_date').html(data[9]);
		            $('#total_uan_count').html(data[10]);
		            $('#gross_wages').html(data[11]);
		            $('#epf_wages').html(data[12]);
		            $('#eps_wages').html(data[13]);
		            $('#edli_wages').html(data[14]);
		            $('#ncp_days').html(data[15]);
		            $('#uan_count1').html(data[16]);
		            $('#uan_count2').html(data[16]);
		            $('#uan_count3').html(data[16]);
		            $('#uan_count4').html(data[16]);
		            $('#epf_ee_share').html(data[17]);
		            $('#epf_er_share').html(data[18]);
		            $('#eps_contri').html(data[19]);
		            $('#edli_contri').html(data[20]);
		            $('#total_refund').html(data[21]);
		            $('#total_contri').html(data[22]);
					
		            $('#total_epf_ecr').html(data[17]);
		            $('#total_eps_ecr').html(data[19]);
		            $('#total_diff_ecr').html(data[18]);
		            $('#total_edli_ecr').html(data[20]);

		            $('#total_epf_charges').html(data[23]);
		            $('#total_edli_charges').html(data[24]);
		            $('#total_refund_ac1').html(data[21]);
					
					var total = parseInt(data[21])+parseInt(data[24])+parseInt(data[23])+parseInt(data[20])+parseInt(data[19])+parseInt(data[18])+parseInt(data[17]); 	 	
		            $('#total_col').html(total);
					
		            $('#pmrpy1').html('0');
		            $('#pmrpy2').html(data[25]);
		            $('#pmrpy3').html(data[26]);
					
					var pmrpy_total = parseInt(data[25])+parseInt(data[26]);
		            $('#total_pmrpy').html(pmrpy_total);

		            $('#net_pay1').html(data[17]-0);
		            $('#net_pay2').html(data[19]-data[25]);
		            $('#net_pay3').html(data[18]-data[26]);
		            $('#net_pay4').html(data[20]-0);
		            $('#net_pay5').html(data[23]-0);
		            $('#net_pay6').html('0');
		            $('#net_pay7').html(data[24]-0);
		            $('#net_pay8').html('0');
		            $('#net_pay9').html(data[21]-0);
					
					var net_total = total-pmrpy_total;
		            $('#net_total').html(net_total);


		            $('#total_emp').html(data[10]);

		            $('#net_paid_ac1ee').html(data[27]);
		            $('#net_paid_ac1er').html(data[28]);
		            $('#net_paid_ac10').html(data[29]);
		            $('#net_paid_ac21er').html(data[30]);
		            $('#net_paid_ac2').html(data[31]);
		            $('#net_paid_ac22').html(data[32]);
					
		            $('#net_paid_total').html(parseInt(data[32])+parseInt(data[31])+parseInt(data[30])+parseInt(data[29])+parseInt(data[28])+parseInt(data[27]));

		            $('#total_emp').html(data[33]);
					        $("#wait").css("display", "none");

					}

		    });
		}
 	
	$(document).on('click','#btn_insert',function(){
	
		show_challan_format();
        });

	
});