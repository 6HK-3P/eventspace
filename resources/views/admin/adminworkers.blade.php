@extends('layouts.adhead')
@section('content')

    <main class="container admin-main">
        <section class="artists">
            <div class="flex"><div><h3>Исполнители - {{$cat->name}}</h3></div>
                <div><a class="new_artist" href="/admin/workers/add/{{$cat->id}}/0">+ Добавить нового</a></div></div>
            <div class="artists-list">
                <ul>
                    @foreach($allWorkers as $worker)
                    <li class="flex">
                        <div class="artists-list-img"><img src="{{$worker->logo}}" alt=""></div>
                        <div class="artists-list-desc">
                            <h4>{{App\User::find($worker->user_id)->name}}</h4>
                            <p>
                                {{$worker->about}}
                            </p>
                            <div class="flex artists-list-desc-params">
                                <div class="flex">
                                    <span class="artist-rating">4,5</span>
                                    <span class="artist-comment">13</span>
                                </div>
                                <span class="artist-price">18900 &#8381;</span>
                            </div>
                        </div>
                        <div class="artists_edit flex column">
                            <a class="edit" href="/admin/workers/add/{{$cat->id}}/{{$worker->id}}">Редактировать</a>
                            <a class="remove" href="/admin/workers/add/{{$cat->id}}/{{$worker->id}}/delete">✖ <span>Удалить</span></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
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
            {{ $allWorkers->links() }}
        </section>
    </main>
<script src="/static/js/entity/api.js"></script>
<script src="/static/js/admin/artists.js"></script>
@endsection