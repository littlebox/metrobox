<!-- FORMULARIO DE INGRESO -->
<div id="bebusca-login-form" class="bebusca-authentication-form hidden">
	<div class="dialog-container" id="signin-dialog-container" data-remove="remove-dialog-container" data-click="hide-dialog-container">
		<div class="dialog text-center" data-id="signin-dialog" data-remove="remove-dialog"><img src="/bebusca/img/logo/bebusca-big.png" height="50px" class="logo" alt="bebusca logo">
			<h3 class="h5 h5--lg" style="margin-bottom: 20px;">Ingresá a bebusca</h3>
			<button class="btn btn-facebook btn-facebook--login wide" data-click="sign-up-facebook">Ingresá con Facebook</button>
			<div class="input-or-separator" style="margin-top: 15px;">
				<div class="row">
					<div class="col-xs-5" style="padding-right: 0;">
						<hr>
					</div>
					<div class="col-xs-2">
						<div class="input-or">or</div>
					</div>
					<div class="col-xs-5" style="padding-left: 0;">
						<hr>
					</div>
				</div>
			</div>
			<form data-submit="sign-in" method="post">
				<input class="" placeholder="Email" required="" type="email" name="email" value="">
				<input class="" placeholder="Contraseña" required="" type="password" name="password" value="">
				<input type="submit" value="Ingresar" class="btn btn-rb btn-primary">
			</form><a href="/forgot" target="_self" class="btn-rb-link--bright">¿Olvidaste tu contraseña?</a>&nbsp;·&nbsp;<a href="/signup" class="btn-rb-link--bright" data-click="switch-to-sign-up">¿No tenés cuenta? ¡Registrate!</a></div>
	</div>
</div>
<!-- FIN FORMULARIO DE INGRESO -->