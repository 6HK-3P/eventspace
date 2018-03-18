$(document).ready(function () {

    function getPrice(form) {
        var worker_id = $(".itemTitle").data("worker");
        var category = $(".bron").data("category");
        var data = form.serialize();
        var param = $(".hours:checked").val();

        $.ajax({
            url: "/"+category+"/pricing/"+worker_id+"/"+param,
            type: "GET",
            data: data,
            complete: function (data) {
                console.log(data["responseText"]);
                var result = JSON.parse(data["responseText"]);
                if(result){
                    $("#price").html(result["price"] + " ₽");
                    $("#deposit").html(result["deposit"] + " ₽");
                    $(".drum__filter-submit").removeAttr("disabled", "disabled");
                    $(".drum__filter-submit").removeClass("disabled");
                    $(".drum__filter-submit").html("Забронировать");
                    
                }
                else{
                    $("#price").html(0 + " ₽");
                    $("#deposit").html(0 + " ₽");
                    $(".drum__filter-submit").attr("disabled", "disabled");
                    $(".drum__filter-submit").addClass("disabled");
                    $(".drum__filter-submit").html("Недоступно");


                }



            }
        });
    }


    getPrice($(".bron"));


    $(".drum__filter input, .drum__filter select").on("change", function(){

        getPrice($(".bron"));

    })




})