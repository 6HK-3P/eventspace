
<div class="drum__filter-form__item" id="primary_repertoire_chooser">
    <span>Народная или эстрадная</span>
    <div class="drum-form-content">
        @foreach($audios as $audio)
            <label>
                <input type="checkbox">
                {{$audio->title}}
            </label>
        @endforeach

    </div>
    <p>Народная музыка — это песни, которые ваши родители пели за праздничным столом, а эстарада — это
        современная
        музыка с канала MTV</p>
</div>

<div class="drum__filter-form__item" id="primary_language_chooser">
    <span>Язык</span>
    <div class="drum-form-content">

        @foreach($alllanguages as $language)
            <label>
                <input type="checkbox">
                {{$language->name}}
            </label>
        @endforeach

    </div>
</div>

<div class="drum__filter-form__item" id="order_duration_chooser">
    <span>Продолжительсонсть заказа</span>
    <div class="drum-form-content">
        <label>
            <input type="radio" name="duration" checked value="0"> Весь вечер
        </label>
        <label>
            <input type="radio" name="duration" value="1"> По часам
        </label>
    </div>
</div>
