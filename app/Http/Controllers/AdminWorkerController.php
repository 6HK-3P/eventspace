<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\User;
use App\Worker;
use App\Workers_categorie;
use App\Workers_citie;
use App\Workers_language;
use App\Workers_musicians_type;
use App\workers_car;
use Illuminate\Http\Request;

class AdminWorkerController extends Controller
{
// --------------страница выбора категории воркеров--------------
    public function selectWorkers(){

        return view('admin.selectworkers');
    }
// --------------получение из бд всех воркеров для вывода--------------
    public function getWorkers($id=4){
        $cat = Workers_categorie::find($id);
        $allWorkers = Worker::where('category_id', $id)->paginate(5);
        return view('admin.adminworkers')->with(['cat'=>$cat, 'allWorkers'=>$allWorkers]);
    }
// --------------добавление в бд новой информации о воркере или добавление нового воркера--------------
    public function addw(Request $request,  $cat, $id)
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
        $addw->category_id = $cat;
        $addw->city_id = $request->input('basic_city');
        $addw->about = $request->input('add_description');
        $addw->manager_id = $request->input('filter_admin_artist');
        $addw->manager_comment = $request->input('filter_comments_artist');
        $addw->worker_contacts = json_encode($phonearray);
        $addw->workers_additional_info = json_encode($array);
        $addw->save();
        return redirect('/admin/workers/add/'.$cat.'/'.$addw->id);
    }
// --------------вывод информации на страницу Информация--------------
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

       $allPricingInfo = Pricing::all();

        $managers = User::where("root",2)->get();


        return view('add_worker')->with(['allcities' => $allcitie, 'audiotypes' => $audiotype, 'alllanguages' => $alllanguage,"managers"=> $managers,
                                               'allWorkerInfo' => $allWorkerInfo, 'id'=> $id, 'cat' =>$cat, 'AllPricing' => $allPricingInfo ]);
    }

