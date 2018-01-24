<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\User;
use App\Worker;
use App\Workers_categorie;
use App\Workers_citie;
use App\Workers_language;
use App\Workers_musicians_type;
use Illuminate\Http\Request;

class AdminWorkerController extends Controller
{
    public function selectWorkers(){

        return view('admin.selectworkers');
    }
    public function getWorkers($id=4){
        $cat = Workers_categorie::find($id);
        $allWorkers = Worker::where('category_id', $id)->paginate(5);
        return view('admin.adminworkers')->with(['cat'=>$cat, 'allWorkers'=>$allWorkers]);
    }

    public function addw(Request $request,  $cat, $id)
    {

        //информация о исполнителе заносится в массив
        $array = [];
        $array["lang"]=$request->input('lang');
        $array["basic_lang"] = $request->input('main_lang');
        $array["types"]=$request->input('type');
        $array["basic_types"] = $request->input('filter_main_type_artist');
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
        if($id!=0){
            $addw = Worker::find($id);
            $addu = User::find($addw->user_id);
        }else{
            $addw = new Worker;
            $addu = new User;
        }
        //добавление в user
        $addu->phone = $request->input('login');
        if(!empty($request->input('password'))){
            $addu->password = $request->input('password');
        }
        $addu->root = '1';
        $addu->name = $request->input('add_title');
        $addu->save();
        //добавление в воркерс

        $addw->user_id = $addu->id;
        $addw->category_id = '4';
        $addw->city_id = $request->input('basic_city');
        $addw->logo = '/static/img/111.png';
        $addw->about = $request->input('add_description');
        $addw->manager_id = $request->input('filter_admin_artist');
        $addw->manager_comment = $request->input('filter_comments_artist');
        $addw->worker_contacts = json_encode($phonearray);
        $addw->workers_additional_info = json_encode($array);
        $addw->save();
        return redirect('/admin/workers/add/'.$cat.'/'.$addw->id);
    }

    public function addz($cat, $id)
    {

        $allWorkerInfo = '';
        $cat = Workers_categorie::find($cat);
        if($id > 0){
            $allWorkerInfo = Worker::find($id);

        }
        //город
        $allcitie = workers_citie::all();
        //музыка тайп
        $audiotype = workers_musicians_type::all();
        //язык
        $alllanguage = workers_language::all();


        $managers = User::where("root",2)->get();
        return view('add_worker')->with(['allcities' => $allcitie, 'audiotypes' => $audiotype, 'alllanguages' => $alllanguage,"managers"=> $managers,
                                               'allWorkerInfo' => $allWorkerInfo, 'id'=> $id, 'cat' =>$cat ]);
    }


    public function getPriceRules($cat, $id){
        $ruleprice = Pricing::where('worker_id', $id)->get();
        foreach ($ruleprice as $rule){
            $rule->cities = [];
            if ($rule->view = "По месяцам"){
                $months = [];
                $arrayMonths = json_decode($rule->date);
                sort($arrayMonths);
                foreach ($arrayMonths as $month_id) {
                    switch ($month_id){
                        case 1: $months[] = "Январь"; break;
                        case 2: $months[] = "Февраль"; break;
                        case 3: $months[] = "Март"; break;
                        case 4: $months[] = "Апрель"; break;
                        case 5: $months[] = "Май"; break;
                        case 6: $months[] = "Июнь"; break;
                        case 7: $months[] = "Июль"; break;
                        case 8: $months[] = "Август"; break;
                        case 9: $months[] = "Сентябрь"; break;
                        case 10: $months[] = "Октябрь"; break;
                        case 11: $months[] = "Ноябрь"; break;
                        case 12: $months[] = "Декабрь"; break;
                    }
                }
                $rule->months = implode($months, ", ");
            }

            $arrayCities = json_decode($rule->city);
            $arr = [];
            foreach ($arrayCities as $city_id) {
                $arr[] = Workers_citie::find($city_id)->title;
            }
            $rule->cities = implode($arr, ", ");
            $rule->price = json_encode($rule->price);
            $rule->deposit = json_encode($rule->deposit);
        }
        echo json_encode(["rules"=>$ruleprice],JSON_UNESCAPED_UNICODE);

    }


    public function pricing(Request $request,  $cat, $id){
        $alltime = '';
        $allprice = '';
        $alldeposit = '';
        $allcity = json_encode($request->input('city'));

        for($i=1; $i<4; $i++) {
            if($request->input('type_'.$i)){
                $allprice[] = [$request->input('type_'.$i) => $request->input('price_type_'.$i)];
            }
        }
        for($i=1; $i<4; $i++) {
            if($request->input('type_'.$i)){
                $alldeposit[] = [$request->input('type_'.$i) =>  $request->input('zalog_type_'.$i)];
            }
        }
        $addPricing = new Pricing();
        $addPricing->worker_id = $id;
        $addPricing->view = 'По месяцам';
        if($request->input('start_date') && $request->input('end_date')) {
            $addPricing->view = 'По дням';
            $alldate = json_encode([$request->input('start_date'),$request->input('end_date')]);
        }
        else{
            $alldate = json_encode($request->input('month'));
        }
        $addPricing->city = $allcity;
        $addPricing->date = $alldate;
        $addPricing->price = json_encode($allprice);
        $addPricing->deposit = json_encode($alldeposit);
        $addPricing -> save();
        return redirect('/admin/workers/add/'.$cat.'/'.$id);
    }
}
