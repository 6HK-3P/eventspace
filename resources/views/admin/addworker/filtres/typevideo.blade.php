@if($id>0)
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info);?>
    <div class="profile_options_item ">
        <h5>Количество камер</h5>
        <?php $count_camers = (isset($addInfo->count_camers))? json_decode($addInfo->count_camers): []; ?>
        <div>
            <input type="checkbox" id="count3" class="types" @if(in_array("3", $count_camers)) checked @endif name="count_camers[]" value="3">
            <label for="count3" @if(in_array("3", $count_camers)) class="check" @endif>3х камерная</label>
        </div>
        <div>
            <input type="checkbox" id="count2" class="types"  @if(in_array("2", $count_camers)) checked @endif name="count_camers[]" value="2">
            <label for="count2" @if(in_array("2", $count_camers)) class="check" @endif>2х камерная</label>
        </div>
        <div>
            <input type="checkbox" id="count1" class="types"  @if(in_array("1", $count_camers)) checked @endif name="count_camers[]" value="1">
            <label for="count1" @if(in_array("1", $count_camers)) class="check" @endif>Однокамерная</label>
        </div>
    </div>
    <div class="profile_options_item ">
        <h5>Качество съемки</h5>

        <div>
            <input type="checkbox" id="fullHD" class="types" @if(isset($addInfo->fullHD)) checked @endif name="fullHD" value="1">
            <label for="fullHD" @if(isset($addInfo->fullHD)) class="check" @endif>FullHD</label>
        </div>
        <div>
            <input type="checkbox" id="4K" class="types"  @if(isset($addInfo->k)) checked @endif name="4K" value="1">
            <label for="4K" @if(isset($addInfo->k)) class="check" @endif>4K</label>
        </div>
    </div>
    <div class="profile_options_item ">
        <h5>Дополнительные услуги</h5>

        <div>
            <input type="checkbox" id="kran" @if(isset($addInfo->kran)) checked @endif class="types" name="kran" value="1">
            <label for="kran" @if(isset($addInfo->kran)) class="check" @endif >Видеокран</label>
        </div>
        <div>
            <input type="checkbox" id="kvadro" @if(isset($addInfo->kvadro)) checked @endif class="types" name="kvadro" value="1">
            <label for="kvadro" @if(isset($addInfo->kvadro)) class="check" @endif>Квадрокоптер</label>
        </div>
    </div>

@else
    <div class="profile_options_item ">
        <h5>Качество съемки</h5>

        <div>
            <input type="checkbox" id="fullHD"  checked class="types" name="fullHD" value="1">
            <label for="fullHD">FullHD</label>
        </div>
        <div>
            <input type="checkbox" id="4K" class="types" name="4K" value="1">
            <label for="4K">4K</label>
        </div>
    </div>

    <div class="profile_options_item ">
        <h5>Дополнительные услуги</h5>

        <div>
            <input type="checkbox" id="kran" class="types" name="kran" value="1">
            <label for="kran">Видеокран</label>
        </div>
        <div>
            <input type="checkbox" id="kvadro" class="types" name="kvadro" value="1">
            <label for="kvadro">Квадрокоптер</label>
        </div>
    </div>


@endif