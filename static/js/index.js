var api = new Api();
var workersList = api.getWorkers("");

console.log(workersList);

$(".podbor1").show();

$(".button-search").click(function () {
    $(".podbor").hide();

    $(".search-box").find(".tabs-body").empty();

    var searchString = $(".index-search-input").val().trim();

    var foundWorkers = workersList.filter(function (item) {
        return item.name.toLowerCase().indexOf(searchString.toLowerCase()) === 0;
    });

    if (foundWorkers.length === 0) $(".search-box").find(".tabs-body").append("<h2> По вашему запросу ничего не найдено</h2>");

    foundWorkers.slice(0, 6).forEach(function (item, index) {
        console.log(index);
        $(".search-box").find(".tabs-body").append(setCategoryToHtml(item, $(getWorkerCardTemplate())));
    });

    $(".search-box").show();
});

function getWorkerCardTemplate() {
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

function setCategoryToHtml(data, template) {
    template.attr('data-id', data.id);
    template.find(".item-photo").css("background-image", "url(" + data["logo"] + ")");
    template.find(".rating").text(data["rating"]);
    template.find(".item-price").html(data["price"] + " &#8381;");
    template.find(".feedbacks").text(data["comments_count"]);
    template.find(".item-desc-text p").html("<b>" + data["name"] + "</b></br>" + data["about"]);

    template.find(".item-desc-tags span")[0].innerText = data["city"];

    for (var item in data.tags) {
        var tagItem = '<span class="dot"></span><span>' + data.tags[item] + '</span>';
        template.find(".item-desc-tags").append(tagItem);
    }

    template.click(function () { window.location = '/product/' + $(this).attr('data-id'); });

    return template;
}
