
$(document).ready(function () {
	console.log("=== Gratuity Report Page Loaded ===");
	//	show_packer_entry();	//call function show all packingwages
	/*---------get  contracor  end-----------------*/

	// Load default data on page load
	console.log("Step 1: Calling load_default_gratuity_data()");
	load_default_gratuity_data();

	$(document).on('change', '#typeEmp', function () {

		var emptype = $('#typeEmp').val();
		console.log("Employee type changed to:", emptype);

		if (emptype == "BIDI MAKER") {
			$("#contractor1").prop('disabled', false).trigger('change');
			console.log("Contractor dropdown enabled");
		}
		else {
			$("#contractor1").prop('disabled', true).val(null).trigger('change');
			console.log("Contractor dropdown disabled and cleared");
		}

	});




	show_contractor();	//call function show all address
	function show_contractor() {
		console.log("Step 2: Loading contractors list...");
		$.ajax({
			type: 'GET',
			url: baseurl + "contractorcontroller/view_contractor",
			//		        async : false,
			dataType: 'json',
			global: false, // Don't trigger global AJAX events (loader)
			beforeSend: function () {
				console.log("Contractor AJAX: Request started");
			},
			success: function (data) {
				console.log("Contractor AJAX: Success - Received", data.length, "contractors");
				var html = '';
				var i;
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].contractor_id + '" >' + data[i].contractor_name + ' - ' + data[i].pf_code + '</option>';
				}
				$('#contractor1').html(html);

				// Initialize Select2
				if ($.fn.select2) {
					$('#contractor1').select2({
						theme: "bootstrap",
						placeholder: "Select Contractors",
						allowClear: true,
						closeOnSelect: true,
						width: '100%'
					});
					console.log("Gratuity: Select2 initialized successfully.");
				}
			},
			error: function (xhr, status, error) {
				console.error("Contractor AJAX: Error -", status, error);
			}
		});
	}

	// Function to load default gratuity data
	function load_default_gratuity_data() {
		console.log("=== load_default_gratuity_data() START ===");
		$("#wait").show(); // Show loader
		$.ajax({
			type: 'POST',
			url: baseurl + "Reportcontroller/show_gratuitycalculation_default",
			dataType: 'json',
			global: false,
			timeout: 30000,
			success: function (data) {
				$("#wait").hide();
				if (data && data.length > 1) {
					render_gratuity_table(data, "Latest 7 Records");
				} else {
					$('#show_gratuitycalculation').html('<div class="alert alert-info" style="margin:20px;"><strong>Info:</strong> No employees found with 5+ years of service.</div>');
				}
			},
			error: function (xhr, status, error) {
				$("#wait").hide();
				$('#show_gratuitycalculation').html('<div class="alert alert-warning" style="margin:20px;">Unable to load data.</div>');
			}
		});
	}

	// Function to render gratuity table
	function render_gratuity_table(data, tableTitle) {
		if ($.fn.DataTable.isDataTable('#example1')) {
			$('#example1').DataTable().destroy();
		}

		var headerInfo = data[0];
		var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">' +
			'<thead>' +
			'<tr>' +
			'<th>SR No.</th>' +
			'<th>Employee Name</th>' +
			'<th>DOJ</th>' +
			'<th>DOR</th>' +
			'<th>Total Year of Working</th>' +
			'<th id="year_1" >' + headerInfo.year1 + '</th>' +
			'<th id="year_2" >' + headerInfo.year2 + '</th>' +
			'<th id="year_3" >' + headerInfo.year3 + '</th>' +
			'<th id="year_4" >' + headerInfo.year4 + '</th>' +
			'<th id="year_5" >' + headerInfo.year5 + '</th>' +
			'<th>Salary</th>' +
			'<th>Gratuity Amount</th>' +
			'</tr></thead><tbody id="">';

		var contractorGroups = {};

		for (var i = 1; i < data.length; i++) {
			var row = data[i];
			var gratuity = 0;
			if ((row.total_years > 5) && (row.gtotal_days0 >= 240) && (row.gtotal_days1 >= 240) && (row.gtotal_days2 >= 240) && (row.gtotal_days3 >= 240) && (row.gtotal_days4 >= 240)) {
				gratuity = (row.salary / 26) * (row.total_years) * 15;
			}

			html += '<tr>' +
				'<td>' + i + '</td>' +
				'<td>' + row.name_as_aadhaar + '</td>' +
				'<td>' + row.doj + '</td>' +
				'<td>' + row.dor + '</td>' +
				'<td>' + row.total_years + '</td>' +
				'<td>' + row.gtotal_days0 + '</td>' +
				'<td>' + row.gtotal_days1 + '</td>' +
				'<td>' + row.gtotal_days2 + '</td>' +
				'<td>' + row.gtotal_days3 + '</td>' +
				'<td>' + row.gtotal_days4 + '</td>' +
				'<td>' + row.salary + '</td>' +
				'<td>' + Math.round(gratuity) + '</td>' +
				'</tr>';

			// For ZIP export grouping
			var cid = row.contractor_id;
			if (!contractorGroups[cid]) {
				contractorGroups[cid] = { name: row.contractor_name, rows: [] };
			}
			contractorGroups[cid].rows.push({
				row: row,
				gratuity: Math.round(gratuity)
			});
		}
		html += '</tbody></table>';

		$('#show_gratuitycalculation').html(html);

		var filename = 'gratuityReport';
		var dateVal = $('#date').val();
		var yearVal = $('#year').val();

		if (dateVal && yearVal) {
			var dateParts = dateVal.split('/');
			if (dateParts.length === 3) {
				var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				filename = 'gratuityReport_' + monthNames[parseInt(dateParts[1]) - 1] + '_' + yearVal;
			}
		}

		var msg = "Gratuity Calculation List" + (tableTitle ? " - " + tableTitle : "");

		$('#example1').DataTable({
			'paging': true, 'ordering': true, 'info': true, 'destroy': true,
			oLanguage: { sSearch: 'Search all columns:' },
			dom: 'Bfrtip',
			buttons: [
				'copy', 'excel', 'csv',
				{
					extend: 'pdfHtml5',
					text: 'PDF',
					className: 'btn-sm',
					title: msg,
					orientation: 'landscape',
					pageSize: 'A4',
					filename: filename,
					action: function (e, dt, node, config) {
						var groupCount = Object.keys(contractorGroups).length;
						if (groupCount > 1) {
							var zip = new JSZip();
							var zipFilename = filename + ".zip";
							var count = 0;
							var totalGroups = groupCount;

							$.each(contractorGroups, function (cid, group) {
								var groupPdfFilename = group.name.replace(/\s+/g, '_') + "_Gratuity_" + yearVal + ".pdf";
								var body = [];
								body.push(['SR No.', 'Employee Name', 'DOJ', 'DOR', 'Working Years', headerInfo.year1, headerInfo.year2, headerInfo.year3, headerInfo.year4, headerInfo.year5, 'Salary', 'Gratuity']);

								$.each(group.rows, function (idx, item) {
									var r = item.row;
									body.push([
										(idx + 1).toString(), r.name_as_aadhaar, r.doj, r.dor, r.total_years,
										r.gtotal_days0, r.gtotal_days1, r.gtotal_days2, r.gtotal_days3, r.gtotal_days4,
										r.salary, item.gratuity.toString()
									]);
								});

								var docDefinition = {
									pageOrientation: 'landscape', pageSize: 'A4',
									content: [
										{ text: "Gratuity Calculation Report - " + group.name, style: 'header' },
										{ text: yearVal ? "Year: " + yearVal : "", style: 'subheader' },
										{
											table: {
												headerRows: 1,
												widths: ['auto', '*', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto'],
												body: body
											}
										}
									],
									styles: {
										header: { fontSize: 12, bold: true, margin: [0, 0, 0, 10], alignment: 'center' },
										subheader: { fontSize: 10, margin: [0, 0, 0, 5], alignment: 'center' }
									},
									defaultStyle: { fontSize: 8, alignment: 'center' }
								};

								pdfMake.createPdf(docDefinition).getBlob(function (blob) {
									zip.file(groupPdfFilename, blob);
									count++;
									if (count === totalGroups) {
										zip.generateAsync({ type: "blob" }).then(function (content) {
											if (typeof saveAs !== 'undefined') { saveAs(content, zipFilename); }
											else {
												var link = document.createElement('a');
												link.href = window.URL.createObjectURL(content);
												link.download = zipFilename;
												document.body.appendChild(link);
												link.click();
												document.body.removeChild(link);
											}
										});
									}
								});
							});
						} else {
							$.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
						}
					}
				}
			]
		});
	}


	$(document).on('submit', '#gratuityform', function (e) {
		e.preventDefault();
		var year = $('#year').val();
		var date = $('#date').val();
		var emptype = $('#typeEmp').val();
		var contractor = $('#contractor1').val();

		if (!contractor || contractor.length === 0) {
			contractor = "all";
		}

		if ((year == "") || (date == "") || (emptype == "") || (emptype == null)) {
			$().toastmessage('showErrorToast', "Please fill all required fields");
		} else {
			$("#wait").show();
			$.ajax({
				type: 'POST',
				url: baseurl + "Reportcontroller/show_gratuitycalculation",
				data: { date: date, year: year, emptype: emptype, contractor: contractor },
				dataType: 'json',
				global: false,
				timeout: 30000,
				success: function (data) {
					$("#wait").hide();
					if (data && data.length > 1) {
						render_gratuity_table(data, "Filtered Results");
					} else {
						$('#show_gratuitycalculation').html('<div class="alert alert-info" style="margin:20px;">No data found.</div>');
					}
				},
				error: function (xhr, status, error) {
					$("#wait").hide();
					$('#show_gratuitycalculation').html('<div class="alert alert-danger" style="margin:20px;">Error loading data.</div>');
				}
			});
		}
	});



});

