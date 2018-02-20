
<div class="drum__filter-form__item" id="priceChooser">
    <span>Гонорар</span>
    <div class="drum-form-content">
        <div id="html5"></div>
        <p>От: <b id="skip-value-lower">@if(isset($arenda_ot)) {{$arenda_ot}} @endif</b></p>
        <p>До: <b id="skip-value-upper">@if(isset($arenda_do)) {{$arenda_do}} @endif</b></p>
        <input type="hidden" value="@if(isset($arenda_ot)) {{$arenda_ot}} @endif" id="skip-value-lower2" name="arenda_ot">
        <input type="hidden" value="@if(isset($arenda_do)) {{$arenda_do}} @endif" id="skip-value-upper2" name="arenda_do">
    </div>
    <p>Цена за весь вечер</p>
</div>
