<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pricing extends Model
{
    public $timestamps = false;

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public static function getPricingDay($id, $data, $city, $price_ot, $price_do, $index){
        $workerPricing = pricing::where("worker_id", $id)->where('view', 'По дням')
            ->orderBy("id", "DESC")
            ->where('date_to', '<=', $data)
            ->where('date_from','>=', $data)
            ->where('city', 'LIKE', '%"'.$city.'"%')
            ->first();

        if(isset($workerPricing->price) && json_decode($workerPricing->price)[$index] >= $price_ot && json_decode($workerPricing->price)[$index] <= $price_do){
            return $workerPricing;
        }else{
            $mesData = getdate(strtotime($data));
            $workerPricing = pricing::where("worker_id", $id)
                ->where('view', 'По месяцам')
                ->orderBy("id", "DESC")
                ->where('date', 'LIKE', '%"' . $mesData["mon"] . '"%')
                ->where('city', 'LIKE', '%"' . $city . '"%')
                ->first();
        }
        if(isset($workerPricing->price) && json_decode($workerPricing->price)[$index] >= $price_ot && json_decode($workerPricing->price)[$index] <= $price_do){
            return $workerPricing;
        }
    }

}
