<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Worker;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function feedback(){
        $allComments = Comment::all();
        return view('admin.adminfeedback')->with(['AllComments' => $allComments]);
    }

    public function addFeedback(Request $request, $user_id, $worker_id){
        $userid = Worker::find($worker_id)->user_id;

        $new_feedback = new Comment;
        $new_feedback->user_id = $user_id;
        $new_feedback->worker_id = $worker_id;
        $new_feedback->comments = $request->input('feedback');
        $new_feedback->mark = $request->input('ocenka');
        $new_feedback->save();
        return redirect("/product/$userid");

    }
}
