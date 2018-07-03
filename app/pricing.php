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

    public static function getPricingDay($id, $data, $city = null, $price_ot = 0, $price_do = 999999999, $index = 0, $moving = null,$cameras = null,$equipment = null){
        $workerPricing = pricing::where("worker_id", $id)->where('view', 'По дням')
            ->orderBy("id", "DESC")
            ->where('date_to', '<=', $data)
            ->where('date_from','>=', $data)
            ->when($city != null, function ($q) use ($city){
                return $q ->where('city', 'LIKE', '%"'.$city.'"%');
            })
            ->when($moving != null, function ($q) use ($moving){
                return $q->where('info->moving', $moving);
            })
            ->when($cameras != null, function ($q) use ($cameras){
                return $q->where('info->cameras', $cameras);
            })
            ->when($equipment != null, function ($q) use ($equipment){
                return $q ->where('info->equipment','LIKE', '%"'.implode('", "',$equipment).'"%');
            })
            ->first();

        if(isset($workerPricing->price) && json_decode($workerPricing->price)[$index] >= $price_ot && json_decode($workerPricing->price)[$index] <= $price_do){
            return $workerPricing;
        }else{
            $mesData = getdate(strtotime($data));
            $workerPricing = pricing::where("worker_id", $id)
                ->where('view', 'По месяцам')
                ->orderBy("id", "DESC")
                ->where('date', 'LIKE', '%"' . $mesData["mon"] . '"%')
                ->when($moving != null, function ($q) use ($city){
                    return $q ->where('city', 'LIKE', '%"'.$city.'"%');
                })
                ->when($moving != null, function ($q) use ($moving){
                    return $q->where('info->moving', $moving);
                })
                ->when($cameras != null, function ($q) use ($cameras){
                    return $q->where('info->cameras', $cameras);
                })
                ->when($equipment != null, function ($q) use ($equipment){
                    return $q ->where('info->equipment','LIKE', '%"'.implode('", "',$equipment).'"%');
                })
                ->first();
        }
        if(isset($workerPricing->price) && json_decode($workerPricing->price)[$index] >= $price_ot && json_decode($workerPricing->price)[$index] <= $price_do){
            return $workerPricing;
        }
    }

}
