<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Site_setting;

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
}
