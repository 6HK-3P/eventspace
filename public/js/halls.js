$(document).ready(function () {

    function getPrice(paramType, date, worker_id ,id) {

        $.ajax({
            url: "/pricing/"+paramType+"/"+worker_id+"?data="+date,
            type: "GET",
            complete: function (data) {
                if(data["responseText"].length){
                    var result = JSON.parse(data["responseText"]);

                    if(id == "#second"){
                        $("#secondType").data("coast", result["price"]).data("deposit", result["deposit"]);
                        asd2();
                    }
                    else{
                        $("#firstType").data("coast", result["price"]).data("deposit", result["deposit"]);
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