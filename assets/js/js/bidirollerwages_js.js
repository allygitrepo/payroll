$(document).ready(function() {
	
/*---------insert address  start-----------------*/
//        $('#btn_save').on('submit',function(e){
//	$("#btn_save").submit(function() {
//				e.preventDefault();
		
    $(document).on("submit","#bidirollewages_form",function(e){
			e.preventDefault();
			var startdate1 = $('#startdate').val();
			
					var fdateAr = startdate1.split('/');
					var startdate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();

			
            var enddate1 = $('#enddate').val();
					var fdateAr = enddate1.split('/');
					var enddate1 = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();


            var rate1 = $('#rate1').val();
            var rate2 = $('#rate2').val();
            var bonus1 = $('#bonus1').val();  
            var bonus2 = $('#bonus2').val();  
            var hra_bonus1 = $('#hra_bonus1').val();  
            var hra_bonus2 = $('#hra_bonus2').val();  
            var save_update1 = $('#save_update').val();
			$.ajax({
			
                type : "POST",
				url  : baseurl+"bidirollewages/save_bidirollewages",
                dataType : "JSON",
                data : {id:save_update1 ,startdate:startdate1 ,enddate:enddate1,rate1:rate1, rate2:rate2,bonus1:bonus1,bonus2:bonus2,hra_bonus1:hra_bonus1,hra_bonus2:hra_bonus2},
                success: function(data){
//alert(data);
			if(data == true){
				$().toastmessage('showSuccessToast', "Bidirollewages Save Successfully");
                    $('#startdate').val("");
                    $('#enddate').val("");
                    $('#rate1').val("");
                    $('#rate2').val("");
                    $('#bonus1').val("");
                    $('#bonus2').val("");
                    $('#save_update').val("add");
		$("#hide_show").hide();
					$("#new").show();

			}
					else if(data == 0){
				$().toastmessage('showErrorToast', "Selected Date Allready Exist , Please Select Other Date");

			
				}
					show_bidirollewages();	//call function show all packingwages
	
                }
            });
            return false;
	});
/*---------insert address  end-----------------*/

/*---------view packingwages list start-----------------*/

	show_bidirollewages();	//call function show all packingwages
		
	
		function show_bidirollewages(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"bidirollewages/show_bidirollewages",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Sr. No.</th><th>Start Date</th><th>End Date</th><th>Rate1</th><th>HRA1</th><th>Bonus1</th><th>Rate2</th><th>HRA2</th><th>Bonus2</th><th><center>Action</center></th></tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
					var fromdate = data[i].from_date;

					var fdateAr = fromdate.split('-');
					var from_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();

					var todate = data[i].to_date;
					
					var tdateAr = todate.split('-');
					var to_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();

					console.log(from_date);
					console.log(to_date);
					
					
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                        '<td id="from_date'+data[i].id+'">'+from_date+'</td>'+
	                        '<td id="to_date'+data[i].id+'">'+to_date+'</td>'+
	                        '<td id="rate1'+data[i].id+'">'+data[i].rate1+'</td>'+
	                        '<td id="bonus1'+data[i].id+'">'+data[i].bonus1+'</td>'+
	                        '<td id="hra_bonus1'+data[i].id+'">'+data[i].hra_bonus1+'</td>'+
	                        '<td id="rate2'+data[i].id+'">'+data[i].rate2+'</td>'+
	                        '<td id="bonus2'+data[i].id+'">'+data[i].bonus2+'</td>'+
	                        '<td id="hra_bonus2'+data[i].id+'">'+data[i].hra_bonus2+'</td>'+
		                        '<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_bidirollewages').html(html);
					
					
					
  
	   var msg = "Bidirollewages List";
    $('#example1').dataTable({
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
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'excel', className: 'btn-sm', title: msg },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ]
    });
					
		        }

		    });
		}
/*---------view packingwages list end-----------------*/

/*---------get  packingwages row  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		var id1 = $(this).attr('id');
		var from_date1 = $('#from_date'+id1).html();
		var to_date1 = $('#to_date'+id1).html();
		var rate1 = $('#rate1'+id1).html();
		var rate2 = $('#rate2'+id1).html();
		var bonus1 = $('#bonus1'+id1).html();
		var bonus2 = $('#bonus2'+id1).html();
		var hra_bonus1 = $('#hra_bonus1'+id1).html();
		var hra_bonus2 = $('#hra_bonus2'+id1).html();

            $('#startdate').val(from_date1);
            $('#enddate').val(to_date1);
            $('#rate1').val(rate1);
            $('#rate2').val(rate2);
            $('#bonus1').val(bonus1);
            $('#bonus2').val(bonus2);
            $('#hra_bonus1').val(hra_bonus1);
            $('#hra_bonus2').val(hra_bonus2);
			
					$('#save_update').val(id1);
	$("#hide_show").show();
        });
	
/*---------get  packingwages row  end-----------------*/



/*---------delete    packingwages row  start-----------------*/

  	$(document).on('click','.delete_row',function(){
		var id1 = $(this).attr('id');
//		 $('#myModal').show();


		      swal({
        title : "Are you sure?",
        text : "You will not be able to recover this  Data!",
        type : "warning",
        showCancelButton : true,
        confirmButtonColor : "#DD6B55",
        confirmButtonText : "Yes, delete it!",
        closeOnConfirm : true
      },
        function () {


				$.ajax({
                type : "POST",
				url  : baseurl+"bidirollewages/delete_bidirollewages",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Bidirollewages Delete Successfully");
				

									
					show_bidirollewages();	//call function show all packingwages
	
					}
					else{
					$().toastmessage('showErrorToast', "Bidirollewages Delete Failed");
					}
	
                }
            });
            return false;

		
		});
	});
	
/*---------delete    packingwages row  end-----------------*/


	
});