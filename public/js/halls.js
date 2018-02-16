$(document).ready(function () {

    var id = $(".itemTitle").data("worker");

    var paramType = $(".typeHall:checked").val();
    var date = $("#data").val();
    alert("/pricing/"+paramType+"/"+id+"?data="+date);
    $.ajax({
        url: "/pricing/"+paramType+"/"+id+"?data="+date,
        type: "GET",
        complete: function (data) {
            var result = JSON.parse(data["responseText"]);
            $("#secondType").data("coast", result["price"]).data("deposit", result["deposit"]);
            $(".line input").change();
        }
    });

    $(".line input").on("change", function(){
        var id = "#"+$(this).data("id");
        $(".drum-container").not(id).slideUp();
        $(id).slideDown();
        if(id == "#second"){
            var res = $(this).data("coast");
            var zal = $(this).data("deposit");
            $("#price").html(res+ " ₽");
            $("#zalog").html(zal+ " ₽");
        }
        else{
            $("#count-people").change();
        }
    })

    $("#count-people").on("change", function(){
        asd()
    });
    $("#count-people").on("keyup", function(){
        asd()
    });
    function asd(){
        var res = $(".line input:checked").data("coast") * $("#count-people").val() ;
        var zal = $(this).data("deposit") * $("#count-people").val();
        $("#price").html(res+ " ₽");
        $("#zalog").html(zal+ " ₽");
    }
})