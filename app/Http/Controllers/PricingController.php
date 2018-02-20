<?php

namespace App\Http\Controllers;

use App\pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function getPricingInfoHall(Request $request, $param, $id){
        $price = '';
        $deposit = '';
        $data = $request->input('data');
        $workerPricing = pricing::where('worker_id', $id)->where( 'view', 'По дням')->orderBy("id", "DESC")->get();
        foreach ($workerPricing as $pricings){
            $arrayData= json_decode($pricings->date);
            if(strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)){
                $arrayPrice = json_decode($pricings->price);
                $price = $arrayPrice[$param];
                $arrayDeposit = json_decode($pricings->deposit);
                $deposit = $arrayDeposit[$param];
                break;
            }
        }

        if(empty($price)){
            $workerPricing = pricing::where('worker_id', $id)->where( 'view', 'По месяцам')->orderBy("id", "DESC")->get();
            $mesData = getdate(strtotime($data));
            foreach ($workerPricing as $pricings){
                $arrayData= json_decode($pricings->date);
                foreach ($arrayData as $month){
                    if($month == $mesData["mon"]){
                        $arrayPrice = json_decode($pricings->price);
                        $price = $arrayPrice[$param];
                        $arrayDeposit = json_decode($pricings->deposit);
                        $deposit = $arrayDeposit[$param];
                        break;
                    }
                }

            }
        }

        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);


    }
    public function getPricingInfoHallCategory(Request $request, $cat){
        $param = $request->input("cost");

        
    }


    public function getPricingInfoAuto(Request $request, $worker_id){
        $price = '';
        $deposit = '';
        $data = $request->input('data');
        $city= $request->input('cities');
        $auto_id= $request->input('auto_id');

        $workerPricing = pricing::where('worker_id', $worker_id)->where("info", $auto_id)->where( 'view', 'По дням')->orderBy("id", "DESC")->get();
        foreach ($workerPricing as $pricings){
            $arrayData= json_decode($pricings->date);
            if(strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)){
                $arrayCities = json_decode($pricings->city);
                foreach ($arrayCities as $c){
                    if($c == $city) {
                        $arrayPrice = json_decode($pricings->price);
                        $price = $arrayPrice[0];
                        $arrayDeposit = json_decode($pricings->deposit);
                        $deposit = $arrayDeposit[0];
                        break;
                    }
                }
            }
        }

        if(empty($price)){
            $workerPricing = pricing::where('worker_id', $worker_id)->where("info", $auto_id)->where( 'view', 'По месяцам')->orderBy("id", "DESC")->get();
            $mesData = getdate(strtotime($data));
            foreach ($workerPricing as $pricings){
                $arrayData= json_decode($pricings->date);
                foreach ($arrayData as $month){
                    if($month == $mesData["mon"]){
                        $arrayCities = json_decode($pricings->city);
                        foreach ($arrayCities as $c){
                            if($c == $city) {
                                $arrayPrice = json_decode($pricings->price);
                                $price = $arrayPrice[0];
                                $arrayDeposit = json_decode($pricings->deposit);
                                $deposit = $arrayDeposit[0];
                                break;
                            }
                        }
                    }
                }

            }
        }

        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);


    }
}
