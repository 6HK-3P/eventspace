<?php

namespace App\Http\Controllers;

use App\pricing;
use App\Site_setting;
use App\User;
use App\workers_car;
use App\Workers_cars_color;
use App\Workers_cars_mark;
use App\Workers_citie;
use App\Workers_language;
use App\Workers_musicians_type;
use App\Workers_toastmaster_type;
use App\Workers_video_equipment;
use App\Workers_video_qualitie;
use App\Worker;
use App\Workers_cars_type;
use App\Workers_count_camer;
use App\Teaser;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index($category = "car")
    {
        //вся информация которая в шапке
        $allhead = Site_setting::all();

        $cat = $this->selectCategory($category);
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
        /*наковыриваем товары-воркеры*/
        $result = $this->sortAlphavit($cat, "ASC");
        $teasers = $result["teasers"];
        $items = $result["items"];

        $worker_ids = Worker::where("category_id", $cat)->get()->pluck('id');
        /*$min_price = pricing::whereIn("worker_id", $worker_ids)->orderBy("price->0")->first();*/
        $items_price = pricing::whereIn("worker_id", $worker_ids)->get();

        $min = $items_price->sortBy(function ($it) {
            $elem = json_decode($it->price);
            return $elem[0];
        });


        $minRes = json_decode($min[0]->price)[0];
        $maxRes = json_decode($min[count($min) - 1]->price)[0];

        dump($min[5]);

        return view('category')->with(['min' => $minRes, 'max' => $maxRes, 'city' => '1', 'items' => $items, 'category' => $category, 'teasers' => $teasers, 'cat' => $cat, 'carstypes' => $carstype, 'carsmarks' => $carsmark, 'carscolors' => $carscolor,
            'allcities' => $allcitie, 'alltoasts' => $alltoast, 'alllanguages' => $alllanguage,
            'videose' => $videoe, 'videosq' => $videoq, 'audios' => $audiotype, 'allheads' => $allhead]);

    }


    public function sort(Request $request)
    {
        $cat = $request->input("cat");
        $order = $request->input("order");
        $result = $this->sortAlphavit($cat, $order);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }


    public function sortAlphavit($cat, $order)
    {
        $items = User::whereHas('worker', function ($q) use ($cat) {
            $q->where('category_id', $cat);
        })->orderBy("name", $order)->limit(7)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", "7")->get();

        return ["teasers" => $teasers, 'items' => $items];
    }


    public function getWorkers(Request $request)
    {
        $cat = $request->input("cat");
        $order = $request->input("order");
        $searchs = $request->input("search");
        $offset = $request->input("offset");
        $items = User::whereHas('worker', function ($q) use ($cat) {
            $q->where('category_id', $cat);
        })->orderBy("name", $order)->offset($offset)->limit(6)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", 6 + $offset)->where("position", "=>", $offset)->get();

        echo json_encode(["teasers" => $teasers, "items" => $items], JSON_UNESCAPED_UNICODE);
    }

    public function search(Request $request)
    {

        $cat = $request->input("cat");
        $order = $request->input("order");
        $searchs = $request->input("search");
        $items = User::whereHas('worker', function ($q) use ($cat) {
            $q->where('category_id', $cat);
        })->where('name', 'LIKE', '%' . $searchs . '%')->orderBy("name", $order)->limit(7)->get();

        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", "7")->get();

        echo json_encode(["teasers" => $teasers, 'items' => $items], JSON_UNESCAPED_UNICODE);
    }


    public function selectCategory($category)
    {
        switch ($category) {
            case "photographers" :
                $cat = 1;
                break;
            case "video":
                $cat = 2;
                break;
            case "halls":
                $cat = 3;
                break;
            case "musicians":
                $cat = 4;
                break;
            case "toastmakers":
                $cat = 5;
                break;
            case "cars":
                $cat = 6;
                break;
            default:
                $cat = 1;
        }
        return $cat;
    }


    public function getAdditionalInfo($items, $cat)
    {
        if (count($items)) {
            foreach ($items as $item) {
                /*наковыриваем для товаров-воркеров недостающую инфу*/
                $item->city = Workers_citie::find($item->worker->city_id)->title;
                $info = json_decode($item->worker->workers_additional_info);
                if ($cat == 4) {
                    $item->param1 = Workers_musicians_type::find($info->basic_types * 1)->title;
                    $item->param2 = Workers_language::find($info->basic_lang * 1)->name;
                } elseif ($cat == 2) {
                    //$item->param1 = Workers_video_qualitie::find($info->basic_quality*1)->title;
                    //$item->param2 = Workers_count_camer::find($info->count_camers*1)->title;
                } elseif ($cat == 5) {
                    print_r($info->types_conf);// $item->param1 = Workers_toastmaster_type::find($info->types_conf*1)->title;
                } elseif ($cat == 6) {
                    //$item->param1 = Workers_cars_mark::find($info->cars_mark*1)->title;
                    //$item->param2 = Workers_cars_color::find($info->cars_color*1)->title;
                }
            }
        }

        return $items;
    }

