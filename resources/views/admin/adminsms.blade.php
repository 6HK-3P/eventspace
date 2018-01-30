@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section>
        <h2>Настройка смс</h2>
        <form action="/admin/sms/add" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <div>
                <h4>Переменные для значений</h4>
                <div class="flex">
                    <div id="p1">
                        <div style="max-width: 300px;">
                            <small><b>$city</b> - город</small> <br>
                            <small><b>$date</b> - дата бронирования</small><br>
                            <small><b>$deposit</b> - залог</small> <br>
                            <small><b>$equipment</b> - дополнительное оборудование</small>

                        </div>
                    </div>
                    <div id="p2">
                        <div style="max-width: 300px;">
                            <small><b>$price</b> - цена</small> <br>
                            <small><b>$service</b> - услуга</small> <br>
                            <small><b>$user_name</b> - имя пользователя</small> <br>
                            <small><b>$user_phone</b> - телефон пользователя</small>
                          </div>
                    </div>
                    <div id="p3">
                        <div style="max-width: 300px;">
                            <small><b>$worker_name</b> - имя исполнителя</small> <br>
                            <small><b>$worker_phone</b> - телефон исполнителя</small>

                        </div>
                    </div>
                </div>
                <h4>1. После нажатия пользователем на кнопку <b>"Забронировать"</b></h4>
                <div class="flex">
                    <div id="p1">
                        <label for="">Пользователь</label>
                        <textarea cols="30" rows="10" name="user1">{{$allSms->reserve_user}}</textarea>

                    </div>
                    <div id="p2">
                        <label for="">Исполнитель</label>
                        <textarea cols="30" rows="10" name="worker1">{{$allSms->reserve_worker}}</textarea>

                    </div>
                    <div id="p3">
                        <label for="">Менеджер</label>
                        <textarea cols="30" rows="10" name="manager1">{{$allSms->reserve_manager}}</textarea>
                    </div>
                </div>

            </div>
            <hr>
            <div>
                <h4>2. После нажатия администратором на кнопку <b>"Разрешить оплату"</b></h4>
                <div id="p4">
                    <label>Пользователь</label> <br>
                    <textarea cols="30" rows="10" name="user2">{{$allSms->payment_user}}</textarea>
                    <br>

                </div>
            </div>
            <hr>
            <div>
                <h4>3. После внесения предоплаты пользователем</h4>
                <div class="flex">
                    <div id="p5">
                        <label for="">Пользователь</label>
                        <textarea cols="30" rows="10" name="user3">{{$allSms->afterpay_user}}</textarea>

                    </div>
                    <div id="p6">
                        <label for="">Исполнитель</label>
                        <textarea cols="30" rows="10" name="worker3">{{$allSms->afterpay_worker}}</textarea>

                    </div>
                    <div id="p7">
                        <label for="">Менеджер</label>
                        <textarea cols="30" rows="10" name="manager3">{{$allSms->afterpay_manager}}</textarea>

                    </div>
                </div>

            </div>

            <input type="submit" class="submit" value="Сохранить">
        </form>
    </section>
</main>
    @endsection