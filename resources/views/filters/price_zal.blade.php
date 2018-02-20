<div class="drum__filter-form__item">
    <span>Стоимость</span>
    {{csrf_field()}}
    <div class="drum-form-content">
        <div class="line-container">
            <div class="line"><label><input type="radio" id="firstType" class="typeHall" name="cost" data-id ="first" data-coast="0" data-deposit="0" value="1">Полное обслуживание <br><i>(средний чек на человека)</i></label></div>
            <div id="first" class="drum-container">
                <div class="drum-form-content asd">
                <span style="width: 100%">
                    Стоимость чека на человека - <i id="forman">0 р.</i>
                </span>
                    <label style="width:100%">
                        Количество человек <input type="number"  id="count-people" min="1" max="{{$capacity->capacity->end}}"  name="count_people_wedding" style="max-width: 60%" >
                    </label>
                </div>
            </div>
        </div>
        <div class="line-container">
            <div class="line"><label><input type="radio" id="secondType" data-id ="second" class="typeHall" name="cost" checked="checked" data-coast="0" data-deposit="0" value="0">Аренда зала <br> <i>(без обслуживания)</i></label></div>
        </div>
    </div>
</div>



<script src="/public/js/halls.js"></script>