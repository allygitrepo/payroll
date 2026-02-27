$(document).ready(function () {

	$(document).on("submit", "#challan_date_form", function (e) {
		e.preventDefault();
		var ttrn1 = $('#trrn').val();
		var crnno1 = $('#crnno').val();
		var wagemonth1 = $('#wagemonth').val();
		var ddate1 = $('#duedate').val();
		var tdateAr = ddate1.split('/');
		var ddate1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();

		var cdate1 = $('#challandate').val();
		if (cdate1 == "") {
			var cdate1 = "";
		}
		else {
			var tdateAr = cdate1.split('/');
			var cdate1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		}

		var ac1 = $('#ac1').val();
		var ac1er = $('#ac1er').val();
		var ac2 = $('#ac2').val();
		var ac10 = $('#ac10').val();
		var ac21 = $('#ac21').val();
		var ac22 = $('#ac22').val();
		var tamount = $('#totalamount').val();
		var rdate = $('#returndate').val();
		if (rdate1 == "") {
			var rdate1 = "";
		}
		else {
			var tdateAr = rdate.split('/');
			var rdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();
		}

		var save_update1 = $('#save_update').val();


		//var sr = 0;
		//	if( (ttrn1 != "")&&(crnno1 != "")&&(wagemonth1 != "")&&(ddate1 != "")&&(cdate1 != "")&&(ac1 != "")&&(ac2 != "")&&(ac10 != "")&&(ac21 != "")&&(ac22 != "")&&(tamount != "")&&(rdate != ""))
		//	{
		$.ajax({

			type: "POST",
			url: baseurl + "notescontroller/save_challan_date",
			dataType: "JSON",
			data: { id: save_update1, ttrn1: ttrn1, crnno1: crnno1, wagemonth1: wagemonth1, ddate1: ddate1, cdate1: cdate1, ac1: ac1, ac1er: ac1er, ac2: ac2, ac10: ac10, ac21: ac21, ac22: ac22, tamount: tamount, rdate: rdate },
			success: function (data) {

				if (data == true) {
					$().toastmessage('showSuccessToast', "Challan Date Save Successfully");
					$('#save_update').val("save");

					$('#trrn').val("");
					$('#crnno').val("");
					$('#wagemonth').val("");
					$('#duedate').val("");
					$('#challandate').val("");
					$('#ac1').val("");
					$('#ac1er').val("");
					$('#ac2').val("");
					$('#ac10').val("");
					$('#ac21').val("");
					$('#ac22').val("");
					$('#totalamount').val("");
					$('#returndate').val("");


					show_challan_date();	//call function show all packingwages
				}
				else {
					$().toastmessage('showSuccessToast', "Challan Date  Save Failed");
				}

			}
		});
		//            return false;

		//	}else{
		//				$().toastmessage('showSuccessToast', "Please Fill All Data");
		//	}

	});




	/*		//delete row from  KYC detail div
		$(document).on("click",".del_row_challan",function(e){
			e.preventDefault();
			$(this).parent().parent().remove();
		});
	*/
	/*-----------------------------cust/party click on edit--------------------------------------*/
	$(document.body).on('focusout', '#wagemonth', function () {
		var wagemonth = $('#wagemonth').val();
		var tdateAr = wagemonth.split('/');
		var year = tdateAr[1];
		var month = parseInt(tdateAr[0]) + parseInt(1);
		if (month == 13) {
			month = '1';
			year = parseInt(year) + parseInt(1);
		}
		if (month < 10) { month = '0' + month; }
		var duedate = '15/' + month + '/' + year;
		$('#duedate').val(duedate);
	});

	$(document.body).on('focusout', '.a_c', function () {
		var ac1 = $('#ac1').val();
		var ac1er = $('#ac1er').val();
		var ac2 = $('#ac2').val();
		var ac10 = $('#ac10').val();
		var ac21 = $('#ac21').val();
		var ac22 = $('#ac22').val();

		if (ac1er == "") { var ac1er = 0; }
		if (ac1 == "") { var ac1 = 0; }
		if (ac2 == "") { var ac2 = 0; }
		if (ac10 == "") { var ac10 = 0; }
		if (ac21 == "") { var ac21 = 0; }
		if (ac22 == "") { var ac22 = 0; }

		var total = parseInt(ac1) + parseInt(ac1er) + parseInt(ac2) + parseInt(ac10) + parseInt(ac21) + parseInt(ac22);

		$('#totalamount').val(total);

	});





	/*---------view challan date list start-----------------*/

	show_challan_date();	//call function show all packingwages


	function show_challan_date() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "notescontroller/show_challan_date",
			dataType: 'json',
			success: function (data) {
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th><center>Action</center></th>' +
					'<th style="white-space:nowrap;"><center>Sr No.</center></th>' +
					'<th style="white-space:nowrap;">TRRN</th>' +
					'<th style="white-space:nowrap;">CRN No</th>' +
					'<th style="white-space:nowrap;">Wage Month</th>' +
					'<th style="white-space:nowrap;">Due Date</th>' +
					'<th style="white-space:nowrap;">Challan Date</th>' +
					'<th style="white-space:nowrap;">A/C 1 (EE)</th> ' +
					'<th style="white-space:nowrap;">A/C 1 (ER)</th>' +
					'<th style="white-space:nowrap;">A/C 2</th>' +
					'<th style="white-space:nowrap;">A/C 10</th>' +
					'<th style="white-space:nowrap;">A/C 21</th>' +
					'<th style="white-space:nowrap;">A/C 22</th>' +
					'<th style="white-space:nowrap;">Total Amount</th>' +
					'<th style="white-space:nowrap;">Return Date</th></tr></thead><tbody id="">';
				var i;
				for (i = 0; i < data.length; i++) {

					var due_date = data[i].due_date;
					if (due_date == "0000-00-00") {
						var due_date = "";
					}
					else {
						var fdateAr = due_date.split('-');
						var due_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					}

					var challan_date = data[i].challan_date;
					if (challan_date == "0000-00-00") {
						var challan_date = "";
					}
					else {
						var fdateAr = challan_date.split('-');
						var challan_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					}


					var return_date = data[i].return_date;
					if (return_date == "0000-00-00") {
						var return_date = "";
					}
					else {
						var fdateAr = return_date.split('-');
						var return_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					}


					var sr = i + 1;
					html += '<tr>' +
						'<td  style="white-space:nowrap;" ><a  class="edit_row btn btn-sm btn-primary"  id="' + data[i].challan_date_id + '"  ><i class="fa fa-edit"></i></a>				<a class="delete_row btn btn-sm btn-danger" type="submit" id="' + data[i].challan_date_id + '" ><i class="fa fa-trash"></i></a></td>' +
						'<td>' + sr + '</td>' +
						'<td  style="white-space:nowrap;" id="ttrn' + data[i].challan_date_id + '">' + data[i].ttrn + '</td>' +
						'<td  style="white-space:nowrap;" id="crn_no' + data[i].challan_date_id + '">' + data[i].crn_no + '</td>' +
						'<td  style="white-space:nowrap;" id="wage_month' + data[i].challan_date_id + '">' + data[i].wage_month + '</td>' +
						'<td  style="white-space:nowrap;" id="due_date' + data[i].challan_date_id + '">' + due_date + '</td>' +
						'<td  style="white-space:nowrap;" id="challan_date' + data[i].challan_date_id + '">' + challan_date + '</td>' +
						'<td  style="white-space:nowrap;" id="ac1ee' + data[i].challan_date_id + '">' + data[i].ac1ee + '</td>' +
						'<td  style="white-space:nowrap;" id="ac1er' + data[i].challan_date_id + '">' + data[i].ac1er + '</td>' +
						'<td  style="white-space:nowrap;" id="ac2_' + data[i].challan_date_id + '">' + data[i].ac2 + '</td>' +
						'<td  style="white-space:nowrap;" id="ac10' + data[i].challan_date_id + '">' + data[i].ac10 + '</td>' +
						'<td  style="white-space:nowrap;" id="ac21' + data[i].challan_date_id + '">' + data[i].ac21 + '</td>' +
						'<td  style="white-space:nowrap;" id="ac22' + data[i].challan_date_id + '">' + data[i].ac22 + '</td>' +
						'<td  style="white-space:nowrap;" id="total_amount' + data[i].challan_date_id + '">' + data[i].total_amount + '</td>' +
						'<td  style="white-space:nowrap;" id="return_date' + data[i].challan_date_id + '">' + return_date + '</td>' +
						'</tr>';
				}
				html += '</tbody></table>';
				$('#table_data1').html(html);




				var msg = "Challan Date List";
				$('#example1').dataTable({
					'bDestroy': true,
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
	/*---------view challan date  list end-----------------*/

	/*---------get  challan date entry row  start-----------------*/

	$(document).on('click', '.edit_row', function () {
		var id1 = $(this).attr('id');
		//challan_date_id
		var ttrn = $('#ttrn' + id1).html();
		var crn_no = $('#crn_no' + id1).html();
		var wage_month = $('#wage_month' + id1).html();
		var due_date = $('#due_date' + id1).html();
		var challan_date = $('#challan_date' + id1).html();
		var ac1ee = $('#ac1ee' + id1).html();
		var ac1er = $('#ac1er' + id1).html();
		var ac2 = $('#ac2_' + id1).html();
		var ac10 = $('#ac10' + id1).html();
		var ac21 = $('#ac21' + id1).html();
		var ac22 = $('#ac22' + id1).html();
		var total_amount = $('#total_amount' + id1).html();
		var return_date = $('#return_date' + id1).html();


		$('#trrn').val(ttrn);
		$('#crnno').val(crn_no);
		$('#wagemonth').val(wage_month);
		$('#duedate').val(due_date);
		$('#challandate').val(challan_date);
		$('#ac1').val(ac1ee);
		$('#ac1er').val(ac1er);

		$('#ac2').val(ac2);
		$('#ac10').val(ac10);
		$('#ac21').val(ac21);
		$('#ac22').val(ac22);
		$('#totalamount').val(total_amount);
		$('#returndate').val(return_date);

		$('#save_update').val(id1);

		$("#hide_show").show();
		$("#new").hide();
		$("#close").show();


	});

	/*---------get  challan date entry row  end-----------------*/


	/*---------delete    challan date entry row  start-----------------*/

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


				$.ajax({
					type: "POST",
					url: baseurl + "notescontroller/delete_challan_date",
					dataType: "JSON",
					data: { id: id1 },
					success: function (data) {
						if (data == true) {
							$().toastmessage('showSuccessToast', "Challan Date Delete Successfully");


							show_challan_date();	//call function show all challan date entry					

						}
						else {
							$().toastmessage('showErrorToast', "Challan Date Delete Failed");
						}

					}
				});
				return false;
			});


	});

	/*---------delete    challan date entry row  end-----------------*/



	/*-----------------------------cust/party click on edit--------------------------------------*/

	/* 
		  $(document).on("click",".add_challan_date_entry",function(e){
			e.preventDefault();
			var ttrn1 = $('#trrn').val();		
			var crnno1 = $('#crnno').val();	
			var wagemonth1 = $('#wagemonth').val();
			var ddate1 = $('#duedate').val();
			var cdate1 = $('#challandate').val();
			var ac1 = $('#ac1').val();
			var ac1er = $('#ac1er').val();
			var ac2 = $('#ac2').val();
			var ac10 = $('#ac10').val();
			var ac21 = $('#ac21').val();
			var ac22 = $('#ac22').val();
			var tamount = $('#totalamount').val();
			var rdate = $('#returndate').val();
			
				   
			//var sr = 0;
	   if( (ttrn1 != "")&&(crnno1 != "")&&(wagemonth1 != "")&&(ddate1 != "")&&(cdate1 != "")&&(ac1 != "")&&(ac2 != "")&&(ac10 != "")&&(ac21 != "")&&(ac22 != "")&&(tamount != "")&&(rdate != "")){
		   
		var sr = 1;   
				var appendDiv="<tr class='editrow' ><td>"+sr+"</td><td>"+ttrn1+"</td><td>"+crnno1+"</td><td >"+wagemonth1+"</td><td >"+ddate1+"</td><td  >"+cdate1+"</td><td  >"+ac1+"</td><td>"+ac1er+"</td><td  >"+ac2+"</td><td  >"+ac10+"</td><td  >"+ac21+"</td><td  >"+ac22+"</td><td>"+tamount+"</td><td  >"+rdate+"</td><td><button class='btn btn-danger btn-sm del_row_challan' ><i class='glyphicon glyphicon'>X</i></button></td></tr>";
			$(".challan_date_entry").append(appendDiv);	
		   
	   }else{
		   alert('Please Fill All Data');
	   }
	
		});
			//delete row from  KYC detail div
		$(document).on("click",".del_row_challan",function(e){
			e.preventDefault();
			$(this).parent().parent().remove();
		});
		*/


});