$(document).ready(function() {
	

/*---------insert address  start-----------------*/

	show_company();	//call function show all address
		function show_company(){
		
				$.ajax({
		        type  : 'GET',
				url  : baseurl+"companycontroller/login_view_company",
//		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		                html += '<option value="" >Select Company</option>';
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].estb_id+'" >'+data[i].name+'</option>';
		            }
		            $('#company_name').html(html);					
				}
					
				});
		}
	
});