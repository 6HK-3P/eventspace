$(document).ready(function () {
    var api = new Api();
    var $ordersPlaceholder = $('.main-orders');
    var ordersCount = api.getOrdersCount();
    var paginationOffset = 5;
    var pagination = +(((ordersCount - 1) / paginationOffset).toString().split('.')[0]) + 1;
    console.log(pagination);
    if (pagination > 1) {
        for (var i = 1; i <= pagination; i++) {
            $('.pagination ul').append('<li  ' + (i === 1 ? 'class="selected"' : '') + '>' +
                '<a href="#">' + i + '</a>' +
                '</li>'
            );
        }
    }

    renderOrders($ordersPlaceholder, api.getOrders());

    $('.pagination li').click(function (e) {
        e.preventDefault();
        var $pagination = $(this);
        var paginationLevel = +$pagination.text();
        var $selectedLi = $('li.selected');
        if (+$selectedLi.text() === paginationLevel) return;
        $selectedLi.removeClass('selected');
        $pagination.addClass('selected');
        console.log('level:' + paginationLevel);
        paginationLevel--;
        renderOrders($ordersPlaceholder, api.getOrders(paginationOffset * paginationLevel));
    });
});

function renderOrders($wrapper, items) {
    $wrapper.find('.order-table-body').remove();
    items.forEach(function (e) {
        var item = getHtmlTemplate(e);
        $wrapper.append(item);
    });
}

function getHtmlTemplate(e) {
    return '<div class="order-table-body flex">' +
        '<div class="order-table-col1">' +
        '<h4>' + e.worker + '</h4>' +
        '<p class="order-table-col1-params">' +
        '<b>' +
        '<span class="order-table-col1-params-date">' + e.date + '</span>' +
        '<span class="order-table-col1-params-city">' + e.city + '</span>' +
        '<span class="order-table-col1-params-price1">' + e.cost + '</span>' +
        '<span class="order-table-col1-params-price2">' + e.deposit + '</span>' +
        '</b>' +
        '</p>' +
        '<p><b>Комментарий к заказу</b></p>' +
        '<p>' + e.commentary +  '</p>' +
        '<p><b>Контакты исполнителя для связи</b></p>' +
        '<p>' + e.manager_telephone + ' - ' + e.manager + '</p>' +
        '</div>' +
        '<div class="order-table-col2"><p class="order-table-name"><span>' + e.user + '</span></p>' +
        '<p>' + e.user_telephone + '</p></div>' +
        '<div class="order-table-col3"><span href="#" class="stages-stage1" style="color: ' + e.colorcode + '">' + e.status + '</span></div>' +
        '<div class="order-table-col4"><a href="" class="edit">Разрешить оплату</a></div>' +
        '</div>'
}

