@extends('layouts.head')
@section('content')
<main data-category="">
    <div class="container">
        <div class="drum__filter">
            <strong class="drum__filter-title">Уточните детали</strong>
            <form class="drum__filter-form">

                 @if ($cat == 6) @include('filters.category_car')
                                 @include('filters.category_date')
                                 @include('filters.category_cities')
                 @endif

                 @if ($cat == 5) @include('filters.category_entertainer')
                                 @include('filters.category_date')
                                 @include('filters.category_cities')
                 @endif

                 @if ($cat == 3) @include('filters.category_date')
                                 @include('filters.category_cities')
                                 @include('filters.category_hall')
                 @endif
                 @if ($cat == 2) @include('filters.category_mediastudio')
                                 @include('filters.category_date')
                                 @include('filters.category_cities')
                 @endif
                 @if ($cat == 4) @include('filters.category_musician')
                                 @include('filters.category_date')
                                 @include('filters.category_cities')
                 @endif

                 @if ($cat == 1) @include('filters.category_date')
                                 @include('filters.category_duration')
                                 @include('filters.category_cities')
                 @endif
                 @if ($cat != 3) @include('filters.category_payment')
                 @endif

                <p class="drum__filter-result"></p>
                <button class="drum__filter-submit">Показать</button>
            </form>
        </div>
        <h1 class="page-title">
            <i class="gidra" style="<?
            switch ($cat){
                case "1": echo "background-image: url(/public/img/photo.png); margin-right:20px;"; break;
                case "2": echo "background-image: url(/public/img/video.png); margin-right:20px;"; break;
                case "3": echo "background-image: url(/public/img/halls.png); margin-right:20px;"; break;
                case "4": echo "background-image: url(/public/img/drum.png); margin-right:20px;"; break;
                case "5": echo "background-image: url(/public/img/conf.png);"; break;
                case "6": echo "background-image: url(/public/img/auto.png); margin-right:10px;"; break;
            }

            ?>"></i>
            {{\App\workers_categorie::find($cat)->name}}
       </h1>
        <form class="search-form">
            <label>
                Сортировка
                <select class="sort-select">
                    <option value="price">по цене</option>
                    <option value="name">по алфавиту</option>
                    <option value="rating">по рейтингу</option>
                    <option value="comments_count">по количеству отзывов</option>
                </select>
                <button class="button-sort"></button>
            </label>
            <label>
                Поиск
                <input type="text" placeholder="В категории">
            </label>

            <input type="submit" value="Искать">
        </form>
        <div class="flex wrap pr">
            <div class="podbor-item ">
                <article class="item-cart">
                    <div class="item-photo" style="background-image: url(/public/img/111.png)"></div>
                    <div class="item-desc">
                        <div class="item-desc-params flex">
                            <div class="flex item-desc-params-left">
                                <span class="rating">4.5</span>
                                <span class="feedbacks">666</span>
                            </div>
                            <div>
                                <span class="item-price">18900</span>
                            </div>
                        </div>
                        <div class="item-desc-text">
                            <p><b>Квартет "Молодость"</b>
                                Народные мотивы в сочетании с современной рок-музыкой. Невозм записать Горных орлов и вы почувствуете
                                драйв
                                привычных народных</p>
                        </div>
                        <div class="item-desc-tags">
                            <span>Махачкала</span>
                            <span class="dot"></span>
                            <span>Эстрада</span>
                            <span class="dot"></span>
                            <span>Аварский</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="podbor-item ">
                <article class="item-cart">
                    <div class="item-photo" style="background-image: url(/public/img/111.png)"></div>
                    <div class="item-desc">
                        <div class="item-desc-params flex">
                            <div class="flex item-desc-params-left">
                                <span class="rating">4.5</span>
                                <span class="feedbacks">666</span>
                            </div>
                            <div>
                                <span class="item-price">18900</span>
                            </div>
                        </div>
                        <div class="item-desc-text">
                            <p><b>Квартет "Молодость"</b>
                                Народные мотивы в сочетании с современной рок-музыкой. Невозм записать Горных орлов и вы почувствуете
                                драйв
                                привычных народных</p>
                        </div>
                        <div class="item-desc-tags">
                            <span>Махачкала</span>
                            <span class="dot"></span>
                            <span>Эстрада</span>
                            <span class="dot"></span>
                            <span>Аварский</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="podbor-item ">
                <article class="tizers">
                    <img class="item-photo" src="/public/img/tizer1.png">
                    <p>Если вы не в перый раз организуете свадьбу, вы, должно быть, знаете, как тяжело наладить коммуникацию с исполнителями: они не берут трубку, постоянно заняты. Даже договориться о встрече большая проблема. Мы решим ее сами. Наш менеджер обо всем позаботиться. Просто оставьте заявку. </p>
                </article>
            </div>
            <div class="podbor-item ">
                <article class="item-cart">
                    <div class="item-photo" style="background-image: url(/public/img/111.png)"></div>
                    <div class="item-desc">
                        <div class="item-desc-params flex">
                            <div class="flex item-desc-params-left">
                                <span class="rating">4.5</span>
                                <span class="feedbacks">666</span>
                            </div>
                            <div>
                                <span class="item-price">18900</span>
                            </div>
                        </div>
                        <div class="item-desc-text">
                            <p><b>Квартет "Молодость"</b>
                                Народные мотивы в сочетании с современной рок-музыкой. Невозм записать Горных орлов и вы почувствуете
                                драйв
                                привычных народных</p>
                        </div>
                        <div class="item-desc-tags">
                            <span>Махачкала</span>
                            <span class="dot"></span>
                            <span>Эстрада</span>
                            <span class="dot"></span>
                            <span>Аварский</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="flex wrap">
            <div class="podbor-item ">
                <article class="item-cart">
                    <div class="item-photo" style="background-image: url(/public/img/111.png)"></div>
                    <div class="item-desc">
                        <div class="item-desc-params flex">
                            <div class="flex item-desc-params-left">
                                <span class="rating">4.5</span>
                                <span class="feedbacks">666</span>
                            </div>
                            <div>
                                <span class="item-price">18900</span>
                            </div>
                        </div>
                        <div class="item-desc-text">
                            <p><b>Квартет "Молодость"</b>
                                Народные мотивы в сочетании с современной рок-музыкой. Невозм записать Горных орлов и вы почувствуете
                                драйв
                                привычных народных</p>
                        </div>
                        <div class="item-desc-tags">
                            <span>Махачкала</span>
                            <span class="dot"></span>
                            <span>Эстрада</span>
                            <span class="dot"></span>
                            <span>Аварский</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="podbor-item ">
                <article class="item-cart">
                    <div class="item-photo" style="background-image: url(/public/img/111.png)"></div>
                    <div class="item-desc">
                        <div class="item-desc-params flex">
                            <div class="flex item-desc-params-left">
                                <span class="rating">4.5</span>
                                <span class="feedbacks">666</span>
                            </div>
                            <div>
                                <span class="item-price">18900</span>
                            </div>
                        </div>
                        <div class="item-desc-text">
                            <p><b>Квартет "Молодость"</b>
                                Народные мотивы в сочетании с современной рок-музыкой. Невозм записать Горных орлов и вы почувствуете
                                драйв
                                привычных народных</p>
                        </div>
                        <div class="item-desc-tags">
                            <span>Махачкала</span>
                            <span class="dot"></span>
                            <span>Эстрада</span>
                            <span class="dot"></span>
                            <span>Аварский</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="podbor-item " >
                <article class="tizers">
                    <img class="item-photo" src="/public/img/tizer2.png">
                    <p>Если вы не в перый раз организуете свадьбу, вы, должно быть, знаете, как тяжело наладить коммуникацию с исполнителями: они не берут трубку, постоянно заняты. Даже договориться о встрече большая проблема. Мы решим ее сами. Наш менеджер обо всем позаботиться. Просто оставьте заявку. </p>
                </article>
            </div>
            <div class="loadNewItem"><span>Загрузить еще</span> ↓</div>
        </div>
    </div>
</main>
<script src="/static/js/entity/api.js"></script>
<script src="/static/js/category.js"></script>

<script>
    $(document).ready(function () {
        // получение  макс и мин
        var min=0;
        var max=10000;
        var price= [1];

        $.ajax({
            url: "/api/getWorkers",
            type: "POST",
            data:  {price},
            success: function(data) {

                data=JSON.parse (data);

                max =JSON.parse (data).max;
                min =JSON.parse (data).min;


            }

        });

//////////////////// аякс выполняетс после и не успевают примениться переменные, ае сли ждать ломается всё что ниже

        var html5Slider = document.getElementById('html5');

        noUiSlider.create(html5Slider, {
            start: [min, max], //сюда минимум и максимум
            connect: true,
            step: 1000,
            range: {
                'min': min, //сюда тоже
                'max': max
            }
        });
        var skipValues = [
            document.getElementById('skip-value-lower'),
            document.getElementById('skip-value-upper')
        ];

        html5Slider.noUiSlider.on('update', function (values, handle) {
            skipValues[handle].innerHTML = parseInt(values[handle]).toFixed();
        });



    });
</script>

@endsection