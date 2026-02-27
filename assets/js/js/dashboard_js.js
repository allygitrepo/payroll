$(document).ready(function () {

	//alert('ok');

	/*---------view 58 years old list start-----------------*/

	show_58yearsoldemployee();	//call function show all list
	function show_58yearsoldemployee() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "reportcontroller/show_58yearsold_list",
			dataType: 'json',
			success: function (data) {
				var html = '<table id="example1" class="table table-striped table-bordered table-hover" style="font-size:10px;" cellspacing="0" width="100%"><thead><tr>' +
					'<th>Name</th>' +
					'<th>A/C No</th>' +
					'<th>UAN</th>' +
					'<th>DOB</th>' +
					'<th>Contractor Name</th></tr></thead><tbody>';
				var i;
				for (i = 0; i < data.length; i++) {
					console.log(data[i]);
					var data1 = data[i].split("####");
					var fromdate = data1[4];
					var fdateAr = fromdate.split('-');
					var dob = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					console.log(dob);
					var sr = i + 1;
					html += '<tr>';
					html += '<td>' + data1[1] + '</td>';
					html += '<td>' + data1[2] + '</td>';
					html += '<td>' + data1[3] + '</td>';
					html += '<td>' + dob + '</td>';
					html += '<td>' + data1[6] + '</td>';
					html += '</tr>';

				}
				html += '</tbody></table>';
				$('#oldemployeelist').html(html);




				var msg = "58 Years of Age List";
				$('#example1').dataTable({
					'bDestroy': true,
					'paging': true,  // Table pagination
					'ordering': true,  // Column ordering
					'info': true,  // Bottom left status text
					//		'sScrollX': '100%',
					//      'responsive': true, // https://datatables.net/extensions/responsive/examples/
					// Text translation options
					// Note the required keywords between underscores (e.g _MENU_)
					'pageLength': 5,
					'lengthMenu': [5, 10],
					oLanguage: {
						info: 'Showing page _PAGE_ of _PAGES_',
						sSearch: 'Search all columns:',
						sLengthMenu: '_MENU_ records per page',
						zeroRecords: 'Nothing found - sorry',
						infoEmpty: 'No records available',
					},
				});

			}

		});
	}
	/*---------view 58 years old list start-----------------*/

	/*---------view notes list start-----------------*/

	show_3monthabsentlist();	//call function show all packingwages


	function show_3monthabsentlist() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "monthabsentlist/show_monthabsentlist",
			dataType: 'json',
			success: function (data) {
				var html = '<table id="example2" class="table table-striped table-bordered table-hover" style="font-size:10px;" cellspacing="0" width="100%"><thead><tr>' +
					'<th>Name</th>' +
					'<th>A/C No.</th>' +
					'<th>UAN</th>' +
					'<th>Contactor Name</th>' +
					'</tr></thead><tbody id="">';
				var i;
				for (i = 0; i < data.length; i++) {

					var data1 = data[i].split('####');



					var sr = i + 1;
					html += '<tr>' +
						'<td>' + data1[0] + '</td>' +
						'<td>' + data1[1] + '</td>' +
						'<td>' + data1[2] + '</td>' +
						'<td>' + data1[5] + '</td>' +
						'</tr>';
				}
				html += '</tbody></table>';
				$('#show_absentlist').html(html);




				var msg = "3 Month Absent List";
				$('#example2').dataTable({
					'bDestroy': true,
					'paging': true,  // Table pagination
					'ordering': true,  // Column ordering
					'info': true,  // Bottom left status text

					'pageLength': 5,
					'lengthMenu': [5, 10],

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

				});

			}

		});
	}
	/*---------view packingwages list end-----------------*/



	show_notes();	//call function show all packingwages


	function show_notes() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "notescontroller/dashboard_show_notes",
			dataType: 'json',
			success: function (data) {
				var html = '<table id="example3" class="table   table-hover" cellspacing="0" width="100%"><tbody id="">';
				var i;
				for (i = 0; i < data.length; i++) {

					var fromdate = data[i].note_date;

					var fdateAr = fromdate.split('-');
					var note_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					console.log(note_date);


					var sr = i + 1;
					html += '<tr>' +
						'<td >' + note_date + '</td>' +
						'<td >' + data[i].note + '</td></tr>';
				}
				var j = 0;
/*					var count = 5-data.length;
		            for(j=0; j<data.length; j++){
		                html += '<tr>'+
		                        '<td ></td>'+
	                        '<td ></td></tr>';
					}		
*/	                html += '</tbody></table>';
				$('#show_notes').html(html);




			}

		});
	}
	/*---------view Last Month Data Entered-----------------*/

	show_last_month();	//Last Month Data Entered


	function show_last_month() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "notescontroller/dashboard_show_last_month",
			dataType: 'json',
			success: function (data) {

				$('#last_month').html(data[0]);
				$('#os_amount').html(data[1]);
				$('#os_nos').html(data[2]);
				$('#ps_amount').html(data[3]);
				$('#ps_nos').html(data[4]);
				$('#br_amount').html(data[5]);
				$('#br_nos').html(data[6]);




			}

		});
	}
	/*---------view Last Month Data Entered-----------------*/

	/*---------view Challan & Return Status-----------------*/

	challan_return_status();	//Challan & Return Status


	function challan_return_status() {
		$.ajax({
			type: 'ajax',
			url: baseurl + "notescontroller/challan_return_status",
			dataType: 'json',
			success: function (data) {
				$('#challan_last_month').html(data[0]);
				$('#challan').html(data[1]);
				$('#challan_date').html(data[2]);
				$('#return').html(data[3]);
				$('#return_date').html(data[4]);




			}

		});
	}
	/*---------view Challan & Return Status----------------*/


});