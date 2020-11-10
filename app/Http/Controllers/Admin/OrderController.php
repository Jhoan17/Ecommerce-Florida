<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Combo;
use App\Models\Admin\ComboCustomer;
use App\Models\Admin\Country;
use App\Models\Admin\Department;
use App\Models\Admin\Order;
use App\Models\Admin\OrderState;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderALL()
    {

        $count = 1;
        $orders = Order::orderBy('created_at', 'DESC')->where("order_state_id",1)->with('combosCustomers', 'customer', 'orderState')->get();
        $order_states = OrderState::orderBy('order_state_id', 'ASC')->get();
        return view('admin.order.order-all', compact('orders', 'order_states', 'count'));
    }

    public function orderUser()
    {

        $count = 1;
        $orders = Order::orderBy('created_at', 'DESC')->where("user_id",session()->get("user_id"))->get();
        $order_states = OrderState::orderBy('order_state_id', 'ASC')->get();
        // dd($order_states);
        return view('admin.order.order-user', compact('orders', 'order_states', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function state()
    {

        if (isset($_GET['order_id']) && isset($_GET['order_state_id'])) {

            
            $order = Order::find($_GET['order_id']);

            if ($_GET['order_state_id']==2 && $order->user_id == null) {

                    $order->user_id = session()->get('user_id');
                    $order->order_state_id = $_GET['order_state_id'];
                    $order->save();
                    echo $order->order_number;
            }else{
                if($order->user_id == session()->get('user_id')){
                    $order->order_state_id = $_GET['order_state_id'];
                    $order->save();
                    echo "1";  
                }else{
                    echo "2";
                }
            }
            
        }elseif (isset($_GET['state_type'])) {

            if($_GET["state_type"]==1){

                return redirect('admin/order-user')->with('message', 'El estado de orden se cambio exitosamente');

            }elseif($_GET["state_type"]==2){

                return redirect('admin/order-all')->with('error', 'Esta orden ya fue asignada');
                
            }else{

                return redirect('admin/order-user#'.$_GET["state_type"])->with('message', 'La orden fue asignada a tu bandeja correctamente');

            }
        }
        
        
        
        
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // dd($order->customer);
        $combo_count_head = 1;
        $combo_count_body = 1;
        $count_orders_customer = 0;
        $country = Country::find($order->customer->phone_code);
        $department = Department::find($order->municipality->department_id);
        // dd($department);
        $order_customers = Order::get();

        foreach($order_customers as $order_customer){
            if($order_customer->customer_id == $order->customer->customer_id){
               $count_orders_customer=$count_orders_customer+1 ;
            }
                                    
        }

        $combosOrderCustomers = ComboCustomer::where("order_id",$order->order_id)->with('products')->get();

        // dd($count_orders_customer);
        return view('admin.order.show', compact('order', 'combo_count_head', 'combo_count_body', 'country', 'orders', 'count_orders_customer','department','combosOrderCustomers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
