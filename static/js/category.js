$(document).ready(function () {
    /* Отключаем кеширование */
    $.ajaxSetup({
        cache: false
    });

    /* Создаем экземпляр API */
    var api = new Api();

    var loadNewItemButton = $('.loadNewItem'); //Кнопка загрузки новых товаров

    /* Получаем данные */
    var selectedCategory = $("main").attr("data-category");
    var sortAction = $(this).find("option:selected").val();
    var workers = api.getWorkers(selectedCategory).sort(getSort(sortAction));

    var teasers = api.getTeasers();
    fillDataTable(mergeData(workers, teasers));

    /* Возникает при нажатии на кнопку "Загрузить еще" */
    loadNewItemButton.click(function () {
        addMoreItems(mergeData(workers, teasers))
    });

    /* Возникает при изменении сортировки */
    $(".sort-select").change(function () {
        renderItems(workers, teasers);
    });

    /* Возникает при нажатии на кнопку смены порядка сортировки */
    $(".button-sort").click(function (e) {
        e.preventDefault();
        workers = workers.reverse();
        renderItems(workers, teasers, false);
        this.classList.toggle('flipped');
    });

    /* Возникает при нажатии на кнопку поиска */
    $(".search-form input[type='submit']").click(function (event) {
        var filteredWorkers = [];

        event.preventDefault();

        var value = $(".search-form input[type='text']").val().toLowerCase();

        workers.forEach(function (e) {
            if (e.name.toLowerCase().indexOf(value) !== -1) filteredWorkers.push(e);
        });

        renderItems(filteredWorkers, teasers, false);
    });

    $(".drum__filter-submit").click(function (event) {
        event.preventDefault();

        var requestData = {};
        var city = [];

        if (selectedCategory === "musician" || selectedCategory === "entertainer") {
            var repertoire = [];
            var languages = [];

            $("#primary_repertoire_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) repertoire.push(index + 1);
            });

            $("#primary_language_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) languages.push(index + 1);
            });

            if (repertoire.length !== 0) requestData.repertoire = repertoire.join(",");
            if (languages.length !== 0) requestData.languages = languages.join(",");
        }

        if (selectedCategory === "musician") {
            var duration = $("#order_duration_chooser").find('.checked input').val();
            if (duration !== undefined) if (duration.length !== 0) requestData.duration = duration;
        }

        if (selectedCategory === "mediastudio") {
            var recordingQualities = [];
            var camerasCount = [];
            var optionalEquipment = [];

            $("#recording_quality_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) recordingQualities.push(index + 1);
            });

            $("#camera_count_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) camerasCount.push(index + 1);
            });

            $("#optional_equipment_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) optionalEquipment.push(index + 1);
            });

            if (recordingQualities.length !== 0) requestData.recording_quality = recordingQuality.join(",");
            if (camerasCount.length !== 0) requestData.cameras_count = camerasCount.join(",");
            if (optionalEquipment.length !== 0) requestData.optional_equipment = optionalEquipment.join(",");
        }

        if (selectedCategory === "car") {
            var carBrands = [];
            var carColors = [];
            var carTypes = [];

            $("#car_brand_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) carBrands.push(index + 1);
            });

            $("#car_color_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) carColors.push(index + 1);
            });

            $("#car_type_chooser").find("input").each(function (index) {
                if ($(this).prop("checked")) carTypes.push(index + 1);
            });

            if (carBrands.length !== 0) requestData.car_brand = carBrands.join(",");
            if (carColors.length !== 0) requestData.car_color = carColors.join(",");
            if (carTypes.length !== 0) requestData.car_type = carTypes.join(",");
        }

        if (selectedCategory === "hall") {
            var minCapacity = $("#min_capacity").val();
            if (duration !== undefined) if (duration.length !== 0) requestData.min_capacity = minCapacity;

            var maxCapacity = $("#max_capacity").val();
            if (duration !== undefined) if (duration.length !== 0) requestData.max_capacity = maxCapacity;
        }

        $("#cityChooser").find("input").each(function (index) {
            if ($(this).prop("checked")) city.push(index);
        });

        var date = $("#dateChooser").find("input").val();

        if (city.length !== 0) requestData.city = city.join(",");
        if (date.length !== 0) requestData.date = date;

        requestData.minprice = $("#priceChooser").find("#skip-value-lower")[0].innerText;
        requestData.maxprice = $("#priceChooser").find("#skip-value-upper")[0].innerText;

        $.ajax("/api/getWorkers", {
            type: "POST",
            data: "category=" + selectedCategory + "&" + $.param(requestData),
            complete: function (response) {
                $('.podbor-item').remove();
                workers = JSON.parse(response.responseText);
                fillDataTable(mergeData(workers, teasers));
                loadNewItemButton.unbind("click");
                loadNewItemButton.click(function () {
                    addMoreItems(mergeData(workers, teasers));
                });
            }
        });
    });
});

