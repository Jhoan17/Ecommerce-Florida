$(document).ready(function () {


	var pass1 = $('[name=new_password]');
	var pass2 = $('[name=confirm_new_password]');
	var confirmation = "Las contraseñas si coinciden";
	var length = "La contraseña debe estar formada de 6 a màs carácteres";
	var denial = "No coinciden las contraseñas";
	var empty = "La contraseña no puede estar vacía";
	//oculto por defecto el elemento span
	var span = $('<br><span  id="result"></span>').insertAfter(pass2);
	span.hide();
	//función que comprueba las dos contraseñas
	function matchPassword(){
		var value1 = pass1.val();
		var value2 = pass2.val();
		//muestro el span
		span.show().removeClass();
		//condiciones dentro de la función
		if(value1 != value2){
		span.text(denial).addClass('denial');	
		}
		if(value1.length==0 || value1==""){
		span.text(empty).addClass('denial');	
		}
		if(value1.length<6){
		span.text(length).addClass('denial');
		}
		if(value1.length!=0 && value1.length>6 && value1==value2){
			span.text(confirmation).removeClass("denial").addClass('confirmation');
			$("#button-change-password").removeAttr("disabled");
			$("#button-change-password").removeClass("disabled");
		}
	}
	//ejecuto la función al soltar la tecla
	pass2.keyup(function(){
		matchPassword();
	});



	var URLhash = window.location.search.substring(1).replace("=","");
	if(URLhash){
		console.log(URLhash);
		
			
			if (URLhash == "password") {

				$("#hrefsettings").removeClass("active");
				$("#settings").removeClass("active");

				$("#"+URLhash).addClass("active");
				$("#href"+URLhash).addClass("active");

			}else if(URLhash == "password-changed"){

				$('#modal-sm-close-session').modal('show');
			}
			

	}
	

	JSMT.validacionGeneral('form-general');

	$("#puser_name").focus();

	$('.select2').select2();



	var image_user = $("#user_image_name").val();

	$("#user_image").fileinput({
	    theme: "fa",
	    language: "es",
	    maxFileSize: 5000,
	    showClose: false,
	    showCaption: false,
	    showZoom: false,
	    browseLabel: 'Cambiar...',
	    browseIcon: '<i class="fa fa-folder-open"></i>',
	    browseClass: 'btn btn-outline-primary',
	    removeIcon: '<i class="fa fa-trash-alt"></i>',
	    removeClass: 'btn btn-outline-secondary',
	    elErrorContainer: '#kv-user-errors-1',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img id="user-image-default" src="'+image_user+'">',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"]
	});

});
