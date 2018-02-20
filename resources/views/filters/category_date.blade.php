
<div class="drum__filter-form__item" id="dateChooser">
    <span>Дата</span>
    <div class="drum-form-content">
        <label>
            <input type="date" id="data" name="data" style="width: 150px;" @if(isset($data)) value="{{$data}}" @else value="{{date("Y-m-d")}}" @endif>
        </label>
    </div>
</div>
