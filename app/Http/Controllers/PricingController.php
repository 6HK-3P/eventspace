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
        $workerPricing = pricing::where('worker_id', $id)->where( 'view', 'По дням')->get();
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
            $workerPricing = pricing::where('worker_id', $id)->where( 'view', 'По месяцам')->get();
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
}