function renderItems(workers, teasers, needsSorting) {
    if (needsSorting === undefined) needsSorting = true;

    $('.podbor-item').remove(); // Сбрасываем рендер

    if (needsSorting) {
        $(".button-sort")[0].classList.remove('flipped'); //Сбрасываем инверсию
        var action = $(this).find("option:selected").val(); // Узнаем сортировку
        workers = workers.sort(getSort(action)); //Сортируем
    }

    fillDataTable(mergeData(workers, teasers)); //Выводим в рендер
}

function getSort(name) {
    return function (a, b) {
        var result = 0;

        if (a[name] > b[name]) result = 1;
        else result = -1;

        if (typeof a[name] === "number") {
            result = -result;
        }

        return result;
    };
}


function fillDataTable(payload) {
    var workersCount = 0;
    payload.forEach(function (e) { if (e.type === 'workers') workersCount++; });
    $(".drum__filter-result").text(workersCount + " соответствуют фильтрам");

    payload.forEach(function (e, i) {
        if (i >= 7) {
            $('.loadNewItem').show();
            return;
        } else $('.loadNewItem').hide();

        var elem;
        if (e.type === 'workers') {
            elem = $(getCategoryTemplate());
            setCategoryToHtml(e.item, elem);
        } else {
            elem = $(getTeaserTemplate());
            setTeaserToHtml(e.item, elem);
        }

        if (i < 4) {
            $('.flex.wrap.pr').append(elem);
        } else {
            $('.loadNewItem').parent().append(elem);
            $('.loadNewItem').parent().append($('.loadNewItem'));
        }
    });
}

function addMoreItems(payload) {
    var length = $('.podbor-item').length - 1;

    payload.forEach(function (e, i) {
        if (i <= length || i >= length + 12) {
            return;
        }

        var elem = '';

        if (e.type === 'workers') {
            elem = $(getCategoryTemplate());
            setCategoryToHtml(e.item, elem);
        } else {
            elem = $(getTeaserTemplate());
            setTeaserToHtml(e.item, elem);
        }

        $('.loadNewItem').parent().append(elem);
        $('.loadNewItem').parent().append($('.loadNewItem'));

        if (i === payload.length - 1) {
            $('.loadNewItem').hide();
        }
    });
}

function getCategoryTemplate() {
    return '<div class="podbor-item">' +
        '<article class="item-cart">' +
        '<div class="item-photo"></div>' +
        '<div class="item-desc">' +
        '<div class="item-desc-params flex">' +
        '<div class="flex item-desc-params-left">' +
        '<span class="rating"></span>' +
        '<span class="feedbacks"></span>' +
        '</div>' +
        '<div>' +
        '<span class="item-price"></span>' +
        '</div>' +
        '</div>' +
        '<div class="item-desc-text">' +
        '<p></p>' +
        '</div>' +
        '<div class="item-desc-tags">' +
        '<span></span>' +
        '</div>' +
        '</div>' +
        '</article>' +
        '</div>'
}

function getTeaserTemplate() {
    return '<div class="podbor-item">' +
        '<article class="tizers">' +
        '<div class="item-photo"></div>' +
        '<p class="item-name"></p>' +
        '<p class="item-text"></p>' +
        '</article>' +
        '</div>';
}


function setCategoryToHtml(category, $html) {
    $html.attr('data-id', category.id);
    $html.find(".item-photo").css("background-image", "url(" + category["logo"] + ")");
    $html.find(".rating").text(category["rating"]);
    $html.find(".item-price").html(category["price"] + " &#8381;");
    $html.find(".feedbacks").text(category["comments_count"]);
    $html.find(".item-desc-text p").html("<b>" + category["name"] + "</b></br>" + category["about"]);

    $html.find(".item-desc-tags span")[0].innerText = category["city"];

    for (var item in category.tags) {
        var tagItem = '<span class="dot"></span><span>' + category.tags[item] + '</span>';
        $html.find(".item-desc-tags").append(tagItem);
    }


    $html.click(function () { window.location = '/product/' + $(this).attr('data-id'); });
}

function setTeaserToHtml(teaser, $html) {
    $html.find(".item-photo").css("background-image", "url(" + teaser["logo"] + ")");
    $html.find(".item-name").text(teaser["title"]);
    $html.find(".item-text").text(teaser["text"]);
}

function add(element, type) {
    return {item: element, type: type};
}

function mergeData(workers, teasers) {
    var data = [];

    workers.forEach(function (e) {
        data.push(add(e, 'workers'));
    });

    teasers.forEach(function (e) {
        data.splice(+e.position + 1, 0, add(e, 'teasers'));
    });

    return data;
}

