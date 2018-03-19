<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/normalize.css/normalize.css">
    <link rel="stylesheet" href="/public/css/slick-theme.css">
    <link rel="stylesheet" href="/public/css/slick.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link href="/public/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/public/js/admin_main.js"></script>
    <script src="/public/js/slick.min.js"></script>
    <script src="/public/js/sortablejs/Sortable.js"></script>
    <script src="/public/js/draggable.js"></script>
    <script src="/public/js/inputmask/inputmask.js"></script>
    <script src="/public/js/inputmask/inputmask.numeric.extensions.js"></script>
    <script src="/public/js/inputmask/jquery.inputmask.js"></script>
    <script src="http://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="http://yastatic.net/share2/share.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">



</head>
<body>

<header class="container main-header">
    <div class="main-header-top flex">
        <div class="main-header-top-logo"><a href="/"><img src="/public/img/logo.png" alt=""></a></div>
        <div class="main-header-top-com">
            <?php $settings = new App\Http\Controllers\SettingsController(); ?>
            <div><p>{{$settings::getNumber()}}</p></div>
            <div><span class="vk"><a href="{{$settings::getVk()}}">Vk</a></span>
                <span class="wats"><a href="{{$settings::getWhatsapp()}}">WhatsApp</a></span>
                <span class="insta"><a href="{{$settings::getInstagram()}}">Instagram</a></span></div>

        </div>
        <div class="main-header-top-company"><a href="#">Компания</a></div>
        <div class="main-header-top-lk"><a href="#">Личный кабинет</a>
            <div class="login" style="display: none;">
                <div class="flex center tabsL"><span class="active" data-tab="loginForm">Вход</span><span data-tab="regForm">Регистрация</span></div>
                <form action="#" method="POST" id="loginForm">
                    <div class="flex"><label>Телефон</label><input type="text" class="tel" placeholder="+7 925 075-82-81"> </div>
                    <div class="flex"><label>Пароль</label><input type="password"></div>
                    <div class="flex">
                        <div class="notfound">Мы не нашли номера телефона в базе <br> Пожалуйста, <span class="reg">зарегистрируйтесь</span></div>
                        <button type="submit">Войти</button>
                    </div>
                </form>
                <form action="#" method="POST" id="regForm" style="display:none">
                    <div class="flex"><label>Телефон</label><input class="tel" type="text" placeholder="+7 925 075-82-81"> </div>
                    <div class="flex">
                        <div class="notfound">Ваш номер уже используется <br> Пожалуйста, <span class="log">войдите</span></div>
                        <button type="submit">Получить смс</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <main class="container admin-main">
        <div class="main-header-bottom">
            <h1>Управление сайтом</h1>
            <nav class="flex">
                <div><a href="/admin">Шапка, тизеры и футер</a></div>
                <div><a href="/admin/workers">Исполнители <br></a></div>
                <div><a href="/admin/user">Пользователи</a></div>
                <div><a href="/admin/order">Заказы</a></div>
                <div><a href="/admin/feedback">Отзывы</a></div>
                <div><a href="/admin/sms">Смс</a></div>
            </nav>
        </div>
    </main>

</header>

@yield('content')

<footer>
    <div  class="footer container flex">
        <div>
            <p><b>© Event Space 2016</b></p>
            <p class="copyright_desc">{{$settings::getCopyright()}}</p>
        </div>
        <div class="flex">
            <div><p>Служба поддержки</p><p>{{$settings::getSupport()}}</p></div>
            <div><p>Вопросы сотрудничества</p><p>{{$settings::getAffilate()}}</p></div>
        </div>
        <div class="solidWorks"><p>Сделано с любовью в SolidWorks</p></div>
    </div>
</footer>
<script src="/public/js/functions.js"></script>
<script src="/public/js/index.js"></script>
<script src="/public/js/datepicker.min.js"></script>
<script src="/public/libs/jquery.formstyler.min.js"></script>
<script src="/public/js/dzen.js"></script>



</body>
</html>