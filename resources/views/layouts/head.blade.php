<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/normalize.css/normalize.css">
    <link rel="stylesheet" href="/public/css/slick-theme.css">
    <link rel="stylesheet" href="/public/css/slick.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link href="/public/css/nouislider.css" rel="stylesheet">
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




</head>
<body>

<header class="container main-header">
    <div class="main-header-top flex">
        <div class="main-header-top-logo"><img src="/public/img/logo.png" alt=""></div>
        <div class="main-header-top-com">
            <div><p>8 925 912-29-12</p></div>
            <div><span class="vk"><a href="https://vk.com">Vk</a></span> <span class="wats">WhatsApp</span> <span class="insta"><a href="https://www.instagram.com/">Instagram</a></span></div>

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
    <div class="main-header-bottom">
        <div class="index-menu flex">
            <a href="/category/photographers" class="photographer">Фотографы</a>
            <a href="/category/video" class="videographer">Видеостудии</a>
            <a href="/category/halls" class="halls">Залы</a>
            <a href="/category/musicians" class="artists">Музыканты</a>
            <a href="/category/toastmakers" class="conferance">Ведущие</a>
            <a href="/category/cars" class="auto">Автомобили</a>
        </div>

    </div>
</header>

@yield('content')

<footer>
    <div  class="footer container flex">
        <div>
            <p><b>© Event Space 2016</b></p>
            <p class="copyright_desc">Пожалуйста, ставьте ссылку <br> на <a href="#">Event Space</a>, если используете материалы с сайта</p>
        </div>
        <div class="flex">
            <div><p>Служба поддержки</p><p>8 925 075-82-81</p></div>
            <div><p>Вопросы сотрудничества</p><p>8 925 075-82-81</p></div>
        </div>
        <div class="solidWorks"><p>Сделано с любовью в SolidWorks</p></div>
    </div>
</footer>
<script src="/public/js/functions.js"></script>
<script src="/public/js/index.js"></script>

<script src="/public/libs/jquery.formstyler.min.js"></script>
<script src="/public/js/dzen.js"></script>
<script src="/public/js/nouislider.min.js"></script>
<script>
    $(document).ready(function () {
        var html5Slider = document.getElementById('html5');

        noUiSlider.create(html5Slider, {
            start: [ 5500, 12500 ],
            connect: true,
            range: {
                'min': 3000,
                'max': 17000
            }
        });
        var skipValues = [
            document.getElementById('skip-value-lower'),
            document.getElementById('skip-value-upper')
        ];

        html5Slider.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = parseInt(values[handle]).toFixed();
        });
    })
</script>

</body>
</html>