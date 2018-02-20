
<div class="drum__filter-form__item" id="car_brand_chooser">
    <span>Марка авто</span>
    <div class="drum-form-content">

        @foreach($carsmarks as $marks)
            <label>
                <input type="checkbox" name="marks[]" @if(isset($mark)) @foreach($mark as $ma) @if($ma == $marks->id) checked @endif @endforeach @endif value="{{$marks->id}}">
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
           <input type="checkbox" name="colors[]" @if(isset($color)) @foreach($color as $co) @if($co == $colors->id) checked @endif @endforeach @endif value="{{$colors->id}}">
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
                <input type="checkbox" name="types[]" @if(isset($type)) @foreach($type as $ty) @if($ty == $types->id) checked @endif @endforeach @endif value="{{$types->id}}">
                {{$types->title}}
            </label>
        @endforeach

    </div>
</div>
