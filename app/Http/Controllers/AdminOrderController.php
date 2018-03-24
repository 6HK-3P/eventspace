<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_statuse;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function order(){
        $all_orders = Order::all();
        $all_status = Order_statuse::all();
        return view('admin.adminorders')->with(["AllOrder" => $all_orders, "AllStatus" => $all_status]);
    }



}
