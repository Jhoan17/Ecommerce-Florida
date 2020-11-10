$(document).ready(function () {
    $('.permission_rol').on('change', function () {
        var data = {
            permission_id: $(this).data('permissionid'),
            rol_id: $(this).val(),
            _token: $('input[name=_token]').val()
        };
        
        if ($(this).is(':checked')) {
            data.state = 1
        } else {
            data.state = 0
        }
        // console.log(data);
        ajaxRequest('/admin/permission-rol', data);
    });

    function ajaxRequest (url, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (respuesta) {
                JSMT.notificaciones(respuesta.respuesta, 'JSMT', 'success');
            }
        });
    }
});