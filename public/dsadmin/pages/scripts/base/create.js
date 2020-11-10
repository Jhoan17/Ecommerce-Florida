$(document).ready(function () {

	JSMT.validacionGeneral('form-general');

	$("#base_name").focus();

    $("#input-24").fileinput({
    	theme: "fa",
    	language: "es",
    	browseLabel: 'Buscar...',
        initialPreviewAsData: false,
        deleteUrl: "/site/file-delete",
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFileCount: 4,
        showUpload: false
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
      $(".bootstrap-switch-handle-on").html("SI");
      $(".bootstrap-switch-handle-off").html("NO");
    });
    
    $('.value_without_space').keyup(function(){

        var value = $(this).val();

        var value_without_space = $.trim(value);

        $(this).val(value_without_space);

    });

    $('.value_without_space').focusout(function(){
        var value = $(this).val();
        var value_latest = value[value.length-1];
        if (value_latest == "," || value_latest == "." ) {
            $(this).val(value.slice(0, -1));
        }
    });

});