@extends('layouts.head')
@section('content')
<main>
    <div class="container flex al">

            <div class="content">
                <h1 class="itemTitle" data-worker="{{$InfoWorker->id}}">{{$InfoUsers['name']}}</h1>
                <div class="owl-carousel">
                    <? $i = 1; ?>
                        @if($InfoWorker->logo)
                            <?  $LogoInfo = json_decode($InfoWorker->logo);?>
                            @foreach($LogoInfo as $logos)
                                @if($logos->type == "photo")
                                    <div data-hash="{{$i}}" class="owl-item" style="background-image: url({{ $logos->src }});"></div>
                                @else
                                    <div data-hash="{{$i}}" class="owl-item" >
                                        <iframe  width="100%" height="100%" src="{{ $logos->src }}" frameborder="0" allowfullscreen=""></iframe>
                                    </div>
                                @endif

                                <? $i++; ?>
                            @endforeach
                        @else
                            <div data-hash="1" class="owl-item" style="background-image: url();"></div>
                        @endif
                </div>
                <div class="minimg flex start">
                    <? $i = 1; ?>
                    @if($InfoWorker->logo)
                        @foreach($LogoInfo as $logos)
                                @if($logos->type == "photo")
                                    <a class="minimg-item @if($i == 1) active @endif" href="#{{$i}}" style="background-image: url({{ $logos->src }});"></a>
                                @else
                                    <a class="minimg-item @if($i == 1) active @endif" href="#{{$i}}" style="background-image: url({{ $logos->poster }});"></a>
                                @endif
                                <? $i++; ?>
                        @endforeach
                    @else
                            <a class="minimg-item active" href="#1" style="background-image: url();"></a>
                    @endif
                </div>
                <div class="flex valuation">
                    <div class="flex valuation-row start"><span class="rat">4.5</span><span class="fed">13</span></div>

                </div>
                <div class="itemDescriprion">
                    <p>
                        {{$InfoWorker->about}}
                    </p>
                </div>
        </div>
        <div class="drum__filter">
            <strong class="drum__filter-title">Забронировать</strong>

            <form class="drum__filter-form bron" data-category = "{{$InfoWorker->category_id}}" method="POST" action="/orders/add/{{$InfoUsers->id}}">
                {{csrf_field()}}
                <?php $start = microtime(true);?>
                @include('filters.category_date')
                @if($InfoWorker->category_id != 3) @include('filters.category_cities') @endif
                @if ($InfoWorker->category_id == 6)

                        @include('filters.auto')

                @elseif($InfoWorker->category_id == 5)

                        <script src="/public/js/entertainer.js"></script>
                        @include('filters.times')

                @elseif($InfoWorker->category_id == 3)

                        <div class="drum__filter-form__item">
                            <? $capacity = json_decode($InfoWorker->workers_additional_info); ?>
                            <span>Вместимость: {{$capacity->capacity->start}} - {{$capacity->capacity->end}} чел.</span>
                        </div>
                        @include('filters.price_zal')

                @elseif($InfoWorker->category_id == 2)

                        <script src="/public/js/video.js"></script>
                        @include('filters.times_video')
                        @include('filters.equipment')

                @elseif($InfoWorker->category_id == 4)

                        <script src="/public/js/entertainer.js"></script>
                        @include('filters.times')

                @elseif($InfoWorker->category_id == 1)

                        <script src="/public/js/entertainer.js"></script>
                        @include('filters.times')

                @endif

                <?php $finish = microtime(true);
                    dump($finish-$start);
                ?>

                <div class="drum__filter-form__item filter-coast">
                    <div class="drum-form-content"><span>Гонорар</span> <span id="price" class="filter-coast">0 ₽</span></div>
                    <div class="drum-form-content"><span>Залог</span> <span id="deposit" class="filter-coast">0 ₽</span></div>
                </div>
                <button class="drum__filter-submit" type="submit">Забронировать</button>
            </form>
        </div>


    </div>
    <div class="container">
        @if($InfoWorker->category_id == 6)
        <h1 class="itemTitle" >Машины</h1>
        <div class="audiorecords">
            @if($allCarsWorker)
                <div class="">
                    <table class="price_rules cars_table" style="display:block; width:100%;">
                        <thead>
                        <td>№</td>
                        <td>Имя автомобиля</td>
                        <td>Марка автомобиля</td>
                        <td>Тип автомобиля</td>
                        <td>Цвет автомобиля</td>
                        <? $i=1; ?>
                        </thead>
                        @foreach($allCarsWorker as $CarsWorker)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$CarsWorker->name}}</td>
                                <td>{{$CarsWorker->mark_car->name}}</td>
                                <td>{{$CarsWorker->type_car->name}}</td>
                                <td>{{$CarsWorker->color_car->name}}</td>
                                <? $i++; ?>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
            <script src="/public/js/cars.js"></script>
        @endif
        @if($InfoWorker->audio)
            <h1 class="itemTitle">Аудиозаписи</h1>
            <div class="audiorecords">

                    <? $audios = json_decode($InfoWorker->audio); $i=1; ?>
                    @foreach($audios as $audio)

                    <div id="audioplayer{{$i}}" class="audiorecord">
                        <audio class="music" preload="true">
                            <source src="{{$audio->link}}">
                        </audio>
                        <div class="flex start audiohead"><button class="pButton play"></button> {{$audio->name}}</div>
                        <div class="timeline">
                            <div class="playhead"></div>
                        </div>
                    </div>
                        <?php $i++;?>
                    @endforeach

            </div>
            @endif
        <h1 class="itemTitle">Отзывы</h1>
            <?
            $userid = '';
            $user = '';
            if(\Illuminate\Support\Facades\Auth::user()){
                $userid = \Illuminate\Support\Facades\Auth::user()->id;
                $user = \Illuminate\Support\Facades\Auth::user();
            }
            $info_order = \App\Order::where('user_id', $userid)->whereIn('status', [4,6])->get();
            ?>
        <form action="/add_feedback/{{$userid}}/{{$InfoWorker->id}}" class="feedbackForm" method="POST">
            {{csrf_field()}}
            <h5>Оставьте отзыв</h5>
            <div class="flex">
                <textarea name="feedback" class="text-feed"  cols="60" rows="10" placeholder="напишите отзыв тут" required></textarea>
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
                    <input type="radio" name="ocenka" id="ocenka4" value="4"> <label for="ocenka4" data-val=4></label>
                    <input type="radio" name="ocenka" id="ocenka5" value="5"> <label for="ocenka5" data-val=5></label>
                </div>
                <button class="drum__filter-submits @if(empty($user) || !count($info_order)) disabled @endif feed-sub" @if(empty($user) || !count($info_order)) disabled @endif type="submit">
                    Отправить отзыв
                </button>
            </div>
        </form>

            <div class="allfeed">
                    @foreach($SelComment as $comment)
                <div class="allfeed-item">
                    <div class="flex start  allfeed-item-title">
                        <span class="name">{{\App\User::find($comment->user_id)->name}}</span>
                        <div class="cc flex">
                            <label  class="@if($comment->mark == 1 || $comment->mark == 2 ||$comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 2 ||$comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 3 ||$comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 4 ||$comment->mark == 5) active @endif"></label>
                            <label class="@if($comment->mark == 5) active @endif"></label>
                        </div>
                        <span class="data">{{date('d m Y',strtotime($comment->created_at))}}</span>
                    </div>
                    <p>
                    {{$comment->comments}}
                    </p>
                </div>
                @endforeach
            </div>

    </div>

</main>
@endsection