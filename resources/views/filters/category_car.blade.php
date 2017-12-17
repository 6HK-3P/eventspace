
<div class="drum__filter-form__item" id="car_brand_chooser">
    <span>Марка авто</span>
    <div class="drum-form-content">

        @foreach($carsmarks as $marks)
            <label>
                <input type="checkbox">
                {{$marks->title}}
            </label>
        @endforeach

    </div>
</div>

<div class="drum__filter-form__item" id="car_color_chooser">
    <span>Цвет авто</span>
    <div class="drum-form-content">
        @foreach($carscolors as $colors)
        <label>
           <input type="checkbox">
            {{$colors->title}}
       </label>
        @endforeach
    </div>
</div>

<div class="drum__filter-form__item" id="car_type_chooser">
    <span>Тип авто</span>
    <div class="drum-form-content">

        @foreach($carstypes as $types)
            <label>
                <input type="checkbox">
                {{$types->title}}
            </label>
        @endforeach

    </div>
</div>
