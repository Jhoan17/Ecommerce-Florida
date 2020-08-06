
$(document).ready(function () {

	JSMT.validacionGeneral('form-general'); //se encarga de validar la peticion del usuario en el formulario de Usuario

	$("#user_name").focus(); // Selecciona el primer input del formulario.

	//$('.select2').select2(); //es para buscar dentro del select.


	$("#user_image").fileinput({
	    theme: "fa", // sireve para la seleccion de tema de iconos.
	    language: "es", //selecciona lenguaje.
	    maxFileSize: 5000, //tamaño maximo del archivo.
	    showClose: false,
	    showCaption: false,
	    showZoom: false,
	    browseLabel: 'Buscar...', //nombre del boto de seleccion o carga de archivo.
	    browseIcon: '<i class="fa fa-folder-open"></i>', //sirve para Seleccionar el icono que deseemos.
	    browseClass: 'btn btn-outline-info', // para seleccionar la clase del boton que tenemos.
	    removeIcon: '<i class="fa fa-trash-alt"></i>', //seleccion de icono para quitar el archivo.
	    removeClass: 'btn btn-outline-secondary', // clase del boto quitar
	    elErrorContainer: '#kv-user-errors-1', //informe de error
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img id="user-image-default" src="https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1" alt="Imagen del usuario">', //seleccionai magen por defecto
	    layoutTemplates: {main2: '{preview} {remove} {browse}'}, //botones del plugin,
	    allowedFileExtensions: ["jpg", "png", "gif"] //tipos de formatos que acepta el plugin.
	});

});
