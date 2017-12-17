$(".tabs").on("click", function () {
    var id = $(this).attr("id");
    $(this).addClass("active");
    $(".tabs").not("#" + id).removeClass("active");
    $(".tabs-body").not("." + id).fadeOut(0, function () {
        $("." + id).fadeIn();
    });
    $("input, textarea").on("change", function () {
        $(this).removeClass("error");
    })
});


$(".titles").on("click", function () {
    var id = "." + $(this).attr("id");
    console.log(id);
    $(".titlebody").hide();
    $(".titles").removeClass("active");
    $(this).addClass("active");
    $(id).fadeIn();
    $(id + " input[type=checkbox]").removeAttr("checked");
    $("#add_interval .ree").slideUp();
    $(".day_end, .day_start").removeClass("error");
});
