<section class="price tabs-body flex" style="display: none;">
    <aside class="filter col30">
        <form action="#" name="add_price_rule" class="add_price_rule">
            <h4>Добавление цен</h4>
            <div class="filter_wrap media price_option">
                <p class="instruction1">Инструкция</p>
                <p class="instruction2">Скрыть</p>
                <p class="desc_interval">Например, Вы хотите указать, что с 1 по 10 января стоимость вашего выступления за вечер в городах Махачкала, Каспийск - 30 000р. <br>Вам следует: <br>
                    1. Выбрать <b>города</b>: Махачкала, Каспийск.<br>
                    2. Выбрать <b>временной интервал по дням</b> с 1 января по 10 января.<br>
                    3. Выбрать <b>услугу</b> "Выступление на весь день" и указать <b>цену</b> и <b>залог</b></p>
                <h5>Добавить цены</h5>
                <span class="desc_h5">на услуги в разных <b>городах</b> с учетом <b>сезонности</b></span>
                <div id="add_city" >
							<span class="ree">
								Выберите хотя бы один тип
							</span>
                    <h6>Выберите города с одинаковой ценой</h6>
                    <div><input type="checkbox" id="city1" name="city[]" class="city" value="1">
                        <label for="city1">Дербент</label></div>
                    <div><input type="checkbox" id="city2" name="city[]" class="city" value="2">
                        <label for="city2">Махачкала</label></div>
                    <div><input type="checkbox" id="city3" name="city[]" class="city" value="3">
                        <label for="city3">Даг. огни</label></div>
                    <div><input type="checkbox" id="city4" name="city[]" class="city" value="4">
                        <label for="city4">Буйнакск</label></div>
                    <div><input type="checkbox" id="city5" name="city[]" class="city" value="5">
                        <label for="city5">Избербаш</label></div>
                    <div><input type="checkbox" id="city6" name="city[]" class="city" value="6">
                        <label for="city6">Хасавюрт</label></div>
                    <div><input type="checkbox" id="city7" name="city[]" class="city" value="7">
                        <label for="city7">Каспийск</label></div>
                    <div><input type="checkbox" id="city8" name="city[]" class="city" value="8">
                        <label for="city8">Кизляр</label></div>
                    <span class="checkAll" data-id = "add_city">Отметить все</span>
                    <span class="unCheckAll" data-id = "add_city">Cнять все</span>
                </div>
                <div id="add_interval">
                    <h6>Выберите временной интервал</h6>
                    <div class="flex">
                        <span class="titles active" id="months">По месяцам</span>
                        <span class="titles" id="calendarWrap">По дням</span>
                    </div>
                    <div class="months titlebody">
								<span class="ree">
									Выберите хотя бы один тип
								</span>
                        <div class="flex wrap">
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
                <div id="add_type">
                    <h6>Выберете услуги и укажите цены</h6>
                    <div class="services_wrap">
							<span class="ree">
									Выберите хотя бы один тип
							</span>
                        <div>
                            <input type="checkbox" id="type_3" class="types" name="type_3">
                            <label for="type_3">Выступление весь  день </label>
                        </div>
                        <div class="prices service_type_3">
                            <div class="flex">
                                <div><label for="">Цена</label><input type="text" name="price_type_3"></div>
                                <div><label for="">Залог</label><input type="text" name="zalog_type_3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="services_wrap">
                        <div>
                            <input type="checkbox" id="type_2" class="types" name="type_2">
                            <label for="type_2">Выступление 2 часа</label>
                        </div>
                        <div class="prices service_type_2">
                            <div class="flex">
                                <div><label for="">Цена</label><input type="text" name="price_type_2"></div>
                                <div><label for="">Залог</label><input type="text" name="zalog_type_2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="services_wrap last-child">
                        <div>
                            <input type="checkbox" id="type_1" class="types" name="type_1">
                            <label for="type_1">Выступление 1 час</label>
                        </div>
                        <div class="prices service_type_1">
                            <div class="flex">
                                <div><label for="">Цена</label><input type="text" name="price_type_1"></div>
                                <div><label for="">Залог</label><input type="text" name="zalog_type_1"></div>
                            </div>
                        </div>
                    </div>
                    <span class="checkAll" data-id = "add_type">Отметить все</span>
                    <span class="unCheckAll" data-id = "add_type">Cнять все</span>
                </div>
                <input type="submit" value="Добавить" class="w100">
            </div>
        </form>
    </aside>
    <div class="add-artist-price col70">
        <h4>Ценовые правила</h4>
        <form action="#" name="price_rules_edit">
            <div class="price_rules_edit_wrap">
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
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>По месяцам</td>
                        <td>Махачкала, Каспийск</td>
                        <td>Декабрь, Январь, Февраль, Март, Апрель</td>
                        <td>
                            <div class="flex"><label>День / Вечер</label><input type="text" class="table_price" value="20 000"></div>
                            <div class="flex"><label>2 часа</label><input type="text" class="table_price" value="8 000"></div>
                            <div class="flex"><label>1 час</label><input type="text" class="table_price" value="5 000"></div>
                        </td>
                        <td><div class="flex"><label>Вечер / день</label><input type="text" class="table_price" value="20 000"></div>
                            <div class="flex"><label>2 часа</label><input type="text" class="table_price" value="2 000"></div>
                            <div class="flex"><label>1 час</label><input type="text" class="table_price" value="1 000"></div>
                        </td>
                        <td><input type="submit" value="" class="delete_rule">
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>По месяцам</td>
                        <td>Дербент, Дагестанские Огни</td>
                        <td>Декабрь, Январь, Февраль, Март, Апрель</td>
                        <td>
                            <div class="flex"><label>День / Вечер</label><input type="text" class="table_price" value="25 000"></div>
                        </td>
                        <td><div class="flex"><label>Вечер / день</label><input type="text" class="table_price" value="2 500"></div>
                        </td>
                        <td><input type="submit" value="" class="delete_rule">
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>По дням</td>
                        <td>Махачкала, Каспийск</td>
                        <td>1 января - 10 января</td>
                        <td>
                            <div class="flex"><label>День / Вечер</label><input type="text" class="table_price" value="28 000"></div>
                            <div class="flex"><label>2 часа</label><input type="text" class="table_price" value="15 000"></div>
                            <div class="flex"><label>1 час</label><input type="text" class="table_price" value="10 000"></div>
                        </td>
                        <td><div class="flex"><label>Вечер / день</label><input type="text" class="table_price" value="10 000"></div>
                            <div class="flex"><label>2 часа</label><input type="text" class="table_price" value="5 000"></div>
                            <div class="flex"><label>1 час</label><input type="text" class="table_price" value="2 000"></div>
                        </td>
                        <td><input type="submit" value="" class="delete_rule">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="empty">Пока нет ценовых правил</p>
            </div>

            <div class="tizer-buttons flex">
                <input type="reset" id="cancel" value="Отменить изменение цен">
                <input type="submit" class="submit" value="Сохранить цены">
            </div>
        </form>
    </div>
</section>
