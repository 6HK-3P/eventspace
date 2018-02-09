window.addEventListener("load", function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var arrayTabs = location.href.split("tab=");
    if(arrayTabs.length>1){
     var id = arrayTabs[arrayTabs.length-1];
    	if (id == 3){
            $("#portfolio").click();
		}


	}


    

    $('.instruction1').on("click", function(){
	  $(this).hide();
	  $('.instruction2').show();
	  $(".desc_interval").fadeIn();
	})

	$('.instruction2').on("click", function(){ 
	  $(this).hide();
	  $('.instruction1').show();
	  $(".desc_interval").fadeOut();
	})

	$("#filter_shortlink_artist, #password, #password_copy").on("keypress",function(event){
		if(!((event.charCode >= 49 && event.charCode <= 58) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))){
			return false;
		}
	})

	$(".contact-name").on("keypress",function(event){
			if(!((event.charCode == 32) || (event.charCode >= 1040 && event.charCode <= 1105) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))){
				return false;
			}
	})

	$(".contact-tel").inputmask("+7 999-999-99-99");
	$(".table_price").inputmask("integer", {min: 0, max: 150000, groupSeparator: "-", groupSize: 3, allowMinus: false, allowPlus: false});

	$(".add_new_contact").on("click",function(){
		var c = $(this).data("count"); c++;
		if (c<3) {
			var contact = '<div class="contact_people"><h4>Номер телефона для заказа</h4><div><span>Имя</span><input type="text" maxlength="20" class="contact-name" name="contact-name'+c+'"></div><div><span>Телефон</span><input type="text" type="text" name="contact-tel'+c+'" class = "contact-tel" placeholder="+7 988-888-22-22"></div></div>';
			$("#contacts_peoples").prepend(contact);
			$(this).data("count", c)
			$(".contact-tel").inputmask("+7 999-999-99-99");
		}
		return false;
	})


	$(".options .submit[type=submit]").on("click", function(e){
		e.preventDefault();
		var error = new Object();
		error.type_sing= [isCheck("type_sing"), ""];
		error.lang = [isCheck("lang"), ""];
		error.title = [isEmpty("add_title") , ".add_title"];
		error.description = [isEmpty("add_description"), ".add_description"];
		error.login = [isFull("contact-tel",16), "input[name='login']"];
		error.contactName = [isEmpty("contact-name"),"input[name='contact-name1']" ];
		error.contactTel = [isFull("telephone",16), "input[name='contact-tel1']"]; 
		console.log(error);
		error.count = 0;
			for (var prop in error) {
				if (prop != "count" ) {
					if (error[prop][0]) {
						$(error[prop][1]).addClass("error");
						error.count++;
					}
				}
			}
			if(error.type_sing[0]){
				$(".profile_options_item:nth-child(2) .ree").show();
			}
			if(error.lang[0]){
				$(".profile_options_item:nth-child(3) .ree").show();
			}
			if (!error.count) {
                $(".options").submit();
            }
			else{
				return false;
			}


	})


