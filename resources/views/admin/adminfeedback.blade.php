@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section class="artists">
        <div class="statuses">
            <p>Показать только:</p>
            <p class="feed flex"><a href="#" class="feed-one"></a><a href="#" class="feed-two"></a> <a href="#"
                                                                                                       class="feed-three"></a>
                <a href="#" class="feed-four"></a> <a href="#" class="feed-five"></a></p>
            <p class="stages-all"><a href="#">Показать все</a></p>
        </div>
        <section class="main-orders">
            <div class="order-table-head flex">
                <div class="feed-table-col1">Отзыв</div>
                <div class="feed-table-col2">Имя</div>
                <div class="feed-table-col3">Дата</div>
                <div class="feed-table-col4">Звезд</div>
                <div class="feed-table-col5">Действие</div>
            </div>
        </section>
        <div class="pagination ">
            <ul class="flex start">
            </ul>
        </div>
    </section>
</main>
<script src="/static/js/entity/api.js"></script>
<script src="/static/js/admin/feedbacks.js"></script>
@endsection