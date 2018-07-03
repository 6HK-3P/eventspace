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

    public function worker_car(){
        return $this->hasMany('\App\worker_car');
    }

    public function priceToDay(){
        $worker = Worker::find($this->id);
        $today = date('Y-m-d');
        if($worker->category_id == 3){
            $index = 1;
        }else {
            $index = 0; //Весь день
        }
        $price_ot = 0;
        $price_do = 999999;

        $price = pricing::getPricingDay($this->id, $today, $worker->city_id, $price_ot, $price_do, $index);

        return (isset($price)) ? json_decode($price->price)[$index] : 0;
    }

    public function city(){
        return $this->belongsTo('\App\workers_citie');
    }

    public function param($index){
        $type = json_decode($this->basic_attributes);
        (count($type) > 0) ? $type = Type::find($type[$index]) : false;
        return (count($type) > 0) ? $type->name : false ;
    }

}
