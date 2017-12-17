$(document).ready(function(){

	$(".tabsIndex").on("click", function(){
		var id = $(this).attr("id");
		$(this).addClass("active");
		$(".tabsIndex").not("#"+id).removeClass("active");
		$(".tabs-body").not("."+id).fadeOut(0, function(){
			$("."+id).fadeIn();
		});
	})

})