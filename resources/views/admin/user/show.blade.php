
<div class="modal-dialog remove-background" >
	<div class="modal-content remove-background">
		<div class="modal-body justify-content-center remove-background">
      <div class="col-md-12">
       <!-- Widget: user widget style 2 -->
       <div class="card card-widget widget-user-2 ">
         <!-- Add the bg color to the header using any of the bg-* classes -->
         <div class="widget-user-header bg-info">

					 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 				<span aria-hidden="true">&times;</span>
		 			</button>

           <div class="widget-user-image">

             <img class="img-circle elevation-2" src="{{$user->user_image_name}}" alt="Foto de usuario">

					 </div>
           <!-- /.widget-user-image -->
           <h3 class="widget-user-username" ><strong> {{ucwords($user->user_name)}} {{ucwords($user->user_surname)}} </strong></h3>
           <h5 class="widget-user-desc">({{($user->rol->rol_name)}})</h5>



         </div>
         <div class="card-footer p-0">
           <ul class="nav flex-column">
             <li class="nav-item">
               <a href="#" class="nav-link">
              <strong>  Numero de identificacion:</strong> {{$user->user_id_card}} <span class="float-right badge bg-primary"></span>
               </a>
             </li>
             <li class="nav-item">
               <a href="#" class="nav-link">
                 <strong>Correo:</strong> {{$user->user_email}} <span class="float-right badge bg-info"></span>
               </a>
             </li>
             <li class="nav-item">
               <a href="#" class="nav-link">
                <strong>Telefono:</strong> {{$user->user_phone}}  <span class="float-right badge bg-success"></span>
               </a>
             </li>
             <li class="nav-item">
               <a href="#" class="nav-link">
                <Strong> Fecha de nacimiento:</Strong> {{$user->user_birth_date}} <span class="float-right badge bg-danger"></span>
               </a>
             </li>

						 <li class="nav-item">
               <a href="#" class="nav-link">
              <strong>  Genero: </strong> @if( $user->user_gender=="male")
									Masculino
								@elseif($user->user_gender=="female")
									Femenino
								@else
									 Indefinido
								@endif <span class="float-right badge bg-danger"></span>
               </a>
             </li>

						 <li class="nav-item">
               <a href="#" class="nav-link">
                 <strong>Estado:</strong> @if($user->user_state=="active")
									 	Activo
									@else Inactivo  <span class="float-right badge bg-danger"></span>
									@endif
               </a>
             </li>
           </ul>
         </div>
       </div>
       <!-- /.widget-user -->
     </div>
     <!-- /.col -->
		</div>
	{{--           <div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div> --}}
	</div>
<!-- /.modal-content -->
</div>