/*Отправка ценового правила блять в базу */
$(".add_price_rule.cat4 input[type=submit]").on("click", function(e){
		e.preventDefault();
    $(".price_rules_body").html();
    $("#updatePrice").addClass("loader");
		var idArray = location.href.split("/");
		var id = idArray[idArray.length-1];
		var error = new Object();
		error.cities= [isCheck("city"), ""];
		error.months = [isCheck("month"), ""];
		error.types = [isCheck("types"), ""];
		error.dayStart = [isEmpty("day_start"), ".day_start"];
		error.dayEnd = [isEmpty("day_end"), ".day_end"];
		console.log(error);
		if (error.cities[0]) {
			$("#add_city .ree").show();
		}
		if (error.months[0] && $(".months").css("display") != "none") {
			$("#add_interval .ree").show();
		}
		if (error.types[0]) {
			$("#add_type .ree").show();
		}
		if(error.dayStart[0] && $(".calendarWrap").css("display") != "none"){
			$(error.dayStart[1]).addClass("error");
		}
		if(error.dayEnd[0] && $(".calendarWrap").css("display") != "none"){
			$(error.dayEnd[1]).addClass("error");
		}
		$(".add_price_rule input[type=checkbox]").on("change",function(){
			$(this).parent().parent().find(".ree").hide();
		})
		if (((error.months[0]) && (error.dayStart[0]  ||  error.dayEnd[0])) || error.types[0] || error.cities[0]) {
            getPriceRules();
			return false;
		}


    $.when($.ajax({
			url: "/admin/workers/price_add/"+id,
			type: "POST",
			data: $("#rule").serialize(),
            complete: function(result){


                $("#add_type input[type=checkbox]").change();
                $(".unCheckAll").click();

            }
		})).then(function(){
        	getPriceRules();
		});

    	$("#rule")[0].reset();
    	$("#rule label").removeAttr("class");

		return false;
		
	})

	/*ОТПРАВКА БЛЯТЬ ОБНОВЛЕННЫХ ПРАВИЛД ЕБАНАВРОТ*/
    $("#updatePrice.cat4 input[type=submit]").on("click", function(e){
        e.preventDefault();
        $(".price_rules_body").html();
        $("#updatePrice").addClass("loader");
        var idArray = location.href.split("/");
        var id = idArray[idArray.length-1];

        $.ajax({
            url: "/admin/workers/update_pricing/"+id,
            type: "POST",
            data: $("#updatePrice").serialize(),
            complete: function(){
                getPriceRules();
            }
        });


        return false;

    })

	/*БУДАЛЕНИЕ БЛЯДСКИХ ПРАВИЛ*/



	/*СУКА ПОЛУЧИ ПРАВИЛА ВСЕ ТВОЮ МАТЬ*/
	function getPriceRules() {

        var idArray = location.href.split("/");
        var id = idArray[idArray.length-1];
        $.ajax({
            url: "/admin/workers/getRulePrice/"+id,
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            complete: function (data) {
                if (data.responseText === '') {

                    return false;
                }
                var response = JSON.parse(data.responseText);
				$("#updatePrice").removeClass("loader")
                bladePriceRules(response);

            }
        });
    }
	getPriceRules();
    /*ЗАШАБЛОНЬ БЛЯДСКИЕ ПРАВИЛА*/
    function bladePriceRules(response) {
        $(".price_rules_edit_wrap").html("");
    	var rules = response.rules;

    	if(rules.length>0) {

            var tmpl = " <table class='price_rules'><thead><td>№</td><td>Вид</td> <td>Города</td> <td>Даты</td> <td>Цена</td> <td>Залог</td> <td></td></thead> <tbody class='price_rules_body'>";
            for (var i = 0; i < rules.length; i++) {
                tmpl += "<tr>";
                tmpl += "<td>" + (i + 1) + " <input type='hidden' name='price_rule_id[]' value='" + rules[i].id + "'> </td>";
                tmpl += "<td>" + rules[i].view + "</td>";
                tmpl += "<td>" + rules[i].cities + "</td>";
                if (rules[i].months) {
                    tmpl += "<td>" + rules[i].months + "</td><td>";
                }
                else {
                    var suka = JSON.parse(rules[i].date);
                    tmpl += "<td>" + suka[0] + " - " + suka[1] + "</td><td>";
                }
                var price = JSON.parse(rules[i].price);
                if (price[0]) {
                    tmpl += "<div class='flex'><label>День / Вечер</label><input type='text' name='date_price_1_" + rules[i].id + "' class='table_price' value='" + price[0] + "'></div>";
                }
                if (price[1]) {
                    tmpl += "<div class='flex'><label>2 часа</label><input type='text' name='date_price_2_" + rules[i].id + "' class='table_price' value='" + price[1] + "'></div>";
                }
                if (price[2]) {
                    tmpl += "<div class='flex'><label>1 час</label><input type='text' name='date_price_3_" + rules[i].id + "' class='table_price' value='" + price[2] + "'></div>";
                }
                tmpl += "</td><td>";

                var deposit = JSON.parse(rules[i].deposit);
                if (deposit[0]) {
                    tmpl += "<div class='flex'><label>День / Вечер</label><input type='text' name='date_deposit_1_" + rules[i].id + "' class='table_price' value='" + deposit[0] + "'></div>";
                }
                if (deposit[1]) {
                    tmpl += "<div class='flex'><label>2 часа</label><input type='text' name='date_deposit_2_" + rules[i].id + "' class='table_price' value='" + deposit[1] + "'></div>";
                }
                if (deposit[2]) {
                    tmpl += "<div class='flex'><label>1 час</label><input type='text' name='date_deposit_3_" + rules[i].id + "' class='table_price' value='" + deposit[2] + "'></div>";
                }
                tmpl += "</td><td><a href='/admin/workers/removeRulePrice/" + rules[i].id + "' class='delete_rule'>x</a></td></tr>";
            }
            tmpl += "</tbody></table>";
            $(".price_rules_edit_wrap").html(tmpl);

            $(".delete_rule").on("click", function (e) {
                e.preventDefault();
                var href = $(this).attr("href");
                $.ajax({
                    url: href,
                    type: "GET",
                    complete: function () {
                        getPriceRules()
                    }
                });
                return false;

            })

        }
        else {
            var tmp =   '<p class="empty">Пока нет ценовых правил</p>';
            $(".price_rules_edit_wrap").html(tmp);
		}
        return false;

    }

	$(".profile_options_item input[type=checkbox]").on("change",function(){
		$(this).parent().parent().parent().find(".ree").hide();
	})
})

