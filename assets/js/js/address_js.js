$(document).ready(function() {
	

/*---------insert address  start-----------------*/

		
    $(document).on("click",".btn_save",function(){
//			e.preventDefault();
			
			var save_update1 = $('#save_update').val();
            var address1 = $('#address').val();
            var postoffice1 = $('#postoffice').val();
            var district1 = $('#district').val();
            var pincode1 = $('#pincode').val();  
			if(address1 == ""){ $('#address').attr('oninvalid','oninvalid'); }
			else if(postoffice1 == ""){ $('#postoffice').attr('oninvalid','oninvalid'); }
			else if(district1 == ""){ $('#district').attr('oninvalid','oninvalid'); }
			else if(pincode1 == ""){ $('#pincode').attr('oninvalid','oninvalid'); }
//			else if(pincode1.length !== 6 ){ $('#pincode').attr('oninvalid','oninvalid'); }
			else{
			
			$.ajax({
                type : "POST",
				url  : baseurl+"addresscontroller/save_address",
                dataType : "JSON",
                data : {id:save_update1 ,address:address1 , postoffice:postoffice1, district:district1,pincode:pincode1},
                success: function(data){
				if(data == true){
				$().toastmessage('showSuccessToast', "Addrss Save Successfully");
                    $('#address').val("");
                    $('#postoffice').val("");
                    $('#district').val("");
                    $('#pincode').val("");
                    $('#save_update').val("add");
					
					show_address();	//call function show all product					
					}
					else{
				$().toastmessage('showErrorToast', "Addrss Save Failed");
						}
	
                }
            });
            return false;
			}
        });
/*---------insert address  end-----------------*/


/*---------view address list start-----------------*/

	show_address();	//call function show all product
		
	
		//function show all product
		function show_address(){
		    $.ajax({
		        type  : 'GET',
				url  : baseurl+"addresscontroller/view_address",
//		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Sr. No.</th>  			<th>Address</th><th>Postoffice</th><th>District</th><th>Pincode</th>  			<th><center>Action</center></th></tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                        '<td id="address'+data[i].id+'">'+data[i].address+'</td>'+
	                        '<td id="postoffice'+data[i].id+'">'+data[i].post_office+'</td>'+
	                        '<td id="district'+data[i].id+'">'+data[i].district+'</td>'+
	                        '<td id="pincode'+data[i].id+'">'+data[i].pincode+'</td>'+
		                        '<td><button  class="edit_address btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_address btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';

					
					
		            $('#show_address').html(html);
					
					
					
  
	   var msg = "Address List";
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
/*---------view address list end-----------------*/


/*---------get  address  start-----------------*/

  	$('#show_address').on('click','.edit_address',function(){
		var id1 = $(this).attr('id');
		var address1 = $('#address'+id1).html();
		var postoffice1 = $('#postoffice'+id1).html();
		var district1 = $('#district'+id1).html();
		var pincode1 = $('#pincode'+id1).html();

            $('#address').val(address1);
            $('#postoffice').val(postoffice1);
            $('#district').val(district1);
            $('#pincode').val(pincode1);
			
					$('#save_update').val(id1);

        });
	
/*---------get  address  start-----------------*/


/*---------delete  address  start-----------------*/

  	$('#show_address').on('click','.delete_address',function(){
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
				url  : baseurl+"addresscontroller/delete_address",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Addrss Delete Successfully");
			
					show_address();	//call function show all product					
					
					}
					else{
					$().toastmessage('showErrorToast', "Addrss Delete Failed");
					}
	
                }
            });
            return false;

		            });

	});
	
/*---------delete  address  end-----------------*/
 
	
});