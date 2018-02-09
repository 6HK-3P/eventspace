@if($id>0 )
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info);?>

        <div class="profile_options_item ska">
            <span class="ree">
                Выберите хотя бы один язык
            </span>
            <h5>Язык исполнения</h5>
            <ul>
            @foreach($alllanguages as $language)
                    <li><input type="checkbox" id = "lang{{$language->id}}" name="lang[]" @foreach($addInfo->lang as $type) @if($type == $language->id) checked @endif @endforeach
                        value={{$language->id}} class="lang">
                        <label for="lang{{$language->id}}"  @foreach($addInfo->lang as $type) @if($type == $language->id) class="check" @endif @endforeach>{{$language->name}}</label>
                        <div><input type="radio" name="main_lang" value="{{$language->id}}" @if($addInfo->basic_lang ==  $language->id) checked  @endif id="main_lang{{$language->id}}" >
                            <label for="main_lang{{$language->id}}" class="filter_radio"></label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

@else

        <div class="profile_options_item ska">
            <span class="ree">
                Выберите хотя бы один язык
            </span>
            <h5>Язык исполнения</h5>
            <ul>
                @foreach($alllanguages as $language)
                    <li><input type="checkbox" id = "lang{{$language->id}}" name="lang[]" value={{$language->id}} class="lang">
                        <label for="lang{{$language->id}}">{{$language->name}}</label>
                        <div><input type="radio" name="main_lang" value="{{$language->id}}" id="main_lang{{$language->id}}" >
                            <label for="main_lang{{$language->id}}" class="filter_radio"></label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

@endif
