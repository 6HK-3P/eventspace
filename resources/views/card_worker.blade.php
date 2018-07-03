<div class="podbor-item ">
    <article class="item-cart">
        <a href="/product/{{$item->id}}">

            <div class="item-photo"  style="background-image: url({{$item->worker->ava}}); Background-size: cover; Background-position: center center"></div>
        </a>
        <div class="item-desc">
            <div class="item-desc-params flex">
                <div class="flex item-desc-params-left">
                    <?php $rating =  $item->worker->comment->avg('mark')?>
                    <span class="rating">{{($rating) ? $rating : 0}}</span>
                    <span class="feedbacks">{{$item->worker->comment->count()}}</span>
                </div>
                <div>
                    <span class="item-price">{{$item->worker->priceToDay()}} ₽</span>
                </div>
            </div>
            <div class="item-desc-text">
                <p><b>{{$item->name}}</b> <br>
                    {{$item->worker->about}}</p>
            </div>
            <div class="item-desc-tags">
                <span>{{$item->worker->city->title}}</span>
                @if($item->worker->param(0) != false)
                    <span class="dot"></span>
                    <span>{{$item->worker->param(0)}}</span>
                @endif
                @if($item->worker->param(1) != false)
                    <span class="dot"></span>
                    <span>{{$item->worker->param(1)}}</span>
                @endif
            </div>
        </div>
    </article>
</div>