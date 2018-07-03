<div id="add_type">
    <h6>Выберете услуги и укажите цены </h6>
        @foreach($all_count_camers->type as $count_camers)
            @if(in_array($count_camers->id,json_decode($allWorkerInfo->attributes)))
            <div>
                <input type="radio" id="{{$count_camers->id}}" class="month" name="type_price" value="{{$count_camers->name}}">
                <label for="{{$count_camers->id}}">{{$count_camers->name}}</label>
            </div>
            @endif
        @endforeach

        @foreach($all_equipment->type as $equipment)
            @if(in_array($equipment->id,json_decode($allWorkerInfo->attributes)))
                <div>
                    <input type="checkbox" id="{{$equipment->id}}" class="month" name="type_equipment[]" value="{{$equipment->name}}">
                    <label for="{{$equipment->id}}">{{$equipment->name}}</label>
                </div>
            @endif
        @endforeach
        <br>
        @foreach($all_qualities->type as $quality)
            @if(in_array($quality->id,json_decode($allWorkerInfo->attributes)))
                <div>
                    <input type="radio" id="{{$quality->id}}" class="month" name="type_moving" value="{{$quality->name}}">
                    <label for="{{$quality->id}}">{{$quality->name}}</label>
                </div>
            @endif
        @endforeach
        <div class="services_wrap">
            <div>
                <span class="ree">
                    Выберите хотя бы один тип
                </span>
                <input type="checkbox" id="type_3" class="types" name="type_3" value="3">
                <label for="type_3">Все мероприятие (день) </label>
            </div>
            <div class="prices service_type_3">
                <div class="flex">
                    <div><label for="">Цена</label><input type="text" name="price_type_3"></div>
                    <div><label for="">Залог</label><input type="text" name="zalog_type_3"></div>
                </div>
            </div>
        </div>
        <div class="services_wrap last-child">
            <div>
                <input type="checkbox" id="type_2" class="types" name="type_2" value="2">
                <label for="type_2">Работа 2 часа</label>
            </div>
            <div class="prices service_type_2">
                <div class="flex">
                    <div><label for="">Цена</label><input type="text" name="price_type_2"></div>
                    <div><label for="">Залог</label><input type="text" name="zalog_type_2"></div>
                </div>
            </div>
        </div>
    <span class="checkAll" data-id = "add_type">Отметить все</span>
    <span class="unCheckAll" data-id = "add_type">Cнять все</span>
</div>