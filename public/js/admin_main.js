$(document).ready(function(){
	$("#new_tizer").on("click",function(e){
	e.preventDefault();
	var form      = $("#tizer_form");
	var container = $("#tizer_container")
	var count     = form.attr('data-count-tizer');
	count++;
	var tizer = "<div class='tizer' id='tizer"+count+"' style='display:none'><h5>Tizer"+count+"</h5><div class='flex'><label>Изображение<br><span>Размер 200 на 50</span></label><input type='file' name='tizer_photo"+count+"' accept='image\\/*,image/jpeg'></div><div class='flex'><label>Позиция</label><div class='tizer-pos'><input type='number' name='tizer_pos"+count+"'></div></div><div class='flex'><label>Заголовок</label><input type='text' name='tizer_title"+count+"'></div><div class='flex'><label>Текст</label><textarea name='tizer_text"+count+"' cols='32' rows='8'></textarea></div><input type='hidden' name='tizer_id"+count+"' value=''></div>";
   $.when(container.append(tizer)).then(function(){ 
    	$("#tizer"+count).slideDown(400)
	    	var elem = $("#tizer"+count);
			scrollTo(elem);
	});
	form.attr('data-count-tizer',count);
	$("#tizer_form_count").val(count);
	return false;
	})

$(".tabs").on("click", function(){
		var id = $(this).attr("id");
		$(this).addClass("active");
		$(".tabs").not("#"+id).removeClass("active");
		$(".tabs-body").not("."+id).fadeOut(0, function(){
			$("."+id).fadeIn();
		});
		$("input, textarea").on("change",function(){
			$(this).removeClass("error");
		})
	})

	$('#meneger_phone').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
	});

$(":checkbox").on("change",function(){
	checkboxing($(this));
})

function checkboxing(th){
	if(th.is(":checked")){
		th.siblings("label").addClass("check");
	}
	else{
		th.siblings("label").removeClass("check");
	}
}


$(".checkAll").on("click", function(){
	var id = $(this).data("id");
	$(this).parent().find(".unCheckAll").show();
	$(this).hide();
	$("input[type=checkbox]").prop('checked', 'checked');
	checkboxing($("#" +id+ " input[type=checkbox]"));
	if (id == "add_type") {
		$(".prices").slideDown(200);	
	}
})
$(".unCheckAll").on("click", function(){
	var id = $(this).data("id");
	$(this).hide();
	$(this).parent().find(".checkAll").show();
	$("input[type=checkbox]").prop('checked', false);
	checkboxing($("#" +id+ " input[type=checkbox]"));
	if (id == "add_type") {
		$(".prices").slideUp(200);	
	}
})
})