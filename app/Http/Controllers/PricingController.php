<?php

namespace App\Http\Controllers;

use App\pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function getPricingInfo(Request $request, $category, $worker_id, $param)
    {

        $result = [];
        switch ($category) {
            case "1" :
                $result = $this->getPricingInfoEntertainer($request, $worker_id, $param);
                break;
            case "2":
                $result = $this->sortAuto($request, $category);
                break;
            case "3":
                $result = $this->getPricingInfoHall($request, $param, $worker_id);
                break;
            case "5":
                $result = $this->getPricingInfoEntertainer($request, $worker_id, $param);
                break;
            case "4":
                $result = $this->getPricingInfoEntertainer($request, $worker_id, $param);
                break;
            case "6":
                $result = $this->getPricingInfoAuto($request, $worker_id);
                break;
            default:
                $result = $this->sortAuto($request, $category);
        }
        return $result;

    }



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

    public function getPricingInfoEntertainer(Request $request, $worker_id, $param){

        $price = '';
        $deposit = '';
        $data = $request->input('data');
        $city= $request->input('cities');
        $workerPricing = pricing::where('worker_id', $worker_id)->where( 'view', 'По дням')->orderBy("id", "DESC")->get();

        foreach ($workerPricing as $pricings){
            $arrayData= json_decode($pricings->date);
            if(strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)){
                $arrayCities = json_decode($pricings->city);
                foreach ($arrayCities as $c){
                    if($c == $city) {
                        $arrayPrice = json_decode($pricings->price);
                        $price = $arrayPrice[$param];
                        $arrayDeposit = json_decode($pricings->deposit);
                        $deposit = $arrayDeposit[$param];
                        break;
                    }
                }
            }
        }

        if(empty($price)){
            $workerPricing = pricing::where('worker_id', $worker_id)->where( 'view', 'По месяцам')->orderBy("id", "DESC")->get();
            $mesData = getdate(strtotime($data));
            foreach ($workerPricing as $pricings){
                $arrayData= json_decode($pricings->date);
                foreach ($arrayData as $month){
                    if($month == $mesData["mon"]){
                        $arrayCities = json_decode($pricings->city);
                        foreach ($arrayCities as $c){
                            if($c == $city) {
                                $arrayPrice = json_decode($pricings->price);
                                if(!empty($arrayPrice[$param])){
                                    $price =  $arrayPrice[$param];
                                    $arrayDeposit = json_decode($pricings->deposit);
                                    $deposit =  $arrayDeposit[$param];
                                }
                                break;
                            }
                        }
                        break;
                    }
                }

            }
        }

        return (empty($price)) ? json_encode(false) : json_encode(["price"=>$price, "deposit"=>$deposit]);


    }
}
