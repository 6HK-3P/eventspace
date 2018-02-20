$(document).ready(function () {

    function getPrice(paramType, date, worker_id ,id) {
        var category = $(".bron").data("category");
        $.ajax({
            url: "/"+category+"/pricing/"+worker_id+"/"+paramType+"?data="+date,
            type: "GET",
            complete: function (data) {
                if(data["responseText"].length){
                    var result = JSON.parse(data["responseText"]);

                    if(id == "#second"){
                        if(result) {
                            $("#secondType").data("coast", result["price"]).data("deposit", result["deposit"]);

                            $(".drum__filter-submit").removeAttr("disabled", "disabled");
                            $(".drum__filter-submit").removeClass("disabled");
                            $(".drum__filter-submit").html("Забронировать");
                        }
                        else {
                            $("#secondType").data("coast", '0').data("deposit", '0');
                            $(".drum__filter-submit").attr("disabled", "disabled");
                            $(".drum__filter-submit").addClass("disabled");
                            $(".drum__filter-submit").html("Недоступно");
                        }
                        asd2();
                    }
                    else{
                        if(result){
                            $("#firstType").data("coast", result["price"]).data("deposit", result["deposit"]);
                            $("#forman").html(result["price"] + " р.");

                            $(".drum__filter-submit").removeAttr("disabled", "disabled");
                            $(".drum__filter-submit").removeClass("disabled");
                            $(".drum__filter-submit").html("Забронировать");
                        }
                        else {
                            $("#firstType").data("coast", '0').data("deposit", '0');
                            $("#forman").html("0 р.");
                            $(".drum__filter-submit").attr("disabled", "disabled");
                            $(".drum__filter-submit").addClass("disabled");
                            $(".drum__filter-submit").html("Недоступно");
                        }
                        asd();

                    }

                }
                else{
                    asd(0, 0);
                }

            }
        });
    }

    function asd(){
        var res = $("#firstType").data("coast");
        var zal = $("#firstType").data("deposit");
        var price = res * $("#count-people").val() ;
        var deposit = zal *  $("#count-people").val();
        $("#price").html(price+ " ₽");
        $("#deposit").html(deposit+ " ₽");
    }

    function asd2(res, zal){
        var res = $("#secondType").data("coast");
        var zal = $("#secondType").data("deposit");
        $("#price").html(res+ " ₽");
        $("#deposit").html(zal+ " ₽");
    }

    var worker_id = $(".itemTitle").data("worker");
    var paramType = $(".typeHall:checked").val();
    var date = $("#data").val();

    getPrice(paramType, date, worker_id, "#second");


    $(".line input").on("change", function(){

        var id = "#"+$(this).data("id");
        var paramType = $(this).val();
        var date = $("#data").val();

        $(".drum-container").not(id).slideUp();
        $(id).slideDown();

        getPrice(paramType, date, worker_id, id);

    })


    $("#count-people").on("change", function(){
        var worker_id = $(".itemTitle").data("worker");
        var paramType = $(".typeHall:checked").val();
        var date = $("#data").val();
        var id = "#"+$(".line input:checked").data("id");
        getPrice(paramType, date, worker_id, "#first");
    });
    $("#count-people").on("keyup", function(){
        var worker_id = $(".itemTitle").data("worker");
        var paramType = $(".typeHall:checked").val();
        var date = $("#data").val();
        var id = "#"+$(".line input:checked").data("id");
        getPrice(paramType, date, worker_id, "#first");
    });

    $("#data").on("change", function(){
        //$(".bron").addClass("loader");
        var worker_id = $(".itemTitle").data("worker");
        var paramType = $(".typeHall:checked").val();
        var date = $("#data").val();
        var id = "#"+$(".line input:checked").data("id");
        getPrice(paramType, date, worker_id, id);
        //$(".bron").delay(100).removeClass("loader");
    });


})