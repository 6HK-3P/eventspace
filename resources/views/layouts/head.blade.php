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
    <script src="/public/js/modernizr.js"></script> <!-- Modernizr -->




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
        <div class="main-header-top-lk">
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->root == 3)
                <a href="/admin">
            @elseif(!empty(\Illuminate\Support\Facades\Auth::user()->worker->id))
                <a href="/lk/{{\Illuminate\Support\Facades\Auth::user()->worker->category_id}}/{{\Illuminate\Support\Facades\Auth::user()->worker->id}}">
            @elseif(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->root == 1)
                <a href="/lk/">
            @else
                <a href="#0" class="cd-signin">
            @endif
                    Личный кабинет
                </a>
            
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
            <p class="copyright_desc">{{$settings::getCopyright()}}</p>
        </div>
        <div class="flex">
            <div><p>Служба поддержки</p><p>{{$settings::getSupport()}}</p></div>
            <div><p>Вопросы сотрудничества</p><p>{{$settings::getAffilate()}}</p></div>
        </div>
        <div class="solidWorks"><p>Сделано с любовью в SolidWorks</p></div>
    </div>
</footer>
<div class="cd-user-modal"> <!-- все формы на фоне затемнения-->
        <div class="cd-user-modal-container"> <!-- основной контейнер -->
            <ul class="cd-switcher">
                <li><a href="#0">Вход</a></li>
                <li><a href="#0">Регистрация</a></li>
            </ul>

            <div id="cd-login"> <!-- форма входа -->
                <form class="cd-form">
                    <p class="fieldset">
                        <label class="image-replace  cd-username" for="signin-email">Телефон</label>
                        <input class="full-width has-padding has-border tel tel1" id="signin-tel" type="text" placeholder="Телефон">
                        <span class="cd-error-message">Введите корректный номер телефона!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signin-password">Пароль</label>
                        <input class="full-width has-padding has-border" id="signin-password" type="text"  placeholder="Пароль">
                        <a href="#0" class="hide-password">Скрыть</a>
                        <span class="cd-error-message">Пароль не менее 6 символов!</span>
                    </p>



                    <p class="fieldset">
                        <input class="full-width" type="submit" id="login" value="Войти">
                    </p>
                </form>
                
                <p class="cd-form-bottom-message"><a href="#0">Забыли свой пароль?</a></p>
                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div> <!-- cd-login -->

            <div id="cd-signup"> <!-- форма регистрации -->
                <form class="cd-form">
                <div class="step1">
                    <p class="fieldset">
                        <label class="image-replace  cd-username" for="signup-username">Телефон</label>
                        <input class="full-width has-padding tel tel2 has-border" id="signup-tel" type="text" placeholder="Телефон">
                        <span class="cd-error-message">Введите корректный номер телефона!</span>
                    </p>
                    <p class="cd-form-message">Введите номер телефона. Вам придет смс с кодом</p>
                    
                    <p class="fieldset">
                        <input class="full-width has-padding" id="step1" type="submit" value="Получить код">
                    </p>
                </div>
                <div class="step2">
                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signup-username">Введите код</label>
                        <input class="full-width has-padding has-border" id="signup-code" type="text"  maxlength="4" placeholder="Введите код">
                        <span class="cd-error-message">Некорректный код! Осталось 2 попытки.</span>
                    </p>
                    <p class="fieldset">
                        <input class="full-width has-padding" id="step2" type="submit" value="Подтвердить">
                    </p>
                </div>
                <div class="step3">
                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signin-password">Пароль</label>
                        <input class="full-width  has-padding has-border" id="signup-password" type="text"  placeholder="Придумайте пароль">
                        <a href="#0" class="hide-password">Скрыть</a>
                        <span class="cd-error-message">Пароль не менее 6 символов!</span>
                    </p>
                    <p class="fieldset">
                        <input class="full-width has-padding" id="step3" type="submit" value="Зарегистрироваться">
                    </p>
                </div>
                <div class="step4">
                    <h3>Вы успешно зарегистрированны!</h3>
                    <img src="img/check.svg" alt="">
                </div>
                </form>

                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div> <!-- cd-signup -->

            <div id="cd-reset-password"> <!-- форма восстановления пароля -->
                <p class="cd-form-message">Забыли пароль? Пожалуйста, введите номер телефона. Вам будет выслан временный пароль, изменить который, вы можете в личном кабинете. </p>

                <form class="cd-form">
                    <p class="fieldset">
                        <label class="image-replace cd-username" for="reset-email">Телефон</label>
                        <input class="full-width has-padding has-border  tel tel3 " id="reset-password" type="text" placeholder="Телефон">
                        <span class="cd-error-message">Введите корректный номер телефона!</span>
                    </p>

                    <p class="fieldset">
                        <input class="full-width has-padding" id="res_pass" type="submit" value="Восстановить пароль">
                    </p>
                </form>

                <p class="cd-form-bottom-message"><a href="#0">Вернуться к входу</a></p>
            </div> <!-- cd-reset-password -->
            <a href="#0" class="cd-close-form">Закрыть</a>
        </div> <!-- cd-user-modal-container -->
    </div> <!-- cd-user-modal -->


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
<script src="/public/js/modal.js"></script> <!-- Gem jQuery -->
</body>
</html>