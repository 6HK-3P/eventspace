
<div class="drum__filter-form__item" id="primary_repertoire_chooser">
    <span>Тип ведущего</span>
    <div class="drum-form-content ved">
        @foreach($alltoasts as $toast)
            <label>
                <input type="checkbox" name="type_narrator[]"  @if(isset($type_narrator)) @foreach($type_narrator as $type) @if($type == $toast->id) checked @endif @endforeach @endif value="{{$toast->id}}">
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
                <input type="checkbox" name="language_narrator[]"  @if(isset($language_narrator)) @foreach($language_narrator as $lang) @if($lang == $language->id) checked @endif @endforeach @endif value="{{$language->id}}">
                {{$language->name}}
            </label>
        @endforeach
    </div>
</div>
