
<div class="drum__filter-form__item" id="cityChooser">
    <span>Город свадьбы</span>
    <div class="drum-form-content">
        @foreach($allcities as $cities)
        <label>
            <input type="radio" name="cities" @if(isset($city)) @if($city == $cities->id) checked @endif @endif value="{{$cities->id}}">
            {{$cities->title}}
        </label>
        @endforeach



    </div>
    <p>Чем дальше исполнитель заказа уезжает от своего города, тем выше его ставка.</p>
</div>
