@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section class="artists">
        <div class="statuses">
            <p>Показать только:</p>
            <p class="stages">
                @foreach($AllStatus as $status)
                    <a href="#" class="stages-stage{{$status->id}}" style="color: {{$status->colorcode}}">{{$status->name}}</a>
            @endforeach
            <p class="stages-all"><a href="#">Показать все</a></p>
        </div>
        <section class="main-orders">
            <div class="order-table-head flex">
                <div class="order-table-col1">Заказ</div>
                <div class="order-table-col2">Заказчик</div>
                <div class="order-table-col3">Статус</div>
                <div class="order-table-col4">Действие</div>
            </div>
            @foreach($AllOrder as $order)
                <div class="order-table-body flex">
                    <div class="order-table-col1">
                        <h4>{{\App\Worker::find($order->worker_id)->user->name}}</h4>
                        <? $select_info_order = json_decode($order->infos);
                        $times = "";
                        switch ($select_info_order->time){
                            case 0: $times = "Весь день";break;
                            case 1: $times = "2 часа";break;
                            case 2: $times = "1 час";break;
                        }
                        ?>
                        <p class="order-table-col1-params">
                            <b>
                                <span class="order-table-col1-params-date">{{$select_info_order->data}}</span>
                                <span class="order-table-col1-params-city">{{\App\Workers_citie::find($select_info_order->city)->title}}</span>
                                <span class="order-table-col1-params-time">{{$times}}</span>
                                <span class="order-table-col1-params-price1">{{$select_info_order->deposit}}</span>
                                <span class="order-table-col1-params-price2">{{$select_info_order->price}}</span></b></p>
                            </b>
                        </p>
                        @if(!empty($order->comments))
                            <p>{{$order->comments}}</p>
                        @else
                            <p style="color: #CCCCCC">Комментарий отсутствует</p>
                        @endif<p><b>Контакты исполнителя для связи</b></p>
                        <p>{{\App\User::find(\App\Worker::find($order->worker_id)->manager_id)->phone}} - {{\App\User::find(\App\Worker::find($order->worker_id)->manager_id)->name}}</p>
                    </div>
                    <div class="order-table-col2">
                        <p class="order-table-name">
                            <span>{{\App\User::find($order->user_id)->name}}</span>
                        </p>
                        <p>{{\App\User::find($order->user_id)->phone}}</p>
                    </div>
                    <div class="order-table-col3">
                        <span href="#" class="stages-stage1" style="color: {{\App\Order_statuse::find($order->status)->colorcode}}">{{\App\Order_statuse::find($order->status)->name}}</span>
                    </div>
                    <? $id_status = \App\Order_statuse::find($order->status)->id;
                    $actions = "";
                    $actions_id = "";
                    switch ($id_status){
                        case 1: $actions = "Разрешить оплату"; $actions_id = 1; break;
                        case 2: $actions = "Напомнить об оплате";  $actions_id = 2; break;
                        case 3: $actions = ""; $actions_id = 3; break;
                        case 4: $actions = "";  $actions_id = 4; break;
                        case 5: $actions = "";  $actions_id = 5; break;
                        case 6: $actions = "В архив"; $actions_id = 6; break;
                        case 7: $actions = "В архив"; $actions_id = 7; break;
                        case 8: $actions = "Вернуть в активные"; $actions_id = 8; break;
                    } ?>
                    <div class="order-table-col4">@if(!empty($actions))<a href="/admin/update_order/{{$actions_id}}" class="edit">{{$actions}}</a>@endif</div>
                </div>
            @endforeach
        </section>
        <div class="pagination ">
            <ul class="flex start">
            </ul>
        </div>
    </section>
</main>

@endsection