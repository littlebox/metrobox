$('*[data-click="show-sign-up"]').on('click', showSignUp);
$('*[data-click="show-sign-in"]').on('click', showSignIn);
$('.btn-rb-switch').on('click', toggleActive);

$('.bebusca-authentication-form .dialog-container').on('click',function (e){
	var container = $('.bebusca-authentication-form .dialog');

	if (!container.is(e.target) // if the target of the click isn't the container...
		&& container.has(e.target).length === 0) // ... nor a descendant of the container
	{
		hideDialogContainer();
	}
});

function showSignUp(){
	$('#bebusca-signup-form').removeClass('hidden');
	setTimeout(function(){
		$('#bebusca-signup-form .dialog-container').addClass('show');
		$('#bebusca-signup-form .dialog').addClass('show');
	},1);
}

function showSignIn(){
	$('#bebusca-login-form').removeClass('hidden');
	setTimeout(function(){
		$('#bebusca-login-form .dialog-container').addClass('show');
		$('#bebusca-login-form .dialog').addClass('show');
	},1);
}

function hideDialogContainer(){
	$('.bebusca-authentication-form .dialog-container').removeClass('show');
	$('.bebusca-authentication-form .dialog').removeClass('show');
	setTimeout(function(){
		$('.bebusca-authentication-form').addClass('hidden');
	},250);
}

function toggleActive(){
	$(this).toggleClass('active');
}

