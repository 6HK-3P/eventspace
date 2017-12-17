var api = new Api();
var cities = api.getCities();

$(document).ready(function () {
    api.getWorkerPrices().forEach(function (price, i) {
        $('.price_rules tbody').append(price.getHtml(i + 1, api.getCitiesByIds(price.cities, cities), getDates(price.dates)));
    });

    applyHandlers();

    $("#add_type input[type=checkbox]").on("change", function () {
        slideDown($(this));
    });
});

function slideDown(elem) {
    var className = ".service_" + elem.attr("id");
    if (elem.is(":checked")) {
        $(className).slideDown(200);
    }
    else {
        $(className).slideUp(200);
    }
}

function getDates(dates) {
    if (typeof dates === 'string') {
        return dates;
    } else {
        return api.getMonthsByIds(dates);
    }
}


/* Хэндлеры для различных действий над ценообразованием */
function applyHandlers() {

    /* Срабатывает при сохранении изменений ценообразования */
    $('form[name="price_rules_edit"]').submit(function (e) {
        e.preventDefault();

        var prices = [];

        ($('.price_rules tbody tr')).each(function (i, e) {
            e = $(e);
            var price = {
                id: e.attr('data-id'),
                price_d: e.find('[data-type="price_d"] input').val()
            };

            var attributes = [
                'price_d', 'price_2h', 'price_1h',
                'deposit_d', 'deposit_2h', 'deposit_1h'
            ];

            attributes.forEach(function (attr) {
                price[attr] = e.find('[data-type="' + attr + '"] input').val();
                price[attr] = price[attr] !== undefined ? price[attr] : 0;
            });

            prices.push(price);
        });

        $.ajax("/api/updateWorkerPrices", {
            type: "POST",
            data: "data=" + JSON.stringify(prices),
            complete: function (response) {
                response = JSON.parse(response.responseText);
                if (response['error'] !== null && response['error'] !== undefined) {
                    alert(response.error);
                    return;
                }
            }
        });

        return false;
    });

    /* Срабатывает при удалении ценового правила */
    $('.price_rules input.delete_rule').off("click").click(function (e) {
        e.preventDefault();
        var priceBlock = $(this).parent().parent();
        var id = priceBlock.attr('data-id');

        $.ajax("/api/deletePriceItem", {
            type: "POST",
            data: "id=" + id,
            complete: function (response) {
                var response = JSON.parse(response.responseText);

                if (response['error'] !== null && response['error'] !== undefined) {
                    alert(response.error);
                    return;
                }

                priceBlock.remove();
            }
        });
    });

    /* Срабатывает при создании нового ценообразования */
    $('.filter.col30 > form').submit(function (e) {
        e.preventDefault();

        var newPriceObject = {};

        newPriceObject.cities = [];

        $('#add_city').find('input[type="checkbox"]:checked').each(function (i, e) {
            newPriceObject.cities.push($(e).val());
        });

        newPriceObject.cities = newPriceObject.cities.join(", ");

        newPriceObject.type = $('#add_interval').find('> .flex > .active')[0].id === 'months' ? 'm' : 'd';
        newPriceObject.dates = [];

        if (newPriceObject.type === 'm') {
            $('.months.flex.wrap.titlebody input[type="checkbox"]:checked').each(function (i, e) {
                    newPriceObject.dates.push(e.value);
            });

            newPriceObject.dates = newPriceObject.dates.join(", ");

        } else {
            var dayStart = $('.day_start').val();
            dayStart = new Date(dayStart);
            dayStart = [
                (dayStart.getDate() >= 10 ? dayStart.getDate() : '0' + dayStart.getDate().toString()),
                (dayStart.getMonth() + 1 >= 10 ? dayStart.getMonth() + 1 : '0' + (dayStart.getMonth() + 1).toString()),
                dayStart.getFullYear()
            ].join('.');
            var dayEnd = $('.day_end').val().replace(new RegExp('-', 'g'), '.');
            dayEnd = new Date(dayEnd);
            dayEnd = [
                (dayEnd.getDate() >= 10 ? dayEnd.getDate() : '0' + dayEnd.getDate().toString()),
                (dayEnd.getMonth() + 1 >= 10 ? dayEnd.getMonth() + 1 : '0' + (dayEnd.getMonth() + 1).toString()),
                dayEnd.getFullYear()
            ].join('.');
            newPriceObject.dates = dayStart + '-' + dayEnd;
        }

        newPriceObject.price_d = $('.service_type_3').find('[name="price_type_3"]').val();
        newPriceObject.deposit_d = $('.service_type_3').find('[name="zalog_type_3"]').val();
        newPriceObject.price_2h = $('.service_type_2').find('[name="price_type_2"]').val();
        newPriceObject.deposit_2h = $('.service_type_2').find('[name="zalog_type_2"]').val();
        newPriceObject.price_1h = $('.service_type_1').find('[name="price_type_1"]').val();
        newPriceObject.deposit_1h = $('.service_type_1').find('[name="zalog_type_1"]').val();

        newPriceObject.id = -1;
        newPriceObject.worker = -1;

        var price = new CurrentWorkerPrice(newPriceObject);

        $.ajax("/api/createNewPriceItem", {
            type: "POST",
            data: $.param(price),
            complete: function (response) {
                var response = JSON.parse(response.responseText);
                if (response['error'] !== null && response['error'] !== undefined) {
                    alert(response.error);
                    return;
                }

                if (response['id'] === undefined) return;

                var price = new CurrentWorkerPrice(response);
                var $items = $('.price_rules tbody tr');
                var index = 1;

                if ($($items[$items.length - 1]).find('td').length > 0) {
                    index = +$($items[$items.length - 1]).find('td')[0].innerText;
                }

                $('.price_rules tbody').append(price.getHtml(index + 1, api.getCitiesByIds(price.cities, cities), getDates(price.dates)));
                applyHandlers();
            }
        });
        return false;
    });
}