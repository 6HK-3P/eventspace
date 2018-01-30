@extends('layouts.head')
@section('content')
<main>
    <div class="container cd">
        <h1 class="index-h1">Event Space делает рынок свадебных услуг <span>прозрачным</span> <br> и
            <span>удобным</span>. И это абсолютно <span>бесплатно</span> для вас.</h1>
        <div class="index-search ">
            <form action="#" method="GET" class="flex">
                <input name="search" placeholder="Введите название для поиска" class="index-search-input">
                <input type="button" name="go" value="Искать" class="button-search">
            </form>
        </div>
    </div>
    <section class="podbor">
        <div class="container">
            <h2 class="index-h2">Посмотрите подборки исполнителей</h2>
            <nav class="index-tabs flex">
                <div id="podbor1" class="tabsIndex active"><span>Разумный выбор</span></div>
                <div id="podbor2" class="tabsIndex"><span>Золотая середина</span></div>
                <div id="podbor3" class="tabsIndex"><span>Лучшие из лучших</span></div>
            </nav>


            <section class="podbor tabs-body flex wrap" style="display: none">

                <div class="podbor-item">
                    <a href="#" class="items-category"></a>
                    <article class="item-cart">
                        <a href="product/2">
                            <div class="item-photo" ></div>
                        </a>
                        <div class="item-desc">
                            <div class="item-desc-params flex">
                                <div class="flex item-desc-params-left">
                                    <span class="rating"></span>
                                    <span class="feedbacks"></span>
                                </div>
                                <div>
                                    <span class="item-price"> &#8381;</span>
                                </div>
                            </div>
                            <div class="item-desc-text">
                                <p><b></p>
                            </div>
                            <div class="item-desc-tags">
                                <span></span>


                                <span class="dot"></span>
                                <span></span>

                            </div>
                        </div>
                    </article>
                </div>

            </section>

        </div>
    </section>
    <section class="podbor search-box" style="display: none">
        <div class="container tabs-body flex wrap"></div>
    </section>
    <section class="work">
        <div class="container flex">
            <div class="c70">
                <h3 class="index-h3">Как мы работаем</h3>
                <div class="work-body">
                    <p>Организация свадьбы дело хлопотное. Много времени и сил уходит на поиск идеального исполнителя. А
                        когда вы нашли нужного исполнителя, оказывается, что:</p>
                    <ul>
                        <li>Цена выше, чем вы ожидали</li>
                        <li>Исполнитель занят на нужную вам дату</li>
                        <li>Или вас все устраивает, но вы бы хотели сравнить, уточнить детали, <br>а поиски отнимают
                            много времени.
                        </li>
                        <h6 class="index-h6">
                            Мы решаем эти проблемы для вас
                        </h6>
                    </ul>
                </div>

            </div>

            <div class="c30">
                <img src="/static/img/P1.png" height="146" width="365">
                <p>Наша задача – сделать рынок свадебных услуг максимально <b>прозрачным</b> и <b>удобным</b>. </p>
                <p>Радик Бегов, <i>основатель</i></p>
            </div>
        </div>
    </section>
    <section class="step">
        <div class="container flex">
            <div class="c30">
                <img src="/static/img/g1.png" alt="">
                <div class="step-desc">
                    <h6 class="index-h6">Выберите исполнителя, подходящего вам <br>по бюджету.</h6>
                    <p>У нас прямые контакты с исполнителями, поэтому мы договариваемся о минимальных единых ценах для
                        всех, делая рынок свадебных услуг прозрачным. </p>
                </div>
            </div>

            <div class="c30">
                <img src="/static/img/g2.png" alt="">
                <div class="step-desc">
                    <h6 class="index-h6">На странице исполнителя <br>выберете услугу и дату, <br>и нажмите кнопку <br>«Забронировать».
                    </h6>
                    <p>Заявка автоматически уходит исполнителю. Он подтверждает свою готовность принять заказ на
                        указанную вами дату, и вы сразу же получаете уведомление на телефон. </p>
                </div>
            </div>
            <div class="c30">
                <img src="/static/img/g3.png" alt="">
                <div class="step-desc">
                    <h6 class="index-h6">Внесите предоплату<br>
                        исполнителю (около 3000 руб.) <br>
                        прямо на сайте</h6>
                    <p>После получения уведомления в личном кабинете вы вносите предоплату исполнителю (около 3 000
                        руб.), которая затем будет вычтена из общей суммы. Не откладывайте, взнос предоплаты, иначе
                        исполнителя может занять кто-то другой.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="post">
        <div class="container">
            <p>Таким образом, вам не нужно тратить свое время, силы и энергию в поисках информации и цен на свадебные
                услуги. Вы можете быстро и удобно сделать это через Event Space. <br>А все остальное время посвятить
                более приятным моментам предстоящего праздника!</p>
        </div>
    </section>
    <section class="wedding-now">
        <div class="container">
            <div class="but_wed_now">
                <a href="#">
                    <span>Начните готовить свадьбу сейчас</span>
                </a>
            </div>
            <p>Если вы не нашли нужного вам исполнителя, оставьте нам заявку <br>по номеру: <span class="tel">+7 925 075-82-81</span>
                или через <span class="vk">Vk</span> <span class="wats">WhatsApp</span> <span
                        class="insta">Instagram</span></p>
        </div>
    </section>
    <section class="exemple">
        <div class="container">
            <h2 class="h2-exepmle">Карточка исполнителя – главный элемент <br> нашего сайта. Посморите, как она работает
            </h2>
            <div class="flex">
                <div class="c70" style="width:59%">
                    <div class="flex">
                        <div>
                            <article>
                                <h3 class="h3-exemple star">Оценка</h3>
                                <p>Исполнителей оценивают только их клиенты после заказа на сайте. Так мы исключаем
                                    мошенничество и предотвращаем накрутку рейтинга.</p>
                            </article>
                            <article>
                                <h3 class="h3-exemple feed">Отзывы</h3>
                                <p>Мы просим наших клиентов оставлять подробные отзывы на сайте. Они помогают
                                    совершенстоваться исполнителям и помогают нашим новым клиентам сделать правильный
                                    выбор</p>
                            </article>
                        </div>





                        <article class="item-cart" style="width:360px;">
                            <div class="item-photo" ></div>
                            <div class="item-desc">
                                <div class="item-desc-params flex">
                                    <div class="flex item-desc-params-left">
                                        <span class="rating"></span>
                                        <span class="feedbacks"></span>
                                    </div>
                                    <div>
                                        <span class="item-price">&#8381;</span>
                                    </div>
                                </div>
                                <div class="item-desc-text">
                                    <p><b></p>
                                </div>
                                <div class="item-desc-tags">
                                    <span></span>


                                    <span class="dot"></span>
                                    <span></span>



                                </div>
                            </div>
                        </article>




                    </div></div></div>
            <article class="t">
                <h3 class="h3-exemple tags">Тэги</h3>
                <p>Тэги на карточках отображают важную информацию для пользователей. <br> Например: город, в
                    котором находится исполнитель. Следовательно, в этом городе у него минимальные цены. Родной
                    язык - для музыкантов и ведущих. Максимальное качество съемки - для видеостудий и т.д.</p>
            </article>

        </div>

        <div class="c30" style="width:40%">
            <article class="t">
                <h3 class="h3-exemple pv">Фото/Видео</h3>
                <p>Каждый исполнитель имеет доступ к личному кабинету, через который может регулярной обновлять
                    свое портфолио. Добавлять фото, видео, музыку; редактировать свой календарь; указывать цены
                    на свои услуги</p>
            </article>
            <article class="t">
                <h3 class="h3-exemple priced">Цена</h3>
                <p>Цена на карточке исполнителя указана на сегодняшний день на базовую услугу, которую чаще
                    всего заказывают пользователи. Обращаем ваше внимание, что цены на свадебные услуги имеют
                    сезонную составляющую (летом – дороже, зимой – дешевле). На самой странице исполнителя вы
                    можете посмотреть цену на интересующую вас услугу и дату. Мы с исполнителями договариваемся
                    об единой минимальной цене для всех.</p>
            </article>
        </div>

        </div>
        </div>

    </section>
    <section class="await">
        <div class="container">
            <h3 class="index-h3">Почему нам можно доверять</h3>
            <p class="await_desc">Ответы на вопросы на странице <a href="/about">о компании</a> и по телефону 8 925
                075-82-81
            </p>
            <div class="flex">
                <div class="c50">
                    <h5 class="index-h5">Гарантируем <br> безопасность</h5>
                    <p>
                        Все платежи обрабатываются сертифицированным партнером. Наш <br> сайт не имеет доступа к вашей
                        <br>платежной информации, бояться нечего.
                    </p>
                </div>
                <div class="c50">
                    <h5 class="index-h5">В партнерстве <br>с клиентами</h5>
                    <p>
                        Мы всегда рады принять вас в гости в нашей <br> студии. Вы можете прийти и обсудить любые<br>
                        интересующие вас вопросы, связанные с <br>организацией праздника.
                    </p>
                    <p>Наш адрес: г. Дербент, ул. 345 ДСД, 17</p>
                </div>
            </div>
            <div class="flex bot">
                <div class="c66">
                    <p>Расскажите друзьям о нашем проекте. Чем больше людей будут использовать <br> EventSpace, тем
                        прозрачнее и удобнее станет рынок свадебных услуг.</p>
                </div>
                <div class="c34">
                    <img src="/static/img/xer1.png" alt=""><br>
                    <img src="/static/img/xer2.png" alt="">
                </div>
            </div>
        </div>
    </section>
</main>


    @endsection