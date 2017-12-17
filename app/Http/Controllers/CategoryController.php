<?php

namespace App\Http\Controllers;

use App\workers_cars_color;
use App\workers_cars_mark;
use App\workers_citie;
use App\workers_language;
use App\workers_musicians_type;
use App\workers_toastmaster_type;
use App\workers_video_equipment;
use App\workers_video_qualitie;
use Illuminate\Http\Request;
use App\workers_cars_type;

class CategoryController extends Controller
{

    public function index($category="car")
    {
        $cat = $this->selectCategory($category);
        //всё про машины
        $carstype = workers_cars_type::all();
        $carsmark = workers_cars_mark::all();
        $carscolor = workers_cars_color::all();
        //города
        $allcitie = workers_citie::all();
        //тамада
        $alltoast = workers_toastmaster_type::all();
        //язык
        $alllanguage = workers_language::all();
        //съёмка
        $videoe = workers_video_equipment::all();
        $videoq = workers_video_qualitie::all();
        //музыка
        $audiotype = workers_musicians_type::all();

        return view('category')->with(['cat'=>$cat, 'carstypes' => $carstype, 'carsmarks' => $carsmark,'carscolors' => $carscolor,
                                             'allcities' => $allcitie ,  'alltoasts' => $alltoast ,'alllanguages' => $alllanguage,
                                              'videose' => $videoe, 'videosq' => $videoq , 'audios'=>$audiotype]);

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

}
