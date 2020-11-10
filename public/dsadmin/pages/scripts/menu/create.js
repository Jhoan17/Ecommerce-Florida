$(document).ready(function () {

	JSMT.validacionGeneral('form-general');
	$("#menu_name").focus();

    $('#menu_icon').on('keyup', function () {
    	if($(this).val()==""){
    		$('#show-icon').addClass('fa fa-question');
    	}else{
    		$('#show-icon').removeClass().addClass('fa fa-' + $(this).val());
    	}
        

	});	
});	