$("input, textarea").on("change",function(){
	$(this).removeClass("error");
})



function isPass() {
	if (!isFull("password",5) && !isFull("password_copy",5)) {
		if ($("#password").val() == $("#password_copy").val()) {
			return false
		}
		else return [true, "Пароли не совпадают"];
	}
	else return true;
}
function isCheck(classNameCheck){
	var arraySing = document.getElementsByClassName(classNameCheck);
	for (var i = 0; i < arraySing.length; i++) {
		if(arraySing[i].checked==true){
			return false;
		}
	}
	return true
}
function isEmpty(classNameCheck){
	var arraySing = document.getElementsByClassName(classNameCheck);
		if(arraySing[0].value.length){
			return false;
		}
		return true
}
function isFull(classNameCheck, leng){
	var arraySing = document.getElementsByClassName(classNameCheck);
		var val = arraySing[0].value;
		val = val.replace(/_/g,"");
		if(val.length >= leng){
			return false;
		}
		return true
}
function check(th){
	var className = ".service_" + th.attr("id");
	if (th.is(":checked")) {
		$(className).slideDown(200);	}
	else{
		$(className).slideUp(200);
	}
}
$("#add_type input[type=checkbox]").on("change",function(){
	check($(this));
})


$(".titles").on("click", function(){
	var id = "." + $(this).attr("id");
	$(".titlebody").hide();
	$(".titles").removeClass("active");
	$(this).addClass("active");
	$(id).fadeIn();
	$(".months input[type=checkbox]").prop('checked', false);
    $(".months label").removeClass("check");
	$(".day_end, .day_start").removeClass("error").val("");
    $("#add_interval .ree").slideUp();

})

$("#save_changes").on("click",function(e) {
		e.preventDefault();
		var idArray = location.href.split("/");
		var id = idArray[idArray.length-1];
		var media = [];
		var audio = [];
		var m = document.getElementById("video_options");
		var a = document.getElementById("audio_options");
		var arrayMedia = (m) ? m.getElementsByClassName("item") : false;
		var arrayAudio = (a) ? a.getElementsByClassName("item") : false;
		if (arrayMedia.length) {
			for (var i = 0; i < arrayMedia.length; i++) {
			    var mediaObject = new Object();
                mediaObject.type = arrayMedia[i].getAttribute("data-type");
                mediaObject.src = arrayMedia[i].getAttribute("data-src");
                if(mediaObject.type == "video"){
                    mediaObject.poster = arrayMedia[i].getAttribute("data-poster");
                }
                media[i] = mediaObject;
			}
		}
		if (arrayAudio.length) {
            for (var i = 0; i < arrayAudio.length; i++) {
                var audioObject = new Object();
                audioObject.name = arrayAudio[i].getAttribute("data-name");
                audioObject.link = arrayAudio[i].getAttribute("data-link");
                audio[i] = audioObject;
            }
		}


		
		/*console.log("media");
		console.log(media);
		console.log("audio");
		console.log(audio);*/
		$.ajax({
		  url: "/admin/workers/updateportfolio/"+id,
		  type: "GET",
		  data: {media: media, audio : audio},
		  success: function(data){

		  }
		});
		return false;
})

$(".item.img").on("mouseleave", function () {
    $(".imgAva").removeClass("hover");
})

$(".imgAva").on("click",function () {
    $(this).addClass("hover");
    var src = $(this).parent().data("src");
    var idArray = location.href.split("/");
    var id = idArray[idArray.length-1];
    $(".avaImg").html("Сделать аватаркой").attr("class","imgAva");
    $(this).html("Аватарка").attr("class","avaImg");
    $.ajax({
        url: "/admin/workers/addava/"+id,
        type: "GET",
        data: {logoAva: src},
        success: function(data){
			$(".ava img").attr("src", src);


        }
    });
})

