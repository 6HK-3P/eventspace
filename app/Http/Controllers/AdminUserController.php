<?php

namespace App\Http\Controllers;

use App\User;
use App\Workers_citie;
use App\Workers_language;
use App\Workers_musicians_type;
use Illuminate\Http\Request;
use App\Worker;

class AdminUserController extends Controller
{
    public function user(){
        $allManager = User::where('root', 2)->get();
        $allPerformer = User::where('root', 1)->get();



        return view('admin.adminuser')->with(["allManagers" => $allManager, "allPerformers" => $allPerformer]);
    }

    public function addMan(Request $request){
        $addMans = new User();
        $addMans->name = $request->input('meneger_name');
        $addMans->phone = $request->input('meneger_phone');
        $addMans->password = $request->input('meneger_password');
        $addMans->root = 3;
        $addMans->save();
        return redirect('/admin/user');
    }


}
