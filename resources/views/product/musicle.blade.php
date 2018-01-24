<main>
    <div class="container flex al">
        <div class="content">
            <h1 class="itemTitle">Ансамбль <br> "Гордость Дагестана"</h1>
            <div class="owl-carousel">
                <div data-hash="1" class="owl-item" style="background-image: url(img/s.jpg);"></div>
                <div data-hash="2" class="owl-item" style="background-image: url(img/sss.png);"></div>
                <div data-hash="3" class="owl-item" style="background-image: url(img/media_art.png);"></div>
            </div>
            <div class="minimg flex start">
                <a class="minimg-item active" href="#1" style="background-image: url(img/s.jpg);"></a>
                <a class="minimg-item" href="#2" style="background-image: url(img/sss.png);"></a>
                <a class="minimg-item" href="#3" style="background-image: url(img/media_art.png);"></a>
            </div>
            <div class="flex valuation">
                <div class="flex valuation-row start"><span class="rat">4.5</span><span class="fed">13</span></div>
                <span class="cost">18900 ₽</span>
            </div>
            <div class="itemDescriprion">
                <p>
                    Поем народные песни под аккомпанимент барабана, клавишных и двух струнных. Всего 5 человек. Есть свое оборудование, трек-лист обсуждается предварительно.
                </p>
                <p>
                    Возможно исполнение на русском языке. Поем народные песни под аккомпанимент барабана, клавишных и двух струнных. Всего 5 человек. Есть свое оборудование, трек-лист обсуждается предварительно. Возможно исполнение на русском языке.
                </p>
            </div>


        </div>

        <div class="drum__filter">
            <strong class="drum__filter-title">Забронировать</strong>

            <form class="drum__filter-form bron">
                <div class="drum__filter-form__item">
                    <span>Дата</span>
                    <div class="drum-form-content">
                        <input type="date" >
                    </div>
                </div>
                <div class="drum__filter-form__item">
                    <span>Количество часов</span>
                    <div class="drum-form-content">


                        <label class="filter-form-date">
                            <input type="radio" name="hours"> Весь день
                        </label>
                        <label>
                            <input type="radio" name="hours"> <input type="number" style="width: 50px;" value="1" min="1" max="2">
                        </label>
                    </div>
                    <p>Минимум 1 час, макисмум 2 часа.</p>
                </div>
                <div class="drum__filter-form__item">
                    <span>Город свадьбы</span>
                    <div class="drum-form-content">
                        <label>
                            <input type="radio" name="city_wedding"> Дербент
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Махачкала
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Даг. огни
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Буйнакск
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Избербаш
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Хасавюрт
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Каспийск
                        </label>
                        <label>
                            <input type="radio" name="city_wedding"> Кизляр
                        </label>


                    </div>
                    <p>Чем дальше артист уезжает от своего города, тем выше его гонорар.</p>
                </div>
                <div class="drum__filter-form__item">
                    <span>Личные данные</span>
                    <div class="drum-form-content ld">
                        <label>Имя</label><input type="text" name="name">
                    </div>
                    <div class="drum-form-content ld">
                        <label>Телефон</label><input type="text" name="tel">
                    </div>
                    <p>Мы зарегистрием вас на сайте и пришлем пароль в смс-сообщении.</p>
                    <div class="drum-form-content ld">
                        <label>Комментарий</label><textarea name="commentBron" id="" cols="20" rows="3"></textarea>
                    </div>
                </div>
                <div class="drum__filter-form__item filter-coast">
                    <div class="drum-form-content"><span>Гонорар</span> <span class="filter-coast">18900 ₽</span></div>
                    <div class="drum-form-content"><span>Залог</span> <span class="filter-coast">1890 ₽</span></div>
                </div>
                <button class="drum__filter-submit" type="submit">Забронировать</button>
            </form>
        </div>


    </div>
    <div class="container">
        <h1 class="itemTitle">Аудиозаписи</h1>
        <div class="audiorecords">
            <div id="audioplayer1" class="audiorecord">
                <audio class="music" preload="true">
                    <source src="/audio/sound.mp3">
                </audio>
                <div class="flex start audiohead"><button class="pButton play"></button> Бутырка: Какая осень в лагерях</div>
                <div class="timeline">
                    <div class="playhead"></div>
                </div>
            </div>

            <div id="audioplayer2" class="audiorecord">
                <audio class="music" preload="true">
                    <source src="/audio/sound2.mp3">
                </audio>
                <div class="flex start audiohead"><button class="pButton play"></button> Михаил Круг: Владимирский централ</div>
                <div class="timeline">
                    <div class="playhead"></div>
                </div>
            </div>
        </div>
        <h1 class="itemTitle">Отзывы</h1>
        <form action="" class="feedbackForm">
            <h5>Оставьте отзыв</h5>
            <div class="flex">
                <textarea name="feedback" class="text-feed"  cols="60" rows="10" placeholder="напишите отзыв тут"></textarea>
                <div class="notes">
                    <p>Отзывы на нашем сайте честные, объективные и конкретные. Пожалуйста, подробно опишите, что понравилось, а что можно улучшить. Отзыв будут видеть все посетители Ивент Спейс</p>
                    <p>Чтобы наши отзывы были честными и объективными, мы даем возможность комментирования только тем, пользователям, которые сделали заказ у этого исполнителя.</p>
                </div>
            </div>

            <h5>Оценка</h5>
            <div class="flex">
                <div class="value flex">
                    <input type="radio" name="ocenka" id="ocenka1" value="1"> <label for="ocenka1" data-val=1></label>
                    <input type="radio" name="ocenka" id="ocenka2" value="2"> <label for="ocenka2" data-val=2></label>
                    <input type="radio" name="ocenka" id="ocenka3" value="3"> <label for="ocenka3" data-val=3></label>
                    <input type="radio" name="ocenka" id="ocenka4" value="4" checked> <label for="ocenka4" data-val=4></label>
                    <input type="radio" name="ocenka" id="ocenka5" value="5"> <label for="ocenka5" data-val=5></label>
                </div>
                <button class="drum__filter-submit feed-sub" type="submit">Отправить отзыв</button>
            </div>
            <div class="allfeed">
                <div class="allfeed-item">
                    <div class="flex start  allfeed-item-title">
                        <span class="name">Зарема</span>
                        <div class="cc flex">
                            <label class="active"></label>
                            <label class="active"></label>
                            <label class="active"></label>
                            <label class="active"></label>
                            <label class=""></label>
                        </div>
                        <span class="data">25 января 2017</span>
                    </div>
                    <p>
                        Возможно исполнение на русском языке. Поем народные песни под аккомпанимент барабана, клавишных и двух струнных. Всего 5 человек. Есть свое оборудование, трек-лист обсуждается предварительно. Возможно исполнение на русском языке.
                    </p>
                </div>
            </div>
        </form>
    </div>
</main>
