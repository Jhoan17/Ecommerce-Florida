@extends('dsadmin.layout')

@section('title','Ordenes')

@section('scripts')
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/order/index.js')}}"></script>
@endsection

@section('styles')
  <link href="{{asset('dsadmin/pages/css/order/index.css')}}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
@endsection

@section('content')

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Lista de tus ordenes</strong></h3>
{{--         <div class="card-tools">
          <a href="{{route('order-create')}}" class="btn btn-block btn-outline-primary">
            <i class="fas fa-plus"></i> Agregar
          </a>
        </div> --}}
      </div>
      <div class="card-body">
       @include('includes.messages')
        <div class="row">
          <div class="col-12">   
            <div class="card-body table-responsive p-0">
              <br>
              <table class="table table-striped table-bordered" id="table-orders">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Direccion de entrega</th>
                    <th>Fecha de entrega </th>
                    <th>Hora de entrega</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr id="{{$order->order_number}}">
                      <td class="align-middle">{{$order->order_number}}</td>
                      <td class="align-middle">{{$order->order_delivery_address}}</td>
                      <td class="align-middle">{{$order->order_delivery_date}}</td>
                      <td class="align-middle">{{$order->order_delivery_time}}</td>
                      <td class="align-middle">${{$order->order_price}}</td>
                      <td class="align-middle"><select class="custom-select select-order-state" data-url="{{route('order-change-state')}}" data-id="{{$order->order_id}}">
                        @foreach($order_states as $order_state)
                          @if($order_state->order_state_id != 1)
                         <option value="{{$order_state->order_state_id}}" @if($order_state->order_state_id == $order->order_state_id) selected @endif >{{ ucwords($order_state->order_state_name) }} </option>
                         @endif
                        @endforeach
                        </select>
                      </td>
{{--                       <td class="text-center align-middle">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          @if($order->order_state == 'desactive')
                          <input type="checkbox" data-url="{{route('order-change-state', ['order_id' => $order->order_id, 'order_state' => $order->order_state])}}" class="custom-control-input change-state" id="{{$order->order_id}}" name="state">
                          @else
                          <input type="checkbox" data-url="{{route('order-change-state', ['order_id' => $order->order_id, 'order_state' => $order->order_state])}}" checked="checked" class="custom-control-input change-state" id="{{$order->order_id}}" name="state">
                          @endif
                          <label class="custom-control-label" for="{{$order->order_id}}"></label>
                        </div>
                      </td> --}}
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        <a href="{{route('order-show', $order)}}" class="btn btn-info order-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                        @csrf
{{--                         <a href="{{route('order-edit', ['order_id' => $order->order_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="{{route('order-destroy', ['order_id' => $order->order_id])}}" class="btn btn-danger order-destroy"><i class="fas fa-trash"></i></a> --}}
                      </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-order-show" style="width: 100%; overflow: scroll;">
      <!-- /.modal-dialog -->
      </div>  
      <div class="card-footer">
        Hay <strong>{{count($orders)}}</strong> ordenes en tu bandeja
      </div>
<!-- /.card-footer-->
  </div>
<!-- /.card -->
</section>
@endsection