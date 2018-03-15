<?php

namespace App\Http\Controllers;

use App\Interval;
use Illuminate\Http\Request;

use App\Site_setting;
use Illuminate\Validation\Rules\In;

class SettingsController extends Controller
{
    public static $settings;

    public  function __construct()
    {
        $settings = json_decode(Site_setting::find(1)->value);
        self::$settings = $settings;

    }
    public static function getNumber(){
         return self::$settings->number;
    }
    public static function getVk(){
        return self::$settings->vk;
    }
    public static function getInstagram(){
        return self::$settings->instagram;
    }
    public static function getWhatsapp(){
        return self::$settings->whatsapp;
    }
    public static function getCopyright(){
        return self::$settings->copyright;
    }
    public static function getSupport(){
        return self::$settings->support;
    }
    public static function getAffilate(){
        return self::$settings->affilate;
    }
    public static function getLogo(){
        return self::$settings->logo;
    }

    public function getInterval($cat){
        $intervals = Interval::where("category_id", $cat)->get();
        return view("admin.interval", ["intervals"=>$intervals, 'cat'=>$cat]);
    }
//----------------------------------------------------------------------------------------------------------------------





//----------------------------------------изменение значений интервалов-------------------------------------------------
    public function addInterval(Request $request, $cat){
        $select_interval = Interval::where("category_id", $cat)->where("type",1)->first();

        $select_interval->to = $request->input("to0");
        $select_interval->save();

        $select_interval = Interval::where("category_id", $cat)->where("type",2)->first();
        $select_interval->to = $request->input("to1");
        $select_interval->save();
        return redirect("/admin/interval/$cat");
    }
//----------------------------------------------------------------------------------------------------------------------





}
