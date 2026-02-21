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
			
		});
					show_address();	//call function show all address
		function show_address(){
		
				$.ajax({
		        type  : 'GET',
				url  : baseurl+"addresscontroller/view_address",
//		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select Address</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
		            $('#address_list').html(html);					
				}
					
				});
		}
/*---------view address list end-----------------*/


/*---------get  address  start-----------------*/
$(document).on('change','#address_list',function(){
//	e.preventDefault();
	var address_id = $('#address_list').val();
	$.ajax({
		        type  : 'POST',
				url  : baseurl+"addresscontroller/get_address_detail",
		        dataType : 'json',
                data : { id:address_id },
		        success : function(data){
		            var i;
					
		            for(i=0; i<data.length; i++){
//					$('#').val(data[i].id);
					$('#postoffice').val(data[i].post_office);
					$('#district').val(data[i].district);
					$('#pincode').val(data[i].pincode);
//		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
					
//		            $('#address_list').html(html);					
				}
					
				});
	
	
});

/*---------get  address  end-----------------*/

		show_nomi_address();	//call function show all address
		function show_nomi_address(){
				$.ajax({
		        type  : 'GET',
				url  : baseurl+"addresscontroller/view_address",
//		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select Address</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].id+'" >'+data[i].address+'</option>';
		            }
		            $('#nomi_address_list').html(html);					
				}
					
				});
		}
/*---------view address list end-----------------*/


/*---------get  address  start-----------------*/

$(document).on('change','#nomi_address_list',function(){
	var address_id = $('#nomi_address_list').val();
	$.ajax({
		        type  : 'POST',
				url  : baseurl+"addresscontroller/get_address_detail",
		        dataType : 'json',
                data : { id:address_id },
		        success : function(data){
		            var i;
					
		            for(i=0; i<data.length; i++){
					$('#nomi_postoffice').val(data[i].post_office);
					$('#nomi_district').val(data[i].district);
					$('#nomi_pincode').val(data[i].pincode);
		            }
				}
					
				});
	
	
});

/*---------get  address  end-----------------*/

		
		
		
});
	