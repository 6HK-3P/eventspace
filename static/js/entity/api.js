function Api() {
    if (document.api === undefined) {
        document.api = {};
    }
}

function CurrentWorkerPrice(object) {
    for (var property in object) if (object.hasOwnProperty(property)) this[property] = object[property];
}

CurrentWorkerPrice.prototype.getHtml = function (index, cities, dates) {
    var htmlTemplate = '<tr data-id="' + this.id + '">' +
        '<td>' + index + '</td>' +
        '<td>' + 'По ' + ((this.type === 'm') ? 'месяцам' : 'дням') + '</td>' +
        '<td>' + cities + '</td>' +
        '<td>' + dates + '</td>' +
        '<td>';

    var priceFields = [
        {name: "price_d", description: "День / Вечер"},
        {name: "price_2h", description: "2 часа"},
        {name: "price_1h", description: "1 час"}
    ];

    var depositFields = [
        {name: "deposit_d", description: "День / Вечер"},
        {name: "deposit_2h", description: "2 часа"},
        {name: "deposit_1h", description: "1 час"}
    ];

    for (var item in priceFields) appendPriceItem(priceFields[item], this);
    htmlTemplate += '</td><td>';
    for (var item in depositFields) appendPriceItem(depositFields[item], this);


    function appendPriceItem(meta, item) {
        if (item[meta.name] != 0 && item[meta.name] !== null) {
            htmlTemplate += '<div class="flex" data-type="' + meta.name + '">' +
                '<label>' + meta.description + '</label>' +
                '<input type="text" class="table_price" value="' + item[meta.name] + '" style="text-align: right;">' +
                '</div>'
        }
    }

    htmlTemplate += '</td>' + '<td><input type="submit" value="" class="delete_rule"></td></tr>';

    return htmlTemplate;
};

Api.prototype.get = function (key) {
    return document.api[key];
};

Api.prototype.set = function (key, value) {
    return document.api[key] = value;
};

Api.prototype.getAccountInfo = function () {
    return sendPOST('/api/getWorkerInfo');
};

Api.prototype.getBannedDates = function () {
    return sendPOST('/api/getBannedDates');
};

Api.prototype.updateWorkerInfo = function (data) {
    return sendPOST('/api/updateWorkerInfo', data)
}

Api.prototype.getWorkerPrices = function () {
    var prices = [];
    var priceItems = sendPOST('/api/getWorkerPrices');

    priceItems.forEach(function (e) {
        prices.push(new CurrentWorkerPrice(e));
    });

    return prices;
};

Api.prototype.createWorker = function (login, password, category) {
    var submitData = {
        login: login,
        password: password,
        category: category
    };

     return sendPOST('/api/createWorker', $.param(submitData));
};


Api.prototype.deleteWorker = function (id) {
    sendPOST('/api/deleteWorker', "worker_id=" + id);
    window.location.reload();
};

Api.prototype.getCitiesByIds = function(ids, cities) {
    ids = ids.map(function (e) {
        return +e;
    });
    cities = cities.map(function (e) {
        e.id = +e.id;
        return e;
    });
    var needly = [];
    cities.forEach(function (e) {
        if (ids.indexOf(e.id) !== -1) {
            needly.push(e.name);
        }
    });
    return needly.join(', ');
};


Api.prototype.getMonthsByIds = function (ids) {
    ids = ids.map(function (e) {
        return +e;
    });

    var monthes = ['Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    ].map(function (e, i) {
        return {id: (i + 1), name: e};
    });

    var needly = [];
    monthes.forEach(function (e) {
        if (ids.indexOf(e.id) !== -1) {
            needly.push(e.name);
        }
    });
    return needly.join(', ');
};

Api.prototype.getCities = function () {
    return sendPOST('/api/getCities');
};

Api.prototype.getTeasers = function () {
    return sendPOST('/api/getTeasers');
};

Api.prototype.getWorkerContent = function () {
    return sendPOST('/api/getWorkerContent');
};

Api.prototype.getCategories = function () {
    return [
        {name: 'Автомобили', type: 'car'},
        {name: 'Видеооператоры', type: 'mediastudio'},
        {name: 'Ведущие', type: 'entertainer'},
        {name: 'Музыканты', type: 'musician'},
        {name: 'Фотографы', type: 'photographer'},
        {name: 'Залы', type: 'hall'}
    ];
};

Api.prototype.getWorkers = function (category) {
    return sendPOST('/api/getWorkers', 'category=' + category);
};

Api.prototype.getComments = function (offset) {
    if (offset === undefined) offset = 0;
    return sendPOST('/api/getComments', 'offset=' + offset);
};

Api.prototype.getCommentsCount = function () {
    return sendPOST('/api/getCommentsCount')['comments_count'];
};

Api.prototype.getOrders = function (offset) {
    if (offset === undefined) offset = 0;
    return sendPOST('/api/getOrders', 'offset=' + offset);
};

Api.prototype.getOrdersCount = function () {
    return sendPOST('/api/getOrdersCount')['orders_count'];
};

function sendPOST(url, data) {
    var responseData = [];

    $.ajax(url, {
        type: 'POST',
        data: data,
        async: false,
        complete: function (response) {
            responseData = JSON.parse(response.responseText);
        }
    });

    return responseData;
}