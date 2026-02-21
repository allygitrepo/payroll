$(document).ready(function() {

    show_packer_entry(); //call function show all packingwages


    function show_packer_entry() {
        var month_year = $('#month_year').val();
console.log("month_year:",month_year);
        $.ajax({
            type: 'POST',
            url: baseurl + "pfsummary/pfsummary_show",
            data: { month_year: month_year },
            dataType: 'json',
            success: function(data) {
                var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>' +
                    '<th style="white-space:nowrap;">Sr No.</th>' +
                    '<th style="white-space:nowrap;">Name</th>' +
                    '<th style="white-space:nowrap;">Employee</th>' +
                    '<th style="white-space:nowrap;">TOTAL UNIT WORKED</th>' +
                    '<th style="white-space:nowrap;">Wages</th>' +
                    '<th style="white-space:nowrap;display:none;">Bonus & Others</th>' +
                    '<th style="white-space:nowrap;display:none;">Total</th>' +
                    '<th style="white-space:nowrap;">PF on Wages</th>' +
                    '<th style="white-space:nowrap;">EPF</th>' +
                    '<th style="white-space:nowrap;">EPS</th>' +
                    '<th style="white-space:nowrap;">Net Payment</th>' +
                    '</tr></thead><tbody id="">';
                var i;


                var emp = 0;
                var unit = 0;
                var wages = 0;
                var bonus = 0;
                var total = 0;
                var pf = 0;
                var epf = 0;
                var eps = 0;
                var net = 0;

                for (i = 0; i < data.length; i++) {

                    //console.log(data[i]);
                    var data1 = data[i].split("####");


                    $('#month_year').val(data1[10]);
                    var sr = i + 1;

                    if (data1[0] == "OFFICE STAFF TOTAL") {
                        var sr_no = "A";
                    } else if (data1[0] == "PACKING STAFF TOTAL") {
                        var sr_no = "B";
                    } else {
                        var sr_no = "";
                    }
                    if ((data1[0] == "BIDI ROLLER TOTAL") || (data1[0] == "OFFICE STAFF TOTAL") || (data1[0] == "PACKING STAFF TOTAL")) {
                        console.log("if bidi total" + data1[5]);

                        if (data1[0] == "PACKING STAFF TOTAL") {
                            html += '<tr>' +
                                '<td>' + sr_no + '</td>' +
                                '<td style="whiteSpace:nowrap;"><b>' + data1[0] + '</b></td>' +
                                '<td  style="white-space:nowrap;"><b>' + data1[1] + '</b></td>' +
                                '<td ><b>' + data1[2] + '</b></td>' +
                                '<td ><b>' + data1[5] + '</b></td>' +
                                // '<td ><b>' + data1[3] + '</b></td>' +
                                '<td style="display:none;"><b>' + data1[4] + '</b></td>' +

                                '<td  style="display:none;"><b>' + data1[5] + '</b></td>' +
                                '<td ><b>' + data1[6] + '</b></td>' +
                                '<td ><b>' + data1[7] + '</b></td>' +
                                '<td ><b>' + data1[8] + '</b></td>' +
                                '<td ><b>' + data1[9] + '</b></td>' +
                                '</tr>';
                        } else {
                            html += '<tr>' +
                                '<td>' + sr_no + '</td>' +
                                '<td style="whiteSpace:nowrap;"><b>' + data1[0] + '</b></td>' +
                                '<td  style="white-space:nowrap;"><b>' + data1[1] + '</b></td>' +
                                '<td ><b>' + data1[2] + '</b></td>' +
                                //'<td ><b>' + data1[5] + '</b></td>' +
                                '<td ><b>' + data1[3] + '</b></td>' +
                                '<td style="display:none;"><b>' + data1[4] + '</b></td>' +

                                '<td  style="display:none;"><b>' + data1[5] + '</b></td>' +
                                '<td ><b>' + data1[6] + '</b></td>' +
                                '<td ><b>' + data1[7] + '</b></td>' +
                                '<td ><b>' + data1[8] + '</b></td>' +
                                '<td ><b>' + data1[9] + '</b></td>' +
                                '</tr>';
                        }

                    } else if (data1[0] == "") {
                        console.log("else if bidi total" + data1[5]);

                        html += '<tr>' +
                            '<td></td>' +
                            '<td style="whiteSpace:nowrap;">' + data1[0] + '</td>' +
                            '<td  style="white-space:nowrap;">' + data1[1] + '</td>' +
                            '<td >' + data1[2] + '</td>' +
                            '<td >' + data1[5] + '</td>' +
                            // '<td >' + data1[3] + '</td>' +
                            '<td style="display:none;">' + data1[4] + '</td>' +
                            '<td style="display:none;">' + data1[5] + '</td>' +
                            '<td >' + data1[6] + '</td>' +
                            '<td >' + data1[7] + '</td>' +
                            '<td >' + data1[8] + '</td>' +
                            '<td >' + data1[9] + '</td>' +
                            '</tr>';


                    } else {
                        console.log("else  bidi total" + data1[5]);

                        html += '<tr>' +
                            '<td>' + sr + '</td>' +
                            '<td style="whiteSpace:nowrap;">' + data1[0] + '</td>' +
                            '<td  style="white-space:nowrap;">' + data1[1] + '</td>' +
                            '<td >' + data1[2] + '</td>' +
                            '<td >' + data1[5] + '</td>' +
                            //'<td >' + data1[3] + '</td>' +
                            '<td style="display:none;">' + data1[4] + '</td>' +
                            '<td style="display:none;">' + data1[5] + '</td>' +
                            '<td >' + data1[6] + '</td>' +
                            '<td >' + data1[7] + '</td>' +
                            '<td >' + data1[8] + '</td>' +
                            '<td >' + data1[9] + '</td>' +
                            '</tr>';

                    }


                    if ((data1[0] == "BIDI ROLLER TOTAL") || (data1[0] == "OFFICE STAFF TOTAL") || (data1[0] == "PACKING STAFF TOTAL")) {
                        emp = parseInt(emp) + parseInt(data1[1]);
                        if (data1[0] != "OFFICE STAFF TOTAL") {
                            unit = parseInt(unit) + parseInt(data1[2]);
                        }
                        wages = parseInt(wages) + parseInt(data1[3]);
                        bonus = parseInt(bonus) + parseInt(data1[4]);
                        total = parseInt(total) + parseInt(data1[5]);
                        pf = parseInt(pf) + parseInt(data1[6]);
                        epf = parseInt(epf) + parseInt(data1[7]);
                        eps = parseInt(eps) + parseInt(data1[8]);
                        net = parseInt(net) + parseInt(data1[9]);

                    }

                }

                html += '</tbody><tfoot><tr>' +
                    '<th ></th>' +
                    '<th >Total </th>' +
                    '<th >' + emp + '</th>' +
                    '<th >' + unit + '</th>' +
                    '<th >' + wages + '</th>' +
                    '<th style="display:none;">' + bonus + '</th>' +
                    '<th style="display:none;" >' + total + '</th>' +
                    '<th >' + pf + '</th>' +
                    '<th >' + epf + '</th>' +
                    '<th >' + eps + '</th>' +
                    '<th >' + net + '</th>' +
                    '</tr></tfoot>';
                html += '</table>';
                $('#table_data1').html(html);
                var month_year = $('#month_year').val();

                var msg = "Month_" + month_year;
                $('#example1').dataTable({
                    'bDestroy': true,
                    'paging': false, // Table pagination
                    'ordering': false, // Column ordering
                    'info': true, // Bottom left status text
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
                    buttons: [{
                        extend: 'excel',
                        className: 'btn-sm',
                        filename: msg,
                        title: msg,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 7, 8, 9, 10]
                        },
                        footer: true
                    }, ]
                });

            }

        });
    }

    $(document).on('click', '#btn_insert', function() {
        show_packer_entry();
    });

});