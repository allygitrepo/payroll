
	$(document).ready(function() {
					//	show_packer_entry();	//call function show all packingwages
		/*---------get  contracor  end-----------------*/

		
		$(document).on('change','#typeEmp',function(){

		var emptype = $('#typeEmp').val();
		
		if(emptype == "BIDI MAKER"){		
			$("#contractor1").removeAttr('disabled'); 
		}
		else{
			$("#contractor1").attr('disabled','disabled');
		}
		
		});
		
		
		
		
		show_contractor();	//call function show all address
		function show_contractor(){
				$.ajax({
		        type  : 'ajax',
				url  : baseurl+"contractorcontroller/view_contractor",
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		           html += '<option value="all" selected >ALL</option>';
		            var i;
		            for(i=0; i<data.length; i++){
					var sr = i+1;
		                html += '<option value="'+data[i].contractor_id+'" >'+data[i].contractor_name+' - '+data[i].pf_code+'</option>';
		            }
		            $('#contractor1').html(html);	
				}
				});
		}
		
	
		function 	show_paymentadvicereport(month_year,emptype,contractor){

		    $.ajax({
		        type  : 'POST',
				url  : baseurl+"paymentadvicereport/paymentadvicereport_show",
                data : {month_year:month_year,emptype:emptype,contractor:contractor},
		        dataType : 'json',
		        success : function(data){
				
					

				var html = '<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr>'+
				'<th style="white-space:nowrap;">Beneficiary Name</th>'+
				'<th style="white-space:nowrap;">Emp. Code</th>'+
				'<th style="white-space:nowrap;">Beneficiary Account Number</th>'+
				'<th style="white-space:nowrap;">IFSC</th>'+  			
				'<th style="white-space:nowrap;">Amount</th>'+  			
				'</tr>'+
				'</thead><tbody id="">';
		            var i;
							var amount = 0;				

		            for(i=0; i<data.length; i++){
					
			console.log(data[i]);			
			var data1 = data[i].split("####");

		                html += '<tr>'+
				'<td style="whiteSpace:nowrap;">'+data1[0]+'</td>'+
				'<td style="whiteSpace:nowrap;">'+data1[1]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[2]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[3]+'</td>'+
				'<td  style="white-space:nowrap;">'+data1[4]+'</td>'+
		                        '</tr>';
								
						amount = parseInt(amount)+parseInt(data1[4]);				
								
		            }
					
					html += '</tbody><tfoot><tr>'+
				'<th >Total </th>'+
				'<th ></th>'+
				'<th ></th>'+
				'<th ></th>'+
				'<th >'+amount+'</th>'+  			
				'</tr>'+
				'</tfoot>';
	                html += '</table>';
		            $('#table_data1').html(html);
						var month_year = $('#month_year').val();
							var rowcount = parseInt(data.length)+parseInt(1);
		
		var d = new Date();
		var strDate =  d.getDate() + "/" + (d.getMonth()+1) + "/" +d.getFullYear();
		
	   var msg = "Payment Advice Report_"+month_year;
//	      $('#example1').append('<caption style="caption-side: bottom">'+msg+'</caption>');
 
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
        dom: 'Bfrtip',
        buttons: [
            {extend: 'excelHtml5', title:null,titleBottom:null, footer: true,header:true,filename:msg,
			customize: function (xlsx) {
       console.log(xlsx);
       var sheet = xlsx.xl.worksheets['sheet1.xml'];
       var downrows = 10;
       var clRow = $('row', sheet);
       //update Row
       clRow.each(function () {
           var attr = $(this).attr('r');
           var ind = parseInt(attr);
           ind = ind + downrows;
           $(this).attr("r",ind);
       });

       // Update  row > c
       $('row c ', sheet).each(function () {
           var attr = $(this).attr('r');
           var pre = attr.substring(0, 1);
           var ind = parseInt(attr.substring(1, attr.length));
           ind = ind + downrows;
           $(this).attr("r", pre + ind);
       });

       function Addrow(index,data) {
           msg='<row r="'+index+'">'
           for(i=0;i<data.length;i++){
               var key=data[i].k;
               var value=data[i].v;
               msg += '<c t="inlineStr" r="' + key + index + '" >';
               msg += '<is>';
               msg +=  '<t>'+value+'</t>';
               msg+=  '</is>';
               msg+='</c>';
           }
           msg += '</row>';
           return msg;
       }

       //insert
       var r1 = Addrow(1, [{ k: 'A', v: 'Company Name' }, { k: 'B', v: 'abc' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r2 = Addrow(2, [{ k: 'A', v: 'Company Address' }, { k: 'B', v: 'xyz' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r3 = Addrow(3, [{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r4 = Addrow(4, [{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r5 = Addrow(5, [{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r6 = Addrow(6, [{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: strDate }]);
       var r7 = Addrow(7, [{ k: 'A', v: 'Sir/Madam,' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r8 = Addrow(8, [{ k: 'A', v: ' I am sending you the cheque of amount ₹ '+amount }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r9 = Addrow(9, [{ k: 'A', v: 'so please transfer the amount in the accounts as per details given below' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       var r10 = Addrow(10,[{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
      var r11 = Addrow(30,[{ k: 'A', v: 'abc' }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }, { k: 'E', v: '' }]);
       
       
     sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+ r3+ r4+ r5 + r6 +r7 + r8 + r9 + r10 +  sheet.childNodes[0].childNodes[1].innerHTML;
   },
			}
       ]
    });
			
		        }

		    });
		}
 	
	$(document).on('click','#btn_insert',function(){

	var month_year = $('#month_year').val();
	var emptype = $('#typeEmp').val();
	
	if(emptype == "BIDI MAKER"){		
				var contractor = $('#contractor1').val();
		}
		else{
				var contractor = "";
		}
	
		if((month_year=="")||(emptype=="")||(emptype==null)){
					$().toastmessage('showErrorToast', "Please Select Month & Type of Employee");
		}else{
					show_paymentadvicereport(month_year,emptype,contractor);
		}
		
        });
	
});