// --------------получить из бд все ценовые правила--------------
    public function getPriceRules($id){
        $ruleprice = Pricing::where('worker_id', $id)->get();
        foreach ($ruleprice as $rule){
            $rule->cities = [];
            if ($rule->view == "По месяцам"){
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

        }
        echo json_encode(["rules"=>$ruleprice],JSON_UNESCAPED_UNICODE);

    }

// --------------добавление в бд нового ценового правила--------------
    public function pricing(Request $request, $id){
        $alltime = '';
        $allprice = [];
        $alldeposit = [];
        $allcity = json_encode($request->input('city'));
        if($request->input('price_type_1') || $request->input('price_type_2') || $request->input('price_type_3')){
            for($i=3; $i>0; $i--) {
                if($request->input('type_'.$i)){
                    $allprice[] = $request->input('price_type_'.$i);
                }
                else{
                    $allprice[] = "";
                }
            }
            for($i=3; $i>0; $i--) {
                if($request->input('type_'.$i)){
                    $alldeposit[] = $request->input('zalog_type_'.$i);
                }
                else{
                    $alldeposit[] = "";
                }
            }
        }

        if($request->input('price_hall_2')){
            $allprice[] = $request->input('price_hall_2');
            $alldeposit[] = $request->input('price_hall_zalog_2');
        }
        else{
            $allprice[] = "";
            $alldeposit[] = "";
        }
        if($request->input('price_hall_1')){
            $allprice[] = $request->input('price_hall_1');
            $alldeposit[] = $request->input('price_hall_zalog_1');
        }
        else{
            $allprice[] = "";
            $alldeposit[] = "";
        }


        $addPricing = new Pricing();
        $addPricing->worker_id = $id;
        $addPricing->view = 'По месяцам';
        if($request->input('start_date') && $request->input('end_date')) {
            $addPricing->view = 'По дням';
            $start = date("d.m.Y",strtotime($request->input('start_date')));
            $end = date("d.m.Y",strtotime($request->input('end_date')));
            $alldate = json_encode([$start, $end]);
        }
        else{
            $alldate = json_encode($request->input('month'));
        }
        $addPricing->city = $allcity;
        $addPricing->date = $alldate;
        $addPricing->price = json_encode($allprice);
        $addPricing->deposit = json_encode($alldeposit);
        $addPricing -> save();

    }
// --------------обновление ценовых правил в бд --------------
    public function updatePricing(Request $request){
        $price_id_array = $request->input('price_rule_id');
        foreach ($price_id_array as $price_id){
            $updateDeposit = [];
            $updatePrice = [];
            $name = "date_price_3_".$price_id;
            if($request->input($name)){
                $updatePrice[] = $request->input($name);
            }
            $name = "date_price_2_".$price_id;
            if($request->input($name)){
                $updatePrice[] = $request->input($name);
            }
            $name = "date_price_1_".$price_id;
            if($request->input($name)){
                $updatePrice[] = $request->input($name);
            }
            //-------------------
            $name = "date_deposit_3_".$price_id;
            if($request->input($name)){
                $updateDeposit[] = $request->input($name);
            }
            $name = "date_deposit_2_".$price_id;
            if($request->input($name)){
                $updateDeposit[] = $request->input($name);
            }
            $name = "date_deposit_1_".$price_id;
            if($request->input($name)){
                $updateDeposit[] = $request->input($name);
            }

            $updatePricing = Pricing::find($price_id);
            $updatePricing->price = json_encode($updatePrice);
            $updatePricing->deposit = json_encode($updateDeposit);
            $updatePricing-> save();
        }

        return json_encode(true);
    }
// --------------удаление ценового правила-----------------
    public function removeRulePrice($id){

        $deleteRulePrice = Pricing::find($id);
        $deleteRulePrice->delete();
        return json_encode(true);

    }

// --------------удаление воркера и юзера--------------
    public function deleteWorker(Request $request, $cat, $id){
        $idW = Worker::find($id)->user_id;
        $delUser = User::find($idW)->delete();
        $delWorkerk = Worker::find($id)->delete();
        return redirect('/admin/workers/'.$cat);
    }
// --------------добавление фотки бд нового ценооброзования--------------
   public function addLogo(Request $request,$cat, $id){
       $images = $request->add_foto;
       $worker = Worker::find($id);
       $arrayPhoto = json_decode($worker->logo);
       foreach ($images as $image) {
           $originalname = explode('.' , $image->getClientOriginalName());
           $pref = rand(1, 10000000);
           $name = $pref.'.'.$originalname[count($originalname)-1];
           $image->move(public_path() . '/img/', $name);

           $arrayPhoto[] =  ["type" => "photo", "src"=>'/public/img/'.$name];

       }
       $worker->logo = json_encode($arrayPhoto);
       $worker-> save();
       return redirect('/admin/workers/add/'.$cat.'/'.$id.'?tab=3');
   }

// --------------добавление видео в  бд--------------


    public function addVideo(Request $request,$cat, $id){
        $worker = Worker::find($id);
        $arrayVideo = json_decode($worker->logo);
        $srcRequest = $request->input('video_src');
        $srcArray = explode( "/", $srcRequest);
        $srcId = str_replace("watch?v=", "",$srcArray[count($srcArray)-1]);
        $srcImg = "http://img.youtube.com/vi/".$srcId."/hqdefault.jpg";
        $srcVideo = "https://www.youtube.com/embed/".$srcId;
        $arrayVideo[] = [ "type" => "video", "src" => $srcVideo, "poster"=>$srcImg];
        $worker->logo = json_encode($arrayVideo);
        $worker-> save();
        return redirect('/admin/workers/add/'.$cat.'/'.$id.'?tab=3');
    }

// --------------добавление аудио в бд  --------------

    public function addAudio(Request $request,$cat, $id){
        $audios = $request->add_audio;
        $worker = Worker::find($id);
        $arrayAudio = json_decode($worker->audio);
        foreach ($audios as $audio) {
            $orgName = $audio->getClientOriginalName();
            $originalname = explode('.' , $orgName);
            $pref = rand(1, 10000000);
            $name = $pref.'.'.$originalname[count($originalname)-1];
            $audio->move(public_path() . '/audio/', $name);
            $arrayAudio[] = ['name' => $orgName, 'link' => '/public/audio/'.$name];
        }
        $worker->audio = json_encode($arrayAudio);
        $worker-> save();
        return redirect('/admin/workers/add/'.$cat.'/'.$id.'?tab=3');
    }

// --------------обновление аудио и видео в бд  --------------
    public function updatePortfolio(Request $request, $id){
        $worker = Worker::find($id);
        $media = $request->input('media');
        $audio = $request->input('audio');
        $worker->logo = json_encode($media);
        $worker->audio = json_encode($audio);
        $worker-> save();
        return json_encode(true);
    }
// -------------- добавление аватарки  --------------
    public function addAva(Request $request, $id){
        $worker = Worker::find($id);
        $worker->ava = $request->input('logoAva');
        $worker->save();
        return json_encode(true);
    }

    public function addCars(Request $request, $id){
        $addCar = new workers_car;
        ($request->input('name_car')) ? $addCar->name=$request->input('name_car') : "";
        $addCar->type_id= $request->input('type_car');
        $addCar->color_id= $request->input('color_car');
        $addCar->mark_id = $request->input('mark_car');
        $addCar->worker_id = $id;
        $addCar->save();
        return json_encode(true);
    }

}
