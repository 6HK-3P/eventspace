
<div class="drum__filter-form__item" id="hall_capacity_chooser">
    <span>Вместимость (чел.)</span>
    <div class="drum-form-content">
        <label style="width: 49%">
            ОТ <input type="number" name="min_capactiy" id="min_capactiy" style="max-width: 60%" min=20 step="10">
        </label>
        <label style="width: 49%">
            ДО <input type="number" name="max_capacity" id="max_capacity" style="max-width: 60%" min=30 step="10">
        </label>

    </div>
</div>
<div class="drum__filter-form__item">
    <span>Стоимость</span>
    <div class="drum-form-content">
        <div class="line-container">
            <div class="line"><label><input type="radio" name="cost" value="1" data-id="first">Полное обслуживание <br><i>(средний
                        чек на человека)</i></label></div>
            <div id="first" class="drum-container">
                <div class="drum-form-content">
                    <label style="width: 49%">
                        ОТ <input type="number" name="price_ot_wedding" style="max-width: 60%" min=200 step="100">
                    </label>
                    <label style="width: 49%">
                        ДО <input type="number" name="price_do_wedding" style="max-width: 60%" min=300 step="100">
                    </label>
                </div>
            </div>
        </div>
        <div class="line-container">
            <div class="line"><label><input type="radio"  data-id="second" value="0" checked="checked" name="cost">Аренда зала
                    <br> <i>(без обслуживания)</i></label></div>
            <div id="second" class="drum-container">

                <div class="drum-form-content">
                    <div id="html5"></div>
                    <p>От: <b id="skip-value-lower"></b></p>
                    <p>До: <b id="skip-value-upper"></b></p>
                    <input type="hidden" value="" id="skip-value-lower2" name="arenda_ot">
                    <input type="hidden" value="" id="skip-value-upper2" name="arenda_do">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".line input").on("change", function(){
        var id = "#"+$(this).data("id");
        $(".drum-container").not(id).slideUp();
        $(id).slideDown();
    })
</script>
