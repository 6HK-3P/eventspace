@if($allCarsWorker)
<div class="drum__filter-form__item">
    <span>Автомобиль</span>
    <div class="drum-form-content">
        <select name="auto_id" >
            @foreach($allCarsWorker as $CarsWorker)
                <option value="{{$CarsWorker->id}}" class="autoOption">{{$CarsWorker->name}} - {{$CarsWorker->mark_car->name}} - {{$CarsWorker->color_car->name}}</option>
            @endforeach
        </select>


    </div>

</div>
@endif