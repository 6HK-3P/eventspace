<section class="price tabs-body flex" style="display: none;">
    <aside class="filter col30">
        <form action="#" id="rule" name="add_price_rule" class="add_price_rule cat{{$cat->id}}" method="POST">
            {{ csrf_field() }}
            <h4>Добавление цен</h4>

            <div class="filter_wrap media price_option">
                <p class="instruction1">Инструкция</p>
                <p class="instruction2">Скрыть</p>
                <p class="desc_interval">Например, Вы хотите указать, что с 1 по 10 января стоимость вашего выступления за вечер в городах Махачкала, Каспийск - 30 000р. <br>Вам следует: <br>
                    1. Выбрать <b>города</b>: Махачкала, Каспийск.<br>
                    2. Выбрать <b>временной интервал по дням</b> с 1 января по 10 января.<br>
                    3. Выбрать <b>услугу</b> "Выступление на весь день" и указать <b>цену</b> и <b>залог</b></p>
                <h5>Добавить цены</h5>
                @if($cat->id != 3 ) @include('admin.addworker.filtres.cities') @endif
                <div id="add_interval">
                    <h6>Выберите временной интервал</h6>
                    <div class="flex">
                        <span class="titles active" id="months">По месяцам</span>
                        <span class="titles" id="calendarWrap">По дням</span>
                    </div>
                    <div class="months  titlebody">

                        <div class="flex wrap">
                                    <span class="ree">
									Выберите хотя бы один тип
								    </span>
                            <div><input type="checkbox" id="month1" value="1" class="month" name="month[]">
                                <label for="month1">Январь</label></div>
                            <div><input type="checkbox" id="month7" name="month[]" class="month" value="7">
                                <label for="month7">Июль</label></div>
                            <div><input type="checkbox" id="month2" name="month[]" class="month" value="2">
                                <label for="month2">Февраль</label></div>
                            <div><input type="checkbox" id="month8" name="month[]" class="month" value="8">
                                <label for="month8">Август</label></div>
                            <div><input type="checkbox" id="month3" name="month[]" class="month" value="3">
                                <label for="month3">Март</label></div>
                            <div><input type="checkbox" id="month9" name="month[]" class="month" value="9">
                                <label for="month9">Сентябрь</label></div>
                            <div><input type="checkbox" id="month4" name="month[]" class="month" value="4">
                                <label for="month4">Апрель</label></div>
                            <div><input type="checkbox" id="month10" name="month[]" class="month" value="10">
                                <label for="month10">Октябрь</label></div>
                            <div><input type="checkbox" id="month5" name="month[]" class="month" value="5">
                                <label for="month5">Май</label></div>
                            <div><input type="checkbox" id="month11" name="month[]" class="month" value="11">
                                <label for="month11">Ноябрь</label></div>
                            <div><input type="checkbox" id="month6" name="month[]" class="month" value="6">
                                <label for="month6">Июнь</label></div>
                            <div><input type="checkbox" id="month12" name="month[]" class="month" value="12">
                                <label for="month12">Декабрь</label></div>

                        </div>
                        <span class="checkAll" data-id = "add_interval">Отметить все</span>
                        <span class="unCheckAll" data-id = "add_interval">Cнять все</span>
                    </div>
                    <div class="calendarWrap titlebody">
								<span class="desc_days">
								Выбрать диапазон дней
								</span>
                        <div class="flex start"><label>С </label><input type="date" class="day_start" name="start_date"></div>
                        <div class="flex start"><label>По</label> <input type="date" class="day_end" name="end_date"></div>
                    </div>
                </div>
                @if($cat->id == 5 || $cat->id == 4) @include('admin.addworker.filtres.pricing.timing') @endif
                @if($cat->id == 1) @include('admin.addworker.filtres.pricing.timing_photo') @endif
                @if($cat->id == 2) @include('admin.addworker.filtres.pricing.timing_video') @endif
                @if($cat->id == 3) @include('admin.addworker.filtres.pricing.hall') @endif
                @if($cat->id == 6) @include('admin.addworker.filtres.pricing.auto') @endif
                <input type="submit" value="Добавить" class="w100">
            </div>
        </form>
    </aside>
    <div class="add-artist-price col70">
        <h4>Ценовые правила</h4>
        <form action="#" id="updatePrice" class="cat{{$cat->id}} loader" name="price_rules_edit" method="POST">
            <div class="price_rules_edit_wrap">
                {{csrf_field()}}
                <table class="price_rules">
                    <thead>
                    <td>№</td>
                    <td>Вид</td>
                    <td>Города</td>
                    <td>Даты</td>
                    <td>Цена</td>
                    <td>Залог</td>
                    <td></td>
                    </thead>
                    <tbody class="price_rules_body">


                    </tbody>
                </table>



            </div>

            <div class="tizer-buttons flex">
                <input type="reset" id="cancel" value="Отменить изменение цен">
                <input type="submit" class="submit" value="Сохранить цены">
            </div>
        </form>
    </div>
</section>
