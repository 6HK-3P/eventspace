@extends('layouts.lkhead')
@section('content')
    <main class="container admin-main">

        <section class="main-orders cc lkUser">

            <h2>Ваши заказы:</h2>
            @foreach($SelOrder as $order)
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
                                <span class="order-table-col1-params-price2">{{$select_info_order->price}}</span>
                            </b>
                        </p>
                        @if($order->status == 4 || $order->status == 6)
                            <p><b>Контакты исполнителя для связи</b></p>
                            <p>{{\App\User::find(\App\Worker::find($order->worker_id)->manager_id)->phone}} - {{\App\User::find(\App\Worker::find($order->worker_id)->manager_id)->name}}</p><br>
                            <h3 class="zag">Оставьте отзыв</h3>
                            <form action="#" class="fedLk">
                                <textarea name="" id="" cols="55" rows="10" placeholder="напишите отзыв тут"></textarea>
                            </form>
                            <h3 class="zag">Оценка</h3>
                            <div class="value flex lkStar">
                                <input type="radio" name="ocenka" id="ocenka1" value="1"> <label for="ocenka1" data-val=1></label>
                                <input type="radio" name="ocenka" id="ocenka2" value="2"> <label for="ocenka2" data-val=2></label>
                                <input type="radio" name="ocenka" id="ocenka3" value="3"> <label for="ocenka3" data-val=3></label>
                                <input type="radio" name="ocenka" id="ocenka4" value="4" checked> <label for="ocenka4" data-val=4></label>
                                <input type="radio" name="ocenka" id="ocenka5" value="5"> <label for="ocenka5" data-val=5></label>
                            </div>
                        @endif

                    </div>
                    <div class="order-table-col4">

                        @if($order->status == 1)
                            <a href="" class="edit disabled-y">
                                Проверяем данные...
                            </a>
                            <p class="info">Сейчас мы проверяем доступность исполнителя.
                            <br>Обычно это занимает до 24 часов. Когда все будет готово мы отправим смс и можно будет внести залог</p>
                        @endif
                        @if($order->status == 2)
                            <a href="" class="edit " >
                                Оплатите залог - {{$select_info_order->deposit}}
                            </a>
                        @endif
                        @if($order->status == 4 || $order->status == 6)

                                    <a href="" class="edit disabled">Оплачено 1800₽</a>
                                    <a href="" class="edit">Оставить отзыв</a>

                        @endif

                    </div>
                </div>
            @endforeach

        </section>
        <div class="pagination ">
            <ul class="flex start">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="selected"><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
            </ul>
        </div>

    </main>
@endsection