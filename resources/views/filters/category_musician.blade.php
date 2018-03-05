
<div class="drum__filter-form__item" id="primary_repertoire_chooser">
    <span>Народная или эстрадная</span>
    <div class="drum-form-content">
        @foreach($audios as $audio)
            <label>
                <input type="checkbox" name="type_narrator[]" @if(isset($type_narrator)) @foreach($type_narrator as $type) @if($type == $audio->id) checked @endif @endforeach @endif value="{{$audio->id}}">
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
                <input type="checkbox" name="language_narrator[]" @if(isset($language_narrator)) @foreach($language_narrator as $lang) @if($lang == $language->id) checked @endif @endforeach @endif value="{{$language->id}}">
                {{$language->name}}
            </label>
        @endforeach

    </div>
</div>
