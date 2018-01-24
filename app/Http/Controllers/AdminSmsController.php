<?php

namespace App\Http\Controllers;

use App\Sm;
use Illuminate\Http\Request;

class AdminSmsController extends Controller
{
    public function sms(){
        $allSm = Sm::find(1);

        return view('admin.adminsms',['allSms' =>$allSm]);
    }

    public function addsms(Request $request){
        $addSm = Sm::find(1);
        $addSm->reserve_user = $request->input("user1");
        $addSm->reserve_worker = $request->input('worker1');
        $addSm->reserve_manager = $request->input('manager1');
        $addSm->payment_user = $request->input('user2');
        $addSm->afterpay_user = $request->input('user3');
        $addSm->afterpay_worker = $request->input('worker3');
        $addSm->afterpay_manager = $request->input('manager3');
        $addSm->save();

        return redirect('/admin/sms');
    }
}
