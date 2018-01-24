<?php

namespace App\Http\Controllers;

use App\Site_setting;
use App\User;
use App\Worker;
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
        $allInfoWorker = Worker::where('user_id',$allInfoUser['id'])->get();

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

        return view("product")->with(["InfoUsers" => $allInfoUser, 'InfoWorker' => $allInfoWorker, 'carstypes' => $carstype, 'carsmarks' => $carsmark,'carscolors' => $carscolor,
                                             'allcities' => $allcitie ,  'alltoasts' => $alltoast ,'alllanguages' => $alllanguage,
                                              'videose' => $videoe, 'videosq' => $videoq , 'audios'=>$audiotype, 'allheads'=>$allhead]);
    }
}
