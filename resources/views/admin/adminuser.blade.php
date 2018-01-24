@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <div class="flex start tabs-cont">
        <div id="users" class="tabs active"><span>Пользователи</span></div>
        <div id="worker" class="tabs"><span>Исполнители</span></div>
        <div id="admins" class="tabs"><span>Менеджеры</span></div>
    </div>
    <section>
        <section class="users tabs-body">
            <h2>Пользователи</h2>
            <table>
                <tr class="thead">
                    <td>Имя</td>
                    <td>Телефон</td>
                    <td>Активные заказы</td>
                </tr>

                <tr class="tbody">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        </section>
        <section class="worker tabs-body">
            <h2>Исполнители</h2>
            <table>
                <tr class="thead">
                    <td>Название</td>
                    <td>Телефон</td>
                    <td>Деятельность</td>
                </tr>
                @foreach($allPerformers as $allPer)
                    <tr class="tbody">
                        <td><a href="">{{$allPer->name}}</a></td>
                        <td>{{$allPer->phone}}</td>
                        <td>{{\App\Workers_categorie::find($allPer->worker['category_id'])["name"]}}</td>
                    </tr>
                @endforeach
            </table>
        </section>
        <section class="admins tabs-body">
            <h2>Менеджеры</h2>
            <div class="container admin-add">
                <form method="POST" action="/admin/createMan" class="flex">
                    {{csrf_field()}}
                    <div><label for="">Имя</label><input type="text" id="name" name="meneger_name"></div>
                    <div><label for="">Телефон</label><input type="text" id="telephone" placeholder="+7 989 661 22 22"
                                                             name="meneger_phone"></div>
                    <div><label for="">Пароль</label><input type="password" id="password" name="meneger_password"></div>
                    <div><input type="submit" value="ОК"></div>
                </form>
            </div>
            <table>
                <tr class="thead">
                    <td>Имя</td>
                    <td>Телефон</td>
                    <td>Активные заказы</td>
                </tr>

                @foreach($allManagers as $allManager)
                <tr class="tbody">
                    <td>{{$allManager->name}}</td>
                    <td>{{$allManager->phone}}</td>
                    <td></td>
                </tr>
                @endforeach

            </table>
        </section>
    </section>
</main>
<script src="/static/js/tabs.js"></script>
@endsection