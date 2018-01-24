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




}
