<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function feedback(){

        return view('admin.adminfeedback');
    }
}
