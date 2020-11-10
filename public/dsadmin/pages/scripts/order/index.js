$(document).ready(function (){

	$('#table-orders').DataTable({
		"paging":   false,
		"info": false,
        "language": {
            "lengthMenu": "Ver _MENU_ ",
            "zeroRecords": "Lo sentimos, no se encontro ninguna orden",
            "info": "Paginas para ver _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search":         "Buscar:",
            "infoFiltered": "( _MAX_ orders)",
            "paginate": {
		        "first":      "Primero",
		        "last":       "Ultimo",
		        "next":       "Siguiente",
		        "previous":   "Anterior"
		    }
        }
	});


	//FUNCION PARA MOSTRAR LA ORDEN DE LA NOTIFICACION

	var URLhash = window.location.hash.replace("#","");
	if(URLhash){

		

		if ($("#"+URLhash).length ) {
			
			$('input[aria-controls=table-orders]').val(URLhash);
		  	animacion = function(){ $("#"+URLhash).effect("highlight", {}, 3000); }
		  	setInterval(animacion, 1000);

		}else{
			$("body").append('<div id="toast-container" class="toast-top-right"><div class="toast toast-error toast-time-hide" aria-live="assertive" style=""><div class="toast-messages">La ordern ya fue asignada</div></div></div>')
			$(".toast-time-hide").fadeOut(4000);
		}
		

	}
	
	//////////////////////////////////////////////////
	

	


	$('.select-order-state').on('change', function(event){
		event.preventDefault();

		const url = $(this).data("url");

		const data = {
			order_id: $(this).data("id"),
			order_state_id: $(this).val()
		}

		ajaxRequest(data, url, 'state', 'GET');

	});

	$('.order-show').on('click', function(event){
		event.preventDefault();

		const url = $(this).attr('href');
		const data = {
			_token:$("input[name=_token]").val()
		}
		// console.log($("input[name=_token]").val());
		ajaxRequest(data, url, 'show', 'POST');
	});	

	function ajaxRequest(data, url, functions, type){
		$.ajax({
			url:url,
			type:type,
			data:data,
			success: function(answer){
				if (functions == 'combo_destroy') {
					

				}else if (functions == 'show'){
					$('#modal-order-show').html(answer);
					$('#modal-order-show').modal('show');
				}else if (functions == 'state'){
									
					if (answer == "1") {
						window.location.href = url+"?state_type=1";
					}else if(answer == "2"){
						window.location.href = url+"?state_type=2";
					}else{
						window.location.href = url+"?state_type="+answer;
					}
				}
			},
			error:function(){

			}
		});
	}




	

    $(document).on('click','[data-toggle="lightbox"]', function(event){
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

});