$(document).ready(function() {
	
	var exampletable = "";
	/*
	//Date range serach
    $.fn.dataTableExt.afnFiltering.push(
   function( oSettings, aData, iDataIndex ) {
       var iFini = document.getElementById('month_year').value;
       var iFfin = document.getElementById('month_year').value;
       var iStartDateCol = 1;
       var iEndDateCol = 1;

      // iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
       iFini=iFini.substring(3,7)+ iFini.substring(0,2);
      // iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
       iFfin= iFfin.substring(3,7)+ iFfin.substring(0,2);

      // var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
       var datofini= aData[iStartDateCol].substring(3,7)+ aData[iStartDateCol].substring(0,2);
     //  var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
       var datoffin= aData[iEndDateCol].substring(3,7)+ aData[iEndDateCol].substring(0,2);

       if ( iFini === "" && iFfin === "" )
       {
           return true;
       }
       else if ( iFini <= datofini && iFfin === "")
       {
           return true;
       }
       else if ( iFfin >= datoffin && iFini === "")
       {
           return true;
       }
       else if (iFini <= datofini && iFfin >= datoffin)
       {
           return true;
       }
       return false;
   }
);
	*/




  	$(document).on('focusout','#account_no',function(){
		
		var member_id1 = $('#account_no').val();
		if($.trim(member_id1)==""){
					$().toastmessage('showErrorToast', "Please Enter Employee No ..!");
			
		}
		else{
			
				$.ajax({
                type : "POST",
				url  : baseurl+"resignation/search_employee",
                dataType : "JSON",
                data : { member_id:member_id1 },
                success: function(data){
				if(data.length > 0){
				$('#uan').val(data[0].UAN);
				$('#name').val(data[0].name_as_aadhaar);
				$('#parents').val(data[0].father_husband);
				
	$().toastmessage('showSuccessToast', "Employee Search Successfully");

									
					
					}
					else{
					$().toastmessage('showErrorToast', "Employee Not Found ..!");
				$('#uan').val('');
				$('#name').val('');
				$('#parents').val('');
					}
	
                }
            });
            return false;
			show_resignation();		
		}

		
	});	
	
	
/*---------insert resignation  start-----------------*/

    $(document).on("submit","#resignation_form",function(e){
			e.preventDefault();

var save_update1 = $('#save_update').val();
			var member_id1 = $('#account_no').val();
			var reason = $('#reason').val();

			var leaving_date = $('#leaving_date').val();
					var fdateAr = leaving_date.split('/');
					var leaving_date = fdateAr[2] + '-' + fdateAr[1] + '-' + fdateAr[0].slice();

			$.ajax({
			
                type : "POST",
				url  : baseurl+"resignation/save_resignation",
                dataType : "JSON",
                data : {id:save_update1,leaving_date:leaving_date ,member_id:member_id1,reason:reason},
                success: function(data){
			if(data == true){
				$().toastmessage('showSuccessToast', "Resignation Data Save Successfully");
                
					$('#account_no').val('');
					$('#reason').val('');
					$('#leaving_date').val('');
					
					$('#uan').val('');
					$('#name').val('');
					$('#parents').val('');
					$('#save_update').val("add");
					$("#hide_show").hide();
					$("#new").show();
					show_resignation();			
			}
				else{
				$().toastmessage('showErrorToast', "Resignation Data save Failed ");
				}
//					show_professionaltax();	//call function show all packingwages
	
                }
            });
            return false;
	});
/*---------insert address  end-----------------*/

/*---------view packingwages list start-----------------*/

	show_resignation();	//call function show all resignation
		
	
		function show_resignation(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"resignation/show_resignation",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
					'<th>Account No.</th>'+
					'<th>Date of Leaving</th>'+
					'<th>Reason Of Leaving</th>'+
					'<th style="display:none;">Reason Of Leaving</th>'+
					'<th><center>Action</center></th>'+
					'<th style="display:none;"></th>'+
					'<th style="display:none;"></th>'+
					'<th style="display:none;"></th>'+
					'<th style="display:none;"></th>'+
					'</tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
					var leaving_date = data[i].leaving_date;
					var fdateAr = leaving_date.split('-');
					var leaving_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();					
					if(data[i].reason=="R"){var reason = "RETIREMENT";}
					if(data[i].reason=="D"){var reason = "DEATH IN SERVICE";}
					if(data[i].reason=="S"){var reason = "SUPERNNUATION";}
					if(data[i].reason=="P"){var reason = "PERMANENT DISABLEMENT";}
					if(data[i].reason=="C"){var reason = "CESSATION (SHORT SERVICE)";}
					if(data[i].reason=="A"){var reason = "DEATH AWAY FROM SERVICE";}
					var sr = i+1;
		                html += '<tr>'+
            	'<td id="uan'+data[i].resignation_id+'">'+data[i].UAN+'</td>'+
            	'<td id="leaving_date'+data[i].resignation_id+'">'+leaving_date+'</td>'+
            	'<td>'+reason+'</td>'+
            	'<td style="display:none;" >'+data[i].reason+'</td>'+
            	'<td style="display:none;" id="member_id'+data[i].resignation_id+'">'+data[i].member_id+'</td>'+
		    	'<td style="display:none;" id="name_as_aadhaar'+data[i].resignation_id+'">'+data[i].name_as_aadhaar+'</td>'+
            	'<td style="display:none;" id="father_husband'+data[i].resignation_id+'">'+data[i].father_husband+'</td>'+
            	'<td style="display:none;" id="reason'+data[i].resignation_id+'">'+data[i].reason+'</td>'+
                '<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].resignation_id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].resignation_id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_resignation').html(html);
					
					
					
  
	   var msg = "Resignation List";
	   
		exampletable = $('#example1').DataTable({
		
		
		
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
            {extend: 'copy',  className: 'btn-sm', title: msg,
			exportOptions: {
                    columns: [ 0, 1, 2]
                }			},
            {extend: 'csv',   className: 'btn-sm', title: msg,
			exportOptions: {
                    columns: [ 0, 1, 2]
                }			},
            {extend: 'excelHtml5', className: 'btn-sm', title:null ,filename:msg,
						exportOptions: {
                    columns: [ 0, 1, 3]
                }
			},
            {extend: 'pdf',   className: 'btn-sm', title: msg,
			exportOptions: {
                    columns: [ 0, 1, 2]
                }		},
            {extend: 'print', className: 'btn-sm', title: msg,
			exportOptions: {
                    columns: [ 0, 1, 2]
                }			}
        ]
    });
	




	
		        }

		    });
		}
		
		
			
  	$(document).on('blur','#month_year',function(){
		
		var month_year = $('#month_year').val();
	
//	exampletable.columns().search(month_year).draw();
	exampletable.search('').columns(1).search(month_year).draw();
	
	
	
	} );
	
