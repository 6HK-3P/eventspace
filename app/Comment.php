<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function avgMark(){

        return Comment::select('mark')->where('worker_id', $this->id)->get()->avg('mark');

    }

}
