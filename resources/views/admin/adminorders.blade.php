@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section class="artists">
        <div class="statuses">
            <p>Показать только:</p>
            <p class="stages">
                <a href="#" class="stages-stage1">ожидает инвойса</a>
                <a href="#" class="stages-stage2">оплата прошла</a>
                <a href="#" class="stages-stage2">ожидает публикации</a>
                <a href="#" class="stages-stage3">с комментарием</a>
                <a href="#" class="stages-stage3">в архиве</a>
                <a href="#" class="stages-stage4">оплата не прошла</a></p>
            <p class="stages-all"><a href="#">Показать все</a></p>
        </div>
        <section class="main-orders">
            <div class="order-table-head flex">
                <div class="order-table-col1">Заказ</div>
                <div class="order-table-col2">Заказчик</div>
                <div class="order-table-col3">Статус</div>
                <div class="order-table-col4">Действие</div>
            </div>
        </section>
        <div class="pagination ">
            <ul class="flex start">
            </ul>
        </div>
    </section>
</main>
<script src="/static/js/entity/api.js"></script>
<script src="/static/js/admin/orders.js"></script>
@endsection