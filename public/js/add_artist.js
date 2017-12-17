window.addEventListener("load", function(){

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
		error.password = [isPass(), ".password, .password_copy"];
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
				$(".options").submit()
			}
			else{
				return false;
			}

	})

$(".add_price_rule input[type=submit]").on("click", function(e){
		//e.preventDefault();
		var error = new Object();
		error.cities= [isCheck("city"), ""];
		error.months = [isCheck("month"), ""];
		error.types = [isCheck("types"), ""];
		error.dayStart = [isEmpty("day_start"), ".day_start"];
		error.dayEnd = [isEmpty("day_end"), ".day_end"];
		if (error.cities[0]) {
			$("#add_city .ree").show();
		}
		if (error.months[0] && $(".months").css("display") != "none") {
			$("#add_interval .ree").show();
		}
		if (error.types[0] && $(".months").css("display") != "none") {
			$("#add_type .ree").show();
		}
		if(error.dayStart[0] && $(".calendarWrap").css("display") != "none"){
			$(error.dayStart[1]).addClass("error");
		}
		if(error.dayEnd[0] && $(".calendarWrap").css("display") != "none"){
			$(error.dayEnd[1]).addClass("error");
		}
		console.log(error);
		$(".add_price_rule input[type=checkbox]").on("change",function(){
			$(this).parent().parent().find(".ree").hide();
		})
		if (error.months[0] && error.types[0]) {
			return false;
		}
		
})

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
	$(id+ " input[type=checkbox]").removeAttr("checked");
	$("#add_interval .ree").slideUp();
	$(".day_end, .day_start").removeClass("error");
})

$("#save_changes").on("click",function(e) {
		e.preventDefault();

		var media = new Object();
		var audio = new Object();
		var m = document.getElementById("video_options");
		var a = document.getElementById("audio_options");
		var arrayMedia = (m) ? m.getElementsByClassName("item") : false;
		var arrayAudio = (a) ? a.getElementsByClassName("item") : false;
		if (arrayMedia.length) {
			for (var i = 0; i < arrayMedia.length; i++) {
				media[i] = new Object();
				media[i].id = arrayMedia[i].getAttribute("data-itemId");
				media[i].type = arrayMedia[i].getAttribute("class").replace("item ","");
			}
		}
		if (arrayAudio.length) {
			for (var i = 0; i < arrayAudio.length; i++) {
				audio[i] = new Object();
				audio[i].id = arrayAudio[i].getAttribute("data-itemId");
				audio[i].type = "audio";
			}
		}
		
		console.log("media");
		console.log(media);
		console.log("audio");
		console.log(audio);
		$.ajax({
		  url: "#",
		  type: "POST",
		  data: {media: media, audio : audio},
		  success: function(data){
		  
		  }
		});
		return false;
})