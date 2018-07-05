jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.cd-signin');

	//открыть модальное окно
	$main_nav.on('click', function(event){
		
			$form_modal.addClass('is-visible');	
			//показать выбранную форму
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		

	});

	//закрыть модальное окно
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//закрыть модальное окно нажатье клавиши Esc 
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//переключения  вкладки от одной к другой
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	//скрыть или показать пароль
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( 'Скрыть' == $this.text() ) ? $this.text('Показать') : $this.text('Скрыть');
		//фокус и перемещение курсора в конец поля ввода
		$password_field.putCursorAtEnd();
	});

	//показать форму востановления пароля 
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//Вернуться на страницу входа с формы востановления пароля
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	//при желании можно отключить - это просто, сообщения об ошибках при заполнении
	/*$form_login.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});
	$form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});*/


	//запасной placeholder для IE9
	//credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
		  	}
		}).blur(function() {
		 	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  	$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
			 		input.val('');
				}
		  	})
		});
	}

});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});



};

 $(".tel1").inputmask("+7 999-999-99-99");

 $(".tel2").inputmask("+7 999-999-99-99");

 $(".tel3").inputmask("+7 999-999-99-99");

$("#step1").on("click",function(e){
	e.preventDefault();
	var tel = $("#signup-tel").val();
	
	if ((tel.length == 16) && (tel.indexOf('_') == -1)) {
		$(".step1").slideUp();
		$(".step2").slideDown();
	}
	else{
		$("#signup-tel").toggleClass('has-error').next('span').toggleClass('is-visible');
		$("#signup-tel").keypress(function(){
			$("#signup-tel").removeClass('has-error').next('span').removeClass('is-visible');
		})
	}
		
		
	return false;
})

$("#step2").on("click",function(e){
	e.preventDefault();
		$(".step2").slideUp();
		$(".step3").slideDown();
	return false;
})

$("#step3").on("click",function(e){
	e.preventDefault();
	var pass = $("#signup-password").val();
	if (pass.length >= 6) {
		$(".step3").slideUp();
		$(".step4").slideDown();
	}
	else{
		$("#signup-password").toggleClass('has-error').parent().find('span').toggleClass('is-visible');
		$("#signup-password").keypress(function(){
			$("#signup-password").removeClass('has-error').parent().find('span').removeClass('is-visible');
		})

	}
	return false;
})

$("#res_pass").on("click", function(e){
	e.preventDefault();
	var tel = $("#reset-password").val();
	
	if ((tel.length != 16) || (tel.indexOf('_') != -1)) {
		$("#reset-password").toggleClass('has-error').next('span').toggleClass('is-visible');
		$("#reset-password").keypress(function(){
			$("#reset-password").removeClass('has-error').next('span').removeClass('is-visible');
		})
	}
		
		
	return false;
})

$("#login").on("click", function(e){
	e.preventDefault();
	var tel = $("#signin-tel").val();
	if ((tel.length != 16) || (tel.indexOf('_') != -1)) {
		$("#signin-tel").toggleClass('has-error').next('span').toggleClass('is-visible');
		$("#signin-tel").keypress(function(){
			$("#signin-tel").removeClass('has-error').next('span').removeClass('is-visible');
		})
	}
	var pass = $("#signup-password").val();
	if (pass.length < 6) {
		$("#signin-password").toggleClass('has-error').parent().find('span').toggleClass('is-visible');
		$("#signin-password").keypress(function(){
			$("#signin-password").removeClass('has-error').parent().find('span').removeClass('is-visible');
		})
	}
	return false;
})