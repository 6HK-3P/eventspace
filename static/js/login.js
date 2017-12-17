$(document).ready(function () {
    $(".main-header-top-lk a").on("click", function (e) {
        if ($(this).attr("href") == "#") {
            e.preventDefault();
            if (!($(".login").is(':visible'))) {
                $(this).parent("div").addClass("sel");
                $(".login").slideDown();
            }
            else {
                $(".login").hide();
                $(this).parent("div").removeClass("sel");
            }
            return false;
        }
    });

    $(".tabsL span").on("click", function (e) {
        var id = "#" + $(this).data("tab");
        $(".login form:not(" + id + ")").css("display", "none");
        $(id).css("display", "block");
        $(".tabsL span").removeClass("active");
        $(this).addClass("active");
        return false;
    });

    $(".log").on("click", function (e) {
        $(".tabsL span:first-child").click();
        return false;
    });

    $(".reg").on("click", function (e) {
        $(".tabsL span:last-child").click();
        return false;
    });
    $(".tel").inputmask("+7 999 999-99-99");


    $('.logout').unbind('click').click(function (e) {
        $.ajax("/api/userLogout", {
            type: "POST",
            complete: function (response) {
                response = JSON.parse(response.responseText);
                if (response['error'] !== null && response['error'] !== undefined) {
                    alert(response.error);
                    return;
                }
                window.location = '/';
            }
        });
    });

    var $form = $('#loginForm');

    $form.submit(function (e) {
        e.preventDefault();

        var $form = $(this);

        var login = $form.find('input.tel').val();
        var password = $form.find('input[type="password"]').val();
        var data = "login=" + login + "&password=" + password;
        console.log(data);

        $.ajax("/api/userAuth", {
            type: "POST",
            data: data,
            complete: function (response) {
                var response = JSON.parse(response.responseText);
                if (response['error'] !== null && response['error'] !== undefined) {
                    $(".notfound").fadeIn();
                    return;
                }
                var isAuth = response['auth'] === "true";

                if (isAuth) {
                    if (response['user_group'] === 'admin') {
                        window.location.pathname = '/admin';
                    } else {
                        window.location.pathname = '/lk';
                    }
                }
            }
        });

        return false;
    });

    $('#regForm').submit(function (e) {
        var $form = $(this);
        var login = $form.find('input.tel').val();
        var data = "login=" + login;

        $.ajax("/api/createNewUser", {
            type: "POST",
            data: data,
            complete: function (response) {
                var resp = JSON.parse(response.responseText);
                console.log(resp);
            }
        });
        return false;
    });
});