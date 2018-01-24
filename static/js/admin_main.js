$(document).ready(function () {
    $.ajax("/api/getTeasers", {
        type: "POST",
        complete: function (teasersResponse) {
            var container = $("#tizer_container");

            var teasers = JSON.parse(teasersResponse.responseText);

            teasers.forEach(function (e) {
                var tizer = "<div class='tizer' data-id='" + e.id + "' id='tizer_" + e.id + "'><h5>Tizer" + e.id + "</h5><div class='flex'><label>Изображение<br><span>Размер 300 на 300</span></label><input type='file' name='tizer_photo_" + e.id + "' accept='image\\/*,image/jpeg'></div><div class='flex'><label>Позиция</label><div class='tizer-pos'><input type='number' min='1' name='tizer_pos_" + e.id + "' value='" + e.position + "'></div></div><div class='flex'><label>Заголовок</label><input type='text' name='tizer_title_" + e.id + "' value='" + e.title + "'></div><div class='flex'><label>Текст</label><textarea name='tizer_text_" + e.id + "' cols='32' rows='8'>" + e.text + "</textarea></div><a class='submit remove_teaser'>Удалить</a></div>";
                container.append(tizer);
            });

            updateRemovers();

        }
    });

    $.ajax("/api/getSiteInfo", {
        type: "GET",
        complete: function (response) {
            var siteInfo = JSON.parse(response.responseText);
            var inputs = $('form.flex').find('input, textarea').not('input[type="submit"], input[type="file"]');

            inputs[0].value = siteInfo.telephone_number;
            inputs[1].value = siteInfo.vk_link;
            inputs[2].value = siteInfo.whatsapp_link;
            inputs[3].value = siteInfo.instagram_link;
            inputs[4].value = siteInfo.footer_copyright_text;
            inputs[5].value = siteInfo.tech_support_telephone_number;
            inputs[6].value = siteInfo.partners_questions_telephone_number;
        }
    });

   /* $("form.flex").on('submit', function (e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            url: "/api/updateSiteInfo",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            complete: function (data) {
                if (data.responseText === '') {
                    return;
                }
                var response = JSON.parse(data.responseText);
                if (response['errormessage'] !== undefined) {
                    form.find('input[type="file"]').val("");
                    alert(response.errormessage);
                }
            }
        });
    });
я хз что это
*/
    $("#tizer_form").on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData();
        var form = $(this);

        var teasers = $('.tizer');

        teasers.each(function (i, e) {
            var id = $(e).attr('data-id');
            var element = $(e);
            var teaser = {};
            teaser['id'] = id;
            // teaser['tizer_photo'] = element.find('[name="tizer_photo_' + id + '"]')[0].files[0];
            teaser['teaser_pos'] = element.find('[name="tizer_pos_' + id + '"]').val();
            teaser['teaser_title'] = element.find('[name="tizer_title_' + id + '"]').val();
            teaser['teaser_text'] = element.find('[name="tizer_text_' + id + '"]').val();
            formData.append('teaser_' + id, JSON.stringify(teaser));
            var file = element.find('[name="tizer_photo_' + id + '"]')[0].files[0];
            if (file !== undefined) {
                file['id'] = id;
                formData.append('teaser_photo_' + id, file);
            }
        });

        $.ajax({
            url: "/api/updateTeasers",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#err").fadeOut();
            },
            complete: function (data) {
                if (data.responseText === '') {
                    return;
                }
                var response = JSON.parse(data.responseText);
                if (response['errormessage'] !== undefined) {
                    form.find('input[type="file"]').val("");
                    alert(response.errormessage);
                }
            },
            error: function (e) {
                $("#err").html(e).fadeIn();
            }
        });
    });


    $("#new_tizer").on("click", function (e) {
        e.preventDefault();
        var form = $("#tizer_form");
        var container = $("#tizer_container");
        var lastId = 0;

        $('.tizer').each(function(e) {
            lastId = Math.max($(this).attr('data-id'), lastId);
        });
        lastId++;
        var tizer = "<div class='tizer' data-id='" + lastId + "' id='tizer_" + lastId + "' style='display:none'><h5>Tizer" + lastId + "</h5><div class='flex'><label>Изображение<br><span>Размер 300 на 300</span></label><input type='file' name='tizer_photo_" + lastId + "' accept='image\\/*,image/jpeg'></div><div class='flex'><label>Позиция</label><div class='tizer-pos'><input type='number' min='1' name='tizer_pos_" + lastId + "'></div></div><div class='flex'><label>Заголовок</label><input type='text' name='tizer_title_" + lastId + "'></div><div class='flex'><label>Текст</label><textarea name='tizer_text_" + lastId + "' cols='32' rows='8'></textarea></div><a class='submit remove_teaser'>Удалить</a></div>";
        $.when(container.append(tizer)).then(function () {
            $("#tizer_" + lastId).slideDown(400);
            var elem = $("#tizer_" + lastId);
            scrollTo(elem);
        });
        updateRemovers();
        form.attr('data-count-tizer', lastId);
        $("#tizer_form_count").val(lastId);
        return false;
    });

    $('#meneger_phone').bind("change keyup input click", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });

    $(".checkAll").on("click", function () {
        var id = $(this).data("id");
        $(this).parent().find(".unCheckAll").show();
        $(this).hide();
        $("input[type=checkbox]").prop('checked', 'checked');
        checkboxing($("#" + id + " input[type=checkbox]"));
        if (id == "add_type") {
            $(".prices").slideDown(200);
        }
    });

    $(".unCheckAll").on("click", function () {
        var id = $(this).data("id");
        $(this).hide();
        $(this).parent().find(".checkAll").show();
        $("input[type=checkbox]").prop('checked', false);
        checkboxing($("#" + id + " input[type=checkbox]"));
        if (id == "add_type") {
            $(".prices").slideUp(200);
        }
    });

});


function updateRemovers() {
    var buttons = $('.remove_teaser');
    buttons.unbind('click');
    buttons.click(function () {
        $(this).parent().remove();
    });
}