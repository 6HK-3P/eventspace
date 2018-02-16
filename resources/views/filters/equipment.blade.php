<div class="drum__filter-form__item" id="optional_equipment_chooser">
    <span>Доп. оборудование</span>
    <div class="drum-form-content">
        @foreach($videose as $equipment)
            <label>
                <input type="checkbox" name="kran">
                {{  $equipment->title }}
            </label>
        @endforeach


    </div>
</div>