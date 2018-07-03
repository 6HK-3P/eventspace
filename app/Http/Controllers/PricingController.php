<?php

namespace App\Http\Controllers;

use App\pricing;
use App\Workers_calendar;
use Illuminate\Http\Request;

class PricingController extends Controller
{




//-------------Получение цены на выбранный день и по выбранным пунктам на странице продукта-----------------------------
    public static function getPricingInfo(Request $request, $category, $worker_id, $param)
    {

        $result = json_encode(false);
        $data = date("d.m.Y",strtotime($request->input('data')));
        $calendar = Workers_calendar::where("worker_id", $worker_id)->first();
        $arrayDates = [];
        if(count($calendar)){
            $arrayDates = json_decode($calendar->dates);
        }
            if(!in_array($data, $arrayDates)){
                switch ($category) {
                    case "1" :
                        $result = self::getPricingInfoEntertainer($request, $worker_id, $param);
                        break;
                    case "2":
                        $result = self::getPricingInfoVideo($request, $worker_id, $param);
                        break;
                    case "3":
                        $result = self::getPricingInfoHall($request, $worker_id, $param);
                        break;
                    case "5":
                        $result = self::getPricingInfoEntertainer($request, $worker_id, $param);
                        break;
                    case "4":
                        $result = self::getPricingInfoEntertainer($request, $worker_id, $param);
                        break;
                    case "6":
                        $result = self::getPricingInfoAuto($request, $worker_id);
                        break;
                    default:
                        $result = self::getPricingInfoAuto($request, $category);
                }
            }


        return $result;

    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------------Получение цены по критериям для залов-------------------------------------
    public static function getPricingInfoHall(Request $request, $worker_id, $param){
        $data = $request->input('data');
        $workerPricing = pricing::getPricingDay($worker_id,$data,null,0,999999999,$param);
        $price = (isset($workerPricing->price)) ? json_decode($workerPricing->price) : null;
        $deposit =  (isset($workerPricing->deposit)) ? json_decode($workerPricing->deposit) : null;
        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);


    }
//----------------------------------------------------------------------------------------------------------------------





//----------------------------------------Получение цен по критериям для авто-------------------------------------------
    public static function getPricingInfoAuto(Request $request, $worker_id){
        $data = $request->input('data');
        $city= $request->input('cities');
        $auto_id= $request->input('auto_id');

        $workerPricing = pricing::getPricingDay($worker_id,$data,$city,0,999999999);
        $workerPricing = ($workerPricing->info == $auto_id) ? $workerPricing : [];
        $price = (isset($workerPricing->price)) ? json_decode($workerPricing->price) : null;
        $deposit =  (isset($workerPricing->deposit)) ? json_decode($workerPricing->deposit) : null;
        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);


    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------------------Получение цен по критериям для остальных---------------------------------------
    public static function getPricingInfoEntertainer(Request $request, $worker_id, $param){

        $data = $request->input('data');
        $city= $request->input('cities');
        $workerPricing = pricing::getPricingDay($worker_id,$data,$city,0,999999999,$param);

        $price = (isset($workerPricing->price)) ? json_decode($workerPricing->price) : null;
        $deposit =  (isset($workerPricing->deposit)) ? json_decode($workerPricing->deposit) : null;
        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);
    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------------------Получение цен по критериям для остальных---------------------------------------
    public static function getPricingInfoVideo(Request $request, $worker_id, $param){

        $data = $request->input('data');
        $moving = $request->input('moving');
        $cameras = $request->input('cameras');
        $equipment = $request->input('equipment');
        $city= $request->input('cities');
        if(!isset($equipment)){
            return json_encode(false);
        }
        $workerPricing = pricing::getPricingDay($worker_id,$data,$city,0,999999999,$param, $moving, $cameras, $equipment);
        $price = (isset($workerPricing->price)) ? json_decode($workerPricing->price) : null;
        $deposit =  (isset($workerPricing->deposit)) ? json_decode($workerPricing->deposit) : null;

//        $workerPricing = pricing::where('worker_id', $worker_id)->where( 'view', 'По дням')->orderBy("id", "DESC")->get();
//        foreach ($workerPricing as $pricings){
//            $arrayInfo= json_decode($pricings->info);
//            if($arrayInfo[0] == $type && $arrayInfo[1] == $quality){
//                $arrayData= json_decode($pricings->date);
//                if(strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)){
//                    $arrayCities = json_decode($pricings->city);
//                    foreach ($arrayCities as $c){
//                        if($c == $city) {
//                            $arrayPrice = json_decode($pricings->price);
//                            $price = $arrayPrice[$param];
//                            $arrayDeposit = json_decode($pricings->deposit);
//                            $deposit = $arrayDeposit[$param];
//                            break;
//                        }
//                    }
//                }
//            }
//
//        }
//
//        if(empty($price)){
//            $workerPricing = pricing::where('worker_id', $worker_id)->where( 'view', 'По месяцам')->orderBy("id", "DESC")->get();
//            $mesData = getdate(strtotime($data));
//            foreach ($workerPricing as $pricings){
//                $arrayInfo= json_decode($pricings->info);
//                if($arrayInfo[0] == $type && $arrayInfo[1] == $quality) {
//                    $arrayData = json_decode($pricings->date);
//                    foreach ($arrayData as $month) {
//                        if ($month == $mesData["mon"]) {
//                            $arrayCities = json_decode($pricings->city);
//                            foreach ($arrayCities as $c) {
//                                if ($c == $city) {
//                                    $arrayPrice = json_decode($pricings->price);
//                                    if (!empty($arrayPrice[$param])) {
//                                        $price = $arrayPrice[$param];
//                                        $arrayDeposit = json_decode($pricings->deposit);
//                                        $deposit = $arrayDeposit[$param];
//                                    }
//                                    break;
//                                }
//                            }
//                            break;
//                        }
//                    }
//                }
//
//            }
//        }

        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price[$param], "deposit"=>$deposit[$param]]);
    }
//----------------------------------------------------------------------------------------------------------------------






}
