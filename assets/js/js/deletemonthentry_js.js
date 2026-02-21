$(document).ready(function() {
	

/*---------insert address  start-----------------*/
		

    $(document).on("submit","#bonussheetform",function(e){
					e.preventDefault();
			var month_year1 = $('#month_year1').val();
			var employee_type = $('#typeEmp').val();
	
	if(((employee_type=="")||(employee_type==null))||(month_year1==""))
				{
						$().toastmessage('showSuccessToast', "Please Fill Details");
				}
				else{
			

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
				url  : baseurl+"notescontroller/delet_emonthentry",
                dataType : "JSON",
                data : {month_year1:month_year1 ,employee_type:employee_type},
                success: function(data){
					if(data == true){
					$().toastmessage('showSuccessToast', "Month Entry Delete Successfully");
					}
					else{
					$().toastmessage('showErrorToast', "Month Entry Delete Failed");
					}
	
					
                }
            });
            });
				}
        });
/*---------insert address  end-----------------*/


	
});