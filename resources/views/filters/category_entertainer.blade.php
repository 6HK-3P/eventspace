
<div class="drum__filter-form__item" id="primary_repertoire_chooser">
    <span>Тип ведущего</span>
    <div class="drum-form-content ved">
        @foreach($alltoasts as $toast)
            <label>
                <input type="checkbox">
                {{$toast->title}}
            </label>
         <br>
        @endforeach
    </div>
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
