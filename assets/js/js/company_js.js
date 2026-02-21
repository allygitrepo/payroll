$(document).ready(function() {
	
     
	
		$("#hide_show").hide();

		$(document).on('click','#new',function(){
			$("#hide_show").show();
			$("#new").hide();
			$("#close").show();
		});
		$(document).on('click','#close',function(){
			$("#hide_show").hide();
			$("#new").show();
			$("#photo_msg").html('');
			 form_clear()
//			clear();
		});

	/*------------show address start-------------------*/
//		show_address();	//call function show all address
		
	

/*---------insert/update company form start-----------------*/
$(document).on('submit','#company_form',function(e){
	e.preventDefault();
	
			var save_update1 = $('#save_update').val();
            var estb_id1 = $('#estb_id').val();
            var esta_name1 = $('#esta_name').val();
            var estaType1 = $('#estaType').val();
            var underEpfo1 = $('#underEpfo').val();  
            var linNo1 = $('#linNo').val();
            var address1 = $('#address_list').val();
            var postoffice1 = $('#postoffice').val();
            var district1 = $('#district').val();
            var pincode1 = $('#pincode').val();  
            var pan1 = $('#pan').val();
            var tan1 = $('#tan').val();
            var pTax1 = $('#pTax').val();
            var primaryEmail1 = $('#primaryEmail').val();
			var phone1 = $('#phone').val();  
			var website = $('#website').val();  
			
			$.ajax({
                type : "POST",
				url  : baseurl+"companycontroller/save_company",
                dataType : "JSON",
                data : {id:save_update1 ,estb_id:estb_id1,esta_name:esta_name1,estaType:estaType1,underEpfo:underEpfo1,linNo:linNo1,address:address1 , postoffice:postoffice1, district:district1,pincode:pincode1,pan:pan1,tan:tan1,pTax:pTax1,primaryEmail:primaryEmail1,phone:phone1,website:website},
                success: function(data){
				if(data == true){
				
				
				$().toastmessage('showSuccessToast', "Company data Save Successfully");
                    $('#address_list').val("");
                    $('#postoffice').val("");
                    $('#district').val("");
                    $('#pincode').val("");
					$('#estb_id').val("");
					$('#esta_name').val("");
					$('#estaType').val("");
					$('#underEpfo').val("");  
					$('#linNo').val("");
					$('#pan').val("");
					$('#tan').val("");
					$('#pTax').val("");
					$('#primaryEmail').val("");
					$('#phone').val("");  
					$('#website').val("");  
                $('#save_update').val("add");
					$("#new").hide();
			$("#close").show();
			//call function show all product	
				}
					else{
				$().toastmessage('showErrorToast', "Company data Save Failed");
						}
						
			
	show_company();
                }
            });
            return false;
			

	
});
/*---------insert/update company form end------------------*/
	
	
	
/*---------view company list start-----------------*/

	show_company();	//call function show all product
		
	
		//function show all product
		function show_company(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"companycontroller/view_company",
		        async : false,
		        dataType : 'json',
		        success : function(data){
				

		       //     $('#show_company_list').html("");

			
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" ><thead><tr><th>Sr. No.</th><th>Estb ID</th><th>Establishment Name</th><th>Establishment Type</th><th>Under EPFO Office</th><th>LIN No.</th><th>Address</th><th>Postoffice</th><th>District</th><th>Pincode</th><th>PAN</th><th>TAN</th><th>PT</th><th>Email</th><th>Phone No.</th><th>Website Name</th><th   ><center>Action</center></th></tr></thead><tbody >';
		            var i;
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
	                        '<td id="estb_id'+data[i].company_id+'">'+data[i].estb_id+'</td>'+
	                        '<td id="name'+data[i].company_id+'">'+data[i].name+'</td>'+
	                        '<td id="type'+data[i].company_id+'">'+data[i].type+'</td>'+
	                        '<td id="epfo_office'+data[i].company_id+'">'+data[i].epfo_office+'</td>'+
	                        '<td id="lin_no'+data[i].company_id+'">'+data[i].lin_no+'</td>'+
	                       '<td id="address'+data[i].company_id+'" >'+data[i].address+'</td>'+
	                        '<td id="post_office'+data[i].company_id+'">'+data[i].post_office+'</td>'+
	                        '<td id="district'+data[i].company_id+'">'+data[i].district+'</td>'+
	                        '<td id="pincode'+data[i].company_id+'">'+data[i].pincode+'</td>'+
					       '<td id="pan'+data[i].company_id+'">'+data[i].pan+'</td>'+
	                        '<td id="tan'+data[i].company_id+'">'+data[i].tan+'</td>'+
	                        '<td id="p_tax'+data[i].company_id+'">'+data[i].p_tax+'</td>'+
		                        '<td id="email_id'+data[i].company_id+'">'+data[i].email_id+'</td>'+
	                        '<td id="phone'+data[i].company_id+'" >'+data[i].phone+'</td>'+
	                        '<td id="website'+data[i].company_id+'" >'+data[i].website+'</td>'+
		                        '<td  ><a  class="edit_company btn btn-xs btn-primary"  id="'+data[i].company_id+'" value="'+data[i].address_id+'"  ><i class="fa fa-edit"></i></a> <a class="delete_company btn btn-xs btn-danger" type="submit"  id="'+data[i].company_id+'" ><i class="fa fa-trash" ></i></a></td>'+
		                        '</tr>';
		            }
					html +='</tbody></table>';
					
					
		            $('#show_company_list').html(html);
					
					
					
  
	   var msg = "Company List";
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
            {extend: 'excel',  title: msg },
            {extend: 'copy',  className: 'btn-sm', title: msg },
            {extend: 'csv',   className: 'btn-sm', title: msg },
            {extend: 'pdf',   className: 'btn-sm', title: msg },
            {extend: 'print', className: 'btn-sm', title: msg }
        ],
 
         
  });
  			
		        }

		    });
		}
