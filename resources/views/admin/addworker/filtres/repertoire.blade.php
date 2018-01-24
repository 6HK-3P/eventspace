@if($id>0)
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info);?>
    @if($cat->id == 4 )
        <div class="profile_options_item ska">
            <span class="ree">
                Выберите хотя бы один тип
            </span>
            <h5>Репертуар</h5>
            <ul>
                @foreach($audiotypes as $audio)
                    <li><input type="checkbox" id = "type{{$audio->id}}" name="type[]" @foreach($addInfo->types as $type) @if($type == $audio->id) checked @endif @endforeach
                        value={{$audio->id}} class="type_sing">
                        <label for="type{{$audio->id}}"  @foreach($addInfo->types as $type) @if($type == $audio->id) class="check" @endif @endforeach >{{$audio->title}}</label>
                        <div>
                            <input type="radio" name="filter_main_type_artist" value={{$audio->id}} @if($addInfo->basic_types ==  $audio->id) checked  @endif id="filter_main_type_artist{{$audio->id}}" >
                            <label for="filter_main_type_artist{{$audio->id}}" class="filter_radio"></label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@else
    @if($cat->id == 4 )
        <div class="profile_options_item ska">
            <span class="ree">
                Выберите хотя бы один тип
	        </span>
            <h5>Репертуар</h5>
            <ul>
                @foreach($audiotypes as $audio)
                    <li>
                        <input type="checkbox" id = "type{{$audio->id}}" name="type[]"  value={{$audio->id}} class="type_sing">
                        <label for="type{{$audio->id}}">{{$audio->title}}</label>
                        <div>
                            <input type="radio" name="filter_main_type_artist" value={{$audio->id}} id="filter_main_type_artist{{$audio->id}}" >
                            <label for="filter_main_type_artist{{$audio->id}}" class="filter_radio"></label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endif