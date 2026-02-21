/*!
 *
 * Angle - Bootstrap Admin App
 *
 * Version: 3.3
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: https://wrapbootstrap.com/help/licenses
 *
 */
!function(e){
	var t=e(".settings");
	e(".settings-ctrl").on("click",function(){
		var c=$('#floatbtn').attr('class');
		if(c == 'settings'){
			//$('#change').html('');
			$( '#change1' ).removeClass('fa fa-arrow-left').addClass('fa fa-arrow-right');
			//$("#arrow").css("box-shadow", "-5px 5px 10px gray");
			$("#inner").css("box-shadow", "-5px 5px 10px gray");

		}else{
			//$('#change').html('Get Help!');
			$( '#change1' ).removeClass('fa fa-arrow-right').addClass('fa fa-arrow-left');
			//$("#arrow").css("box-shadow", "-5px 5px 10px gray");
			$("#inner").css("box-shadow", "");
		}
		t.toggleClass("show");
		
		});
	}(window.jQuery);