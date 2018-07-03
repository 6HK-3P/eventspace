@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section class="artists">
        <div class="statuses">
            <p>Показать только:</p>
            <p class="feed flex">
                <a href="?mark=1" class="feed-one"></a>
                <a href="?mark=2" class="feed-two"></a>
                <a href="?mark=3" class="feed-three"></a>
                <a href="?mark=4" class="feed-four"></a>
                <a href="?mark=5" class="feed-five"></a>
            </p>
            <p class="stages-all"><a href="/admin/feedback/">Показать все</a></p>
        </div>
        <section class="main-orders">
            <div class="order-table-head flex">
                <div class="feed-table-col1">Отзыв</div>
                <div class="feed-table-col2">Имя</div>
                <div class="feed-table-col3">Дата</div>
                <div class="feed-table-col4">Звезд</div>
                <div class="feed-table-col5">Действие</div>
            </div>
            @foreach($AllComments as $comment)
                <div class="order-table-body flex">
                    <div class="feed-table-col1 feedback">

                        <h4>{{\App\Worker::find($comment->worker_id)->user->name}}</h4>
                        <p><b>Текст отзыва</b></p>
                        <p>{{$comment->comments}}</p>
                    </div>
                    <div class="feed-table-col2"><p class="order-table-name"><span>{{\App\User::find($comment->user_id)->name}}</span></p><p>{{\App\User::find($comment->user_id)->phone}}</p></div>
                    <div class="feed-table-col3"><p class="order-table-name">{{date('d.m.Y',strtotime($comment->created_at))}}</p></div>
                    <div class="feed-table-col4 feed"><div class="cc flex">
                            <label  class="@if($comment->mark == 1 || $comment->mark == 2 ||$comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 2 ||$comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 5) active @endif"></label>
                        </div></div>
                    <div class="feed-table-col5">
                        <a href="" class="edit">Редактировать</a><br>
                        <a href="" class="edit rem">Удалить</a>
                    </div>
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