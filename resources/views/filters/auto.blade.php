@if($allCarsWorker)
<div class="drum__filter-form__item">
    <span>Автомобиль</span>
    <div class="drum-form-content">
        <select name="" id="">
            @foreach($allCarsWorker as $CarsWorker)
            <option value="{{$CarsWorker->id}}">{{$CarsWorker->name}} - {{\App\Workers_cars_mark::find($CarsWorker->mark_id)->title}} - {{\App\Workers_cars_color::find($CarsWorker->color_id)->title}}</option>
            @endforeach
        </select>


    </div>

</div>
    @endif