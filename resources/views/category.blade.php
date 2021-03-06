@extends('layouts.head')
@section('content')
    <main data-category="">

        <div class="container">
            <div class="drum__filter">
                <strong class="drum__filter-title">Уточните детали</strong>

                <form class="drum__filter-form" action="{{url('')}}/category/{{$category}}/find" method="GET">
                    {{csrf_field()}}
                    @include('filters.category_date')
                    @include('filters.category_cities')
                    @include('filters.filters')
                    @if($cat == 3) @include('filters.category_hall')
                    @else
                        @include('filters.category_payment')
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
            @if($items)
                @foreach($items as $item)
                    @if($loop->first || $loop->iteration == 4)<div class="flex wrap pr @if($loop->iteration <= 3) topBlock @else bottomBlock @endif"> @endif
                        @include('card_worker')
                        @foreach($teasers as $teaser)
                            @if($loop->parent->iteration % $teaser->position == 0 || $loop->parent->last)
                                <div class="podbor-item ">
                                    <article class="tizers">
                                        <img class="item-photo" src="{{$teaser->logo}}">
                                        <p>{{$teaser->text}}</p>
                                    </article>
                                </div>
                                @break
                            @endif
                        @endforeach
                        @if($loop->iteration == 3 || $loop->last) </div> @endif
                    @if($loop->last) <div class="loadNewItem" data-offsetElem="{{$loop->iteration}}"><span>Загрузить еще</span> ↓</div> @endif
                @endforeach
            @else
                <br><br>
                <p class="empty">Пока нет предложений</p>
            @endif

        </div>
    </main>


    <script>


        $(document).ready(function () {
            // получение  макс и мин
            var min = @if(isset($arenda_ot)) {{$arenda_ot}} @else {{$min}}  @endif;
            var max = @if(isset($arenda_do)) {{$arenda_do}} @else {{$max}}  @endif;
            var min0 =  {{$min}};
            var max0 =  {{$max}};
            var price= [1];


            function mock(item) {
                var price_today = '';
                $.ajax({
                    url: '/api/getpricetoday/'+item.worker.id,
                    type: "GET",
                    complete: function (data) {
                        price_today = (data['responseText']) ? JSON.parse(data['responseText']) : '0 ';
                        $('.price_today_'+item.worker.id).append(price_today+"₽");
                    }
                });
                var sum = 0;
                var iteration = 0
                for(var avg in item.worker.comment){
                    sum = item.worker.comment[avg].mark+sum;
                    iteration++;
                }
                var avg_mark = sum/iteration;
                avg_mark = avg_mark ? avg_mark : 0;
                var mock =	"<div class='podbor-item '>";
                mock += "<article class='item-cart'>";
                mock += "<article class='item-cart'>";
                mock += '<a href="/product/'+item.id+'">';
                mock += "<div class='item-photo' style='background-image: url("+item.worker.ava+"); Background-size: cover; Background-position: center center'></div>";
                mock += "</a>";
                mock += "<div class='item-desc'>";
                mock += "<div class='item-desc-params flex'>";
                mock += "<div class='flex item-desc-params-left'>";
                mock += "<span class='rating'>"+avg_mark+"</span>";
                mock += "<span class='feedbacks'>"+iteration+"</span>";
                mock += "</div>";
                mock += "<div>";
                mock += "<span class='price_today_"+item.worker.id+" item-price'>"+price_today+"</span>";
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
            @if(count($teasers))
            function mockTeaser(teaser) {
                var mock = "<div class='podbor-item '>";
                mock +=  "<article class='tizers'>";
                mock +=  "<img class='item-photo' src='{{$teaser->logo}}'>";
                mock +=  "<p>{{$teaser->text}}</p>";
                mock +=  "</article></div>";
                return mock;
            }
            @endif
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
                            $(".topBlock").append("<br><br><p class='empty'> По вашему запросу ничего не найдено </p>")
                        }
                        else{
                            var item_class = $(".topBlock");
                            for(var p in items){
                                if(p>=4 && p < 7){
                                    item_class = $(".bottomBlock")
                                }
                                $(item_class).append(mock(items[p]));
                            }
//                        for(var i=0; i<4; i++){
//                            $(".topBlock").append(mock(items[i]));
//                        }
//                        for(var p=k; p<7; p++){
//                            $(".bottomBlock").append(mock(items[p]));
//                        }
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
                            $(".topBlock").append("<br><br><p class='empty'> По вашему запросу ничего не найдено </p>")
                        }
                        else{
                            var item_class = $(".topBlock");
                            for(var l in items){
                                if(l>=4 && l < 7){
                                    item_class = $(".bottomBlock")
                                }
                                $(item_class).append(mock(items[l]));
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
                $.ajax({
                    url: "/api/getWorkers",
                    data:{
                        search:valueSearch,
                        cat:{{$cat}},
                        order:order,
                        offset:offset
                    },
                    type: "GET",
                    success: function(data) {
                        var items = data["items"];
                        var newOffset = parseInt($(".loadNewItem").attr("data-offsetelem")) + items.length;
                        $(".loadNewItem").attr('data-offsetelem',newOffset);
                        if(items.length==0){
                            $(".loadNewItem").remove()
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
                    'min': min0, //сюда тоже
                    'max': max0
                }
            });
            var skipValues = [
                document.getElementById('skip-value-lower'),
                document.getElementById('skip-value-upper')
            ];
            var skipValues2 = [
                document.getElementById('skip-value-lower2'),
                document.getElementById('skip-value-upper2')
            ];

            html5Slider.noUiSlider.on('update', function (values, handle) {
                skipValues[handle].innerHTML= parseInt(values[handle]).toFixed();
                skipValues2[handle].value = parseInt(values[handle]).toFixed();
            });



        });
    </script>

@endsection