<?php

namespace App\Http\Controllers;

use App\User;
use App\worker;
use App\workers_citie;
use App\workers_language;
use App\workers_musicians_type;
use App\Site_setting;
use Illuminate\Http\Request;

class MainController extends Controller
{



    public function index()
    {

        return view('index');
    }

    public function addz()
    {
        //город
        $allcitie = workers_citie::all();
        //музыка тайп
        $audiotype = workers_musicians_type::all();
        //язык
        $alllanguage = workers_language::all();

        $managers = User::where("root",2)->get();
        return view('add_worker')->with(['allcities' => $allcitie, 'audiotypes' => $audiotype, 'alllanguages' => $alllanguage,"managers"=> $managers ]);
    }

    public function addw(Request $request)
    {
        //информация о исполнителе заносится в массив
        $array = [];
        $array["lang"]=$request->input('lang');
        $array["basic_lang"] = $request->input('main_lang');
        $array["types"]=$request->input('type');
        $array["basic_types"] = $request->input('filter_main_type_artist');
        //информация о телефонах заносится в массив
        $phonearray = [];
        $phonearray["name"]=$request->input('contact-name1');
        $phonearray["phone"] = $request->input('contact-tel1');
        if($request->input('contact-name2') && $request->input('contact-tel2')) {
            $phonearray["name_2"] = $request->input('contact-name2');
            $phonearray["phone_2"] = $request->input('contact-tel2');
        }
        //добавление в user
        $addu= new User;
        $addu->phone = $request->input('login');
        $addu->password = $request->input('password');
        $addu->root = '1';
        $addu->name = $request->input('add_title');
        $addu->save();
        $userid = User::select('id')->orderBy('id','desc')->first();
        //добавление в воркерс
        $addw= new worker;
        $addw->user_id = $userid['id'];
        $addw->category_id = '4';
        $addw->city_id = $request->input('basic_city');
        $addw->logo = '/static/img/111.png';
        $addw->about = $request->input('add_description');
        $addw->manager_id = $request->input('filter_admin_artist');
        $addw->manager_comment = $request->input('filter_comments_artist');
        $addw->worker_contacts = json_encode($phonearray);
        $addw->workers_additional_info = json_encode($array);
        $addw->save();
        return redirect('/add');
    }
}