/*---------view company list end-----------------*/


/*---------get  company  start-----------------*/

  	$(document).on('click','.edit_company',function(){
		var id1 = $(this).attr('id');
		var address_id1 = $(this).attr('value');
		
			$("#new").show();
			$("#close").hide();
		
	
	                    var estb_id   = $('#estb_id'+id1).html();
	                    var name   = $('#name'+id1).html();
	                    var type   = $('#type'+id1).html();
	                    var epfo_office   = $('#epfo_office'+id1).html();
	                    var line_no   = $('#lin_no'+id1).html();
				//		var	address_id = $('#address'+id1).val();
						var	address = $('#address'+id1).html();
//alert(address_id1);
	                    var post_office   = $('#post_office'+id1).html();
	                    var district   = $('#district'+id1).html();
	                    var pincode   = $('#pincode'+id1).html();
						var	pan= $('#pan'+id1).html();
	                    var tan   = $('#tan'+id1).html();
	                    var p_tax   = $('#p_tax'+id1).html();
		                var email   = $('#email_id'+id1).html();
	                    var phone   = $('#phone'+id1).html();
	                    var website   = $('#website'+id1).html();

//								alert(id1+','+address1+','+postoffice1+','+district1+','+pincode1);

					$('#address_list').val(address_id1);
                    $('#postoffice').val(post_office);
                    $('#district').val(district);
                    $('#pincode').val(pincode);
					$('#estb_id').val(estb_id);
					$('#esta_name').val(name);
					$('#estaType').val(type);
					$('#underEpfo').val(epfo_office);  
					$('#linNo').val(line_no);
					$('#pan').val(pan);
					$('#tan').val(tan);
					$('#pTax').val(p_tax);
					$('#primaryEmail').val(email);
					$('#phone').val(phone);  
					$('#website').val(website);  

					$('#save_update').val(id1);

			$("#hide_show").show();
			$("#new").hide();
			$("#close").show();
					
        });
	
/*---------get  company  start-----------------*/


/*---------delete  company  start-----------------*/

  	$(document).on('click','.delete_company',function(){
		
		
		
		
		var id1 = $(this).attr('id');
		
		
		      swal({
        title : "Are you sure?",
        text : "You will not be able to recover this imaginary Data!",
        type : "warning",
        showCancelButton : true,
        confirmButtonColor : "#DD6B55",
        confirmButtonText : "Yes, delete it!",
        closeOnConfirm : true
      },
        function () {
			
			
			$.ajax({
                type : "POST",
				url  : baseurl+"companycontroller/delete_company",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Company Data Delete Successfully");
//	        swal("Deleted!", "Company Data Delete Successfully.", "success");
			

					show_company();	//call function show all product					
					
					}
					else{
					$().toastmessage('showErrorToast', "Company Data Delete Failed");
					}
	
                }
            });
            return false;
      });

		
			
		
	});
	
/*---------delete  company  end-----------------*/
function form_clear(){
			
	                    $('#address_list').val("");
                    $('#postoffice').val("");
                    $('#district').val("");
                    $('#pincode').val("");
					$('#estb_id').val("");
					$('#esta_name').val("");
					$('#estaType').val("");
					$('#underEpfo').val("");  
					$('#linNo').val("");
					$('#pan').val("");
					$('#tan').val("");
					$('#pTax').val("");
					$('#primaryEmail').val("");
					$('#phone').val("");  
                $('#save_update').val("add");
			
					

}



	
});