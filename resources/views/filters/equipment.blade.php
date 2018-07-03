<?php $category = \App\Entry::find(1);
?>
<div class="drum__filter-form__item" id="optional_equipment_chooser">
    <span>Качество съемки</span>
    <div class="drum-form-content">
        @foreach($category->type as $attribute)
            @if(in_array($attribute->id, json_decode($InfoWorker->attributes)))
                <label for="{{$attribute->name}}">
                    <input type="radio" name="moving" id="{{$attribute->name}}" value="{{$attribute->name}}">
                    {{$attribute->name}}
                </label>
            @endif
        @endforeach
    </div>
</div>
<?php $all_count_camers = \App\Entry::find('6') ?>
<?php $all_equipment = \App\Entry::find('2') ?>
<?php  ?>
<div class="drum__filter-form__item" id="optional_equipment_chooser">
    <span>Тип съемки</span>
    <div class="drum-form-content types_moves">
        @foreach($all_count_camers->type as $count_camers)
            @if(in_array($count_camers->id,json_decode($InfoWorker->attributes)))
                <div>
                    <input type="radio" id="{{$count_camers->id}}" class="month" name="cameras" value="{{$count_camers->name}}">
                    <label for="{{$count_camers->id}}">{{$count_camers->name}}</label>
                </div>
            @endif
        @endforeach

        @foreach($all_equipment->type as $equipment)
            @if(in_array($equipment->id,json_decode($InfoWorker->attributes)))
                <div>
                    <input type="checkbox" id="{{$equipment->id}}" class="month" name="equipment[]" value="{{$equipment->name}}">
                    <label for="{{$equipment->id}}">{{$equipment->name}}</label>
                </div>
            @endif
        @endforeach



    </div>
</div>
{{--@if(in_array("3", $count_camers))--}}

{{--@endif--}}
{{--@if(in_array("2", $count_camers))--}}
    {{--<label for="2t">--}}
        {{--<input type="radio" name="type_moving" id="2t" checked value="2">--}}
        {{--2х камерная--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(in_array("1", $count_camers))--}}
    {{--<label for="3t">--}}
        {{--<input type="radio" name="type_moving" id="3t" checked value="3">--}}
        {{--Однокамерная--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kran) && in_array("3", $count_camers))--}}
    {{--<label for="4t">--}}
        {{--<input type="radio" name="type_moving" id="4t" checked value="4">--}}
        {{--3х камерная + кран--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kran) && in_array("2", $count_camers))--}}
    {{--<label for="5t">--}}
        {{--<input type="radio" name="type_moving" id="5t" checked value="5">--}}
        {{--2х камерная + кран--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("3", $count_camers))--}}
    {{--<label for="6t">--}}
        {{--<input type="radio" name="type_moving" id="6t" checked value="6">--}}
        {{--3х камерная + кран + квадрокоптер--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("2", $count_camers))--}}
    {{--<label for="7t">--}}
        {{--<input type="radio" name="type_moving" id="7t" checked value="7">--}}
        {{--2х камерная + кран + квадрокоптер--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kvadro) && in_array("3", $count_camers))--}}
    {{--<label for="8t">--}}
        {{--<input type="radio" name="type_moving" id="8t" checked value="8">--}}
        {{--3х камерная + квадрокоптер--}}
    {{--</label>--}}
{{--@endif--}}
{{--@if(isset($addInfo->kvadro) && in_array("2", $count_camers))--}}
    {{--<label for="9t">--}}
        {{--<input type="radio" name="type_moving" id="9t" checked value="9">--}}
        {{--2х камерная + квадрокоптер--}}
    {{--</label>--}}
{{--@endif--}}