
<div class="drum__filter-form__item" id="recording_quality_chooser">
    <span>Качество съемки</span>
    <div class="drum-form-content">
        @foreach($videosq as $qualiti)
        <label>
            <input type="checkbox" name="quality_wedding">
            {{ $qualiti->title }}
        </label>
        @endforeach


    </div>
</div>
<div class="drum__filter-form__item" id="camera_count_chooser">
    <span>Количество камер</span>
    <div class="drum-form-content">
        <label style>
            <input type="radio" name="count_camera_wedding"> 3-камерная
        </label></div>
    <div class="drum-form-content">
        <label style>
            <input type="radio" name="count_camera_wedding"> 2-камерная
        </label></div>
    <div class="drum-form-content">
        <label>
            <input type="radio" name="count_camera_wedding"> 1-камерная
        </label>
    </div>
</div>
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
