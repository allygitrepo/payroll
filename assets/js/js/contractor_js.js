$(document).ready(function() {
	

/*---------insert/update contractor form start-----------------*/
$(document).on('submit','#contractor_form',function(e){
	e.preventDefault();
	
			var save_update1 = $('#save_update').val();
            var ccode1 = $('#ccode').val();
            var name1 = $('#name').val();
            var address1 = $('#address_list').val();
            var pfcode1 = $('#pfcode').val();
            var doj1 = $('#doj').val();  
            var pan1 = $('#pan').val();
            var adhar1 = $('#adhar').val();
            var gstno1 = $('#gstno').val();
            var bankac1 = $('#bankac').val();
			var bankname1 = $('#bankname').val();  
			var ifsc1 = $('#ifsc').val();  
			$.ajax({
                type : "POST",
				url  : baseurl+"contractorcontroller/save_contractor",
                dataType : "JSON",
                data : {id:save_update1 ,ccode:ccode1,name:name1,address:address1 , pfcode:pfcode1, doj:doj1,pan:pan1,adhar:adhar1,gstno:gstno1,bankac:bankac1,bankname:bankname1,ifsc:ifsc1},
                success: function(data){
				if(data == true){
				
				$().toastmessage('showSuccessToast', "Contractor data Save Successfully");
                    	$("#hide_show").hide();
					$("#new").show();
				show_contractor();	//call function show all cotractor
				form_clear();
                $('#save_update').val("add");
				}
					else{
				$().toastmessage('showErrorToast', "Contractor data Save Failed");
						}
                }
            });
            return false;
			

	
});
/*---------insert/update contractor form end------------------*/
	
  	$(document).on('click','#close',function(){
					form_clear();
	});
	function form_clear(){
		$('#address_list').val("");
                    $('#postoffice').val("");
                    $('#district').val("");
                    $('#pincode').val("");
					$('#ccode').val("");
					$('#name').val("");
					$('#doj').val("");
					$('#pan').val("");  
					$('#adhar').val("");
					$('#pan').val("");
					$('#gstno').val("");
					$('#bankac').val("");
					$('#bankname').val("");
					$('#ifsc').val("");  
					$('#pfcode').val("");  
					$("#btn_insert").removeAttr('disabled'); 
	                $('#save_update').val("add");

		}
		

/*---------view cotractor list start-----------------*/

	show_contractor();	//call function show all cotractor
		
		//function show all product
		function show_contractor(){
			        $("#wait").css("display", "block");

			
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"contractorcontroller/view_contractor",
		        async : false,
		        dataType : 'json',
		        success : function(data){
				

		            $('#show_contractor_list').html("");

			
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">  <thead><tr><th>Sr No.</th><th>Ccode</th>  			<th>Name</th>  			<th>Address</th>  			<th>Postoffice</th>  			<th>District</th>  			<th>Pincode</th>  			<th>Pf Code</th> <th>Date of Joining</th>  			<th>PAN</th>  			<th>Adhar</th>  			<th>GST No.</th>  			<th>Bank A/c</th> <th>Bank Name</th><th>IFSC</th>  			<th style="width:15%;"><center>Action</center></th>  </tr></thead><tbody>';
		            var i;
					
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
	                        '<td id="ccode'+data[i].contractor_id+'">'+data[i].ccode+'</td>'+
	                        '<td id="contractor_name'+data[i].contractor_id+'">'+data[i].contractor_name+'</td>'+
	                       '<td id="address'+data[i].contractor_id+'" >'+data[i].address+'</td>'+
	                        '<td id="post_office'+data[i].contractor_id+'">'+data[i].post_office+'</td>'+
	                        '<td id="district'+data[i].contractor_id+'">'+data[i].district+'</td>'+
	                        '<td id="pincode'+data[i].contractor_id+'">'+data[i].pincode+'</td>'+
	                        '<td id="pf_code'+data[i].contractor_id+'">'+data[i].pf_code+'</td>'+
	                        '<td id="doj'+data[i].contractor_id+'">'+data[i].doj+'</td>'+
					       '<td id="pan'+data[i].contractor_id+'">'+data[i].pan+'</td>'+
	                        '<td id="aadhar'+data[i].contractor_id+'">'+data[i].aadhar+'</td>'+
	                        '<td id="gst_no'+data[i].contractor_id+'">'+data[i].gst_no+'</td>'+
		                        '<td id="bank_ac'+data[i].contractor_id+'">'+data[i].bank_ac+'</td>'+
	                        '<td id="bank_name'+data[i].contractor_id+'" >'+data[i].bank_name+'</td>'+
	                        '<td id="ifsc'+data[i].contractor_id+'">'+data[i].ifsc+'</td>'+
		                        '<td><a  class="edit_contractor btn btn-xs btn-primary"  id="'+data[i].contractor_id+'" value="'+data[i].contractor_address+'"  ><i class="fa fa-edit"></i></a> <a class="delete_contractor btn btn-xs btn-danger" type="submit"  id="'+data[i].contractor_id+'" ><i class="fa fa-trash" ></i></a></td>'+
		                        '</tr>';
		            }

					
					html +='</tbody></table>';
		            $('#show_contractor_list').append(html);
					
					
					
  
	   var msg = "Contractor List";
    $('#example1').dataTable({
		'scrollX':  true,
		'bDestroy': true,
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
  			        $("#wait").css("display", "none");

		        }

		    });
		}
/*---------view cotractor list end-----------------*/

	
/*---------get  contractor  start-----------------*/

  	$(document).on('click','.edit_contractor',function(){
		var id1 = $(this).attr('id');
		var address_id1 = $(this).attr('value');
		
	
	                    var ccode   = $('#ccode'+id1).html();
	                    var name   = $('#contractor_name'+id1).html();
	                    var post_office   = $('#post_office'+id1).html();
	                    var district   = $('#district'+id1).html();
	                    var pincode   = $('#pincode'+id1).html();
	                    var pfcode   = $('#pf_code'+id1).html();
	                    var doj   = $('#doj'+id1).html();
						var	pan= $('#pan'+id1).html();
	                    var adhar   = $('#aadhar'+id1).html();
	                    var gstno   = $('#gst_no'+id1).html();
		                var bankac   = $('#bank_ac'+id1).html();
	                    var bankname   = $('#bank_name'+id1).html();
	                    var ifsc   = $('#ifsc'+id1).html();

					$('#address_list').val(address_id1);
                    $('#postoffice').val(post_office);
                    $('#district').val(district);
                    $('#pincode').val(pincode);
					$('#ccode').val(ccode);
					$('#name').val(name);
					$('#pfcode').val(pfcode);
					$('#doj').val(doj);  
					$('#pan').val(pan);
					$('#adhar').val(adhar);
					$('#gstno').val(gstno);
					$('#bankac').val(bankac);
					$('#bankname').val(bankname);  
					$('#ifsc').val(ifsc);  

					$('#save_update').val(id1);

			$("#hide_show").show();
			$("#new").hide();
			$("#close").show();
					
        });
	
/*---------get  contractor  start-----------------*/

	
/*---------delete  contractor  start-----------------*/

  	$(document).on('click','.delete_contractor',function(){
		var id1 = $(this).attr('id');
	


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
				url  : baseurl+"contractorcontroller/delete_contractor",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "contractor Data Delete Successfully");
				

				show_contractor();	//call function show all contractor					
					
					}
					else{
					$().toastmessage('showErrorToast', "contractor Data Delete Failed");
					}
	
                }
            });
            return false;
   });

		
	});
	
