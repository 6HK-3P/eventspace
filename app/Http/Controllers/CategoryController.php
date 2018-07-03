<?php

namespace App\Http\Controllers;

use App\pricing;
use App\Site_setting;
use App\Type;
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




//---------------------------------------Индексовая страница------------------------------------------------------------
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
        $minmax = $this->minmax($cat);

        return view('category')
            ->with([
                'attributes' =>  [],
                'min' => $minmax["min"],
                'max' => $minmax["max"],
                'city' => '1',
                'items' => $items,
                'category' => $category,
                'teasers' => $teasers,
                'cat' => $cat,
                'carstypes' => $carstype,
                'carsmarks' => $carsmark,
                'carscolors' => $carscolor,
                'allcities' => $allcitie,
                'alltoasts' => $alltoast,
                'alllanguages' => $alllanguage,
                'videose' => $videoe,
                'videosq' => $videoq,
                'audios' => $audiotype,
                'allheads' => $allhead
            ]);

    }
//----------------------------------------------------------------------------------------------------------------------





//------------------------------------Сортировка на странице выбора воркера---------------------------------------------
    public function sort(Request $request)
    {
        $cat = $request->input("cat");
        $order = $request->input("order");
        $result = $this->sortAlphavit($cat, $order);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
//----------------------------------------------------------------------------------------------------------------------





//------------------------------------Округление значений палзунка------------------------------------------------------
    public function minmax($cat){
        $worker_ids = Worker::where("category_id", $cat)->pluck('id');
        $items_price = pricing::whereIn("worker_id", $worker_ids)->pluck('price');
        $arrayPrice = [];
        $max = 0;
        $min = 0;
        foreach ($items_price as $price){
            $arrayPrice[] = json_decode($price)[0];
        }
        $max = collect($arrayPrice)->max();
        $min = collect($arrayPrice)->min();
        if ($min<1000){
            $min = 0;
        }
        elseif ($min % 1000){
            $min = floor($min/1000)*1000;
        }
        if ($max % 1000){
            $max = ceil($max/1000)*1000;
        }
        return ["min"=>$min, "max"=>$max];
    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------------Сортировка по алфавиту на странице выбор воркера-------------------------------------
    public function sortAlphavit($cat, $order)
    {
        $items = User::whereHas('worker', function ($q) use ($cat) {
            $q->where('category_id', $cat);
        })->orderBy("name", $order)->limit(7)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", "7")->get();

        return ["teasers" => $teasers, 'items' => $items];
    }
//----------------------------------------------------------------------------------------------------------------------





//-------------------------------------Получение всех воркеров выбранной категории для вывода---------------------------
    public function getWorkers(Request $request)
    {
        $cat = $request->cat;
        $order = $request->order;
        $searchs = $request->search;
        $offset = $request->offset;
        $items = User::whereHas('worker', function ($q) use ($cat) {
            $q->where('category_id', $cat);
        })->orderBy("name", $order)->offset($offset)->limit(6)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", 6 + $offset)->where("position", "=>", $offset)->get();

        return response()->json(["teasers" => $teasers, "items" => $items]);
    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------Поиск по имени воркера----------------------------------------------------------
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
        foreach ( $items as $item){
            $test = $item->worker->comment;
        }
        $test = null;
        echo json_encode(["teasers" => $teasers, 'items' => $items], JSON_UNESCAPED_UNICODE);
    }
//----------------------------------------------------------------------------------------------------------------------





//----------------------------------------Преоброзование категорий в id-------------------------------------------------
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
//----------------------------------------------------------------------------------------------------------------------





//-------------------------------------Получение основной информации о воркере для вывода на карточку-------------------
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
                    //print_r($info->types_conf);// $item->param1 = Workers_toastmaster_type::find($info->types_conf*1)->title;
                } elseif ($cat == 6) {
                    //$item->param1 = Workers_cars_mark::find($info->cars_mark*1)->title;
                    //$item->param2 = Workers_cars_color::find($info->cars_color*1)->title;
                }
            }
        }

        return $items;
    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------------Общая сортировка по выбранным пунктам в фильтрах--------------------------
    public function sortFilters(Request $request, $category)
    {
        $cat = $this->selectCategory($category);
        $users = [];
        switch ($cat) {
            case "1" :
                $users = $this->sortNarrator($request, $cat);
                break;
            case "2":
                $users = $this->sortNarrator($request, $cat);
                break;
            case "3":
                $users = $this->sortNarrator($request, $cat);
                break;
            case "5":
                $users = $this->sortNarrator($request, $cat);
                break;
            case "4":
                $users = $this->sortNarrator($request, $cat);
                break;
            case "6":
                $users = $this->sortAuto($request, $cat);
                break;
            default:
                $users = $this->sortNarrator($request, $cat);
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

        $minmax = $this->minmax($cat);

        return view('category')->with([
            'min' => $minmax["min"],
            'max' => $minmax["max"],
            'items' => $users,
            'category' => $category,
            'teasers' => [],
            'cat' => $cat,
            'carstypes' => $carstype,
            'carsmarks' => $carsmark,
            'carscolors' => $carscolor,
            'allcities' => $allcitie,
            'alltoasts' => $alltoast,
            'alllanguages' => $alllanguage,
            'videose' => $videoe,
            'videosq' => $videoq,
            'audios' => $audiotype,
            'allheads' => $allhead,
            'city' => $city,
            'arenda_ot' => $request->input("arenda_ot"),
            'arenda_do' => $request->input("arenda_do"),
            'attributes' => ($request->input('attributes')) ? $request->input('attributes') : [],
        ]);
    }
//----------------------------------------------------------------------------------------------------------------------





//------------------------------------------Сортировка для автомобилей--------------------------------------------------
    private function sortAuto(Request $request, $cat)
    {
        $data = $request->input("data");
        $city = $request->input("cities");
        $price_ot = $request->input("arenda_ot");
        $price_do = $request->input("arenda_do");
        $attributes = ($request->input('attributes')) ? $request->input('attributes') : [];
//        $mark = $request->input("marks");
//        $color = $request->input("colors");
//        $type = $request->input("types");
        $type = Type::where('entry_id', 7)->whereIn('id', $attributes)->pluck('id');
        $mark = Type::where('entry_id', 9)->whereIn('id', $attributes)->pluck('id');
        $color = Type::where('entry_id', 8)->whereIn('id', $attributes)->pluck('id');
        $result = workers_car::whereNotNull("worker_id");
        if (count($color) > 0) $result->whereIn("color_id", $color);
        if (count($type) > 0) $result->whereIn("type_id", $type);
        if (count($mark) > 0) $result->whereIn("mark_id", $mark);
//        if (!empty($attributes)) $result->whereIn("mark_id", $mark);

        $cars = $result->get();

        $arrayCarIds = [];

        foreach ($cars as $car) {
            $workerPricing = pricing::getPricingDay($car->worker_id, $data, $city, $price_ot, $price_do);
            if (count($workerPricing) > 0) {
                $arrayCarIds[] = $car->worker_id;
            }
        }

        if (count($arrayCarIds)) {
            $usersIds = Worker::whereIn('id', $arrayCarIds)->pluck("user_id");
            return User::whereIn("id", $usersIds)->get();
        }
        return false;
    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------------Сортировка для залов------------------------------------------------------
        public function sortHalls(Request $request, $cat)
        {
            if ($request->input('cities')) {
                $search = Worker::where('category_id', $cat)->where('city_id', $request->input('cities'));
            }
            if ($request->input('min_capacity') && $request->input('max_capacity')) {
                $search = Worker::where('category_id', $cat)
                    ->where('workers_additional_info->capacity->start', '<=', trim($request->input('min_capacity')))
                    ->where('workers_additional_info->capacity->end', '>=', trim($request->input('max_capacity')))
                    ->get();

//                //работает
//                foreach ($search as $searchs) {
//                    $decod[] = json_decode($searchs->workers_additional_info);
//                    if ($decod[$i]->capacity->start <= $request->input('min_capacity') && $decod[$i]->capacity->end >= $request->input('max_capacity')) {
//
//                    }
//                    $i++;
//                }



            }


        }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------Сортировка для ведущих----------------------------------------------------------------
    public function sortNarrator(Request $request, $cat)
    {
        $attributes = ($request->input('attributes')) ? $request->input('attributes') : [];

        $result = Worker::where('category_id',$cat);
        if($attributes != []) {
            $result->where(function ($query) use($attributes){
                foreach ($attributes as $attribute) {
                    $query->where('attributes', 'LIKE', '%"' . $attribute . '"%');
                }
            });
        }
//        $typeNarr = ($request->input('type_narrator')) ? $request->input('type_narrator'): [];
//        $langNarr = ($request->input('language_narrator')) ? $request->input('language_narrator'): [];
        $index = 0;
        if($cat == 3){
            $max_capacity = ($request->input('max_capacity')) ? trim($request->input('max_capacity')) : 99999 ;
            $min_capacity = ($request->input('min_capacity')) ? trim($request->input('min_capacity')) : 0 ;
            $result = Worker::where('category_id', $cat)
                ->where('capacity_start', '>=', $min_capacity)
                ->where('capacity_end', '<=', $max_capacity);
            $index = 1;
        }
        $data = $request->input('data');
        $city = $request->input('cities');
        $price_ot = ($request->input('price_check')) ? $request->input('price_check')[0]  : $request->input('arenda_ot');
        $price_do = ($request->input('price_check')) ? $request->input('price_check')[1]  : $request->input('arenda_do');
        $searchNarrType = [];
        foreach ($result->get() as $worker) {
            $workerPricing = pricing::getPricingDay($worker->id, $data, $city, $price_ot, $price_do, $index);
            if (count($workerPricing) > 0) {
                $searchNarrType[] = $worker->id;
            }
        }

        if ($searchNarrType) {
            $users_id = Worker::select('user_id')->whereIn('id', $searchNarrType)->pluck('user_id');
            return User::whereIn('id', $users_id)->get();
        }

    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------Сортировка для фотографов-------------------------------------------------------
    public function sortPhoto(Request $request, $cat)
    {
        $data = $request->input('data');
        $city = $request->input('cities');
        $price_ot = $request->input('arenda_ot');
        $price_do = $request->input('arenda_do');

        //---------------------
        $result = Worker::where('category_id', $cat)->get();

        /*Нарыли ведущих - исполнителей в зависимости от типа. На выходе массив их id*/


        $searchNarrType = [];
        foreach ($result as $worker) {
            $price = "";
            $workerPricing = pricing::where("worker_id", $worker->id)->where('view', 'По дням')->orderBy("id", "DESC")->get();
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
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            if ($price >= $price_ot && $price <= $price_do) {
                $searchNarrType[] = $worker->id;
            }
        }

        if ($searchNarrType) {
            $users_id = Worker::select('user_id')->whereIn('id', $searchNarrType)->get()->pluck('user_id');
            return User::whereIn('id', $users_id)->get();
        }
    }
//----------------------------------------------------------------------------------------------------------------------





//--------------------------------------Сортировка для видеостудий-------------------------------------------------------
    public function sortVideo(Request $request, $cat)
    {
        $kran = ($request->input('kran')) ? "kran" : false ;
        $kvadro = ($request->input('kvadro')) ? "kvadro" : false ;
        $k = ($request->input('k')) ? "k" : false ;
        $FullHD = ($request->input('FullHD')) ? "fullHD" : false ;
        $count_camera_wedding = $request->input('count_camera_wedding');
        $data = $request->input('data');
        $city = $request->input('cities');
        $price_ot = $request->input('arenda_ot');
        $price_do = $request->input('arenda_do');
        $diapazone = [];
        $quality = ($request->input('quality'))? $request->input('quality'): ["1"];
        $result = Worker::where('category_id', $cat)->get();

        switch ($count_camera_wedding){
            case "1" : $diapazone = [3]; break;
            case "2" : $diapazone = [2,5,7,9]; break;
            case "3" : $diapazone = [1,4,6,8]; break;
        }


        if($kvadro || $kran){
            if (!($kvadro && $kran)){
                if($kvadro){
                    $key = array_search('4',$diapazone);
                    if($key) unset($diapazone[$key]) ;
                    $key = array_search('5',$diapazone);
                    if($key) unset($diapazone[$key]) ;
                }
                if($kran){
                    $key = array_search('8',$diapazone);
                    if($key) unset($diapazone[$key]) ;
                    $key = array_search('9',$diapazone);
                    if($key) unset($diapazone[$key]) ;
                }
                $key = array_search('6',$diapazone);
                if($key) unset($diapazone[$key]) ;
                $key = array_search('7',$diapazone);
                if($key) unset($diapazone[$key]) ;
            }
        }
        


        /*Нарыли ведущих - исполнителей в зависимости от типа. На выходе массив их id*/


        $searchNarrType = [];
        foreach ($result as $worker) {
            $price = "";
            $workerPricing = pricing::where("worker_id", $worker->id)->where('view', 'По дням')->orderBy("id", "DESC")->get();
            foreach ($workerPricing as $pricings) {
                $arrayData = json_decode($pricings->date);
                if (strtotime($arrayData[0]) <= strtotime($data) && strtotime($arrayData[1]) >= strtotime($data)) {
                    $arrayCities = json_decode($pricings->city);
                    foreach ($arrayCities as $c) {
                        if ($c == $city) {
                            $tp = json_decode($pricings->info)[0];
                            if (in_array($tp, $diapazone)){
                                $tp2 = json_decode($pricings->info)[1];
                                if (in_array($tp2, $quality)) {
                                    $arrayPrice = json_decode($pricings->price);
                                    $price = $arrayPrice[0];
                                    break;
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
                                    $tp = json_decode($pricings->info)[0];
                                    if (in_array($tp, $diapazone)){
                                        $tp2 = json_decode($pricings->info)[1];
                                        if (in_array($tp2, $quality)) {
                                            $arrayPrice = json_decode($pricings->price);
                                            $price = $arrayPrice[0];
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($price >= $price_ot && $price <= $price_do) {
                $searchNarrType[] = $worker->id;
            }
        }

        if ($searchNarrType) {
            $users_id = Worker::select('user_id')->whereIn('id', $searchNarrType)->get()->pluck('user_id');
            return User::whereIn('id', $users_id)->get();
        }
    }
//----------------------------------------------------------------------------------------------------------------------





//---------------------------------Сортировка для музыкантов------------------------------------------------------------
    public function sortAudio(Request $request, $cat)
    {
        $typeNarr = ($request->input('type_narrator')) ? $request->input('type_narrator'): [];
        $langNarr = ($request->input('language_narrator')) ? $request->input('language_narrator'): [];
        $data = $request->input('data');
        $city = $request->input('cities');
        $price_ot = $request->input('arenda_ot');
        $price_do = $request->input('arenda_do');
        $searchNarrType = '';


        $result = Worker::where('category_id', $cat)->get();
        /*Нарыли ведущих - исполнителей в зависимости от типа. На выходе массив их id*/
        if ((in_array("1", $typeNarr) && in_array("2", $typeNarr)) || count($typeNarr) == 0) {
            $searchNarrType = Worker::where('category_id', $cat)->get()->pluck("id");
        }
        elseif (in_array("2", $typeNarr) && !in_array("1", $typeNarr)) {
            foreach ($result as $sear) {
                $searchs = json_decode($sear->workers_additional_info);
                if (in_array("2" ,$searchs->types)) {
                    $searchNarrType[] = $sear['id'];

                }
            }
        }
        elseif (in_array("1", $typeNarr) && !in_array("2", $typeNarr)) {
            foreach ($result as $sear) {
                $searchs = json_decode($sear->workers_additional_info);
                if (in_array("1" ,$searchs->types)) {
                    $searchNarrType[] = $sear['id'];

                }
            }
        }


        /*Нарыли ведущих - исполнителей в зависимости от языка и типа. На выходе массив их id*/
        if (count($langNarr) != 0) {
            $result = Worker::whereIn('id', $searchNarrType)->get();
            $searchNarrType = [];
            foreach ($result as $worker) {
                $info = json_decode($worker->workers_additional_info);
                $langArray = $info->lang;
                for ($j = 0; $j < count($langNarr); $j++) {
                    if (in_array($langNarr[$j], $langArray)) {
                        $searchNarrType[] = $worker->id;
                        break;
                    }
                }
            }

        }

        $result = Worker::whereIn('id', $searchNarrType)->get();
        $searchNarrType = [];
        foreach ($result as $worker) {
            $price = "";
            $workerPricing = pricing::where("worker_id", $worker->id)->where('view', 'По дням')->orderBy("id", "DESC")->get();
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
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            if ($price >= $price_ot && $price <= $price_do) {
                $searchNarrType[] = $worker->id;
            }
        }


        if ($searchNarrType) {
            $users_id = Worker::select('user_id')->whereIn('id', $searchNarrType)->get()->pluck('user_id');
            return User::whereIn('id', $users_id)->get();
        }

    }
//----------------------------------------------------------------------------------------------------------------------



}
