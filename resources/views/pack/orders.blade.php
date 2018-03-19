<section class="orders tabs-body flex" style="display: none;">
    <div class="add-artist-orders">
        @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->root == 1)
            <h4>Ваши заказы</h4>
            <div class="order-table-head lk flex"><div class="order-table-col1">Заказ</div><div class="order-table-col3">Статус</div><div class="order-table-col4">Действие</div></div>
            @foreach($AllOrders as $Orders)
                @if($Orders->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                <? $info_order = json_decode($Orders->infos);
                $times = "";
                    switch ($info_order->time){
                        case 0: $times = "Весь день";break;
                        case 1: $times = "2 часа";break;
                        case 2: $times = "1 час";break;
                    }
                ?>
                <div class="order-table-body flex">
                    <div class="order-table-col1">
                        <h4>{{\App\User::find($Orders->user_id)->name}}</h4>
                        <p class="order-table-col1-params"><b>
                                <span class="order-table-col1-params-date">{{$info_order->data}}</span>
                                <span class="order-table-col1-params-city">{{\App\Workers_citie::find($info_order->city)->title}}</span>
                                <span class="order-table-col1-params-time">{{$times}}</span>
                                <span class="order-table-col1-params-price1">{{$info_order->deposit}}</span>
                                <span class="order-table-col1-params-price2">{{$info_order->price}}</span></b></p>
                        <p><b>Комментарий к заказу</b></p>
                        @if(!empty($Orders->comments))
                            <p>{{$Orders->comments}}</p>
                        @else
                            <p style="color: #CCCCCC">Комментарий отсутствует</p>
                        @endif
                    </div>
                    <div class="order-table-col3"><span href="#" class="stages-stage1">ожидает инвойса</span></div>
                    <div class="order-table-col4"><a href="" class="edit">Разрешить оплату</a></div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
</section>