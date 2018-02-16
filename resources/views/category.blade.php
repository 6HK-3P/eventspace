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
        <form class="search-form" id="search_form">
            <label>
                Сортировка
                <select class="sort-select" id="sort">
                    <option value="1">по цене</option>
                    <option value="2" selected>по алфавиту</option>
                    <option value="3">по рейтингу</option>
                    <option value="4">по количеству отзывов</option>
                </select>
                <button class="button-sort" data-order="asc"></button>
            </label>
            <label>
                Поиск
                <input type="text" name="search" id="input_search" placeholder="В категории">
            </label>

            <input type="submit" id="search" value="Искать">
        </form>
        <div class="flex wrap pr topBlock">
            <? $k = 4; ?>
            @if (count($items))
                @for($i=0; $i<$k; $i++)
                    @foreach($teasers as $teaser)
                        @if($teaser->position == $i+1)
                            <div class="podbor-item ">
                                <article class="tizers">
                                    <img class="item-photo" src="{{$teaser->logo}}">
                                    <p>{{$teaser->text}}</p>
                                </article>
                            </div>
                            <?  $k--; ?>
                        @endif
                        @endforeach
                            @if(isset($items[$i]))
                            <div class="podbor-item ">
                                <article class="item-cart">
                                    <a href="/product/{{$items[$i]->id}}">
                                        
                                        <div class="item-photo"  style="background-image: url(); Background-size: cover; Background-position: center center"></div>
                                    </a>
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
                                            <p><b>{{$items[$i]->name}}</b> <br>
                                                {{$items[$i]->worker->about}}</p>
                                        </div>
                                        <div class="item-desc-tags">
                                                <span>{{$items[$i]->city}}</span>
                                            @if(isset($items[$i]->param1))
                                                <span class="dot"></span>
                                                <span>{{$items[$i]->param1}}</span>
                                            @endif
                                            @if(isset($items[$i]->param2))
                                                <span class="dot"></span>
                                                <span>{{$items[$i]->param2}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endif
                    @endfor
                @endif
        </div>
        <div class="flex wrap bottomBlock">
            @if (count($items)>$k)
                <? $g =  $k+3 ?>
                    @for($i=$k; $i<$g; $i++)
                        @foreach($teasers as $teaser)
                            @if($teaser->position == $i+1)
                                <div class="podbor-item ">
                                    <article class="tizers">
                                        <img class="item-photo" src="{{$teaser->logo}}">
                                        <p>{{$teaser->text}}</p>
                                    </article>
                                </div>
                                <? $g--; ?>
                            @endif
                        @endforeach
                        @if(isset($items[$i]))
                                <div class="podbor-item ">
                                    <article class="item-cart">
                                        <div class="item-photo" style="background-image: url({{$items[$i]->worker->logo}})"></div>
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
                                                <p><b>{{$items[$i]->name}}</b> <br>
                                                    {{$items[$i]->worker->about}}</p>
                                            </div>
                                            <div class="item-desc-tags">
                                                <span>{{$items[$i]->city}}</span>
                                                @if(isset($items[$i]->param1))
                                                    <span class="dot"></span>
                                                    <span>{{$items[$i]->param1}}</span>
                                                @endif
                                                @if(isset($items[$i]->param2))
                                                    <span class="dot"></span>
                                                    <span>{{$items[$i]->param2}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endif
                    @endfor
              @endif
        </div>
        @if (count($items)>$k) @if(\App\Worker::where("category_id", $cat)->count()>$g) <div class="loadNewItem" data-offsetElem="{{$g}}"><span>Загрузить еще</span> ↓</div>@endif @endif
    </div>
</main>


<script>


    $(document).ready(function () {
        // получение  макс и мин
        var min=0;
        var max=10000;
        var price= [1];


        function mock(item) {
            var mock =	"<div class='podbor-item '>";
            mock += "<article class='item-cart'>";
            mock += "<div class='item-photo' style='background-image: url("+item.worker.logo+")'></div>";
            mock += "<div class='item-desc'>";
            mock += "<div class='item-desc-params flex'>";
            mock += "<div class='flex item-desc-params-left'>";
            mock += "<span class='rating'>4.5</span>";
            mock += "<span class='feedbacks'>666</span>";
            mock += "</div>";
            mock += "<div>";
            mock += "<span class='item-price'>18900</span>";
            mock += "</div>";
            mock += "</div>";
            mock += "<div class='item-desc-text'>";
            mock += "<p><b>"+item.name+"</b> <br>";
            mock += ""+item.worker.about+"</p>";
            mock += "</div><div class='item-desc-tags'>";
            mock += "<span>"+item.city+"</span>";
            if(item.param1) {
                mock += "<span class='dot'></span>";
                mock += "<span>" + item.param1 + "</span>";
            }
            if(item.param2){
                mock += "<span class='dot'></span>";
                mock += "<span>"+item.param2+"</span>";
            }

            mock += "</div>";
            mock += "</div>";
            mock += "</article>";
            mock += "</div>";
            return mock;
        }

        function mockTeaser(teaser) {
            var mock = "<div class='podbor-item '>";
            mock +=  "<article class='tizers'>";
            mock +=  "<img class='item-photo' src='{{$teaser->logo}}'>";
            mock +=  "<p>{{$teaser->text}}</p>";
            mock +=  "</article></div>";
            return mock;
        }
        $("#search_form").on("submit", function (e) {
            e.preventDefault();
            return false;
        })
        $("#sort").on("change",function () {
            var valueSort = $(this).val();
            var order = $(".button-sort").data("order");
            $.ajax({
                url: "/api/getSort?sort="+valueSort+"&cat={{$cat}}&order="+order,
                type: "GET",
                success: function(data) {
                    $(".topBlock").html("");
                    $(".bottomBlock").html("");
                    var json = JSON.parse(data);
                    var items = json["items"];
                    if(items.length==0){
                        $(".topBlock").append("<h3> По вашему запросу ничего не найдено </h3>")
                    }
                    else{
                        for(var i=0; i<4; i++){
                            $(".topBlock").append(mock(items[i]));
                        }
                        for(var p=k; p<7; p++){
                            $(".bottomBlock").append(mock(items[p]));
                        }
                    }


                }

            });
        });

        $("#search").on("click",function (e) {
            e.preventDefault();
            var valueSearch = $("#input_search").val();
            var order = $(".button-sort").data("order");
            $.ajax({
                url: "/api/getSearch?search="+valueSearch+"&cat={{$cat}}&order="+order,
                type: "GET",
                success: function(data) {

                    $(".topBlock").html("");
                    $(".bottomBlock").html("");
                    var json = JSON.parse(data);
                    var items = json["items"];
                    if(items.length==0){
                        $(".topBlock").append("<h3> По вашему запросу ничего не найдено </h3>")
                    }
                    else{
                        for(var i=0; i<4; i++){
                            $(".topBlock").append(mock(items[i]));
                        }
                        for(var p=4; p<7; p++){
                            $(".bottomBlock").append(mock(items[p]));
                        }
                    }

                }

            });
            return false;
        });


        $(".loadNewItem").on("click",function (e) {
            e.preventDefault();
            var offset = $(this).attr("data-offsetelem");
            var valueSearch = $("#input_search").val();
            var order = $(".button-sort").data("order");
            alert(offset);
            $.ajax({
                url: "/api/getWorkers?search="+valueSearch+"&cat={{$cat}}&order="+order+"&offset="+offset,
                type: "GET",
                success: function(data) {

                    var json = JSON.parse(data);
                    var items = json["items"];
                    var newOffset = $(".loadNewItem").data("offsetelem") + items.length;
                    $(".loadNewItem").attr('data-offsetelem',newOffset);
                    if(items.length==0){
                        $(".topBlock").append("<h3> По вашему запросу ничего не найдено </h3>")
                    }
                    else{

                        for(var p=0; p<items.length; p++){
                            $(".bottomBlock").append(mock(items[p]));

                        }
                    }

                }

            });
            return false;
        });

        $(".button-sort").on("click", function (e) {
            e.preventDefault();
            if($(this).hasClass('reverse')){
                $(this).removeClass('reverse').data('order','asc');
            }
            else {
                $(this).addClass('reverse').data('order', 'desc');
            }
            return false;
        })
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