//


    public function sortFilters(Request $request, $category)
    {
        $cat = $this->selectCategory($category);
        $users = [];
        switch ($cat) {
            case "1" :
                $users = $this->sortAuto($request, $cat);
                break;
            case "2":
                $users = $this->sortAuto($request, $cat);
                break;
            case "3":
                $users = $this->sortAuto($request, $cat);
                break;
            case "5":
                $users = $this->sortAuto($request, $cat);
                break;
            case "4":
                $users = $this->sortAuto($request, $cat);
                break;
            case "6":
                $users = $this->sortAuto($request, $cat);
                break;
            default:
                $users = $this->sortAuto($request, $cat);
        }
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
        $city = (!empty($request->input('cities'))) ? $request->input('cities') : 1;
        dump($users);
        return view('category')->with(['items' => $users, 'category' => $category, 'teasers' => [],
            'cat' => $cat, 'carstypes' => $carstype, 'carsmarks' => $carsmark, 'carscolors' => $carscolor,
            'allcities' => $allcitie, 'alltoasts' => $alltoast, 'alllanguages' => $alllanguage,
            'videose' => $videoe, 'videosq' => $videoq, 'audios' => $audiotype, 'allheads' => $allhead,
            'city' => $city, 'data' => $request->input("data"), 'arenda_ot' => $request->input("arenda_ot"),
            'arenda_do' => $request->input("arenda_do"), 'mark' => $request->input("marks"), 'type' => $request->input("types"),
            'color' => $request->input("colors"),
        ]);
    }


    private function sortAuto(Request $request, $cat)
    {
        $data = $request->input("data");
        $city = $request->input("cities");
        $price_ot = $request->input("arenda_ot");
        $price_do = $request->input("arenda_do");
        $mark = $request->input("marks");
        $color = $request->input("colors");
        $type = $request->input("types");

        $result = workers_car::whereNotNull("worker_id");

        if (!empty($color)) $result->whereIn("color_id", $color);
        if (!empty($type)) $result->whereIn("type_id", $type);
        if (!empty($mark)) $result->whereIn("mark_id", $mark);

        $cars = $result->get();

        $arrayCarIds = [];

        foreach ($cars as $car) {
            $price = "";
            $workerPricing = pricing::where("info", $car->id)->where('view', 'По дням')->orderBy("id", "DESC")->get();

            foreach ($workerPricing as $pricings) {
                $arrayData = json_decode($pricings->date);
                if (strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)) {
                    $arrayCities = json_decode($pricings->city);
                    foreach ($arrayCities as $c) {
                        if ($c == $city) {
                            $arrayPrice = json_decode($pricings->price);
                            $price = $arrayPrice[0];
                            break;
                        }
                    }
                }
            }
            if (empty($price)) {
                $workerPricing = pricing::where("info", $car->id)->where('view', 'По месяцам')->orderBy("id", "DESC")->get();
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
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            if ($price >= $price_ot && $price <= $price_do) {

                $arrayCarIds[] = $car->id;

            }
        }

        if (count($arrayCarIds)) {
            $workerIds = workers_car::select("worker_id")->groupBy("worker_id")->whereIn("id", $arrayCarIds)->get()->pluck("worker_id");
            $usersIds = Worker::select("user_id")->whereIn('id', $workerIds)->get()->pluck("user_id");
            return User::whereIn("id", $usersIds)->get();
        }
        return json_encode(false);
    }


        public function searchCategory(Request $request, $cat)
        {
            $search = '';
            $decod = '';
            $i = 0;
            if ($cat == 3) {
                if ($request->input('cities')) {
                    $search = Worker::where('category_id', $cat)->where('city_id', $request->input('cities'))->get();
                }
                if ($request->input('min_capacity') && $request->input('max_capacity')) {
                    print_r($request->input('min_capacity'));
                    print_r($request->input('max_capacity'));
                    $search = Worker::where('category_id', $cat)->get();
                    // $search = Worker::where('category_id', $cat)->where('workers_additional_info->capacity->start', '<=', trim($request->input('min_capacity')))->where('workers_additional_info->capacity->end', '>=', trim($request->input('max_capacity')))->get();

                    //работает
                    foreach ($search as $searchs) {
                        $decod[] = json_decode($searchs->workers_additional_info);
                        if ($decod[$i]->capacity->start <= $request->input('min_capacity') && $decod[$i]->capacity->end >= $request->input('max_capacity')) {
                            dump($searchs);
                        }
                        $i++;
                    }


                    dump($search);
                }
            }

        }

}
