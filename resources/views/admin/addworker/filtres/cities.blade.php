<span class="desc_h5">на услуги в разных <b>городах</b> с учетом <b>сезонности</b></span>
<div id="add_city" >
							<span class="ree">
								Выберите хотя бы один тип
							</span>
    <h6>Выберите города с одинаковой ценой</h6>
    <? $k = 1; ?>
    @foreach($allcities as $cities)

        <div><input type="checkbox" id="city{{$k}}" name="city[]" class="city" value="{{$cities->id}}">
            <label for="city{{$k}}">{{$cities->title}}</label></div>
        <? $k++; ?>
    @endforeach
    <span class="checkAll" data-id = "add_city">Отметить все</span>
    <span class="unCheckAll" data-id = "add_city">Cнять все</span>
</div>