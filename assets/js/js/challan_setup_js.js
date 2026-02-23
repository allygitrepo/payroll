$(document).ready(function () {

	/*---------insert address  start-----------------*/
	//        $('#btn_save').on('submit',function(e){
	//	$("#btn_save").submit(function() {
	//				e.preventDefault();

	$(document).on("submit", "#challan_form", function (e) {
		e.preventDefault();
		var startdate1 = $('#startdate').val();
		var fdateAr = startdate1.split('/');
		var startdate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();

		var enddate1 = $('#enddate').val();
		var fdateAr = enddate1.split('/');
		var enddate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();


		var salarylimit = $('#salarylimit').val();
		var edliwages = $('#edliwages').val();
		var ac1eemale = $('#ac1eemale').val();
		var ac1eefemale = $('#ac1eefemale').val();
		var ac1er = $('#ac1er').val();
		var ac2 = $('#ac2').val();
		var ac10 = $('#ac10').val();
		var ac21 = $('#ac21').val();
		var ac22 = $('#ac22').val();
		var ac2min = $('#ac2min').val();
		var ac22min = $('#ac22min').val();

		var pmrpy = $('#pmrpy').val();
		var esic_wages = $('#esic_wages').val();
		var employee_share = $('#employee_share').val();
		var employer_share = $('#employer_share').val();
		var save_update1 = $('#save_update').val();

		$.ajax({

			type: "POST",
			url: baseurl + "challansetup/save_challansetup",
			dataType: "JSON",
			data: {
				esic_wages: esic_wages, employee_share: employee_share, employer_share: employer_share, id: save_update1, startdate: startdate1, enddate: enddate1, salarylimit: salarylimit, edliwages: edliwages, ac1eemale: ac1eemale,
				ac1eefemale: ac1eefemale, ac1er: ac1er, ac2: ac2, ac10: ac10, ac21: ac21, ac22: ac22, ac2min: ac2min, ac22min: ac22min, pmrpy: pmrpy
			},
			success: function (data) {
				//salert(data);
				if (data == true) {
					$().toastmessage('showSuccessToast', "Challan Data Save Successfully");
					$('#startdate').val("");
					$('#enddate').val("");
					$('#salarylimit').val("");
					$('#edliwages').val("");
					$('#ac1eemale').val("");
					$('#ac1eefemale').val("");
					$('#ac1er').val("");
					$('#ac2').val("");
					$('#ac10').val("");
					$('#ac21').val();
					$('#ac22').val("");
					$('#ac2min').val("");
					$('#ac22min').val("");
					$('#pmrpy').val("");
					$('#esic_wages').val("");
					$('#employee_share').val("");
					$('#employer_share').val("");
					$('#save_update').val("add");
					$("#hide_show").hide();
					$("#new").show();

					show_challansetup();	//call function show all packingwages
				}
				else if (data == 0) {
					$().toastmessage('showErrorToast', "Challan Data Save Failed");
				}

			}
		});
		return false;

	});
	/*---------insert address  end-----------------*/

	/*---------view challansetup list start-----------------*/

	show_challansetup();	//call function show all challansetup


	function show_challansetup() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "challansetup/show_challansetup",
			async: false,
			dataType: 'json',
			success: function (data) {


				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>' +
					'<th style="white-space:nowrap;">Sr. No.</th>' +
					'<th style="white-space:nowrap;" >Start Date</th>' +
					'<th style="white-space:nowrap;" >End Date</th>' +
					'<th style="white-space:nowrap;" >Salary Limit</th>' +
					'<th style="white-space:nowrap;" >EDLI Wages</th>' +
					'<th style="white-space:nowrap;" >A/c No.1 EE (Male)</th>' +
					'<th style="white-space:nowrap;" >A/c No.1 EE (Female)</th>' +
					'<th style="white-space:nowrap;" >A/c No. 1 ER</th>' +
					'<th style="white-space:nowrap;" >A/c No.2</th>' +
					'<th style="white-space:nowrap;" >A/c No. 10</th>' +
					'<th style="white-space:nowrap;" >A/c No. 21</th>' +
					'<th style="white-space:nowrap;" >A/c No. 22</th>' +
					'<th style="white-space:nowrap;" >A/c no.2 Min</th>' +
					'<th style="white-space:nowrap;" >A/c no.22 Min</th>' +
					'<th style="white-space:nowrap;" >PMRPY</th>' +
					'<th style="white-space:nowrap;" >ESIC Wages</th>' +
					'<th style="white-space:nowrap;" >Employee Share</th>' +
					'<th style="white-space:nowrap;" >Employer Share</th>' +
					'<th style="white-space:nowrap;" ><center>Action</center></th></tr></thead><tbody id="">';
				var i;
				for (i = 0; i < data.length; i++) {

					var fromdate = data[i].from_date;

					var fdateAr = fromdate.split('-');
					var from_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();

					var todate = data[i].to_date;

					var tdateAr = todate.split('-');
					var to_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					var sr = i + 1;
					html += '<tr>' +
						'<td>' + sr + '</td>' +
						'<td id="from_date' + data[i].challan_id + '">' + from_date + '</td>' +
						'<td id="to_date' + data[i].challan_id + '">' + to_date + '</td>' +
						'<td id="salarylimit' + data[i].challan_id + '">' + data[i].salarylimit + '</td>' +
						'<td id="edliwages' + data[i].challan_id + '">' + data[i].edliwages + '</td>' +
						'<td id="ac1eemale' + data[i].challan_id + '">' + data[i].ac1eemale + '</td>' +
						'<td id="ac1eefemale' + data[i].challan_id + '">' + data[i].ac1eefemale + '</td>' +
						'<td id="ac1er' + data[i].challan_id + '">' + data[i].ac1er + '</td>' +
						'<td id="ac_2' + data[i].challan_id + '">' + data[i].ac2 + '</td>' +
						'<td id="ac10' + data[i].challan_id + '">' + data[i].ac10 + '</td>' +
						'<td id="ac21' + data[i].challan_id + '">' + data[i].ac21 + '</td>' +
						'<td id="ac22' + data[i].challan_id + '">' + data[i].ac22 + '</td>' +
						'<td id="ac2min' + data[i].challan_id + '">' + data[i].ac2min + '</td>' +
						'<td id="ac22min' + data[i].challan_id + '">' + data[i].ac22min + '</td>' +
						'<td id="pmrpy' + data[i].challan_id + '">' + data[i].pmrpy + '</td>' +
						'<td id="esic_wages' + data[i].challan_id + '">' + data[i].esic_wages + '</td>' +
						'<td id="employee_share' + data[i].challan_id + '">' + data[i].employee_share + '</td>' +
						'<td id="employer_share' + data[i].challan_id + '">' + data[i].employer_share + '</td>' +
						'<td><button  class="edit_row btn btn-xs btn-primary"  id="' + data[i].challan_id + '"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-xs btn-danger" type="submit" id="' + data[i].challan_id + '" ><i class="fa fa-trash"></i></button></td>' +
						'</tr>';
					//alert(data[i].ac2);								
				}
				html += '</tbody></table>';
				$('#show_packingwages').html(html);




				var msg = "challansetup List";
				$('#example1').dataTable({
					'scrollX': true,  // Table pagination
					'paging': true,  // Table pagination
					'ordering': true,  // Column ordering
					'info': true,  // Bottom left status text
					//       'responsive': true, // https://datatables.net/extensions/responsive/examples/
					// Text translation options
					// Note the required keywords between underscores (e.g _MENU_)
					oLanguage: {
						sSearch: 'Search all columns:',
						sLengthMenu: '_MENU_ records per page',
						info: 'Showing page _PAGE_ of _PAGES_',
						zeroRecords: 'Nothing found - sorry',
						infoEmpty: 'No records available',
						infoFiltered: '(filtered from _MAX_ total records)'
					},
					// Datatable Buttons setup
					dom: '<"html5buttons"B>lTfgitp',
					buttons: [
						{ extend: 'copy', className: 'btn-sm', title: msg },
						{ extend: 'csv', className: 'btn-sm', title: msg },
						{ extend: 'excel', className: 'btn-sm', title: msg },
						{ extend: 'pdf', className: 'btn-sm', title: msg },
						{ extend: 'print', className: 'btn-sm', title: msg }
					]
				});

			}

		});
	}
	/*---------view challansetup list end-----------------*/

	/*---------get  challansetup row  start-----------------*/

	$(document).on('click', '.edit_row', function () {

		var id1 = $(this).attr('id');
		var from_date1 = $('#from_date' + id1).html();
		var to_date1 = $('#to_date' + id1).html();
		var salarylimit = $('#salarylimit' + id1).html();
		var edliwages = $('#edliwages' + id1).html();
		var ac1eemale = $('#ac1eemale' + id1).html();
		var ac1eefemale = $('#ac1eefemale' + id1).html();
		var ac1er = $('#ac1er' + id1).html();
		var ac2 = $('#ac_2' + id1).html();

		var ac10 = $('#ac10' + id1).html();
		var ac21 = $('#ac21' + id1).html();
		var ac22 = $('#ac22' + id1).html();
		var ac2min = $('#ac2min' + id1).html();
		var ac22min = $('#ac22min' + id1).html();
		var pmrpy = $('#pmrpy' + id1).html();
		var esic_wages = $('#esic_wages' + id1).html();
		var employee_share = $('#employee_share' + id1).html();
		var employer_share = $('#employer_share' + id1).html();
		$('#startdate').val(from_date1);
		$('#enddate').val(to_date1);
		$('#salarylimit').val(salarylimit);
		$('#edliwages').val(edliwages);
		$('#ac1eemale').val(ac1eemale);
		$('#ac1eefemale').val(ac1eefemale);
		$('#ac1er').val(ac1er);
		$('#ac2').val(ac2);
		$('#ac10').val(ac10);
		$('#ac21').val(ac21);
		$('#ac22').val(ac22);
		$('#ac2min').val(ac2min);
		$('#ac22min').val(ac22min);
		$('#pmrpy').val(pmrpy);
		$('#esic_wages').val(esic_wages);
		$('#employee_share').val(employee_share);
		$('#employer_share').val(employer_share);

		$('#save_update').val(id1);
		$("#hide_show").show();
	});

	/*---------get  challansetup row  end-----------------*/



	/*---------delete    challansetup row  start-----------------*/

	$(document).on('click', '.delete_row', function () {
		var id1 = $(this).attr('id');


		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this  Data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: true
		},
			function () {

				//		 $('#myModal').show();
				$.ajax({
					type: "POST",
					url: baseurl + "challansetup/delete_challansetup",
					dataType: "JSON",
					data: { id: id1 },
					success: function (data) {
						if (data == true) {
							$().toastmessage('showSuccessToast', "challansetup Delete Successfully");


							show_challansetup();	//call function show all packingwages

						}
						else {
							$().toastmessage('showErrorToast', "challansetup Delete Failed");
						}

					}
				});
				return false;

			});
	});

	/*---------delete    challansetup row  end-----------------*/



});