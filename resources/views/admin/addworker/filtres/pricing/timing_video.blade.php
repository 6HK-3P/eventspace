<div id="add_type">
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info); ?>
    <?php $count_camers = (isset($addInfo->count_camers))? json_decode($addInfo->count_camers): []; ?>
    <h6>Выберете услуги и укажите цены </h6>
        <select name="type_price" >
            @if(in_array("3", $count_camers))<option value="1">3х камерная</option> @endif
            @if(in_array("2", $count_camers))<option value="2">2х камерная</option> @endif
            @if(in_array("1", $count_camers))<option value="3">Однокамерная</option> @endif
            @if(isset($addInfo->kran) && in_array("3", $count_camers)) <option value="4">3х камерная + кран</option> @endif
            @if(isset($addInfo->kran) && in_array("2", $count_camers)) <option value="5">2х камерная + кран</option> @endif
            @if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("3", $count_camers)) <option value="6">3х камерная + кран + квадрокоптер</option> @endif
            @if(isset($addInfo->kran) && isset($addInfo->kvadro) && in_array("2", $count_camers)) <option value="7">2х камерная + кран + квадрокоптер</option> @endif
            @if(isset($addInfo->kvadro) && in_array("3", $count_camers)) <option value="8">3х камерная + квадрокоптер</option> @endif
            @if(isset($addInfo->kvadro) && in_array("2", $count_camers))<option value="9">2х камерная + квадрокоптер</option> @endif
        </select>
        <select name="type_moving" >
            <option value="1">FullHD</option>
            @if(isset($addInfo->k)) <option value="2">4K</option> @endif

        </select>
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