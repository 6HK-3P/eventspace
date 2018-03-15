<?php

namespace App\Http\Controllers;

use App\Interval;
use App\pricing;
use App\User;
use App\worker;
use App\Workers_categorie;
use App\workers_citie;
use App\workers_language;
use App\workers_musicians_type;
use App\Site_setting;
use Illuminate\Http\Request;

class MainController extends Controller
{



    public function index()
    {
        $all_category = Workers_categorie::all();
        $all_workers = Worker::all();
        $infos = '';
        $infos_min = '';
        $infos_norm = '';

        foreach ($all_category as $categories){

            $info_min = '';
            $info_max = '';
            $info_norm = '';
            $allworker = Worker::where("category_id", $categories->id)->get();
            $select_interval = Interval::where("category_id", $categories->id)->get();
            foreach ($allworker as $worker){

                $city = $worker->city_id;
                $price = "";
                $workerPricing = pricing::where("worker_id", $worker->id)->where('view', 'По дням')->orderBy("id", "DESC")->get();
                $data = date('d-m-Y');
                foreach ($workerPricing as $pricings) {
                    $arrayData = json_decode($pricings->date);
                    if (strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)) {
                        $arrayCities = json_decode($pricings->city);
                        foreach ($arrayCities as $c) {
                            if ($c == $city) {
                                $arrayPrice = json_decode($pricings->price);
                                $price = $arrayPrice[0];
                                if(!empty($price)){

                                    if($price <= $select_interval[0]->to ){
                                        $info_min[] = $worker;
                                        $worker->minprice = $price;
                                    }
                                    if($price >= $select_interval[0]->to && $price <=  $select_interval[1]->to){
                                        $info_norm[] = $worker;
                                        $worker->normprice = $price;
                                    }
                                    if($price >=  $select_interval[1]->to){
                                        $info_max[] = $worker;
                                        $worker->maxprice = $price;
                                    }
                                }
                            }
                        }
                    }
                }
                if (empty($price)) {
                    $workerPricing = pricing::where("worker_id", $worker->id)->where('view', 'По месяцам')->orderBy("id", "DESC")->get();
                    $mesData = getdate(strtotime($data));
                    foreach ($workerPricing as $pricings) {
                        $arrayData = json_decode($pricings->date);
                        foreach ($arrayData as $month) {

                            if ($month == $mesData["mon"]) {
                                $arrayCities = json_decode($pricings->city);
                                foreach ($arrayCities as $c) {
                                    if ($c == $city) {
                                        $arrayPrice = json_decode($pricings->price);
                                        $price = $arrayPrice[0];
                                        if(!empty($price)){

                                            if($price <= $select_interval[0]->to ){
                                                $info_min[] = $worker;
                                                $worker->minprice = $price;
                                            }
                                            if($price >= $select_interval[0]->to && $price <=  $select_interval[1]->to){
                                                $info_norm[] = $worker;
                                                $worker->normprice = $price;
                                            }
                                            if($price >=  $select_interval[1]->to){
                                                $info_max[] = $worker;
                                                $worker->maxprice = $price;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $min = null;
            $max = null;
            $norm = null;
            $minss = rand(0, count($info_min)-1);
            $normss = rand(0, count($info_norm)-1);
            $maxss = rand(0, count($info_max)-1);
            if(!empty($info_min))
                $min = $info_min[$minss];
            if(!empty($info_norm))
                $norm = $info_norm[$normss];
            if(!empty($info_max))
                $max = $info_max[$maxss];

            $categories->worker_min = $min;
            $categories->worker_norm = $norm;
            $categories->worker_max = $max;

        }

        $rand = rand(0, count($all_workers)-1);
        $rand_worker = $all_workers[$rand];

        return view('index')->with(["AllCategory" => $all_category, 'rand_worker'=>$rand_worker]);
    }




}



