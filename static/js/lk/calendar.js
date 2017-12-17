$(document).ready(function () {
    var api = new Api();

    var bannedDates = api.getBannedDates();
    var eventDates = [];

    bannedDates.forEach(function (e) {
        var splitedDate = e.date.split('.');
        var date = new Date();
        date.setDate(splitedDate[0]);
        date.setMonth(splitedDate[1] - 1);
        date.setFullYear(splitedDate[2]);
        eventDates.push(date);
    });

    $('.datepicker-here').datepicker({
        inline: true,
        minDate: new Date(),
        language: 'ru',
        onSelect: function (dateText, date) {
            var isFound = false;
            for (var index in eventDates) {
                var element = eventDates[index];
                if (equalDate(date, element)) {
                    eventDates.splice(index, 1);
                    isFound = true;
                }
            }

            if (!isFound) eventDates.push(date);


            $.ajax("/api/updateBannedDate", {
                type: "POST",
                data: "date=" + dateText,
                async: false,
                complete: function (response) {
                    var response = JSON.parse(response.responseText);
                    if (response['error'] !== null && response['error'] !== undefined) {
                        alert(response.error);
                        return;
                    }

                }
            });
        },

        onRenderCell: function (date, cellType) {
            if (cellType !== 'day') return;

            for (var index in eventDates) {
                var element = eventDates[index];
                if (equalDate(date, element)) {
                    return {
                        html: '<span class="busy-day-datepic">' + element.getDate() + '</span>'
                    }
                }
            }
        }
    });

    function equalDate(first, second) {
        return first.getDate() === second.getDate() &&
            first.getMonth() === second.getMonth() &&
            first.getYear() === second.getYear();
    }
});
