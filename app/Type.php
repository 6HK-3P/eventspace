<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public static function getType($id){
        return Type::find($id);
    }
}
