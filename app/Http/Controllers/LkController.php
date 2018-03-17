<?php

namespace App\Http\Controllers;

use App\pricing;
use App\User;
use App\Worker;
use App\Workers_citie;
use App\Workers_language;
use App\Workers_musicians_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LkController extends Controller
{
    public function index(){
        if(!Auth::user()){
            return redirect('/login');
        }
        $worker_id = Worker::where('user_id', Auth::user()->id)->first();
        $flag = 0;
        if(empty($worker_id)){
            return redirect('/');
        }else{
            $flag = 1;
        }
        $id = $worker_id->id;
        //город
        $allcitie = workers_citie::all();
        //музыка тайп
        $audiotype = workers_musicians_type::all();
        //язык
        $alllanguage = workers_language::all();
        //все ценообразования
        $allPricingInfo = pricing::all();
        //все менеджеры
        $managers = User::where("root",2)->get();
        $sel_pricing = pricing::where('worker_id', $worker_id->id)->get();




        return view('lk.lk')->with(['allcities' => $allcitie, 'audiotypes' => $audiotype, 'alllanguages' => $alllanguage,"managers"=> $managers,
            "flag" => $flag, 'AllPricing' => $allPricingInfo, 'id'=>$id, 'allWorkerInfo' => $worker_id ]);
    }


    public function addWorker(Request $request,  $cat, $id)
    {

        //информация о исполнителе заносится в массив
        $array = [];
        ($request->input('lang'))       ? $array["lang"] = $request->input('lang') : false;
        ($request->input('main_lang'))  ? $array["basic_lang"] = $request->input('main_lang') : false;
        ($request->input('type'))       ? $array["types"] = $request->input('type') : false;
        ($request->input('types_conf')) ? $array["types_conf"] = $request->input('types_conf') : false ;
        ($request->input('capacity_start')) ? $array["capacity"]["start"] = $request->input('capacity_start') : false ;
        ($request->input('capacity_end')) ? $array["capacity"]["end"] = $request->input('capacity_end') : false ;
        ($request->input('filter_main_type_artist')) ? $array["basic_types"] = $request->input('filter_main_type_artist') : false;
        //информация о телефонах заносится в массив
        $phonearray = [];
        $phonearray[0]["name"]=$request->input('contact-name1');
        $phonearray[0]["phone"] = $request->input('contact-tel1');
        if($request->input('contact-name2') && $request->input('contact-tel2')) {
            $phonearray[1]["name"] = $request->input('contact-name2');
            $phonearray[1]["phone"] = $request->input('contact-tel2');
        }

        $addw = '';
        $addu = '';
        $addw = Worker::find($id);
        $addu = User::find(Auth::user()->id);
        //добавление в user
        if(!empty($request->input('password_old'))){
            if(Hash::check($request->input('password_old'),$addu->password )&& $request->input('password_new') == $request->input('password_copy')) {
                $addu->password = bcrypt($request->input('password_new'));
            }
        }
        $addu->name = $request->input('add_title');
        $addu->save();
        //добавление в воркерс
        $addw->user_id = $addu->id;
        $addw->category_id = $cat;
        $addw->city_id = $request->input('basic_city');
        $addw->about = $request->input('add_description');
        $addw->manager_id = $request->input('filter_admin_artist');
        $addw->manager_comment = $request->input('filter_comments_artist');
        $addw->worker_contacts = json_encode($phonearray);
        $addw->workers_additional_info = json_encode($array);
        $addw->save();
        return redirect('/lk');
    }


}
