@if($id>0)
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info);?>

        <div class="profile_options_item ">
            <span class="ree">
                Выберите хотя бы один тип
            </span>
            <h5>Тип ведущего</h5>
            <ul>
                    <li><input type="checkbox" id = "type_conf1" name="attributes[]" class="type_conf" @foreach($addInfo->types_conf as $type) @if($type == 1) checked @endif @endforeach
                        value=1 class="lang">
                        <label for="type_conf1"  @foreach($addInfo->types_conf as $type) @if($type == 1) class="check" @endif @endforeach>Ведущий</label>
                    </li>
                    <li><input type="checkbox" id = "type_conf2" name="attributes[]" class="type_conf" @foreach($addInfo->types_conf as $type) @if($type == 2) checked @endif @endforeach
                        value=2 class="lang">
                        <label for="type_conf2"  @foreach($addInfo->types_conf as $type) @if($type == 2) class="check" @endif @endforeach>Ведущий + исполнитель</label>

                    </li>
            </ul>
        </div>

@else

        <div class="profile_options_item ">
            <span class="ree">
                Выберите хотя бы один язык
            </span>
            <h5>Тип ведущего</h5>
            <ul>
                <li><input type="checkbox" id = "type_conf1" name="attributes[]" value=1 class="type_conf">
                    <label for="type_conf1" >Ведущий</label>
                </li>
                <li><input type="checkbox" id = "type_conf2" name="attributes[]" value=2 class="type_conf">
                    <label for="type_conf2" >Ведущий + исполнитель</label>
                </li>
            </ul>
        </div>

@endif
