<?php

namespace App\Http\Controllers;

use App\Site_setting;
use App\User;
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

    public function index($category="car")
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


        return view('category')->with(['items'=>$items, 'teasers'=>$teasers,'cat'=>$cat, 'carstypes' => $carstype, 'carsmarks' => $carsmark,'carscolors' => $carscolor,
                                             'allcities' => $allcitie ,  'alltoasts' => $alltoast ,'alllanguages' => $alllanguage,
                                              'videose' => $videoe, 'videosq' => $videoq , 'audios'=>$audiotype, 'allheads'=>$allhead]);

    }


    public function sort(Request $request)
    {
        $cat = $request->input("cat");
        $order = $request->input("order");
        $result = $this->sortAlphavit($cat, $order);
        echo json_encode($result,JSON_UNESCAPED_UNICODE);

    }


    public function sortAlphavit($cat, $order)
    {
        $items = User::whereHas('worker', function($q) use ($cat) {$q->where('category_id', $cat);})->orderBy("name", $order)->limit(7)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=","7")->get();

        return ["teasers"=>$teasers, 'items'=>$items];
    }


    public function getWorkers(Request $request)
    {
        $cat = $request->input("cat");
        $order = $request->input("order");
        $searchs = $request->input("search");
        $offset = $request->input("offset");
        $items = User::whereHas('worker', function($q) use ($cat) {$q->where('category_id', $cat);})->orderBy("name", $order)->offset($offset)->limit(6)->get();
        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=", 6+$offset)->where("position", "=>", $offset)->get();

        echo json_encode(["teasers"=>$teasers,"items"=> $items],JSON_UNESCAPED_UNICODE);
    }

    public function search(Request $request)
    {

        $cat = $request->input("cat");
        $order = $request->input("order");
        $searchs = $request->input("search");
        $items = User::whereHas('worker', function($q) use ($cat) {$q->where('category_id', $cat); })->where('name','LIKE', '%'.$searchs.'%')->orderBy("name", $order)->limit(7)->get();

        $items = $this->getAdditionalInfo($items, $cat);
        $teasers = Teaser::where("position", "<=","7")->get();

        echo json_encode(["teasers"=>$teasers, 'items'=>$items],JSON_UNESCAPED_UNICODE);
    }


    public function selectCategory($category){
        switch ($category){
            case "photographers" : $cat = 1; break;
            case "video": $cat = 2; break;
            case "halls": $cat = 3; break;
            case "musicians": $cat = 4; break;
            case "toastmakers": $cat = 5; break;
            case "cars": $cat = 6; break;
            default: $cat = 1;
        }
        return $cat;
    }


    public function getAdditionalInfo($items,  $cat){
        if (count($items)){
            foreach ($items as $item){
                /*наковыриваем для товаров-воркеров недостающую инфу*/
                $item->city = Workers_citie::find($item->worker->city_id)->title;
                $info = json_decode($item->worker->workers_additional_info);
                if ($cat == 4){
                    $item->param1 = Workers_musicians_type::find($info->basic_types*1)->title;
                    $item->param2 = Workers_language::find($info->basic_lang*1)->name;
                }
                elseif($cat == 2){
                    //$item->param1 = Workers_video_qualitie::find($info->basic_quality*1)->title;
                    //$item->param2 = Workers_count_camer::find($info->count_camers*1)->title;
                }
                elseif($cat == 5){
                   print_r($info->types_conf);// $item->param1 = Workers_toastmaster_type::find($info->types_conf*1)->title;
                }
                elseif($cat == 6){
                    //$item->param1 = Workers_cars_mark::find($info->cars_mark*1)->title;
                    //$item->param2 = Workers_cars_color::find($info->cars_color*1)->title;
                }
            }
        }

        return $items;
    }
}
