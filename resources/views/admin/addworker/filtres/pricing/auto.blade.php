<? $allCarsWorker = \App\workers_car::where("worker_id", $id)->get(); ?>
@if($allCarsWorker)
    <div id="add_auto">
        <span>Автомобиль</span>
        <div>
            <select name="auto_id" id="auto_id">
                @foreach($allCarsWorker as $CarsWorker)
                    <option value="{{$CarsWorker->id}}" class="autoOption">{{$CarsWorker->name}} - {{$CarsWorker->mark_car->name}} - {{$CarsWorker->color_car->name}}</option>
                @endforeach
            </select>
            <br><br>
            <div>
                <div class="flex"><label style="min-width: 40px; ">Цена</label><div><input type="number" style="height: 20px; width: 50%;"  name="price_auto"> руб.</div></div>
                <br>
                <div class="flex"><label style="min-width: 40px; " >Залог</label><div><input type="number" style="height: 20px; width: 50%;" name="price_zalog_auto"> руб.</div></div>

            </div>
        </div>

    </div>
@endif