/*---------delete  contractor  end-----------------*/
 $(document).on('blur','#ccode',function(){

 
		var save = $('#save_update').val();
		var ccode = $('#ccode').val();
		var name = $('#name').val();
		if(($.trim(ccode)!="")&&($.trim(name)!="")&&(save=="add")){
			$.ajax({
		        type  : 'POST',
				url  : baseurl+"Contractorcontroller/check_ccode_name",
                data : {ccode:ccode,name:name},
		        dataType : 'json',
		        success : function(data){
					if(data == 1)
					{
					
			$("#btn_insert").attr('disabled','disabled');
					}
					else{
			$("#btn_insert").removeAttr('disabled'); 
					}
				}					
				});			
		}
			

 });
$(document).on('blur','#name',function(){
		var save = $('#save_update').val();
		var ccode = $('#ccode').val();
		var name = $('#name').val();
		if(($.trim(ccode)!="")&&($.trim(name)!="")&&(save=="add")){
			$.ajax({
		        type  : 'POST',
				url  : baseurl+"Contractorcontroller/check_ccode_name",
                data : {ccode:ccode,name:name},
		        dataType : 'json',
		        success : function(data){
						if(data == 1)
					{
			$("#btn_insert").attr('disabled','disabled');
					}
					else{
			$("#btn_insert").removeAttr('disabled'); 
					}
				}					
				});			
		}
			

 });



});
	