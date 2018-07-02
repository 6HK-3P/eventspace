<?php $all_categories = \App\Entry::all();
?>
<div class="drum__filter-form__item" id="optional_equipment_chooser">
    <span>Качество съемки</span>
    <div class="drum-form-content">
        @foreach($all_categories as $category)
            @if(in_array($cat, json_decode($category->category_id)))
                @foreach($category->type->where('entry_id',1) as $attribute)
                    @if(in_array($attribute->id, json_decode($InfoWorker->attributes)))
                        <label for="{{$attribute->name}}">
                            <input type="radio" name="quality" id="{{$attribute->name}}" value="{{$attribute->id}}">
                            {{$attribute->name}}
                        </label>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
</div>
<div class="drum__filter-form__item" id="optional_equipment_chooser">
    <span>Тип съемки</span>
    <div class="drum-form-content types_moves">
        @foreach($all_categories as $category)
            @if(in_array($cat, json_decode($category->category_id)))

                @foreach($category->type->where('entry_id',1) as $attribute)
                    <label for="1t">
                        <input type="radio" name="type_moving" id="1t" checked value="1">
                        3х камерная
                    </label>
                    <label for="{{$attribute->name}}">
                        <input type="radio" name="quality" id="{{$attribute->name}}" value="{{$attribute->id}}">
                        {{$attribute->name}}
                    </label>
                @endforeach
            @endif
        @endforeach
        @if(in_array("3", $count_camers))

        @endif
        @if(in_array("2", $count_camers))
            <label for="2t">
                <input type="radio" name="type_moving" id="2t" checked value="2">
                2х камерная
            </label>
        @endif
        @if(in_array("1", $count_camers))
            <label for="3t">
                <input type="radio" name="type_moving" id="3t" checked value="3">
                Однокамерная
            </label>
        @endif
        @if(isset($addInfo->kran) && in_array("3", $count_camers))
            <label for="4t">
                <input type="radio" name="type_moving" id="4t" checked value="4">
                3х камерная + кран
            </label>
        @endif
        @if(isset($addInfo->kran) && in_array("2", $count_camers))
            <label for="5t">
                <input type="radio" name="type_moving" id="5t" checked value="5">
                2х камерная + кран
            </label>
        @endif
        @if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("3", $count_camers))
            <label for="6t">
                <input type="radio" name="type_moving" id="6t" checked value="6">
                3х камерная + кран + квадрокоптер
            </label>
        @endif
        @if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("2", $count_camers))
            <label for="7t">
                <input type="radio" name="type_moving" id="7t" checked value="7">
                2х камерная + кран + квадрокоптер
            </label>
        @endif
        @if(isset($addInfo->kvadro) && in_array("3", $count_camers))
            <label for="8t">
                <input type="radio" name="type_moving" id="8t" checked value="8">
                3х камерная + квадрокоптер
            </label>
        @endif
        @if(isset($addInfo->kvadro) && in_array("2", $count_camers))
            <label for="9t">
                <input type="radio" name="type_moving" id="9t" checked value="9">
                2х камерная + квадрокоптер
            </label>
        @endif


    </div>
</div>
