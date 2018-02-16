<div class="drum__filter-form__item">
    <span>Стоимость</span>
    <div class="drum-form-content">
        <div class="line-container">
            <div class="line"><label><input type="radio" name="cost" data-id ="first"  data-coast ="850">Полное обслуживание <br><i>(средний чек на человека)</i></label></div>
            <div id="first" class="drum-container">
                <div class="drum-form-content asd">
                <span style="width: 100%">
                  Стоимость чека на человека - 850р
                </span>
                    <label style="width:100%">
                        Количество человек <input type="number" id="count-people"   name="count_people_wedding" style="max-width: 60%" >
                    </label>
                </div>
            </div>
        </div>
        <div class="line-container">
            <div class="line"><label><input type="radio" data-id ="second" name="cost" checked="checked" data-coast="18000" >Аренда зала <br> <i>(без обслуживания)</i></label></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*newnewnewnewnew*/
    $(".line input").on("change", function(){
        var id = "#"+$(this).data("id");
        $(".drum-container").not(id).slideUp();
        $(id).slideDown();
        if(id == "#second"){
            var res = $(this).data("coast");
            var zal = Math.round(res/100*10);
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
        var zal = Math.round(res/100*10);
        $("#price").html(res+ " ₽");
        $("#zalog").html(zal+ " ₽");
    }
</script>
