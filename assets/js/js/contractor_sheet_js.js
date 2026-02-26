$(document).ready(function() {

    show_contractor(); //call function show all address
    function show_contractor() {
        $.ajax({
            type: 'ajax',
            url: baseurl + "contractorcontroller/view_contractor",
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var html1 = '';
                var i;
                html += '<option value="all" selected >ALL</option>';
                for (i = 0; i < data.length; i++) {
                    var sr = i + 1;
                    html += '<option value="' + data[i].contractor_id + '" >' + data[i].contractor_name + ' - ' + data[i].pf_code + '</option>';
                }
                $('#contractor1').html(html);


            }

        });
    }


    var buttonCommon = {
        exportOptions: {
            format: {
                body: function(data, row, column, node) {
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
        console.log("ALLY SOFT SOLUTIONS" + contractor);
        if (contractor == null) {
            contractor = "all";
        }
        $.ajax({
            type: 'POST',
            url: baseurl + "contractorsheet/contractorsalarysheet_show",
            data: { month_year: month_year, contractor: contractor },
            dataType: 'json',
            success: function(data) {
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

                    '</tr>' +
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

                    if(data1[18] == 1){
                        
                        abry = -data1[9];
                    }else{
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
                var contractor1 = $("#contractor1 option:selected").text();
                // alert(contractor1);
                var msg = '';
                var pdfFilename = '';

                if (contractor1 == 'ALL') {
                    msg = "Contractor Salary Sheet_" + month_year;
                    pdfFilename = "All_Contractors_" + month_year.replace('/', '_');
                } else {
                    // Extract contractor name (before the dash)
                    var contractorParts = contractor1.split('-');
                    var contractorName = contractorParts[0].trim();
                    
                    msg = "Home Worker" + "---------------------------------------------------------------------------------------------------------------" + month_year;
                    pdfFilename = contractorName.replace(/\s+/g, '_') + "_" + month_year.replace('/', '_');
                }


                $('#example1').dataTable({
                    'stateSave': true,
                    'bDestroy': true,
                    'paging': true, // Table pagination
                    'ordering': true, // Column ordering
                    'info': true, // Bottom left status text
                    //"lengthMenu": [ 8, 16, 32],
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

                    /*		columnDefs: [
                               { width: 400, targets: 11 }
                           ],
                    	*/


                    // Datatable Buttons setup
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 rows', '25 rows', '50 rows', 'Show all']
                    ],
                    buttons: [

                        $.extend(true, {}, buttonCommon, {
                            extend: 'pdfHtml5',
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
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
                                doc.styles.tableHeader.fontSize = 8;
                                doc.styles.tableFooter.fontSize = 8;
                                doc.defaultStyle.alignment = 'center';

                                doc.content[2].table.widths = ['2%', '15%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '40%'];

                            }

                        })
                    ],

                    defaultStyle: {
                        fontSize: 8
                    }
                });

            }

        });
    }





    $(document).on('click', '#btn_insert', function() {
        show_packer_entry(); //call function show all packingwages		
    });



});