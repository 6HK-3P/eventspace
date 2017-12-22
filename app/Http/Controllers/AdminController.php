<?php

namespace App\Http\Controllers;

use App\Site_setting;
use App\Teaser;
use App\User;
use Illuminate\Http\Request;
use Monolog\Handler\UdpSocketTest;

class AdminController extends Controller
{
    public function index(){

        $teasers = Teaser::all();
        return view('admin.adminmenu', ['teasers'=>$teasers]);
    }

    public function addteaser(Request $request){

        $tizer_count = $request->input('tizer_form_count');
        for($i=1; $i<$tizer_count+1; $i++){
            $id = $request->input('tizer_id'.$i);
            if (empty($id)){
                $addTeasers = new Teaser();
            }
            else{
                $addTeasers = Teaser::find($id);
            }
            $addTeasers->title = $request->input('tizer_title'.$i);
            $addTeasers->text = $request->input('tizer_text'.$i);
            $addTeasers->position = $request->input('tizer_pos'.$i);
            $imageName = "tizer_photo".$i;
            $image = $request->$imageName;

            if (count($image)) {
                $pref = rand(1, 10000);
                $name = $pref . $image->getClientOriginalName();
                $image->move(public_path() . '/img/teasers/', $name);
                $addTeasers->logo = "/public/img/teasers/" . $name;

            } else {
                if(empty($id)){
                    $addTeasers->logo = "/public/img/teasers/empty.png";
                }

            }
            $addTeasers->save();

        }

        return redirect('/admin');
    }

    public function addhead(Request $request)
    {
        $addHead = Site_setting::find(1);
        $array = [];

        $array['number'] = $request->input('head1');
        $array['vk'] = $request->input('head2');
        $array['whatsapp'] = $request->input('head3');
        $array['instagram'] = $request->input('head4');
        $array['copyright'] = $request->input('head5');
        $array['support'] = $request->input('head6');
        $array['affilate'] = $request->input('head7');

        $image = $request->head8;

        if (count($image)) {
            $pref = rand(1, 10000);
            $name = $pref . $image->getClientOriginalName();
            $image->move(public_path() . '/img/', $name);
            $array['logo']  = "/public/img/" . $name;

        }
        $addHead->value = json_encode($array);
        $addHead->save();
        return redirect('/admin');
    }

    public function workers(){

        return view('admin.adminworkers');
    }

    public function user(){

        return view('admin.adminuser');
    }

    public function addMan(Request $request){
        $addMans = new User();
        $addMans->name = $request->input('meneger_name');
        $addMans->phone = $request->input('meneger_phone');
        $addMans->password = $request->input('meneger_password');
        $addMans->root = 2;
        $addMans->save();
        return redirect('/admin/user');
    }

    public function order(){

        return view('admin.adminorders');
    }

    public function sms(){

        return view('admin.adminsms');
    }

    public function feedback(){

        return view('admin.adminfeedback');
    }
}
