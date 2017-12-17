function scrollTo(elem){
	elem ?
	$('body').animate({ scrollTop: $(elem).offset().top}, 1100) :	false;
   return false;
}

$(document).ready(function() {
    $(".tabsIndex").on("click", function () {
        var id = $(this).attr("id");
        $(this).addClass("active");
        $(".tabsIndex").not("#" + id).removeClass("active");
        $(".tabs-body").not("." + id).fadeOut(0, function () {
            $("." + id).fadeIn();
        });
    });

    $('.drum__filter input[type=radio], .drum__filter input[type=checkbox]').styler();
});



	
