$(document).ready(function () {
    var api = new Api();
    var $ordersPlaceholder = $('.main-orders');
    var commentsCount = api.getCommentsCount();
    console.log(commentsCount);

    var paginationOffset = 5;
    var pagination = +(((commentsCount - 1) / paginationOffset).toString().split('.')[0]) + 1;
    console.log(pagination);
    if (pagination > 1) {
        for (var i = 1; i <= pagination; i++) {
            $('.pagination ul').append('<li  ' + (i === 1 ? 'class="selected"' : '') + '>' +
                '<a href="#">' + i + '</a>' +
                '</li>'
            );
        }
    }

    renderComments($ordersPlaceholder, api.getComments());
    setHandlers($ordersPlaceholder.find('.order-table-body'));

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
        renderComments($ordersPlaceholder, api.getComments(paginationOffset * paginationLevel));
    });
});

function setHandlers($items, itemsCallback) {
    $items.each(function (i, e) {
        var $item = $(e);
        console.log($item);
        var $buttons = $item.find('.edit');
        var id = $item.attr('data-id');

        $($buttons[0]).click(function (e) {
            e.preventDefault();
            console.log('edit: ' + id);
        });

        $($buttons[1]).click(function (e) {
            e.preventDefault();
            $.ajax('/api/deleteComment', {
                type: 'POST',
                data: 'id=' + id,
                complete: function (response) {
                    console.log(response.responseText);
                }
            });
            $item.remove();
        });
    });
}

function renderComments($wrapper, items) {
    $wrapper.find('.order-table-body').remove();
    items.forEach(function (e) {
        var item = getHtmlComment(e);
        $wrapper.append(item);
    });
}

function getHtmlComment(e) {
    return '<div class="order-table-body flex" data-id="' + e.id + '">' +
        '<div class="feed-table-col1 feedback">' +
        '<h4>' + e.workername + '</h4>' +
        '<p class="order-table-col1-params"><b>' +
        '<span>' + e.orderdate + '</span>' +
        '<span>' + e.city + '</span>' +
        '<span>Весь вечер</span>' +
        '<span>' + e.deposit + ' р.</span>' +
        '<span>' + e.price + ' р.</span></b></p>' +
        '<p><b>Текст отзыва</b></p>' +
        '<p>' + e.message + '</p>' +
        '</div>' +
        '<div class="feed-table-col2"><p class="order-table-name">' +
        '<span>' + e.username + '</span>' +
        '</p><p>' + e.usertelephone + '</p></div>' +
        '<div class="feed-table-col3">' +
        '<p class="order-table-name">' + e.commentdate + '</p></div>' +
        '<div class="feed-table-col4 feed"><a href="#" class="feed-' + translateRating(e.rating) + '"></a></div>' +
        '<div class="feed-table-col5">' +
        '<a href="#" class="edit">Редактировать</a><br>' +
        '<a href="#" class="edit rem">Удалить</a>' +
        '</div>' +
        '</div>';
}

function translateRating(rating) {
    return [
        'one',
        'two',
        'three',
        'four',
        'five'
    ][rating - 1];
}