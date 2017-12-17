var api = new Api();
var accountData = api.getAccountInfo();

$(document).ready(function () {
    console.log(accountData);

    $(":checkbox").on("change", function () {
        checkboxing($(this));
    });

    /* Заполняем основную информацию */
    $(".add-artist-info .add_title").val(accountData.name);
    $(".add-artist-info .add_description").val(accountData.about);
    $("#comment_artist").find("textarea").val(accountData.manager_commentary);
    $("select[name='basic_city']").val(accountData.city).change();
    $("select[name='filter_admin_artist']").val(accountData.manager).change();

    /* Заполняем дополнительную инфу в соотвествии с категориями */
    if (accountData.category === "musician" || accountData.category === "entertainer") fillAdditionalInfo_Musician(accountData);
    if (accountData.category === "car") fillAdditionalInfo_Car(accountData);
    if (accountData.category === "mediastudio") fillAdditionalInfo_Mediastudio(accountData);
    if (accountData.category === "hall") fillAdditionalInfo_Hall(accountData);

    fillContacts(accountData);

    /* Костыль для чекбоксов*/
    $(':checkbox').change();

    applyInfoHandlers();
});

/* Хэндлеры для действий */
function applyInfoHandlers() {
    $('.add-artist-info.col70 button.submit').click(function (e) {
        e.preventDefault();

        var passwordBlock = $('.add-artist-info.col70');
        var passwordData = {"old_password": "", "new_password": ""};
        for (var key in passwordData) passwordData[key] = passwordBlock.find("input[name='" + key + "']").val();

        if (oldPassword.length === 0 || newPassword.length === 0) return;

        var ajaxRequest = api.sendPOST("/api/changePassword", $.param(passwordData));
        if (ajaxRequest['error'] !== null && ajaxRequest['error'] !== undefined) alert(ajaxRequest.error);
    });

    $('form.options').on("submit", function (event) {
        event.preventDefault();
        updateWorkerData();
    })
}

function fillAdditionalInfo_Musician(accountData) {
    $("#filter_main_type_artist_" + accountData.additionalInfo.primary_repertoire).prop("checked", true);
    $("#main_lang_" + accountData.additionalInfo.primary_language).prop("checked", true);

    accountData.additionalInfo.languages.split(", ").forEach(function (language) {
        $("#lang_" + language).prop("checked", true);
    });

    accountData.additionalInfo.repertoires.split(", ").forEach(function (repertoire) {
        $("#repertoires_" + repertoire).prop("checked", true);
    });
}

function fillAdditionalInfo_Car(accountData) {
    $("select[name='car_brand']").val(accountData.additionalInfo.car_brand).change();
    $("select[name='car_color']").val(accountData.additionalInfo.car_color).change();
    $("select[name='car_type']").val(accountData.additionalInfo.car_type).change();
}

function fillAdditionalInfo_Mediastudio(accountData) {
    $("#recording_quality_" + accountData.additionalInfo.recording_quality).prop("checked", true);
    $("#cameras_count_" + accountData.additionalInfo.cameras_count).prop("checked", true);

    accountData.additionalInfo.optional_equipment.split(", ").forEach(function (item) {
        $("#optional_equipment_" + item).prop("checked", true);
    });
}

function fillAdditionalInfo_Hall(accountData) {
    $("#hall_capacity").val(accountData.additionalInfo.capacity);
}

function checkboxing(target) {
    if (target.is(":checked")) target.siblings("label").addClass("check");
    else target.siblings("label").removeClass("check");
}

function fillContacts(accountData) {
    var contactsBlock = $('#contacts_peoples');

    if (accountData.contacts.length === 0) contactsBlock.append(getEmptyBlock());

    accountData.contacts.forEach(function (e) {
        contactsBlock.append(
            '<div class="contact_people" data-id="' + e.id + '"><h4>Номер телефона для заказа</h4><div><span>Имя</span>' +
            '<input type="text" name="contact-name1" value="' + e.name + '" maxlength="20" class="contact-name">' +
            '</div><div><span>Телефон</span>' +
            '<input type="text" name="contact-tel1" value="' + e.telephone + '"  class="contact-tel telephone" placeholder="+7 988-888-22-22">' +
            '</div><div><a href="#" class="add_new_contact" data-count=1>Добавить дополнительный контакт</a></div></div>'
        );
    });

    addContact();
}

function addContact() {
    $(".contact-tel").inputmask("+7 999-999-99-99");
    $('.add_new_contact').unbind('click').on("click", function (event) {
        event.preventDefault();
        $('#contacts_peoples').append(getEmptyBlock());
        addContact();
    });
}

function getEmptyBlock() {
    return '<div class="contact_people"><h4>Номер телефона для заказа</h4><div><span>Имя</span>' +
        '<input type="text" name="contact-name1" value="" maxlength="20" class="contact-name">' +
        '</div><div><span>Телефон</span>' +
        '<input type="text" name="contact-tel1" value=""  class="contact-tel telephone" placeholder="+7 988-888-22-22">' +
        '</div><div><a href="#" class="add_new_contact" data-count=1>Добавить дополнительный контакт</a></div></div>';
}

function updateWorkerData() {
    var payload = {};

    payload.name = $(".add_title").val();
    payload.about = $(".add_description").val();
    payload.city = $("select[name='basic_city']").val();
    payload.manager_commentary = $("#comment_artist").find("textarea").val();
    payload.manager = $("select[name='filter_admin_artist']").val();
    payload.additionalInfo = {};

    if (accountData.category === "mediastudio") {
        var optionalEquipment = [];

        $('input[name=optional_equipment]:checked').each(function () {
            optionalEquipment.push($(this).val());
        });

        payload.additionalInfo.cameras_count = $('input[name=cameras_count]:checked').val();
        payload.additionalInfo.recording_quality = $('input[name=recording_quality]:checked').val();
        payload.additionalInfo.optional_equipment = optionalEquipment.join(", ");
    }

    if (accountData.category === "musician" || accountData === "entertainer") {
        var languages = [];
        var repertoires = [];

        $('input[name=repertoires]:checked').each(function () {
            repertoires.push($(this).val());
        });

        $('input[name=languages]:checked').each(function () {
            languages.push($(this).val());
        });

        payload.additionalInfo.primary_repertoire = $('input[name=filter_main_type_artist]:checked').val();
        payload.additionalInfo.primary_language = $('input[name=main_lang]:checked').val();
        payload.additionalInfo.languages = languages.join(", ");
        payload.additionalInfo.repertoires = repertoires.join(", ");
    }

    if (accountData.category === "car") {
        payload.additionalInfo.car_brand = $("select[name='car_brand']").val();
        payload.additionalInfo.car_color = $("select[name='car_color']").val();
        payload.additionalInfo.car_type = $("select[name='car_type']").val();
    }

    if (accountData.category === "hall") payload.additionalInfo.capacity = $("#hall_capacity").val();

    payload.contacts = {};

    $('#contacts_peoples').find('.contact_people').each(function (i) {
        payload.contacts[i] = {
            id: $(this).attr('data-id'),
            name: $(this).find('.contact-name').val(),
            telephone: $(this).find('.contact-tel').val()
        };
    });

    payload.contacts = JSON.stringify(payload.contacts);
    payload.additionalInfo = JSON.stringify(payload.additionalInfo);
    var ajaxResponse = api.updateWorkerInfo($.param(payload));
    console.log(ajaxResponse);
}