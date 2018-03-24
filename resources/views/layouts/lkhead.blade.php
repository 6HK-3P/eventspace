<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/normalize.css/normalize.css">
    <link rel="stylesheet" href="/public/css/slick-theme.css">
    <link rel="stylesheet" href="/public/css/slick.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/public/css/owl.theme.default.min.css">
    <link href="/public/css/datepicker.min.css" rel="stylesheet" type="text/css">
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
    <script src="/public/js/datepicker.min.js"></script>




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
        <div class="main-header-top-lk"><a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                Выход
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    <div class="main-header-bottom">
        <div class="main-header-bottom">
            <h1>Здравствуйте {{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
        </div>

    </div>

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

<script src="/public/libs/jquery.formstyler.min.js"></script>
<script src="/public/js/dzen.js"></script>
<script src="/public/js/nouislider.min.js"></script>
<script src="/public/js/product.js"></script>
<script src="/public/js/owl.carousel.js"></script>
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