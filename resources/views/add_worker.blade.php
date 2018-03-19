@extends('layouts.adhead')
@section('content')

<main class="container admin-main">
    <section class="add-artist">
        @if($id!=0)
            <div class="flex start tabs-cont">
                @if(\Illuminate\Support\Facades\Auth::user()->worker->id)
                    <div id="calendar" class="tabs active"><span>Календарь</span></div>

                    <div id="orders" class="tabs"><span>Мои заказы</span></div>
                @endif
                <div id="info" class="tabs "><span>Информация</span></div>
                @if($id!=0 && $cat->id == 6 )
                    <div id="cars" class="tabs "><span>Мои автомобили</span></div>
                @endif
                <div id="price" class="tabs "><span>Ценообразование</span></div>
                <div id="portfolio" class="tabs"><span>Портфолио</span></div>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->worker->id)
                @include('pack.calendar')
                @include('pack.orders')
        @endif
        @include('pack.info')
        @if($id!=0 && $cat->id == 6 )
            @include('pack.cars')
        @endif
        @if($id!=0)
            @include('pack.pricing')
            @include('pack.portfolio')
        @endif
            <script src="/public/js/add_artist.js"></script>

            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            var arrSortVideo = [];
            $( function() {
                $( "#audio_options" ).sortable();
                $( "#audio_options" ).disableSelection();
            } );
            $( function() {
                $( "#video_options" ).sortable();
                $( "#video_options" ).disableSelection();
            } );
        </script>
    </section>
</main>
@endsection