/*---------view packingwages list end-----------------*/

/*---------get  packingwages row  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		var id1 = $(this).attr('id');
		var member_id = $('#member_id'+id1).html();
		var uan = $('#uan'+id1).html();
		var name_as_aadhaar = $('#name_as_aadhaar'+id1).html();
		var father_husband = $('#father_husband'+id1).html();
		var leaving_date = $('#leaving_date'+id1).html();
		var reason = $('#reason'+id1).html();

					$('#account_no').val(member_id);
					$('#reason').val(reason);
					$('#leaving_date').val(leaving_date);
					
					$('#uan').val(uan);
					$('#name').val(name_as_aadhaar);
					$('#parents').val(father_husband);
			
					$('#save_update').val(id1);
	$("#hide_show").show();
        });
	
/*---------get  packingwages row  end-----------------*/



/*---------delete    resignation row  start-----------------*/

  	$(document).on('click','.delete_row',function(){
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
				url  : baseurl+"resignation/delete_resignation",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Resignation Delete Successfully");
				

					show_resignation();	//call function show all resignation					
					
					}
					else{
					$().toastmessage('showErrorToast', "Resignation Delete Failed");
					}
	
                }
            });
            return false;

            });
		
	});
	
/*---------delete    resignation row  end-----------------*/


	
});