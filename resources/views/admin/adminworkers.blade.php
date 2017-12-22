@extends('layouts.adhead')
@section('content')

<main class="container admin-main">
    <section class="artists">
        <div class="flex">
            <div><h3></h3></div>
            <div><a class="new_artist" style="display: none" href="#">+ Добавить нового</a></div>
        </div>
        <div class="artists-list">
            <ul>
            </ul>
        </div>
        <div class="pagination ">
            <ul class="flex start">
            </ul>
        </div>
    </section>


<div id="create-new-worker" title="Создать нового исполнителя" style="display: none">
    <form id="create-new-worker-form">
        <div class="flex">
            <label>Телефон</label>
            <input type="text" class="tel" placeholder="+7 925 075-82-81">
        </div>
        <div class="flex">
            <label>Пароль</label>
            <input type="password">
        </div>
        <div class="flex">
            <input type="submit">
        </div>
    </form>
</div>
</main>
<script src="/static/js/entity/api.js"></script>
<script src="/static/js/admin/artists.js"></script>
@endsection