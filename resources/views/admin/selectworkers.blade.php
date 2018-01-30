@extends('layouts.adhead')
@section('content')

    <main class="container admin-main">
        <section class="artists">
            <div class="index-menu flex">
                <a href="/admin/workers/1" class="photographer">Фотографы</a>
                <a href="/admin/workers/2" class="videographer">Видеостудии</a>
                <a href="/admin/workers/3" class="halls">Залы</a>
            </div>
            <div class="index-menu flex">
                <a href="/admin/workers/4" class="artists">Музыканты</a>
                <a href="/admin/workers/5" class="conferance">Ведущие</a>
                <a href="/admin/workers/6" class="auto">Автомобили</a>
            </div>
        </section>
    </main>
@endsection
