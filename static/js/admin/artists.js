$(document).ready(function () {
    var api = new Api();
    var categories = api.getCategories();
    var categoryBlock = $($('nav.flex div a')[1]);

    categoryBlock.attr("href", "#");

    categories.forEach(function (e) {
        categoryBlock.append('<br><span data-type="' + e.type + '">' + e.name + '</span>');
    });

    categoryBlock.find('span').click(function () {
        $('.artists-list ul, .pagination ul, .artists > .flex h3').empty();

        var selectedCategory = $(this).attr('data-type');
        var workersInfo = api.getWorkers(selectedCategory);
        console.log(workersInfo);

        $('.artists > .flex h3').text('Исполнители - ' + $(this).text());

        if (!workersInfo.length) {
            $('.artists-list ul').empty().append('<h2>Нет данных</h2>');
            return;
        }

        /* Всякое для пагинации */
        var paginationConst = 10;
        var pagination = +(((workersInfo.length - 1) / paginationConst).toString().split('.')[0]) + 1;
        if (pagination > 1) {
            for (var i = 1; i <= pagination; i++) {
                $('.pagination ul').append('<li  ' + (i === 1 ? 'class="selected"' : '') + '>' +
                    '<a href="#">' + i + '</a>' +
                    '</li>'
                );
            }
        }

        for (var i = 0; i < (workersInfo.length > paginationConst ? paginationConst : workersInfo.length); i++) {
            $('.artists-list ul').append(getHtmlDoerItem(workersInfo[i]));
        }

        $('.pagination li').click(function (e) {
            var paginationLevel = +$(this).text();
            if (+$('li.selected').text() === paginationLevel) {
                return;
            }

            $('li.selected').removeClass('selected');
            $(this).addClass('selected');
            paginationLevel--;
            $('.artists-list ul').empty();
            for (var i = paginationLevel * paginationConst; i < paginationLevel * paginationConst + paginationConst; i++) {
                console.log('element: ' + i);
                if (workersInfo[i] === undefined) {
                    return;
                }
                $('.artists-list ul').append(getHtmlDoerItem(workersInfo[i]));
            }
        });

        /* Создание воркеров */
        $(".new_artist").on("click", function(event) {
            event.preventDefault();
            $("#create-new-worker").dialog();
            $("#create-new-worker-form").off("submit").on("submit", function (event) {
                event.preventDefault();

                var login = $("#create-new-worker-form").find(".tel").val();

                var password = $("#create-new-worker-form").find("input[type='password']").val();
                
                if (login && password)  {
                    var response = api.createWorker(login, password, selectedCategory);

                     window.location.href = "/edit/" + response.id; 
                }
              //alert ("login= "+ login + " pas= " +password );
            })
        }).show();

        /* Удаление воркеров */
        $(".artists-list ul li .remove").on("click", function (event) {
           event.preventDefault();
           var clickedWorker = $(this).parent().parent().attr("data-id");
           api.deleteWorker(clickedWorker);
        });


    });
});

/* Шаблон для карточки воркера */
function getHtmlDoerItem(item) {
    return '<li class="flex" data-id="' + item.id + '">' +
        '    <div class="artists-list-img"><img src="' + item.logo + '" alt="' + item.name + '"></div>' +
        '    <div class="artists-list-desc">' +
        '        <h4>' + item.name + ' [' + item.telephone + '] </h4>' +
        '        <p>' + item.about + '</p>' +
        '        <div class="flex artists-list-desc-params">' +
        '            <div class="flex">' +
        '                <span class="artist-rating">' + item.rating + '</span>' +
        '                <span class="artist-comment">' + item.comments_count + '</span>' +
        '            </div>' +
        '            <span class="artist-price">' + item.price + ' &#8381;</span>' +
        '        </div>' +
        '    </div>' +
        '    <div class="artists_edit flex column">' +
        '        <a class="edit" href="/edit/' + item.id + '">Редактировать</a>' +
        '        <br><a class="remove" href="#">✖ <span>Удалить</span></a>' +
        '    </div>' +
        '</li>';
}