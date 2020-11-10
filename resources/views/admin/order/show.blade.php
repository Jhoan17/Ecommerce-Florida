
<div class="modal-dialog modal-lg" style="margin-left: 1.5%; max-width: 100% !important; overflow: hidden;">
  <div class="modal-content" >
  	<div class="modal-header">
		<h4 class="modal-title text-center"><strong>Orden:</strong> #{{$order->order_number}} ({{$order->orderState->order_state_name}})</small></h4>
          <div class="form-group">
          </div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
      <div class="col-12 col-sm-12">
        <div class="card card-info card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              	<li class="nav-item">
               	 <a class="nav-link active" id="custom-tabs-one-customer-tab" data-toggle="pill" href="#custom-tabs-one-customer" role="tab" aria-controls="custom-tabs-one-customer" aria-selected="true">Cliente</a>
              	</li>
              	<li class="nav-item">
               	 <a class="nav-link" id="custom-tabs-one-delivery_information-tab" data-toggle="pill" href="#custom-tabs-one-delivery_information" role="tab" aria-controls="custom-tabs-one-delivery_information" aria-selected="false">Informacion de entrega</a>
              	</li>
                @foreach($order->combosCustomers as $combos_customers)
                <?php $count = $combo_count_head++; ?>
              	<li class="nav-item">
               	 <a class="nav-link" id="custom-tabs-one-combo-{{$count}}-tab" data-toggle="pill" href="#custom-tabs-one-combo-{{$count}}" role="tab" aria-controls="custom-tabs-one-combo-{{$count}}" aria-selected="false">Combo #{{$count}} </a>
             	  </li>
                @endforeach
            </ul>
          </div>
          <div class="card-body" style="overflow-x: scroll;">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-customer" role="tabpanel" aria-labelledby="custom-tabs-one-customer-tab">
                 <div class="row justify-content-center">
                    <div class="col-md-12">
                      <!-- Widget: user widget style 1 -->
                      <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                          <h3 class="widget-user-username">{{$order->customer->customer_name}}</h3>
                          <h5 class="widget-user-desc">{{$order->customer->customer_email}}</h5>
                        </div>
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col-sm-4 border-right">
                              <div class="description-block">
                                <h5 class="description-header">Pais</h5>
                                  <span class="description-text">{{$country->name}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                              <div class="description-block">
                                <h5 class="description-header">Telefono </h5>
                                  <span class="description-text">+{{$country->phone_code}} {{$order->customer->customer_phone}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                              <div class="description-block">
                                <h5 class="description-header">Ordenes Realizadas</h5>
                                <span class="description-text">{{$count_orders_customer}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-delivery_information" role="tabpanel" aria-labelledby="custom-tabs-one-delivery_information-tab">
              	<div class="col-md-12 text-center"><h5><strong></strong></h5></div>
              	<div class="row justify-content-center">
                  <div class="card-body row">
                    <dl class="col-md-4">
                      <dt>Fecha y hora de creaciòn</dt>
                      <dd>{{$order->created_at }}</dd>
                      <dt>Departamento</dt>
                      <dd>{{$department->department_name}}</dd>
                    </dl>
                    <dl class="col-md-4">
                      <dt>Fecha de entrega (aaaa-mm-dd)</dt>
                      <dd>{{$order->order_delivery_date}}</dd>
                      <dt>Ciudad/Municipio</dt>
                      <dd>{{$order->municipality->municipality_name}}</dd>
                    </dl>
                    <dl class="col-md-4">
                      <dt>Hora de entrega</dt>
                      <dd>{{$order->order_delivery_time}}</dd>
                      <dt>Dirección</dt>
                      <dd>{{$order->order_delivery_address}}</dd>
                    </dl>
                    <dl class="col-md-4">
                      
                      
                      
                    </dl>
                  </div>
                </div>
              </div>
              @foreach($combosOrderCustomers as $combos_customers)
              <?php $count = $combo_count_body++; ?>
              <div class="tab-pane fade" id="custom-tabs-one-combo-{{$count}}" role="tabpanel" aria-labelledby="custom-tabs-one-combo-{{$count}}-tab">
      					<div class="row">
                <dl class="col-md-3">
                    <dt>Combo Referencia</dt>
                    <dd>{{$combos_customers->combo_name}}</dd>
                  </dl>
                  <dl class="col-md-3">
                    <dt>Color de la base</dt>
                    @if($combos_customers->customization_base_color=="")
                      <dd>SIN SELECCIONAR</dd>
                    @else
                      <dd>{{$combos_customers->customization_base_color}}</dd>
                    @endif 
                  </dl>
                  <dl class="col-md-3">
                    <dt>Personalizacion base</dt>
                    @if($combos_customers->customization_base_text=="")
                      <dd>SIN TEXTO</dd>
                    @else
                      <dd>{{$combos_customers->customization_base_text}}</dd>
                    @endif 
                  </dl>
                  <dl class="col-md-3">
                    <dt>Descripcion</dt>
                    @if($combos_customers->combo_description=="")
                      <dd>NINGUNA</dd>
                    @else
                      <dd>{{$combos_customers->combo_description}}</dd>
                    @endif 
                  </dl>
                  <table class="table table-bordered col-md-12 text-center">
                    <tr>         
                      <th style="width: 42px; height: 40px;"></th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>C. Neto</th>
                      <th>Color</th>
                      <th>Sabor</th>
                      <th>Receta</th>
                      <th>Texto</th>
                      <th>Imagen</th>
                    </tr>
                    @foreach($combos_customers->products as $combo_product)
                    <tr>
                      <td  class="justify-content-center" style="width: 42px; height: 50px;">
                        <div class="product-image-thumb" style="width: 42px; height: 50px; overflow: hidden;">
                          <img src="{{$combo_product->product_image_name}}">
                        </div>
                      </td>
                      <td>{{$combo_product->product_name}}</td>
                      <td>{{$combo_product->product_trademark}}</td>
                      <td>{{$combo_product->product_net_content}}</td>
                      <td>
                        @if($combo_product->pivot->color == "")
                          -N-
                        @else
                          {{$combo_product->pivot->color}}
                        @endif
                      </td>
                      <td>
                        @if($combo_product->pivot->flavor == "")
                          -N-
                        @else
                          {{$combo_product->pivot->flavor}}
                        @endif
                      </td>
                      <td>
                        @if($combo_product->pivot->recipe == "")
                          -N-
                        @else
                          {{$combo_product->pivot->recipe}}
                        @endif
                      </td>
                      <td>
                        @if($combo_product->pivot->customization_text == "")
                          -N-
                        @else
                          {{$combo_product->pivot->customization_text}}
                        @endif
                      </td>
                      <td  class="justify-content-center" style="width: 42px; height: 40px;">
                        @if($combo_product->pivot->customization_image == "")
                          -N-
                        @else
                          <div class="product-image-thumb" style=" position: relative; left: 15%; width: 42px; height: 50px; overflow: hidden;">
                            <img src="{{$combo_product->pivot->customization_image}}">
                          </div>
                        @endif  
                      </td>
                    </tr>
                    @endforeach           
                  </table>
      			    </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>
</div>