$(document).ready(function() {
	

/*---------insert address  start-----------------*/
//        $('#btn_save').on('submit',function(e){
//	$("#btn_save").submit(function() {
//				e.preventDefault();
		
    $(document).on("submit","#notes_form",function(e){
			e.preventDefault();
			var note_date = $('#note_date').val();
			var tdateAr = note_date.split('/');
			var note_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0].slice();

            var note = $('#notes').val();
            var save_update1 = $('#save_update').val(); 
			$.ajax({
			
                type : "POST",
				url  : baseurl+"notescontroller/save_notes",
                dataType : "JSON",
                data : {id:save_update1 ,note_date:note_date ,note:note},
                success: function(data){
			//salert(data);
			if(data == true){
				$().toastmessage('showSuccessToast', "Notes Save Successfully");
                    $('#note_date').val("");
                    $('#notes').val("");
                    $('#save_update').val("add");
		
					$("#new").show();

				show_notes();	//call function show all packingwages
				}
					else{
				$().toastmessage('showSuccessToast', "Notes Save Failed");
					}
					
                }
            });
            return false;
			
        });
/*---------insert address  end-----------------*/

/*---------view notes list start-----------------*/

	show_notes();	//call function show all packingwages
		
	
		function show_notes(){
		    $.ajax({
		        type  : 'ajax',
				url  : baseurl+"notescontroller/show_notes",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th>Sr. No.</th>  			<th>Date</th><th>Notes</th>		<th><center>Action</center></th></tr></thead><tbody id="">';
		            var i;
		            for(i=0; i<data.length; i++){
					
					var fromdate = data[i].note_date;

					var fdateAr = fromdate.split('-');
					var note_date = fdateAr[2] + '/' + fdateAr[1] + '/' + fdateAr[0].slice();
					console.log(note_date);
					
					
					var sr = i+1;
		                html += '<tr>'+
		                  		'<td>'+sr+'</td>'+
		                        '<td id="note_date'+data[i].id+'">'+note_date+'</td>'+
	                        '<td id="note'+data[i].id+'">'+data[i].note+'</td>'+
		                        '<td><button  class="edit_row btn btn-sm btn-primary"  id="'+data[i].id+'"  ><i class="fa fa-edit"></i></button>				<button class="delete_row btn btn-sm btn-danger" type="submit" id="'+data[i].id+'" ><i class="fa fa-trash"></i></button></td>'+
		                        '</tr>';
		            }
	                html += '</tbody></table>';
		            $('#show_notes').html(html);
					
					
					
  
	   var msg = "Notes List";
    $('#example1').dataTable({
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
					
		        }

		    });
		}
/*---------view packingwages list end-----------------*/

/*---------get  packingwages row  start-----------------*/

  	$(document).on('click','.edit_row',function(){
		var id1 = $(this).attr('id');
		var note_date = $('#note_date'+id1).html();
		var note = $('#note'+id1).html();

            $('#note_date').val(note_date);
            $('#notes').val(note);
			
					$('#save_update').val(id1);
	
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
				url  : baseurl+"notescontroller/delete_notes",
                dataType : "JSON",
                data : { id:id1 },
                success: function(data){
				if(data == true){
	$().toastmessage('showSuccessToast', "Notes Delete Successfully");
				

					show_notes();	//call function show all product					
					
					}
					else{
					$().toastmessage('showErrorToast', "Notes Delete Failed");
					}
	
                }
            });
            return false;
            });

		
	});
	
/*---------delete    packingwages row  end-----------------*/


	
});