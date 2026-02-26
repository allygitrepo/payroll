function show_contractor() {
    console.log("ALLY: Initializing contractor load...");
    if (typeof baseurl === 'undefined') {
        console.error("ALLY: baseurl is not defined!");
        return;
    }

    $.ajax({
        type: 'ajax',
        url: baseurl + "contractorcontroller/view_contractor",
        async: false,
        dataType: 'json',
        success: function (data) {
            console.log("ALLY: Contractors data received:", data);
            var html = '';
            var i;
            if (data && Array.isArray(data)) {
                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].contractor_id + '" >' + data[i].contractor_name + ' - ' + data[i].pf_code + '</option>';
                }
            } else {
                console.warn("ALLY: No contractor data found or invalid format.", data);
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
                console.log("ALLY: Select2 initialized successfully.");
            } else {
                console.error("ALLY: Select2 library NOT LOADED in jQuery context!");
            }
        },
        error: function (xhr, status, error) {
            console.error("ALLY: AJAX error loading contractors:", status, error, xhr.responseText);
        }
    });
}

$(document).ready(function () {

    show_contractor(); //call function show all address


    var buttonCommon = {
        exportOptions: {
            format: {
                body: function (data, row, column, node) {
                    // Strip $ from salary column to make it numeric
                    return column === 1 ?
                        //                        data.replace( /[$,]/g, '' ) :
                        data.replace(/<br\s*\/?>/ig, "\n") :
                        data;
                }
            },
            //		 columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
        }
    };



    show_packer_entry(); //call function show all packingwages


    function show_packer_entry() {
        var month_year = $('#month_year').val();
        var contractor = $('#contractor1').val();
        console.log("ALLY SOFT SOLUTIONS", contractor);

        if (!contractor || contractor.length === 0) {
            contractor = ["all"];
        }

        $.ajax({
            type: 'POST',
            url: baseurl + "contractorsheet/contractorsalarysheet_show",
            data: { month_year: month_year, contractor: contractor },
            dataType: 'json',
            success: function (data) {
                var html = '<table id="example1" class="table table-striped table-bordered table-hover" style="font-Size:12px;" cellspacing="0" width="100%">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>SR .NO.</th>' +
                    '<th>Employee Name</th>	' +
                    '<th>Quantity</th>	' +
                    '<th>No. of working Day</th>  			' +
                    '<th>Wages</th>  			' +
                    '<th>HRA</th>  		' +
                    '<th>Total</th>  			' +
                    '<th>PF(EE)</th>   			' +
                    '<th>ABRY</th>   			' +
                    //'<th>ER EPF</th>  		' +
                    //'<th>SHARE EPS</th>  		' +
                    '<th>Net Wages</th>  			' +
                    '<th style="max-width:125%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"  >Signature of The Employee</th>' +
                    '+					</tr>' +
                    '</thead>' +
                    '<tbody>';
                var i;
                var data4 = 0;
                var data5 = 0;
                var data6 = 0;
                var data7 = 0;
                var data8 = 0;
                var data9 = 0;
                var data10 = 0;
                var data11 = 0;
                var data12 = 0;
                var data13 = 0;

                for (i = 0; i < data.length; i++) {
                    var sr = i + 1;
                    console.log(data[i]);
                    var data1 = data[i].split("####");

                    $('#month_year').val(data1[3]);

                    if (data1[18] == 1) {

                        abry = -data1[9];
                    } else {
                        abry = 0;
                    }
                    html += '<tr>' +
                        '<td>' + sr + '</td>' +
                        '<td style="white-space:nowrap;width:25%;">' + data1[0] + '<br>Member Id:' + data1[1] + '<br>UAN:' + data1[2] + '</td>' +
                        '<td>' + data1[4] + '</td>' +
                        '<td>' + data1[5] + '</td>' +
                        '<td>' + data1[6] + '</td>' +
                        '<td>' + data1[7] + '</td>' +
                        '<td>' + data1[8] + '</td>' +
                        '<td>' + data1[9] + '</td>' +
                        '<td>' + abry + '</td>' +
                        //'<td>' + data1[10] + '</td>' +
                        //'<td>' + data1[11] + '</td>' +
                        '<td>' + data1[12] + '</td>' +
                        '<td></td>' +
                        '</tr>';
                    data4 = parseInt(data4) + parseInt(data1[4]);
                    data5 = parseInt(data5) + parseInt(data1[5]);
                    data6 = parseInt(data6) + parseInt(data1[6]);
                    data7 = parseInt(data7) + parseInt(data1[7]);
                    data8 = parseInt(data8) + parseInt(data1[8]);
                    data9 = parseInt(data9) + parseInt(data1[9]);
                    data10 = parseInt(data10) + parseInt(data1[10]);
                    data11 = parseInt(data11) + parseInt(data1[11]);
                    data12 = parseInt(data12) + parseInt(data1[12]);
                    data13 = parseInt(data13) + parseInt(abry);
                    var msgtop = "COMPANY NAME : " + data1[13] + " , ADDRESS:  " + data1[14] + " , POSTOFFICE:  " + data1[15] + " , DISTRICT:  " + data1[16] + " , PINCODE:  " + data1[17];

                }
                html += '</tbody>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th></th><th  ><b>Total<b></th>' +
                    '<th  >' + data4 + '</th>  	' +
                    '<th  >' + data5 + '</th>  ' +
                    '<th  >' + data6 + '</th>  		' +
                    '<th  >' + data7 + '</th>  			' +
                    '<th  >' + data8 + '</th>  		' +
                    '<th  >' + data9 + '</th>  			' +
                    '<th  >' + data13 + '</th>  			' +
                    //'<th  >' + data10 + '</th>  			' +
                    //'<th  >' + data11 + '</th>  			' +
                    '<th  >' + data12 + '</th>  			' +
                    '<th  ></th>  			' +
                    '</tr>' +
                    '</tfoot>' +
                    '</table>';
                $('#table_data1').html(html);
                var month_year = $('#month_year').val();

                // For multi-select, getting text is more complex, just show a summary in PDF title
                var selectedCount = $('#contractor1').val() ? $('#contractor1').val().length : 0;
                var contractorSummary = selectedCount > 0 ? selectedCount + " Contractors" : "ALL";

                var msg = '';
                var pdfFilename = '';

                if (contractorSummary == 'ALL') {
                    msg = "Contractor Salary Sheet_" + month_year;
                    pdfFilename = "All_Contractors_" + month_year.replace('/', '_');
                } else {
                    msg = "Home Worker (" + contractorSummary + ") - " + month_year;
                    pdfFilename = "Salary_Sheet_" + month_year.replace('/', '_');
                }


                // Group data by contractor for ZIP export
                var contractorGroups = {};
                var allRowsData = [];
                for (var j = 0; j < data.length; j++) {
                    var rowData = data[j].split("####");
                    var cId = rowData[20];
                    var cName = rowData[19];
                    if (!contractorGroups[cId]) {
                        contractorGroups[cId] = {
                            name: cName,
                            rows: []
                        };
                    }
                    contractorGroups[cId].rows.push(rowData);
                    allRowsData.push(rowData);
                }

                $('#example1').dataTable({
                    'stateSave': true,
                    'bDestroy': true,
                    'paging': true,
                    'ordering': true,
                    'info': true,
                    oLanguage: {
                        sSearch: 'Search all columns:',
                        sLengthMenu: '_MENU_ records per page',
                        info: 'Showing page _PAGE_ of _PAGES_',
                        zeroRecords: 'Nothing found - sorry',
                        infoEmpty: 'No records available',
                        infoFiltered: '(filtered from _MAX_ total records)'
                    },
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 rows', '25 rows', '50 rows', 'Show all']
                    ],
                    buttons: [
                        $.extend(true, {}, buttonCommon, {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            className: 'btn-sm',
                            title: msg,
                            messageTop: msgtop,
                            footer: true,
                            header: true,
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ':visible'
                            },
                            filename: pdfFilename,
                            action: function (e, dt, node, config) {
                                var groupCount = Object.keys(contractorGroups).length;

                                if (groupCount > 1) {
                                    console.log("ALLY: Multiple contractors detected, generating ZIP...");
                                    var zip = new JSZip();
                                    var zipFilename = "Contractor_Salaries_" + month_year.replace('/', '_') + ".zip";
                                    var count = 0;
                                    var totalGroups = groupCount;

                                    $.each(contractorGroups, function (cid, group) {
                                        var groupMsgTop = "COMPANY NAME : " + group.rows[0][13] + " , ADDRESS:  " + group.rows[0][14] + " , POSTOFFICE:  " + group.rows[0][15] + " , DISTRICT:  " + group.rows[0][16] + " , PINCODE:  " + group.rows[0][17];
                                        var groupMsg = month_year;
                                        var groupPdfFilename = group.name.replace(/\s+/g, '_') + "_" + month_year.replace('/', '_') + ".pdf";

                                        var body = [];
                                        body.push(['SR .NO.', 'Employee Name', 'Quantity', 'No. of working Day', 'Wages', 'HRA', 'Total', 'PF(EE)', 'ABRY', 'Net Wages', 'Signature']);

                                        var gTotalQty = 0, gTotalDays = 0, gTotalWages = 0, gTotalBonus = 0, gTotalAll = 0, gTotalPF = 0, gTotalABRY = 0, gTotalNet = 0;

                                        for (var k = 0; k < group.rows.length; k++) {
                                            var r = group.rows[k];
                                            var gAbry = (r[18] == "1") ? -parseFloat(r[9]) : 0;
                                            body.push([
                                                (k + 1).toString(),
                                                r[0] + "\nMember Id:" + r[1] + "\nUAN:" + r[2],
                                                r[4], r[5], r[6], r[7], r[8], r[9], gAbry.toString(), r[12], ''
                                            ]);
                                            gTotalQty += parseInt(r[4]);
                                            gTotalDays += parseInt(r[5]);
                                            gTotalWages += parseInt(r[6]);
                                            gTotalBonus += parseInt(r[7]);
                                            gTotalAll += parseInt(r[8]);
                                            gTotalPF += parseInt(r[9]);
                                            gTotalABRY += gAbry;
                                            gTotalNet += parseInt(r[12]);
                                        }

                                        body.push(['', 'Total', gTotalQty.toString(), gTotalDays.toString(), gTotalWages.toString(), gTotalBonus.toString(), gTotalAll.toString(), gTotalPF.toString(), gTotalABRY.toString(), gTotalNet.toString(), '']);

                                        var docDefinition = {
                                            pageOrientation: 'landscape',
                                            pageSize: 'A4',
                                            content: [
                                                { text: groupMsg, style: 'header' },
                                                { text: groupMsgTop, style: 'subheader' },
                                                {
                                                    table: {
                                                        headerRows: 1,
                                                        widths: ['auto', '15%', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', 'auto', '*'],
                                                        body: body
                                                    }
                                                }
                                            ],
                                            styles: {
                                                header: { fontSize: 10, bold: true, margin: [0, 0, 0, 10], alignment: 'center' },
                                                subheader: { fontSize: 8, margin: [0, 0, 0, 5], alignment: 'center' },
                                                tableExample: { margin: [0, 5, 0, 15] }
                                            },
                                            defaultStyle: { fontSize: 8, alignment: 'center' }
                                        };

                                        pdfMake.createPdf(docDefinition).getBlob(function (blob) {
                                            zip.file(groupPdfFilename, blob);
                                            count++;
                                            if (count === totalGroups) {
                                                zip.generateAsync({ type: "blob" }).then(function (content) {
                                                    if (typeof saveAs !== 'undefined') {
                                                        saveAs(content, zipFilename);
                                                    } else if (typeof Blob !== 'undefined') {
                                                        var link = document.createElement('a');
                                                        link.href = window.URL.createObjectURL(content);
                                                        link.download = zipFilename;
                                                        document.body.appendChild(link);
                                                        link.click();
                                                        document.body.removeChild(link);
                                                    } else {
                                                        alert("Your browser does not support downloading files.");
                                                    }
                                                });
                                            }
                                        });
                                    });
                                } else {
                                    console.log("ALLY: Single contractor or all, downloading standard PDF...");
                                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
                                }
                            },
                            customize: function (doc) {
                                doc.defaultStyle.fontSize = 8;
                                doc.styles.tableHeader.fontSize = 8;
                                doc.styles.tableFooter.fontSize = 8;
                                doc.defaultStyle.alignment = 'center';
                                doc.content[2].table.widths = ['2%', '15%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '40%'];
                            }
                        })
                    ]
                });

            }

        });
    }





    $(document).on('click', '#btn_insert', function () {
        show_packer_entry(); //call function show all packingwages		
    });



});