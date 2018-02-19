
<div class="drum__filter-form__item" id="cityChooser">
    <span>Город базирования</span>
    <div class="drum-form-content">
        <? $i=1; ?>
        @foreach($allcities as $cities)
        <label>
            <input type="radio" name="cities" value="{{$i++}}">
            {{$cities->title}}
        </label>
        @endforeach



    </div>
    <p>Чем дальше исполнитель заказа уезжает от своего города, тем выше его ставка.</p>
</div>
