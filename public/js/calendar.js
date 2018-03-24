var idArray = location.href.split("/");
var id = idArray[idArray.length-1];
var eventDates = []; ///Тут надо принимать массив занятых дней
var newBusyDates = [];
var now = new Date();
var month = now.getMonth()+1;
var year  = now.getFullYear();

var datepicker = null;
window.addEventListener("load", function() {
    $.when($.when(
        $.ajax({
            url: "/admin/workers/getBusyDates/"+id,
            data: {"month":month, "year":year}
        }).done(function(data) {
            eventDates = JSON.parse(data);
            console.log(eventDates);
        })

    ).then(function() {

         datepicker = $('.datepicker-here').datepicker({
            inline: false,
            minDate: new Date(),
            multipleDates: true,
            language: 'ru',
            onSelect: function (dateText) {
                var array_dates = dateText.split(",");
                newBusyDates = array_dates;
            },
            onChangeMonth: function(){
                console.log(newBusyDates);
                save();


            }
        });


    })).then(function() {

        for(var i = eventDates.length-1; i >= 0; i-- ){
            var date = eventDates[i].split(".");
            datepicker.data('datepicker').selectDate(new Date(date[2], (date[1]-1), date[0]))
        }
    })

$("#saveCalendar").on("click",function () {
    save();
})

function save() {

    if(newBusyDates.length > 0){
        $.ajax({
            url: "/admin/workers/addBusyDate/"+id,
            data: {"dates":JSON.stringify(newBusyDates)}
        }).done(function(data) {
            if(data.length > 0){
                eventDates = JSON.parse(data);
            }
        })
    }
}

})
