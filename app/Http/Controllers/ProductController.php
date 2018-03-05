<?php

namespace App\Http\Controllers;

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

class ProductController extends Controller
{
    public function index($id){
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
        return view("product")->with([ 'city'=>$city, 'allCarsWorker' => $allCarsWorker, 'InfoUsers' => $allInfoUser, 'InfoWorker' => $allInfoWorker, 'carstypes' => $carstype, 'carsmarks' => $carsmark,'carscolors' => $carscolor,
                                             'allcities' => $allcitie ,  'alltoasts' => $alltoast ,'alllanguages' => $alllanguage,
                                              'videose' => $videoe, 'videosq' => $videoq , 'audios'=>$audiotype, 'allheads'=>$allhead]);
    }

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
            case 6 : $price = self::getPriceTodayDefault($id, $worker); break;

        }
        return $price;
    }
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
}
