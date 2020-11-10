<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read($notification_id)
    {
        if (isset($notification_id)) {

            $notification = Notification::find($notification_id);
            
            if($notification->notifiable_type == "order"){
                $notification->read_at = Carbon::now();
                $notification->save();
                return redirect('admin/order-all#'.$notification->order_number);
            }else{
                $notification->read_at = Carbon::now();
                $notification->save();
                return redirect('admin/suggestion'); 
            }
            
        }
        
        
    }

    public function push(){


        $notifications = Notification::where("user_id",session()->get("user_id"))->get();

        if(count($notifications)==0){

            $ar['notification_id'] = null;
            $ar['notification_type'] = null;
            $ar['created_at'] = null;
            $ar['created_att'] = null;


        }else{

            $data_ac = $_GET['created_at'];
            $data_db = strtotime($notifications->last()->created_at);

            while($data_db <= $data_ac){
                $notifications = Notification::where("user_id",session()->get("user_id"))->get();
                usleep(100000);
                clearstatcache();
                $data_db = strtotime($notifications->last()->created_at);
            }
            $notifications_s = Notification::where("user_id",session()->get("user_id"))->get();
            
            foreach ($notifications_s as $notification_s) {
                   $ar['notification_id'] = $notification_s->notifiable_id;
                   $ar['notification_type'] = $notification_s->notifiable_type;
                   $ar['created_at'] = strtotime($notification_s->created_at);
                   $ar['created_att'] = Carbon::parse($notification_s->created_at)->format('Y-m-d h:i A');
            }
        }


        $data_json = json_encode($ar);
        echo $data_json;


    }

}
