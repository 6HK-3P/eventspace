<section class="calendar tabs-body flex"  @if(\Illuminate\Support\Facades\Auth::user()->root != 3) style="display: block;" @else style="display: none;"  @endif>
    <h4>Календарь занятости</h4>
    <div id="calendarWrap">
        <h5>Выберите дни, в которые Вы заняты</h5>
        <div class="datepicker-here"></div>
        <p class="calendar-desc flex start"><span class="busy-day"></span> <span>Дата забронирована. На эту дату пользователи не могут заказать Ваши услуги.</span></p>
    </div>
    <button id="saveCalendar">Сохранить</button>
</section>
<script src="/public/js/calendar.js"></script>