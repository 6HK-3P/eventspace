<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Order;
use App\pricing;
use App\Site_setting;
use App\User;
use App\Worker;
use App\workers_car;
use App\Workers_cars_color;
use App\Workers_cars_mark;
use App\Workers_cars_type;
use App\Workers_citie;
use App\Workers_count_camer;
use App\Workers_language;
use App\Workers_musicians_type;
use App\Workers_toastmaster_type;
use App\Workers_video_equipment;
use App\Workers_video_qualitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{





//---------------------------------------Получение всей информации о всём-----------------------------------------------
    public function index($id){
        $worker_id = Worker::where('user_id', $id)->first();
        $select_comment = Comment::where('worker_id', $worker_id->id)->orderBy('id','desc')->get();
        $allInfoUser = User::find($id);
        $allInfoWorker = Worker::where('user_id',$allInfoUser['id'])->first();

        //вся информация которая в шапке
        $allhead = Site_setting::all();
        //всё про машины
        $carstype = Workers_cars_type::all();
        $carsmark = Workers_cars_mark::all();
        $carscolor = Workers_cars_color::all();
        //города
        $allcitie = Workers_citie::all();
        //тамада
        $alltoast = Workers_toastmaster_type::all();
        //язык
        $alllanguage = Workers_language::all();
        //съёмка
        $videoe = Workers_video_equipment::all();
        $videoq = Workers_video_qualitie::all();
        //музыка
        $audiotype = Workers_musicians_type::all();

        $countcamers = Workers_count_camer::all();
        //информация о машинах текущенго воркера
        $allCarsWorker = workers_car::where('worker_id',$allInfoWorker->id)->get();
        $city = 1;
        return view("product")
            ->with([
                'cat' => $worker_id->category_id,
                'attributes' => [],
                'SelComment' => $select_comment,
                'city'=>$city,
                'allCarsWorker' => $allCarsWorker,
                'InfoUsers' => $allInfoUser,
                'InfoWorker' => $allInfoWorker,
                'carstypes' => $carstype,
                'carsmarks' => $carsmark,
                'carscolors' => $carscolor,
                'allcities' => $allcitie ,
                'alltoasts' => $alltoast ,
                'alllanguages' => $alllanguage,
                'videose' => $videoe,
                'videosq' => $videoq ,
                'audios'=>$audiotype,
                'allheads'=>$allhead
            ]);
    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------------Получение цены на сегоднящний день---------------------------------------------------
    public static function getPriceToday($id){
        $worker = Worker::find($id);
        $cat = $worker->category_id;
        $price = 0;
        switch ($cat){
            case 1 : $price = self::getPriceTodayDefault($id, $worker); break;
            case 2 : $price = self::getPriceTodayDefault($id, $worker); break;
            case 3 : $price = self::getPriceTodayDefault($id, $worker); break;
            case 4 : $price = self::getPriceTodayDefault($id, $worker); break;
            case 5 : $price = self::getPriceTodayDefault($id, $worker); break;
            case 6 : $price = self::getPriceTodayAuto($id, $worker); break;

        }
        return $price;
    }
//----------------------------------------------------------------------------------------------------------------------





//----------------------------------Получение сегоднящней цены для всех-------------------------------------------------
    public static function getPriceTodayDefault($id, $worker){
        $today = date('d.m.Y');
        $base_city = $worker->city_id;
        $index = 0; //Весь день
        $price = 0;

        $pricings = pricing::where("worker_id", $id)->where("view", "По дням")->get();
        foreach ($pricings as $price_rule){
           $cities = json_decode($price_rule->city);
           if (in_array($base_city, $cities)){
               $dates = json_decode($price_rule->date);
               if (strtotime($today)<=$dates[1] && strtotime($today)>=$dates[0]){
                   $prices= json_decode($price_rule->price);
                   $price = $prices[$index];
               }
           }
        }
        if (!$price){
            $pricings = pricing::where("worker_id", $id)->where("view", "По месяцам")->get();
            foreach ($pricings as $price_rule){
                $cities = json_decode($price_rule->city);
                if (in_array($base_city, $cities)){
                    $months = json_decode($price_rule->date);
                    $todayMonth = getdate(strtotime($today));
                    if (in_array($todayMonth["mon"], $months)){
                        $prices= json_decode($price_rule->price);
                        $price = $prices[$index];
                    }
                }
            }
        }

        return $price;
    }
//----------------------------------------------------------------------------------------------------------------------





//-------------------------------Получение цены на сегодня для автомобиля-----------------------------------------------
    public static function getPriceTodayAuto($id, $worker){
        $today = date('d.m.Y');
        $base_city = $worker->city_id;
        $index = 0; //Весь день
        $price = 0;
        $maxL = 0;
        $pricings = pricing::where("worker_id", $id)->where("view", "По дням")->get();

        foreach ($pricings as $price_rule){
            $cities = json_decode($price_rule->city);
            if (in_array($base_city, $cities) && $price_rule->info == 1){
                $dates = json_decode($price_rule->date);
                if (strtotime($today)<=$dates[1] && strtotime($today)>=$dates[0]){
                    $prices= json_decode($price_rule->price);
                    $price = $prices[$index];
                }
            }
        }
        if (!$price){
            $pricings = pricing::where("worker_id", $id)->where("view", "По месяцам")->get();

            foreach ($pricings as $price_rule){
                if($price_rule->info <  $maxL){
                    $maxL = $price_rule->info;
                }

                $cities = json_decode($price_rule->city);
                if (in_array($base_city, $cities) && $price_rule->info == 1){
                    $months = json_decode($price_rule->date);
                    $todayMonth = getdate(strtotime($today));
                    if (in_array($todayMonth["mon"], $months)){
                        $prices= json_decode($price_rule->price);
                        $price = $prices[$index];
                    }
                }
            }

        }

        return $price;

    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------Добавление заказа--------------------------------------------------------------------------
    public function addOrders(Request $request, $id){
        $worker_id =  Worker::where("user_id", $id)->first();
        $cat = $worker_id->category_id;
        $new_order = new Order();
        $info["data"] = $request->input('data');
        $info["city"] = $request->input('cities');
        $hours = $request->input('hours');
        $count_hours = $request->input('hours_count');
        $param = 0;
        if($cat == 1 || $cat == 4 || $cat == 5){
            if($hours == 3) {
               $param = ($count_hours == 1) ? 2 : 1;
            }
        }
        $info["time"] = $param;
        $price_info = PricingController::getPricingInfo($request, $cat, $worker_id->id, $param);
        $info["price"] = json_decode($price_info)->price;
        $info["deposit"] = json_decode($price_info)->deposit;

        $new_order->infos = json_encode($info);
        $new_order->status = 1;
        $new_order->user_id = Auth::user()->id;

        $new_order->worker_id = $worker_id->id;
        $new_order->save();
        return redirect("/product/$id");

    }
//----------------------------------------------------------------------------------------------------------------------













}
