<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class workers_car extends Model
{
    public $timestamps = false;

    public function type_car(){
        return $this->hasOne('\App\Type', 'id', 'type_id');
    }
    public function mark_car(){
        return $this->hasOne('\App\Type', 'id', 'mark_id');
    }
    public function color_car(){
        return $this->hasOne('\App\Type', 'id', 'color_id');
    }

    public function worker(){
        return $this->belongsTo('\App\Worker');
    }

}
