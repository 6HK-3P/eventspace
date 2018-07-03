<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_status;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function get_orders(Request $request){
        if($request->status){
            $all_orders = Order::where('status', $request->status)->get();

        }else {
            $all_orders = Order::all();
        }
        $all_status = Order_status::all();
        return view('admin.adminorders')->with(["AllOrder" => $all_orders, "AllStatus" => $all_status]);
    }

    public function updateOrder($order_id, $action_id){
        switch ($action_id){
            case 1: $action_system = $this->set_accsess_payment($order_id); break; /*доступно админу и воркеру*/
            case 2: $action_system = $this->ping_payment($order_id); break; /*доступно админу*/
            case 3: $action_system = $this->set_info_payment($order_id); break; /*доступно пользователю*/
            case 4: $action_system = $this->put_in_archive($order_id); break; /*доступно админу и воркеру*/
            case 5: $action_system = $this->remove_in_archive($order_id); break; /*доступно админу и воркеру*/
            case 6: $action_system = $this->cancel_payment($order_id); break; /*внутреняя хня*/
            case 7: $action_system = $this->add_feedback($order_id); break; /*доступно пользователю*/
        }
    }
    /*-----------------------Разрешить предоплату----------------------------*/
    public function set_accsess_payment($order_id){
        $order = Order::find($order_id);
        $order->status = 2;
        $order->save();
        $action_system = ['Предоплата разрешена'];
        return $action_system;
    }

    /*-----------------------Напомнить о предоплате----------------------------*/
    public function ping_payment($order_id){
        $order = Order::find($order_id);
        $data = date("Y-m-d", strtotime($order->updated_at));
        $endData = strtotime("+1 day" , $data);
        $now = strtotime(date("Y-m-d"));
        $action_system = ['Дату уже заняли так как с заказа прошло более суток'];
        /*Тут надо отправлять смску заказчику о том что время ожидания предоплаты подходит к концу*/
        if (($order->status == 2 || $order->status == 3) && $now >= $endData){
            $res = $this->check_order($order_id);
            if ($res["id"]){
                $action_system = ['Отправлено смс с напоминанием об оплате'];
                /*А если прошло более 1 дня о том что уже кто то другой может занять дату соверши оплату пока не заняли*/
            }
            /*Либо заказ закрывается*/
        }


        return $action_system;
    }

    /*-----------------------Проверяем не совершил ли кто другой заказ и оплату на эту дату----------------------------*/
    public function check_order($order_id){
        $order = Order::find($order_id);
        $action = ['id'=>1, 'info'=>'Дата свободна'];
        $data = json_decode($order->infos)->data;
        $other_orders = Order::where('id',"!=", $order->id)->whereIn('status', [4,6,7])->where('worker_id', $order->worker_id)->where('infos->data', $data)->get();
        if (count($other_orders)){
            $action = ['id'=>0, 'info'=>'Заказ создан'];
            /*Закрываем этот заказ*/
            $this->cancel_payment($order_id);
        }

        return $action;
    }

    /*-----------------------Заказчик совершил оплату----------------------------*/
    public function set_info_payment($order_id){
        $order = Order::find($order_id);
        /*(надо подключить платежную систему)*/
        /*если предоплата прошла*/
        $order->status = 4;
        $action_system = ['Оплата прошла'];
        /*если предоплата не прошла*/
        /*$order->status = 5;*/
        /*$action_system = ['Оплата не прошла. Менеджер свяжется с вами'];*/
        $order->save();
        return $action_system;
    }

    /*-----------------------Положить в архив----------------------------*/
    public function put_in_archive($order_id){
        $order =Order::find( $order_id);
        $order->in_archive = 1;
        $order->save();
        $action_system = ['Помещено в архив'];
        return $action_system;
    }

    /*-----------------------Достать из архива----------------------------*/
    public function remove_in_archive($order_id){
        $order =Order::find( $order_id);
        $order->in_archive = 0;
        $order->save();
        $action_system = ['Возвращено в активные'];
        return $action_system;
    }
    /*-----------------------Кто то другой успел сделать заказ до предоплаты--------------------*/
    public function cancel_payment($order_id){
        $order = Order::find($order_id);
        $order->status = 9;
        /*Тут надо отправлять смску заказчику о том что товар уже заняли на эту дату*/
        /*Так как этот гандон не успел вовремя оплатить*/
        /*Статус будет меняться при заказе и оплате этого заказа другого заказчика*/
        /*Либо если сам воркер отметил в календаре что дата занята*/
        /*Либо если сам админ напомнил об оплате а дата занята*/
        /*--------------------------------*/
        /*Если чел совершает заказ и делает предоплату а на ту дату что он хочет занять уже кто то сделал заказ*/
        /*Но не сделал предоплату хотя прошло более одного дня*/
        /*Создается заказ нового чела и тот заказ меняет статус на 9 типа первый пидр не успел*/
        $order->save();
        return $order;
    }


    /*-----------------------Кто то другой успел сделать заказ до предоплаты--------------------*/
    public function add_feedBack($order_id){
        $order = Order::find($order_id);
        /*Тут надо вызывать метод FeedBack контроллера и оставлять отзыв с оценкой*/
        $order->status = 7;
        $order->save();
        return $order;
    }

}
