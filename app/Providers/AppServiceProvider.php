<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Menu;
use App\Models\Admin\Order;
use App\Models\Security\User;
use App\Models\Admin\notification;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        date_default_timezone_set('America/Bogota');
        
        View::composer("dsadmin.menu", function ($view) {
            $menus = Menu::getMenu(true);
            $view->with('menusComposer', $menus);
        });
        View::share('dsadmin', 'lte');

        View::composer("dsadmin.navbar", function ($view) {

            $notification = Notification::where("user_id",session()->get('user_id'))->where("read_at",NULL)->get();
            $count_notification=count($notification);

            $view->with('userNotifications', $notification);
            $view->with('countNotifications', $count_notification);
        });
        View::share('dsadmin', 'lte');

        View::composer("dsadmin.menu-item", function ($view) {

            $orders = Order::orderBy('created_at', 'DESC')->where("order_state_id",1)->with('combosCustomers', 'customer', 'orderState')->get();
            $count_order=count($orders);

            $view->with('countOrders', $count_order);
        });
        View::share('dsadmin', 'lte');

        View::composer(["dsadmin.menu", "admin.profile.index"], function ($view) {

            $user = User::find(session('user_id'));
            // dd($user);
            $view->with('userImage', $user->user_image_name);
        });
        View::share('dsadmin', 'lte');


    }
}
