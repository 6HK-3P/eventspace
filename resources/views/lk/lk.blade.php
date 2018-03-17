@extends('layouts.lkhead')
@section('content')
<main class="container admin-main">
	<section class="add-artist">
		<div class="flex start tabs-cont">

				<div id="calendar" class="tabs active"><span>Календарь</span></div>
				<div id="orders" class="tabs"><span>Мои заказы</span></div>
				<div id="info" class="tabs"><span>Информация</span></div>
				<div id="price" class="tabs"><span>Ценообразование</span></div>
				<div id="portfolio" class="tabs"><span>Портфолио</span></div>

		</div>
		@include('lk.filters.calendar')
		@include('lk.filters.zakaz')
		@include('lk.filters.info')
		@include('lk.filters.pricing')
		@include('lk.filters.portfolio')

		<script src="/public/js/add_artist.js"></script>
		<script src="/public/js/calendar.js"></script>
	</section>
</main>
@endsection