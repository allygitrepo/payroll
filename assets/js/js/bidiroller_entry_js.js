$(document).ready(function () {




	/*---------get  contracor  end-----------------*/

	show_contractor();	//call function show all address
	function show_contractor() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "contractorcontroller/view_contractor",
			async: false,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var html1 = '';
				var i;
				html += '<option value=""  selected >ALL</option>';
				for (i = 0; i < data.length; i++) {
					var sr = i + 1;
					html += '<option value="' + data[i].contractor_id + '" >' + data[i].contractor_name + ' - ' + data[i].pf_code + '</option>';
				}
				$('#contractor1').html(html);


			}

		});
	}


	/*---------view contracor list end-----------------*/

	//		show_bidi_roller_entry();	//call function show all address
	function show_bidi_roller_entry() {
		$("#table_data1").html("");
		$("#wait").css("display", "block");



		var month_year = $('#month_year').val();
		var contractor = $('#contractor1').val();

		console.log('making req for :', { month_year: month_year, contractor: contractor });
		$.ajax({
			type: 'POST',
			url: baseurl + "Bidirollewages/show_bidi_roller_entry",
			data: { month_year: month_year, contractor: contractor },
			dataType: 'json',
			global: false,
			success: function (data) {
				console.log('res :', data);
				console.log('data', data);

				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>' +
					'<th style="display:none;">Employee id</th>' + // 0: data1[0]
					'<th style="display:none;">Name hidden</th>' + // 1: data1[1]
					'<th style="display:none;">UAN hidden</th>' +  // 2: data1[2]
					'<th style="white-space:nowrap;">Employee Name.</th>' + // 3: Visible name info
					'<th>No. of Unit worked</th>' + // 4: Unit1
					'<th>No. of Unit worked</th>' + // 5: Unit2
					'<th style="display:none;">Rem Days</th>' + // 6: data1[4]
					'<th>No. of Days worked</th>' + // 7: worked_days
					'<th>Leave With Pay</th>' + // 8: leave_with_pay
					'<th style="display:none;">BR ID</th>' + // 9: data1[5]
					'<th style="display:none;">Rate1</th>' + // 10: data1[6]
					'<th style="display:none;">Rate2</th>' + // 11: data1[7]
					'<th style="display:none;">Bonus1</th>' + // 12: data1[8]
					'<th style="display:none;">Bonus2</th>' + // 13: data1[9]
					'<th style="display:none;">PF Rate</th>' + // 14: data1[10]
					'<th style="display:none;">AC10</th>' + // 15: data1[11]
					'<th>Wages</th>' + // 16: wages
					'<th>Bonus</th>' + // 17: bonus
					'<th>Total</th>' + // 18: total
					'<th>PF</th>' + // 19: pf
					'<th>PT</th>' + // 20: pt
					'<th style="display:none;">PT ID</th>' + // 21: data1[30]
					'<th>ESIC</th>' + // 22: esic
					'<th>Net Wages</th>' + // 23: net_wages
					'<th style="display:none;">AC1Male</th>' + // 24: data1[22]
					'<th style="display:none;">NCP Days</th>' + // 25: data1[23]
					'<th style="display:none;">Status</th>' + // 26: data1[24]
					'<th style="display:none;">Member ID</th>' + // 27: data1[21]
					'<th style="display:none;">Total Days</th>' + // 28: data1[27]
					'</tr></thead><tbody>';
				var i;


				var data_1 = 0;
				var data_2 = 0;
				var data_3 = 0;
				var data_4 = 0;
				var data_5 = 0;
				var data_6 = 0;
				var data_7 = 0;
				var data_8 = 0;
				var data_pt = 0;
				var data_9 = 0;
				var data_10 = 0;



				for (i = 0; i < data.length; i++) {

					console.log(data[i]);
					var data1 = data[i].split("####");

					$('#month_year').val(data1[3]);
					//					$('#leave_without_pay').val(data1[4]);
					//	            for(j=0;j<data1.length;j++){
					html += '<tr>' +
						'<td style="display:none;">' + data1[0] + '</td>' + // 0
						'<td id="name' + data1[0] + '" style="display:none;">' + data1[1] + '</td>' + // 1
						'<td style="display:none;" id="uan' + data1[0] + '">' + data1[2] + '</td>' + // 2
						'<td style="whiteSpace:nowrap;width:20%;">' + data1[1] + '<br>' + data1[21] + '<br>' + data1[2] + '</td>' + // 3
						'<td><center><input type="text" name="' + data1[0] + '" id="unit1_' + data1[0] + '" class="unit_worked_days1 form-control" value="' + data1[17] + '" style="width:70%;" /></center></td>' + // 4
						'<td><center><input type="text" name="' + data1[0] + '" id="unit2_' + data1[0] + '" class="unit_worked_days2 form-control" value="' + data1[18] + '" style="width:70%;" /></center></td>' + // 5
						'<td id="remaining_days' + data1[0] + '" style="display:none;">' + data1[4] + '</td>' + // 6
						'<td><center><input type="text" name="' + data1[0] + '" id="worked_days' + data1[0] + '" class="worked_days form-control" disabled value="' + data1[19] + '" style="width:70%;" /></center></td>' + // 7
						'<td><center><input type="text" name="' + data1[0] + '" id="leave_with_pay' + data1[0] + '" class="leave_with_pay form-control" value="' + data1[20] + '" style="width:70%;" /></center></td>' + // 8
						'<td id="br_id' + data1[0] + '" style="display:none;">' + data1[5] + '</td>' + // 9
						'<td id="rate1' + data1[0] + '" style="display:none;">' + data1[6] + '</td>' + // 10
						'<td id="rate2' + data1[0] + '" style="display:none;">' + data1[7] + '</td>' + // 11
						'<td id="bonus1_' + data1[0] + '" style="display:none;">' + data1[8] + '</td>' + // 12
						'<td id="bonus2_' + data1[0] + '" style="display:none;">' + data1[9] + '</td>' + // 13
						'<td id="pf_rate' + data1[0] + '" style="display:none;">' + data1[10] + '</td>' + // 14
						'<td id="ac10' + data1[0] + '" style="display:none;">' + data1[11] + '</td>' + // 15
						'<td id="wages' + data1[0] + '">' + data1[12] + '</td>' + // 16
						'<td id="bonus' + data1[0] + '">' + data1[13] + '</td>' + // 17
						'<td id="total' + data1[0] + '">' + data1[14] + '</td>' + // 18
						'<td id="pf' + data1[0] + '">' + data1[15] + '</td>' + // 19
						'<td id="pt' + data1[0] + '">' + data1[29] + '</td>' + // 20
						'<td style="display:none;" id="pt_id' + data1[0] + '">' + data1[30] + '</td>' + // 21
						'<td id="esic' + data1[0] + '">' + data1[27] + '</td>' + // 22
						'<td id="net_wages' + data1[0] + '">' + data1[16] + '</td>' + // 23
						'<td style="display:none;" id="ac1male' + data1[0] + '">' + data1[22] + '</td>' + // 24
						'<td style="display:none;" id="ncp_days' + data1[0] + '">' + data1[23] + '</td>' + // 25
						'<td style="display:none;" id="status' + data1[0] + '">' + data1[24] + '</td>' + // 26
						'<td style="display:none;" id="member_id_' + data1[0] + '">' + data1[21] + '</td>' + // 27
						'<td style="display:none;" id="total_no_of_days_' + data1[0] + '">' + data1[27] + '</td>' + // 28
						'</tr>';

					if (parseInt(data1[25]) > 0) {
						$('#save_update').val('update');
					}
					else {
						$('#save_update').val('save');
					}
					if (data1[26] > 0) {
						$('#table_insert').attr('disabled', 'disabled');
					}
					else {
						$('#table_insert').removeAttr('disabled');
					}
					//						data_1_total = unit1_'+data1[0];	
					data_1 = parseInt(data_1) + parseInt(data1[17]);
					data_2 = parseInt(data_2) + parseInt(data1[18]);
					data_3 = parseInt(data_3) + parseInt(data1[19]);
					data_4 = parseInt(data_4) + parseInt(data1[20]);
					data_5 = parseInt(data_5) + parseInt(data1[12]);
					data_6 = parseInt(data_6) + parseInt(data1[13]);
					data_7 = parseInt(data_7) + parseInt(data1[14]);
					data_8 = parseInt(data_8) + parseInt(data1[15]);
					data_pt = parseInt(data_pt || 0) + parseInt(data1[29]);
					data_9 = parseInt(data_9) + parseInt(data1[28]);
					data_10 = parseInt(data_10) + parseInt(data1[16]);



				}
				html += '</tbody><tfoot><tr>' +
					'<th style="display:none;"></th>' + // 0: id
					'<th style="display:none;"></th>' + // 1: name
					'<th style="display:none;"></th>' + // 2: uan
					'<th >Total</th>' + // 3: Visible name
					'<th id="total_data_1">' + data_1 + '</th>' + // 4: Unit1
					'<th id="total_data_2">' + data_2 + '</th>' + // 5: Unit2
					'<th style="display:none;"></th>' + // 6: remaining
					'<th id="total_data_3">' + data_3 + '</th>' + // 7: worked
					'<th id="total_data_4">' + data_4 + '</th>' + // 8: leave
					'<th style="display:none;"></th>' + // 9: br_id
					'<th style="display:none;"></th>' + // 10: rate1
					'<th style="display:none;"></th>' + // 11: rate2
					'<th style="display:none;"></th>' + // 12: bonus1
					'<th style="display:none;"></th>' + // 13: bonus2
					'<th style="display:none;"></th>' + // 14: pf_rate
					'<th style="display:none;"></th>' + // 15: ac10
					'<th id="total_data_5">' + data_5 + '</th>' + // 16: wages
					'<th id="total_data_6">' + data_6 + '</th>' + // 17: bonus
					'<th id="total_data_7">' + data_7 + '</th>' + // 18: total
					'<th id="total_data_8">' + data_8 + '</th>' + // 19: pf
					'<th id="total_data_pt">' + (data_pt || 0) + '</th>' + // 20: pt
					'<th style="display:none;"></th>' + // 21: pt_id
					'<th id="total_data_9">' + data_9 + '</th>' + // 22: esic
					'<th id="total_data_10">' + data_10 + '</th>' + // 23: net
					'<th style="display:none;"></th>' + // 24: ac1male
					'<th style="display:none;"></th>' + // 25: ncp
					'<th style="display:none;"></th>' + // 26: status
					'<th style="display:none;"></th>' + // 27: member_id
					'<th style="display:none;"></th>' + // 28: total_days
					'</tr></tfoot>';
				html += '</table>';
				$("#table_data1").html(html);
				var msg = "Bidi Roller Entry List";
				$('#example1').DataTable({
					'scrollX': true,
					'bDestroy': true,
					'paging': false,  // Table pagination
					'ordering': true,  // Column ordering
					'info': true,  // Bottom left status text
					oLanguage: {
						// sSearch:      'Search all columns:',
						sLengthMenu: '_MENU_ records per page',
						info: 'Showing page _PAGE_ of _PAGES_',
						zeroRecords: 'Nothing found - sorry',
						infoEmpty: 'No records available',
						infoFiltered: '(filtered from _MAX_ total records)'
					},
					dom: '<"html5buttons"B>lTfgitp',
					buttons: [
						{ extend: 'copy', className: 'btn-sm', title: msg },
						{ extend: 'csv', className: 'btn-sm', title: msg },
						{ extend: 'excel', className: 'btn-sm', title: msg },
						{ extend: 'pdf', className: 'btn-sm', title: msg },
						{ extend: 'print', className: 'btn-sm', title: msg }
					]
				});
				$("#wait").hide();
			},
			error: function (xhr, status, error) {
				console.log('AJAX Error Status:', status);
				console.log('AJAX Error:', error);
				console.log('AJAX Response Text:', xhr.responseText);
				$("#wait").hide();
			}

		});

	}

	$(document).on('click', '#btn_insert', function () {
		console.log('search button clicked');
		show_bidi_roller_entry();
	});

	$(document).on("input change", ".unit_worked_days1", function () {
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_' + emp_id).val();
		var unit_days2 = $('#unit2_' + emp_id).val();
		var remaining_days = $('#remaining_days' + emp_id).html();
		var unit = parseInt(unit_days1) + parseInt(unit_days2);
		var leave_with_pay = $('#leave_with_pay' + emp_id).val();
		if (remaining_days > unit) {
			$('#worked_days' + emp_id).val(unit);
		}
		else {
			$('#worked_days' + emp_id).val(remaining_days);
		}

		var worked_days = $('#worked_days' + emp_id).val();
		var rate1 = $('#rate1' + emp_id).html();
		var rate2 = $('#rate2' + emp_id).html();
		var bonus1 = $('#bonus1_' + emp_id).html();
		var bonus2 = $('#bonus2_' + emp_id).html();
		var pf_rate = $('#pf_rate' + emp_id).html();

		var wages1 = parseInt((unit_days1) * (rate1)) + parseInt((unit_days2) * (rate2));
		if (worked_days == 0) {
			var wages2 = 0;
		}
		else {
			var wages2 = (wages1 / worked_days) * leave_with_pay;
		}
		var wages = (wages1) + (wages2);
		$('#wages' + emp_id).html(Math.round(wages));

		var bonus = (parseInt(unit_days1) * parseInt(bonus1)) + (parseInt(unit_days2) * parseInt(bonus2));

		var total = parseInt(wages) + parseInt(bonus);
		$('#bonus' + emp_id).html(parseInt(bonus));
		$('#total' + emp_id).html(parseInt(total));

		var pf = (parseInt(wages) * parseInt(pf_rate)) / 100;
		$('#pf' + emp_id).html(parseInt(pf));

		// Get PT and ESIC from backend
		$.ajax({
			type: "POST",
			url: baseurl + "Packingwages/get_ptax",
			dataType: "JSON",
			data: { salary: total, worked_days: worked_days, leave_with_pay: leave_with_pay },
			async: false,
			success: function (data) {
				var data1 = data.split("####");
				var pt = parseInt(data1[0]) || 0;
				var pt_id = parseInt(data1[1]) || 0;
				var esic = parseInt(data1[2]) || 0;

				$('#pt' + emp_id).html(pt);
				$('#pt_id' + emp_id).html(pt_id);
				$('#esic' + emp_id).html(esic);

				var net_wages = parseInt(total) - parseInt(pf) - parseInt(pt) - parseInt(esic);
				$('#net_wages' + emp_id).html(parseInt(net_wages));
			}
		});


		get_grand_total();
	});

	$(document).on("input change", ".unit_worked_days2", function () {
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_' + emp_id).val();
		var unit_days2 = $('#unit2_' + emp_id).val();
		var remaining_days = $('#remaining_days' + emp_id).html();
		var unit = parseInt(unit_days1) + parseInt(unit_days2);
		var leave_with_pay = $('#leave_with_pay' + emp_id).val();
		if (remaining_days > unit) {
			$('#worked_days' + emp_id).val(unit);
		}
		else {
			$('#worked_days' + emp_id).val(remaining_days);
		}

		var worked_days = $('#worked_days' + emp_id).val();
		var rate1 = $('#rate1' + emp_id).html();
		var rate2 = $('#rate2' + emp_id).html();
		var bonus1 = $('#bonus1_' + emp_id).html();
		var bonus2 = $('#bonus2_' + emp_id).html();
		var pf_rate = $('#pf_rate' + emp_id).html();

		var wages1 = parseInt((unit_days1) * (rate1)) + parseInt((unit_days2) * (rate2));
		if (worked_days == 0) {
			var wages2 = 0;
		}
		else {
			var wages2 = (wages1 / worked_days) * leave_with_pay;
		}
		var wages = (wages1) + (wages2);
		$('#wages' + emp_id).html(Math.round(wages));

		var bonus = (parseInt(unit_days1) * parseInt(bonus1)) + (parseInt(unit_days2) * parseInt(bonus2));

		var total = parseInt(wages) + parseInt(bonus);
		$('#bonus' + emp_id).html(parseInt(bonus));
		$('#total' + emp_id).html(parseInt(total));

		var pf = (parseInt(wages) * parseInt(pf_rate)) / 100;
		$('#pf' + emp_id).html(parseInt(pf));

		// Get PT and ESIC from backend
		$.ajax({
			type: "POST",
			url: baseurl + "Packingwages/get_ptax",
			dataType: "JSON",
			data: { salary: total, worked_days: worked_days, leave_with_pay: leave_with_pay },
			async: false,
			success: function (data) {
				var data1 = data.split("####");
				var pt_amount = parseInt(data1[0]) || 0;
				var pt_id = parseInt(data1[1]) || 0;
				var esic_amount = parseInt(data1[2]) || 0;

				$('#pt' + emp_id).html(pt_amount);
				$('#pt_id' + emp_id).html(pt_id);
				$('#esic' + emp_id).html(esic_amount);

				var net_wages = parseInt(total) - parseInt(pf) - parseInt(pt_amount) - parseInt(esic_amount);
				$('#net_wages' + emp_id).html(parseInt(net_wages));
			}
		});


		get_grand_total();
	});

	$(document).on("input change", ".leave_with_pay", function () {
		var emp_id = $(this).attr('name');
		var unit_days1 = $('#unit1_' + emp_id).val();
		var unit_days2 = $('#unit2_' + emp_id).val();
		var remaining_days = $('#remaining_days' + emp_id).html();
		var unit = parseInt(unit_days1) + parseInt(unit_days2);
		var leave_with_pay = $('#leave_with_pay' + emp_id).val();
		if (remaining_days > unit) {
			$('#worked_days' + emp_id).val(unit);
		}
		else {
			$('#worked_days' + emp_id).val(remaining_days);
		}

		var worked_days = $('#worked_days' + emp_id).val();
		var rate1 = $('#rate1' + emp_id).html();
		var rate2 = $('#rate2' + emp_id).html();
		var bonus1 = $('#bonus1_' + emp_id).html();
		var bonus2 = $('#bonus2_' + emp_id).html();
		var pf_rate = $('#pf_rate' + emp_id).html();

		var wages1 = parseInt((unit_days1) * (rate1)) + parseInt((unit_days2) * (rate2));
		if (worked_days == 0) {
			var wages2 = 0;
		}
		else {
			var wages2 = (wages1 / worked_days) * leave_with_pay;
		}
		var wages = (wages1) + (wages2);
		$('#wages' + emp_id).html(Math.round(wages));

		var bonus = (parseInt(unit_days1) * parseInt(bonus1)) + (parseInt(unit_days2) * parseInt(bonus2));

		var total = parseInt(wages) + parseInt(bonus);
		$('#bonus' + emp_id).html(parseInt(bonus));
		$('#total' + emp_id).html(parseInt(total));

		var pf = (parseInt(wages) * parseInt(pf_rate)) / 100;
		$('#pf' + emp_id).html(parseInt(pf));

		// Get PT and ESIC from backend
		$.ajax({
			type: "POST",
			url: baseurl + "Packingwages/get_ptax",
			dataType: "JSON",
			data: { salary: total, worked_days: worked_days, leave_with_pay: leave_with_pay },
			async: false,
			success: function (data) {
				var data1 = data.split("####");
				var pt_amount = parseInt(data1[0]) || 0;
				var pt_id = parseInt(data1[1]) || 0;
				var esic_amount = parseInt(data1[2]) || 0;

				$('#pt' + emp_id).html(pt_amount);
				$('#pt_id' + emp_id).html(pt_id);
				$('#esic' + emp_id).html(esic_amount);

				var net_wages = parseInt(total) - parseInt(pf) - parseInt(pt_amount) - parseInt(esic_amount);
				$('#net_wages' + emp_id).html(parseInt(net_wages));
			}
		});


		get_grand_total();
	});



	$(document).on('click', '#table_insert', function () {

		var table = $('#example1').DataTable();
		var r1 = table.rows().nodes();
		var r = r1.length;
		var month_year = $('#month_year').val();
		var save_update = $('#save_update').val();

		console.log('save button clicked', { month_year: month_year, save_update: save_update, total_rows: r });

		$("#wait").show();
		$('#table_insert').attr('disabled', 'disabled');

		function saveRow(i) {
			if (i >= r) {
				$("#wait").hide();
				$('#table_insert').removeAttr('disabled');
				$().toastmessage('showSuccessToast', "Bidi Roller Entry data save successfully");
				$('#save_update').val('update');
				return;
			}

			var emp_id = $(r1[i]).find('td:eq(0)').html();
			var member_name = $(r1[i]).find('td:eq(1)').html();
			var uan = $(r1[i]).find('td:eq(2)').html();

			var unit_days1 = $('#unit1_' + emp_id).val();
			var unit_days2 = $('#unit2_' + emp_id).val();

			var worked_days = $('#worked_days' + emp_id).val();
			var leave_with_pay = $('#leave_with_pay' + emp_id).val();

			var uan = $('#uan' + emp_id).html();
			var name = $('#name' + emp_id).html();
			var br_id = $('#br_id' + emp_id).html();
			var wages = $('#wages' + emp_id).html();
			var bonus = $('#bonus' + emp_id).html();
			var total = $('#total' + emp_id).html();
			var pf = $('#pf' + emp_id).html();
			var net_wages = $('#net_wages' + emp_id).html();
			var ac10 = $('#ac10' + emp_id).html();
			var ac1male = $('#ac1male' + emp_id).html();
			var ncp_days = $('#ncp_days' + emp_id).html();
			var status1 = $('#status' + emp_id).html();
			var member_id = $('#member_id_' + emp_id).html();
			var total_no_of_days = $('#total_no_of_days_' + emp_id).html();
			var pf_rate = $('#pf_rate' + emp_id).html();
			var pt = $('#pt' + emp_id).html();
			var pt_id = $('#pt_id' + emp_id).html();

			$.ajax({
				type: "POST",
				url: baseurl + "bidirollewages/bidiroller_entry_save",
				dataType: "JSON",
				data: { member_id: member_id, br_id: br_id, month_year: month_year, ac10: ac10, pf_rate: pf_rate, worked_days: worked_days, leave_with_pay: leave_with_pay, wages: wages, bonus: bonus, total: total, pf: pf, net_wages: net_wages, save_update: save_update, emp_id: emp_id, member_name: member_name, uan: uan, unit_days1: unit_days1, unit_days2: unit_days2, ac1male: ac1male, ncp_days: ncp_days, status1: status1, total_no_of_days: total_no_of_days, pt: pt, pt_id: pt_id },
				success: function (data) {
					saveRow(i + 1);
				},
				error: function () {
					console.error('Failed to save row ' + i);
					saveRow(i + 1); // Continue anyway for now
				}
			});
		}

		saveRow(0);
	});




	function get_grand_total() {
		var table = $('#example1').DataTable();
		var r1 = table.rows().nodes();
		var r = r1.length;
		var msg = 0;
		var i = 0;


		var total_data_1 = 0;
		var total_data_2 = 0;
		var total_data_3 = 0;
		var total_data_4 = 0;
		var total_data_5 = 0;
		var total_data_6 = 0;
		var total_data_7 = 0;
		var total_data_8 = 0;
		var total_data_pt = 0;
		var total_data_9 = 0;
		var total_data_10 = 0;


		for (var i = 0; i < r; i++) {
			var emp_id = $(r1[i]).find('td:eq(0)').html();

			var data_1 = $('#unit1_' + emp_id).val() || 0;
			var data_2 = $('#unit2_' + emp_id).val() || 0;
			var data_3 = $('#worked_days' + emp_id).val() || 0;
			var data_4 = $('#leave_with_pay' + emp_id).val() || 0;
			var data_5 = $('#wages' + emp_id).html() || 0;
			var data_6 = $('#bonus' + emp_id).html() || 0;
			var data_7 = $('#total' + emp_id).html() || 0;
			var data_8 = $('#pf' + emp_id).html() || 0;
			var data_pt = $('#pt' + emp_id).html() || 0;
			var data_9 = $('#esic' + emp_id).html() || 0;
			var data_10 = $('#net_wages' + emp_id).html() || 0;


			total_data_1 = parseInt(total_data_1) + parseInt(data_1);
			total_data_2 = parseInt(total_data_2) + parseInt(data_2);
			total_data_3 = parseInt(total_data_3) + parseInt(data_3);
			total_data_4 = parseInt(total_data_4) + parseInt(data_4);
			total_data_5 = parseInt(total_data_5) + parseInt(data_5);
			total_data_6 = parseInt(total_data_6) + parseInt(data_6);
			total_data_7 = parseInt(total_data_7) + parseInt(data_7);
			total_data_8 = parseInt(total_data_8) + parseInt(data_8);
			total_data_pt = parseInt(total_data_pt) + parseInt(data_pt);
			total_data_9 = parseInt(total_data_9) + parseInt(data_9);
			total_data_10 = parseInt(total_data_10) + parseInt(data_10);
		}

		$('#total_data_1').html(total_data_1);
		$('#total_data_2').html(total_data_2);
		$('#total_data_3').html(total_data_3);
		$('#total_data_4').html(total_data_4);
		$('#total_data_5').html(total_data_5);
		$('#total_data_6').html(total_data_6);
		$('#total_data_7').html(total_data_7);
		$('#total_data_8').html(total_data_8);
		$('#total_data_pt').html(total_data_pt);
		$('#total_data_9').html(total_data_9);
		$('#total_data_10').html(total_data_10);


	}


});