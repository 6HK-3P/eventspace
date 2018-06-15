<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function pricing()
    {
        return $this->hasMany('App\pricing');
    }

    public function avgMark(){
        print_r(Worker::find(16)->comment);
    }

}
