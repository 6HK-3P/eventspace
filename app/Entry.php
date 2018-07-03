<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function type(){
        return $this->hasMany('\App\Type');
    }
}
